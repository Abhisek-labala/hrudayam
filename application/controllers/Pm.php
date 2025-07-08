<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pm extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		if (!$this->session->userdata('pm_id')) {
			redirect(base_url() . '/pm-login');
		}
	}



	public function index()
	{
		if ($this->session->userdata('pm_id')) {
			redirect('pm-dashboard');
		} else {
			redirect('pm-login');
		}
	}


	public function dashBoard()
	{
		//die();
		if (!$this->session->userdata('pm_id')) {
			redirect('pm-login');
		}
		$this->load->view('pm/dashboard');
	}

	public function adminDashBoardTable()
	{
		if (!$this->session->userdata('pm_id')) {
			redirect('pm-login');
		}

		$query = "SELECT * FROM `patient_inquiry_new` WHERE `educator_id`!='' ORDER BY `date` desc";
		$patient_inquiry_Data = $this->master_model->customQueryArray($query);
		$sr = 1;

		$excelData = array();
		$patientInquiryData = array();

		foreach ($patient_inquiry_Data as $key => $item) {

			$educator_id = $item['educator_id'];

			$query = "SELECT * FROM `educator` WHERE `id` = '" . $educator_id . "'";
			$educatorData = $this->master_model->customQueryRow($query);
			$educatorName = $educatorData->first_name;
			$rmId = $educatorData->rm_id;

			$query = "SELECT * FROM `rm_name` WHERE `id` = '" . $rmId . "'";
			$rmNameData = $this->master_model->customQueryRow($query);
			$rmName = $rmNameData->name;

			$gender = ($item['gender'] == 1) ? 'Male' : 'Female';

			$excelData[$sr] = array($sr, $item['date'], $item['patient_name'], $gender, $item['blood_pressure'], $item['bmi'], $educatorName, $rmName, $item['city']);
			$patientInquiryData[] = array('date' => $item['date'], 'patient_name' => $item['patient_name'], 'gender' => $gender, 'blood_pressure' => $item['blood_pressure'], 'bmi' => $item['bmi'], 'educator_name' => $educatorName, 'rm_name' => $rmName, 'city' => $item['city']);

		}

		$fileName = 'hardiyam-' . time() . ".xlsx";

		$viewData['patient_inquiry_Data'] = $patientInquiryData;
		$viewData['fileName'] = $fileName;

		$this->load->view('pm/dashboardTable', $viewData);

		$this->makeXls($excelData, $fileName);
		//die();	
	}


	public function CreateEducator()
	{
		$this->load->view('pm/create-educator');
	}

	public function createEducatorPost()
	{
		// Check session
		if (!$this->session->userdata('pm_id')) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'status' => false,
					'message' => 'Session expired. Please login again.'
				]));
			return;
		}

		// Initialize response
		$response = ['status' => false, 'message' => ''];

		try {
			// Validate required fields
			$required_fields = [
				'first_name',
				'email',
				'password',
				'mobile',
				'city',
				'state',
				'address',
				'emp_id'
			];

			$errors = [];
			$educatorData = [];

			foreach ($required_fields as $field) {
				if (empty($this->input->post($field))) {
					$errors[$field] = ucfirst($field) . " is required.";
				} else {
					$educatorData[$field] = $this->security->xss_clean($this->input->post($field));
				}
			}

			// Validate email format
			if (!filter_var($educatorData['email'], FILTER_VALIDATE_EMAIL)) {
				$errors['email'] = "Invalid email format.";
			}

			// Validate mobile number
			if (!preg_match('/^\d{10}$/', $educatorData['mobile'])) {
				$errors['mobile'] = "Mobile must be 10 digits.";
			}

			// Handle file upload
			$profileImageName = '';
			if (!empty($_FILES['profile_image']['name'])) {
				$config = [
					'upload_path' => './uploads/',
					'allowed_types' => 'jpg|jpeg|png',
					'max_size' => 2048, // 2MB
					'file_name' => md5(time() . $_FILES['profile_image']['name'])
				];

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('profile_image')) {
					$uploadData = $this->upload->data();
					$profileImageName = $uploadData['file_name'];
				} else {
					$errors['profile_image'] = $this->upload->display_errors('', '');
				}
			}

			// Check for errors
			if (!empty($errors)) {
				$response['status'] = false;
				$response['message'] = 'Please correct the errors below.';
				$response['errors'] = $errors;

				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($response));
				return;
			}

			// Hash password
			$educatorData['password'] = password_hash($educatorData['password'], PASSWORD_DEFAULT);

			// Add profile image if uploaded
			if ($profileImageName) {
				$educatorData['profile_image'] = $profileImageName;
			}

			// Save educator data
			$user_id = $this->master_model->save('educator', $educatorData);

			if ($user_id) {
				$response['status'] = true;
				$response['message'] = 'Educator created successfully';
			} else {
				$response['message'] = 'Failed to create educator. Please try again.';
			}

		} catch (Exception $e) {
			log_message('error', 'Educator creation error: ' . $e->getMessage());
			$response['message'] = 'An error occurred. Please try again.';
		}

		// Return JSON response
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function getEducators()
	{
		// Check session
		if (!$this->session->userdata('pm_id')) {
			$this->jsonResponse(['error' => 'Session expired'], 401);
		}

		try {
			// Get JSON input
			$json = file_get_contents('php://input');
			$postData = json_decode($json, true) ?: [];

			// Extract parameters with defaults
			$draw = (int) ($postData['draw'] ?? 0);
			$start = (int) ($postData['start'] ?? 0);
			$length = (int) ($postData['length'] ?? 10);
			$searchValue = trim($postData['search']['value'] ?? '');

			// Ordering
			$orderColumn = (int) ($postData['order'][0]['column'] ?? 0);
			$orderDir = in_array(strtoupper($postData['order'][0]['dir'] ?? 'ASC'), ['ASC', 'DESC'])
				? strtoupper($postData['order'][0]['dir'])
				: 'ASC';

			// Column mapping
			$columns = [
				'educator.id',
				'educator.first_name',
				'educator.email',
				'educator.mobile',
				'educator.city',
				'educator.state',
				'educator.address',
				'rm_name.name'
			];
			$orderBy = $columns[$orderColumn] ?? $columns[0];

			// Base query
			$this->db->select('educator.*, rm_name.name as rm_name')
				->from('educator')
				->join('rm_name', 'rm_name.id = educator.rm_id', 'left');

			// Apply search filter
			if (!empty($searchValue)) {
				$this->db->group_start()
					->like('educator.first_name', $searchValue)
					->or_like('educator.email', $searchValue)
					->or_like('educator.mobile', $searchValue)
					->or_like('educator.city', $searchValue)
					->or_like('educator.state', $searchValue)
					->or_like('educator.address', $searchValue)
					->or_like('rm_name.name', $searchValue)
					->group_end();
			}

			// Get filtered count
			$filteredQuery = clone $this->db;
			$filteredCount = $filteredQuery->count_all_results('', false);

			// Apply ordering and pagination
			$this->db->order_by($orderBy, $orderDir)
				->limit($length, $start);

			$records = $this->db->get()->result();

			// Format response
			$response = [
				'draw' => $draw,
				'recordsTotal' => $this->db->count_all('educator'),
				'recordsFiltered' => $filteredCount,
				'data' => array_map(function ($record) {
					return [
						'id' => $record->id,
						'first_name' => $record->first_name,
						'email' => $record->email,
						'mobile' => $record->mobile,
						'city' => $record->city,
						'state' => $record->state,
						'address' => $record->address,
						'rm' => $record->rm_name ?: 'N/A'
					];
				}, $records)
			];

			$this->jsonResponse($response);

		} catch (Exception $e) {
			log_message('error', 'Educators DataTable Error: ' . $e->getMessage());
			$this->jsonResponse(['error' => 'Server error'], 500);
		}
	}

	// Helper method for JSON responses
	private function jsonResponse($data, $status = 200)
	{
		http_response_code($status);
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}
	// Delete educator
	public function deleteEducator($id)
	{
		// Disable output compression for this response
		if (function_exists('apache_setenv')) {
			@apache_setenv('no-gzip', '1');
		}
		@ini_set('zlib.output_compression', 'Off');

		// Set proper headers
		header('Content-Type: application/json');
		header('Content-Encoding: none');

		$response = ['status' => false, 'message' => ''];

		// Check session
		if (!$this->session->userdata('pm_id')) {
			$response['message'] = 'Session expired';
			echo json_encode($response);
			exit;
		}

		// Validate ID
		if (!is_numeric($id) || $id <= 0) {
			$response['message'] = 'Invalid ID';
			echo json_encode($response);
			exit;
		}

		try {
			$this->db->trans_start();

			// Get educator data
			$educator = $this->db->select('profile_image')
				->where('id', $id)
				->get('educator')
				->row();

			if (!$educator) {
				throw new Exception('Educator not found');
			}

			// Delete profile image
			if (!empty($educator->profile_image)) {
				$file_path = FCPATH . 'uploads/' . $educator->profile_image;
				if (file_exists($file_path)) {
					@unlink($file_path);
				}
			}

			// Delete record
			$this->db->where('id', $id)->delete('educator');

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Database error');
			}

			$response['status'] = true;
			$response['message'] = 'Educator deleted successfully';

		} catch (Exception $e) {
			$this->db->trans_rollback();
			$response['message'] = $e->getMessage();
		}

		// Output without encoding
		die(json_encode($response));
	}
	public function deleteDoctor($id)
	{
		// Disable output compression for this response
		if (function_exists('apache_setenv')) {
			@apache_setenv('no-gzip', '1');
		}
		@ini_set('zlib.output_compression', 'Off');

		// Set proper headers
		header('Content-Type: application/json');
		header('Content-Encoding: none');

		$response = ['status' => false, 'message' => ''];

		// Check session
		if (!$this->session->userdata('pm_id')) {
			$response['message'] = 'Session expired';
			echo json_encode($response);
			exit;
		}

		// Validate ID
		if (!is_numeric($id) || $id <= 0) {
			$response['message'] = 'Invalid ID';
			echo json_encode($response);
			exit;
		}

		try {
			$this->db->trans_start();

			// Delete record
			$this->db->where('id', $id)->delete('doctors_new');

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Database error');
			}

			$response['status'] = true;
			$response['message'] = 'Educator deleted successfully';

		} catch (Exception $e) {
			$this->db->trans_rollback();
			$response['message'] = $e->getMessage();
		}

		// Output without encoding
		die(json_encode($response));
	}
	public function deleteRM($id)
	{
		// Disable output compression for this response
		if (function_exists('apache_setenv')) {
			@apache_setenv('no-gzip', '1');
		}
		@ini_set('zlib.output_compression', 'Off');

		// Set proper headers
		header('Content-Type: application/json');
		header('Content-Encoding: none');

		$response = ['status' => false, 'message' => ''];

		// Check session
		if (!$this->session->userdata('pm_id')) {
			$response['message'] = 'Session expired';
			echo json_encode($response);
			exit;
		}

		// Validate ID
		if (!is_numeric($id) || $id <= 0) {
			$response['message'] = 'Invalid ID';
			echo json_encode($response);
			exit;
		}

		try {
			$this->db->trans_start();

			// Delete record
			$this->db->where('id', $id)->delete('rm_name');

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Database error');
			}

			$response['status'] = true;
			$response['message'] = 'Educator deleted successfully';

		} catch (Exception $e) {
			$this->db->trans_rollback();
			$response['message'] = $e->getMessage();
		}

		// Output without encoding
		die(json_encode($response));
	}

	public function createDoctor()
	{
		$this->load->view('pm/create-doctor');
	}

	public function createDoctorPost()
	{

		if (!$this->session->userdata('pm_id')) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'status' => false,
					'message' => 'Session expired. Please login again.'
				]));
			return;
		}

		// Initialize response
		$response = ['status' => false, 'message' => ''];

		try {
			// Validate required fields
			$required_fields = [
				'name',
				'msl_code',
				'zone',
				'speciality',
				'first_vist',
				'city',
				'state'
			];

			$errors = [];
			$educatorData = [];

			foreach ($required_fields as $field) {
				if (empty($this->input->post($field))) {
					$errors[$field] = ucfirst($field) . " is required.";
				} else {
					$educatorData[$field] = $this->security->xss_clean($this->input->post($field));
				}
			}

			// Check for errors
			if (!empty($errors)) {
				$response['status'] = false;
				$response['message'] = 'Please correct the errors below.';
				$response['errors'] = $errors;

				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($response));
				return;
			}

			// Save educator data
			$user_id = $this->master_model->save('doctors_new', $educatorData);

			if ($user_id) {
				$response['status'] = true;
				$response['message'] = 'Doctor created successfully';
			} else {
				$response['message'] = 'Failed to create doctor. Please try again.';
			}

		} catch (Exception $e) {
			log_message('error', 'Doctor creation error: ' . $e->getMessage());
			$response['message'] = 'An error occurred. Please try again.';
		}

		// Return JSON response
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));

	}

	public function getDoctors()
	{
		// Check session
		if (!$this->session->userdata('pm_id')) {
			$this->jsonResponse(['error' => 'Session expired'], 401);
		}

		try {
			// Get JSON input
			$json = file_get_contents('php://input');
			$postData = json_decode($json, true) ?: [];

			// Extract parameters with defaults
			$draw = (int) ($postData['draw'] ?? 0);
			$start = (int) ($postData['start'] ?? 0);
			$length = (int) ($postData['length'] ?? 10);
			$searchValue = trim($postData['search']['value'] ?? '');

			// Ordering
			$orderColumn = (int) ($postData['order'][0]['column'] ?? 0);
			$orderDir = in_array(strtoupper($postData['order'][0]['dir'] ?? 'ASC'), ['ASC', 'DESC'])
				? strtoupper($postData['order'][0]['dir'])
				: 'ASC';

			// Column mapping
			$columns = [
				'doctors_new.id',
				'doctors_new.name',
				'doctors_new.msl_code',
				'doctors_new.zone',
				'doctors_new.city',
				'doctors_new.state',
				'doctors_new.first_vist',
				'doctors_new.speciality',
				'educator.first_name'
			];
			$orderBy = $columns[$orderColumn] ?? $columns[0];

			// Base query
			$this->db->select('doctors_new.*, educator.first_name as first_name,zones.name as zone_name')
				->from('doctors_new')
				->join('educator', 'educator.id = doctors_new.educator_id', 'left')
				->join('zones', 'zones.id = doctors_new.zone', 'left');

			// Apply search filter
			if (!empty($searchValue)) {
				$this->db->group_start()
					->like('doctors_new.name', $searchValue)
					->or_like('doctors_new.msl_code', $searchValue)
					->or_like('doctors_new.zone', $searchValue)
					->or_like('doctors_new.city', $searchValue)
					->or_like('doctors_new.state', $searchValue)
					->or_like('doctors_new.first_vist', $searchValue)
					->or_like('doctors_new.speciality', $searchValue)
					->or_like('educator.first_name', $searchValue)
					->group_end();
			}

			// Get filtered count
			$filteredQuery = clone $this->db;
			$filteredCount = $filteredQuery->count_all_results('', false);

			// Apply ordering and pagination
			$this->db->order_by($orderBy, $orderDir)
				->limit($length, $start);

			$records = $this->db->get()->result();
			$response = [
				'draw' => $draw,
				'recordsTotal' => $this->db->count_all('doctors_new'),
				'recordsFiltered' => $filteredCount,
				'data' => array_map(function ($record) {
					return [
						'id' => $record->id,
						'name' => $record->name,
						'msl_code' => $record->msl_code,
						'zone' => $record->zone_name,
						'city' => $record->city,
						'state' => $record->state,
						'speciality' => $record->speciality,
						'first_vist' => $record->first_vist,
						'first_name' => $record->first_name ?: 'N/A',
					];
				}, $records)
			];

			$this->jsonResponse($response);

		} catch (Exception $e) {
			log_message('error', 'Educators DataTable Error: ' . $e->getMessage());
			$this->jsonResponse(['error' => 'Server error'], 500);
		}
	}


	public function getcities()
	{
		if (ob_get_length()) {
			ob_end_clean();
		}

		// Disable PHP output compression if enabled (optional but recommended)
		ini_set('zlib.output_compression', 'Off');

		header('Content-Type: application/json; charset=UTF-8');
		$stateName = $this->input->post('state'); // expecting state name, e.g. 'Andaman and Nicobar Islands'


		if (!empty($stateName)) {
			$this->db->select('c.city_name');
			$this->db->from('all_cities c');
			$this->db->join('state_list s', 's.id = c.state_code');
			$this->db->where('s.state', $stateName);
			$this->db->order_by('c.city_name', 'ASC');
			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				$cities = [];
				foreach ($query->result() as $row) {
					$cities[] = $row->city_name;
				}

				echo json_encode([
					'status' => 'success',
					'cities' => $cities
				]);
			} else {
				echo json_encode(['status' => 'no_data', 'message' => 'No cities found']);
			}
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid state name']);
		}
		exit;
	}
	public function getZones()
	{
		if (ob_get_length()) {
			ob_end_clean();
		}

		ini_set('zlib.output_compression', 'Off');

		header('Content-Type: application/json; charset=UTF-8');

		$this->db->select('c.name, c.id');
		$this->db->from('zones c');
		$this->db->order_by('c.id', 'ASC');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$zones = [];
			foreach ($query->result() as $row) {
				$zones[] = ['id' => $row->id, 'name' => $row->name];
			}

			echo json_encode([
				'status' => 'success',
				'zones' => $zones
			]);
		} else {
			echo json_encode(['status' => 'no_data', 'message' => 'No zones found']);
		}

		exit;
	}




	public function createRm()
	{
		$this->load->view('pm/create-rm');
	}
	public function getRm()
	{
		// Check session
		if (!$this->session->userdata('pm_id')) {
			$this->jsonResponse(['error' => 'Session expired'], 401);
		}

		try {
			// Get JSON input
			$json = file_get_contents('php://input');
			$postData = json_decode($json, true) ?: [];

			// Extract parameters with defaults
			$draw = (int) ($postData['draw'] ?? 0);
			$start = (int) ($postData['start'] ?? 0);
			$length = (int) ($postData['length'] ?? 10);
			$searchValue = trim($postData['search']['value'] ?? '');

			// Ordering
			$orderColumn = (int) ($postData['order'][0]['column'] ?? 0);
			$orderDir = in_array(strtoupper($postData['order'][0]['dir'] ?? 'ASC'), ['ASC', 'DESC'])
				? strtoupper($postData['order'][0]['dir'])
				: 'ASC';

			// Column mapping
			$columns = [
				'rm_name.id',
				'rm_name.name',
				'rm_name.username',
				'zones.name',
			];
			$orderBy = $columns[$orderColumn] ?? $columns[0];

			// Base query
			$this->db->select('rm_name.*, zones.name as zone_name')
				->from('rm_name')
				->join('zones', 'zones.id = rm_name.zone_id', 'left');

			// Apply search filter
			if (!empty($searchValue)) {
				$this->db->group_start()
					->like('rm_name.name', $searchValue)
					->or_like('rm_name.username', $searchValue)
					->group_end();
			}

			// Get filtered count
			$filteredQuery = clone $this->db;
			$filteredCount = $filteredQuery->count_all_results('', false);

			// Apply ordering and pagination
			$this->db->order_by($orderBy, $orderDir)
				->limit($length, $start);

			$records = $this->db->get()->result();
			$response = [
				'draw' => $draw,
				'recordsTotal' => $this->db->count_all('rm_name'),
				'recordsFiltered' => $filteredCount,
				'data' => array_map(function ($record) {
					return [
						'id' => $record->id,
						'name' => $record->name,
						'username' => $record->username,
						'zone' => $record->zone_name,
					];
				}, $records)
			];

			$this->jsonResponse($response);

		} catch (Exception $e) {
			log_message('error', 'Educators DataTable Error: ' . $e->getMessage());
			$this->jsonResponse(['error' => 'Server error'], 500);
		}
	}
	public function createRmPost()
{
    // Check session
    if (!$this->session->userdata('pm_id')) {
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => false,
                'message' => 'Session expired. Please login again.'
            ]));
    }

    // Initialize response
    $response = ['status' => false, 'message' => '', 'errors' => []];

    try {
        // Validate required fields
        $required_fields = [
            'name' => 'name',
            'password' => 'password',
            'zone_id' => 'zone_id'
        ];
		
        $errors = [];
        $educatorData = [];

        foreach ($required_fields as $field => $display_name) {
            if (empty($this->input->post($field))) {
                $errors[$field] = $display_name . " is required.";
            } else {
                $educatorData[$field] = $this->security->xss_clean($this->input->post($field));
            }
        }

        // Check for errors
        if (!empty($errors)) {
            $response['errors'] = $errors;
            $response['message'] = 'Please correct the errors below.';
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }

        // Generate username from name
        $name = $educatorData['name'];
        $username = $this->generateUsername($name);
		
        $educatorData['password'] = password_hash($educatorData['password'], PASSWORD_DEFAULT);
        
        // Add generated username and timestamp
        $educatorData['username'] = $username;
        // Save RM data
        $user_id = $this->master_model->save('rm_name', $educatorData);

        if ($user_id) {
            $response['status'] = true;
            $response['message'] = 'RM created successfully';
            $response['username'] = $username; // Return the generated username
        } else {
            throw new Exception('Database save operation failed');
        }

    } catch (Exception $e) {
        log_message('error', 'RM creation error: ' . $e->getMessage());
        $response['message'] = 'An error occurred: ' . $e->getMessage();
    }

    // Return JSON response
    return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
}

/**
 * Generate username from name by removing spaces and adding random digits
 */
private function generateUsername($name)
{
    // Remove all spaces and special characters, convert to lowercase
    $cleanName = preg_replace('/[^A-Za-z0-9]/', '', $name);
    
    // Generate 5 random digits
    $randomDigits = mt_rand(10000, 99999);
    
    // Combine and return
    return strtolower($cleanName) . $randomDigits;
}
	public function createDistrictManagerPost()
	{

		if (!$this->session->userdata('pm_id')) {
			redirect('pm-login');
		}

		if (isset($_POST['submit'])) {
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$mobile = $_POST['mobile'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$first_vist = $_POST['address'];
			$about = $_POST['about'];
			$profile_image = $_POST['profile_image'];


			// Required fields
			$required_fields = array('first_name', 'last_name', 'email', 'password', 'mobile', 'city', 'state', 'address', 'about');
			$errors = array();

			// Validate required fields
			foreach ($required_fields as $field) {
				if (empty($_POST[$field])) {
					$errors[] = ucfirst($field) . " is required.";
				} else {
					$field = sanitize_input($_POST[$field]);
				}
			}


			// Handle file upload if exists
			$profileImageName = '';
			if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
				$fileTmpPath = $_FILES['profile_image']['tmp_name'];
				$fileName = $_FILES['profile_image']['name'];
				$fileSize = $_FILES['profile_image']['size'];
				$fileType = $_FILES['profile_image']['type'];
				$fileNameCmps = explode(".", $fileName);
				$fileExtension = strtolower(end($fileNameCmps));

				//$allowedfileExtensions = array('jpg', 'jpeg', 'png');
				$allowedfileExtensions = imageExtensionAllow();

				if (in_array($fileExtension, $allowedfileExtensions)) {
					$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
					$uploadFileDir = './uploads/';
					$dest_path = $uploadFileDir . $newFileName;

					/*if (!is_dir($uploadFileDir)) {
						mkdir($uploadFileDir, 0777, true);
					}*/

					if (move_uploaded_file($fileTmpPath, $dest_path)) {
						$profileImageName = $newFileName;
					} else {
						$errors[] = "There was an error uploading the file.";
					}
				} else {
					$errors[] = "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
				}
			}

			if (!empty($errors)) {
				foreach ($errors as $error) {
					echo "<p style='color:red;'>$error</p>";
				}
				exit;
			}

			$managerData = array();
			$managerData['first_name'] = $first_name;
			$managerData['last_name'] = $last_name;
			$managerData['email'] = $email;
			$managerData['password'] = $password;
			$managerData['mobile'] = $mobile;
			$managerData['city'] = $city;
			$managerData['state'] = $state;
			$managerData['address'] = $address;
			$managerData['about'] = $about;
			if ($profileImageName) {
				$educatorData['profile_image'] = $profileImageName;
			}
			$user_id = $this->master_model->save('district_managers', $managerData);
			unset($managerData);

			if ($user_id) {
				$this->session->set_flashdata('message', 'District manager create successfully');
			}

			redirect(base_url() . '/Create-District-Manager');

		}

	}



	public function createZoneManager()
	{
		$this->load->view('pm/create-zone-manager');
	}

	public function createZoneManagerPost()
	{

		if (!$this->session->userdata('pm_id')) {
			redirect('pm-login');
		}

		if (isset($_POST['submit'])) {
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$mobile = $_POST['mobile'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$address = $_POST['address'];
			$about = $_POST['about'];
			$profile_image = $_POST['profile_image'];


			// Required fields
			$required_fields = array('first_name', 'last_name', 'email', 'password', 'mobile', 'city', 'state', 'address', 'about');
			$errors = array();

			// Validate required fields
			foreach ($required_fields as $field) {
				if (empty($_POST[$field])) {
					$errors[] = ucfirst($field) . " is required.";
				} else {
					$field = sanitize_input($_POST[$field]);
				}
			}


			// Handle file upload if exists
			$profileImageName = '';
			if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
				$fileTmpPath = $_FILES['profile_image']['tmp_name'];
				$fileName = $_FILES['profile_image']['name'];
				$fileSize = $_FILES['profile_image']['size'];
				$fileType = $_FILES['profile_image']['type'];
				$fileNameCmps = explode(".", $fileName);
				$fileExtension = strtolower(end($fileNameCmps));

				//$allowedfileExtensions = array('jpg', 'jpeg', 'png');
				$allowedfileExtensions = imageExtensionAllow();

				if (in_array($fileExtension, $allowedfileExtensions)) {
					$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
					$uploadFileDir = './uploads/';
					$dest_path = $uploadFileDir . $newFileName;

					/*if (!is_dir($uploadFileDir)) {
						mkdir($uploadFileDir, 0777, true);
					}*/

					if (move_uploaded_file($fileTmpPath, $dest_path)) {
						$profileImageName = $newFileName;
					} else {
						$errors[] = "There was an error uploading the file.";
					}
				} else {
					$errors[] = "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
				}
			}

			if (!empty($errors)) {
				foreach ($errors as $error) {
					echo "<p style='color:red;'>$error</p>";
				}
				exit;
			}

			$managerData = array();
			$managerData['first_name'] = $first_name;
			$managerData['last_name'] = $last_name;
			$managerData['email'] = $email;
			$managerData['password'] = $password;
			$managerData['mobile'] = $mobile;
			$managerData['city'] = $city;
			$managerData['state'] = $state;
			$managerData['address'] = $address;
			$managerData['about'] = $about;
			if ($profileImageName) {
				$educatorData['profile_image'] = $profileImageName;
			}
			$user_id = $this->master_model->save('zone_managers', $managerData);
			unset($managerData);

			if ($user_id) {
				$this->session->set_flashdata('message', 'Zone manager create successfully');
			}

			redirect(base_url() . '/Create-Zone-Manager');

		}

	}



	public function assignEducatorView()
	{
		$this->load->view('pm/assign-educator-view');
	}
	public function assignHcpView()
	{
		$this->load->view('pm/assign-hcp-view');
	}


	public function pmassignEducatorPost()
{
	if (ob_get_contents()) ob_clean();
    header('Content-Type: application/json');
    header('Content-Encoding: identity');
    $educator_id = $this->input->post('educator_id');
    $rm_id = $this->input->post('rm_id');
    
    // Validate inputs
    if (empty($educator_id)){
        $this->jsonResponse(['success' => false, 'message' => 'Please select an educator']);
        return;
    }
    
    // Prepare update data
    $update_data = [
        'rm_id' => $rm_id == 0 ? NULL : $rm_id,
        'update_at' => date('Y-m-d H:i:s')
    ];
    
    // Update educator record
    $this->db->where('id', $educator_id);
    $result = $this->db->update('educator', $update_data);
    // echo $result;die;
    if ($result) {
        $message = ($rm_id == NULL) 
            ? 'Educator successfully unassigned from RM' 
            : 'Educator successfully assigned to RM';
        $this->jsonResponse(['success' => true, 'message' => $message]);
    } else {
        $this->jsonResponse(['success' => false, 'message' => 'Failed to assign educator']);
    }
}
	public function pmassignHcpPost()
{
	if (ob_get_contents()) ob_clean();
    header('Content-Type: application/json');
    header('Content-Encoding: identity');
    $educator_id = $this->input->post('educator_id');
    $hcp_id = $this->input->post('hcp_id');
    
    // Validate inputs
    if (empty($educator_id)){
        $this->jsonResponse(['success' => false, 'message' => 'Please select an educator']);
        return;
    }
    
    // Prepare update data
    $update_data = [
        'educator_id' => $educator_id == 0 ? NULL : $educator_id,
        'update_at' => date('Y-m-d H:i:s')
    ];
    
    // Update educator record
    $this->db->where('id', $hcp_id);
    $result = $this->db->update('doctors_new', $update_data);
    // echo $result;die;
    if ($result) {
        $message = ($hcp_id == NULL) 
            ? 'Educator successfully unassigned from RM' 
            : 'Educator successfully assigned to RM';
        $this->jsonResponse(['success' => true, 'message' => $message]);
    } else {
        $this->jsonResponse(['success' => false, 'message' => 'Failed to assign educator']);
    }
}
	public function mapEducatorToDoctorView()
	{
		$this->load->view('pm/map-edcator-to-doctor-view');
	}


	public function mapEducatorToDoctorPost()
	{
		//pr($_POST);

		//$_POST['mapFrom'];
		//$doctorIds = $_POST['doctorIds'];

		$mapTo = $_POST['mapTo'];
		if ($mapTo != '') {
			if (isset($_POST['doctorIds'])) {
				$doctorIds = $_POST['doctorIds'];
				$count = count($doctorIds);
				if ($count == 0) {
					$this->session->set_flashdata('error', 'Please Select At one Dotctor To Map');
					redirect(base_url() . '/Map-Educator-To-Doctor');
					die();
				}


				foreach ($doctorIds as $key => $doctorItem) {
					$mapArray = array();
					$mapArray['id'] = $doctorItem;
					$mapArray['educator_id'] = $mapTo;
					//pr($mapArray);
					//die();			
					$row = $this->master_model->save('doctors', $mapArray);
					unset($mapArray);
				}


				$this->session->set_flashdata('message', 'Map Successfully');
				redirect(base_url() . '/Map-Educator-To-Doctor');
				die();
			} else {
				$this->session->set_flashdata('error', 'Please Select At one Dotctor To Map');
				redirect(base_url() . '/Map-Educator-To-Doctor');
				die();
			}
		} else {
			$this->session->set_flashdata('error', 'Educator Not Select');
			redirect(base_url() . '/Map-Educator-To-Doctor');
		}

	}

	public function getDoctorByEducator()
	{
		$educatorId = trim($_POST['EducatorId']);
		$mapEdcuatorName = trim($_POST['MapEducatorName']);

		/*$EducatorDetails =  getEducatorDetails($educatorId);
		$mapEdcuatorName= "";	
		if($EducatorDetails['educatorData']){
			$first_name = $EducatorDetails['educatorData']->first_name;
			$last_name  = $EducatorDetails['educatorData']->last_name;
			$mapEdcuatorName= $first_name.' '.$last_name;
		}*/

		if ($educatorId == 'all') {
			$doctorsData = getAllDoctor();
		} else {
			$doctorsData = getDoctorByEducator($educatorId);
		}

		$doctorsData = $doctorsData['doctorsData'];


		//pr($doctorsData);
		//die();

		if ($doctorsData) {
			?>
			<div>
				<div style="margin:5px;"> <label> Doctors </label> </div>

				<table id="myTable" class="display">
					<thead>
						<tr>
							<th>Sr </th>
							<th>Select </th>
							<th>Name</th>
							<th>Educator</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sr = 1;
						$doctorIds = array();
						foreach ($doctorsData as $doctorsItem) {
							//pr($doctorsItem);
							$doctorName = $doctorsItem['first_name'] . ' ' . $doctorsItem['last_name'];
							$doctorId = $doctorsItem['id'];
							//die();
							?>
							<tr>
								<td><?php echo $sr; ?></td>
								<td>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="doctorIds[]" value="<?php echo $doctorId; ?>">
										</label>
									</div>
								</td>
								<td><?php echo $doctorName; ?></td>
								<td><?php echo $mapEdcuatorName; ?></td>
							</tr>
							<?php $sr++;
						} ?>
					</tbody>
				</table>
			</div>
			<?php
		}
		die();
	}


	public function assignDistrictManagerView()
	{
		$this->load->view('pm/assign-district-manager-view');
	}


	public function assignDistrictManagerPost()
	{
		//pr($_POST); 

		//$_POST['mapFrom'];
		//$doctorIds = $_POST['doctorIds'];

		$mapTo = $_POST['mapTo'];
		if ($mapTo != '') {
			if (isset($_POST['managerId'])) {
				$doctorIds = $_POST['managerId'];
				$count = count($doctorIds);
				if ($count == 0) {
					$this->session->set_flashdata('error', 'Please Select At one Manager To Map');
					redirect(base_url() . '/Assign-District-Manager');
					die();
				}


				foreach ($doctorIds as $key => $doctorItem) {
					$mapArray = array();
					$mapArray['id'] = $doctorItem;
					$mapArray['zonal_manager_id'] = $mapTo;
					//pr($mapArray);
					//die();			
					$row = $this->master_model->save('district_managers', $mapArray);
					unset($mapArray);
				}


				$this->session->set_flashdata('message', 'Map Successfully');
				redirect(base_url() . '/Assign-District-Manager');
				die();
			} else {
				$this->session->set_flashdata('error', 'Please Select At one Dotctor To Map');
				redirect(base_url() . '/Assign-District-Manager');
				die();
			}
		} else {
			$this->session->set_flashdata('error', 'Manager Not Select');
			redirect(base_url() . '/Assign-District-Manager');
		}

	}


	public function getManagerByzone()
	{
		$zoneId = trim($_POST['zoneId']);
		$mapMapzoneName = trim($_POST['MapzoneName']);

		$zoneManagerData = getDistrictManagerByZone($zoneId);
		$zoneManagerData = $zoneManagerData['zoneManagerData'];


		//pr($zoneManagerData);
		//die();

		if ($zoneManagerData) {
			?>
			<div>
				<div style="margin:5px;"> <label> Distric Manager </label> </div>

				<table id="myTable" class="display">
					<thead>
						<tr>
							<th>Sr </th>
							<th>Select </th>
							<th>Name</th>
							<th>Zone Manager</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sr = 1;
						$zoneManagerIds = array();
						foreach ($zoneManagerData as $zoneManagerItem) {
							//pr($doctorsItem);
							$managerName = $zoneManagerItem['first_name'] . ' ' . $zoneManagerItem['last_name'];
							$managerId = $zoneManagerItem['id'];
							//die();
							?>
							<tr>
								<td><?php echo $sr; ?></td>
								<td>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="managerId[]" value="<?php echo $managerId; ?>">
										</label>
									</div>
								</td>
								<td><?php echo $managerName; ?></td>
								<td><?php echo $mapMapzoneName; ?></td>
							</tr>
							<?php $sr++;
						} ?>
					</tbody>
				</table>
			</div>
			<?php
		}
		die();
	}



	public function getEducatorByManager()
	{
		$dmId = trim($_POST['DmId']);
		$mapdmName = trim($_POST['DmName']);

		$educatorData = getEducatorByDm($dmId);
		$educatorData = $educatorData['educatorData'];


		//pr($dmManagerData);
		//die();

		if ($educatorData) {
			?>
			<div>
				<div style="margin:5px;"> <label> Educator </label> </div>

				<table id="myTable" class="display">
					<thead>
						<tr>
							<th>Sr </th>
							<th>Select </th>
							<th>Name</th>
							<th>Manager</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sr = 1;
						$dmManagerIds = array();
						foreach ($educatorData as $educatorItem) {
							//pr($doctorsItem);
							$educatorName = $educatorItem['first_name'] . ' ' . $educatorItem['last_name'];
							$educatorId = $educatorItem['id'];
							//die();
							?>
							<tr>
								<td><?php echo $sr; ?></td>
								<td>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="educatorId[]" value="<?php echo $educatorId; ?>">
										</label>
									</div>
								</td>
								<td><?php echo $educatorName; ?></td>
								<td><?php echo $mapdmName; ?></td>
							</tr>
							<?php $sr++;
						} ?>
					</tbody>
				</table>
			</div>
			<?php
		}
		die();
	}



	public function doctorsList()
	{
		$this->load->view('pm/doctors-list');
	}

	public function educatorsList()
	{
		$this->load->view('pm/educators-list');
	}

	public function zoneManagerList()
	{
		$this->load->view('pm/zone-manager-list');
	}

	public function districtManagerList()
	{
		$this->load->view('pm/district-manager-list');
	}

	public function changePassword()
	{
		$this->load->view('pm/change-password');
	}

	public function changePasswordPost()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$oldPassword = $_POST['currentPassword'];
			$newPassword = $_POST['newPassword'];

			if (!$oldPassword) {
				$this->session->set_flashdata('error', 'Old Password Empty');
				redirect(base_url() . '/pm-change-password');
			}

			if (!$newPassword) {
				$this->session->set_flashdata('error', 'New Password Empty');
				redirect(base_url() . '/pm-change-password');
			}

			$adminId = $this->session->userdata('pm_id');

			$query = "SELECT * FROM `admin` WHERE `password`='" . $oldPassword . "' and `id`='" . $adminId . "';";
			$adminData = $this->master_model->customQueryArray($query);

			if ($adminData) {

				$adminData = array();
				$adminData['id'] = $adminId;
				$adminData['password'] = $newPassword;
				$row = $this->master_model->save('admin', $adminData);
				unset($adminData);

				$this->session->set_flashdata('message', 'Password update Successfully');
				redirect(base_url() . '/pm-change-password');

			} else {
				$this->session->set_flashdata('error', 'Password Not Matched');
				redirect(base_url() . '/pm-change-password');
			}


		}
	}










	public function logout()
	{
		$this->session->unset_userdata('pm_id');
		redirect(base_url() . '/pm-login');
	}















































	public function users()
	{

		if (!$this->session->userdata('pm_id')) {
			redirect(base_url() . 'Admin');
		}

		$page = 1;
		if ($_GET['page']) {
			$page = $_GET['page'];
		}

		$user_type = "All";
		if ($_GET['user_type']) {
			$user_type = $_GET['user_type'];
		}

		$sub_query = "";
		if ($user_type != "All") {
			$sub_query .= " AND `Title`='" . $user_type . "' ";
		}

		$service_provider_type = 0;

		if ($_GET['service_provider_type']) {
			$service_provider_type = $_GET['service_provider_type'];
			$sub_query .= " AND `Service_Category`=" . $service_provider_type . " ";
		}

		if ($_GET['search_text']) {
			$search_text = $_GET['search_text'];
			$sub_query .= " AND (`Name` LIKE '%" . $search_text . "%' OR `Email` LIKE '%" . $search_text . "%' OR `Title` LIKE '%" . $search_text . "%' OR `City` LIKE '%" . $search_text . "%' OR `State` LIKE '%" . $search_text . "%' OR `Zipcode` LIKE '%" . $search_text . "%' OR `Company_Name` LIKE '%" . $search_text . "%' OR `Office_Phone` LIKE '%" . $search_text . "%' OR `Website_URL` LIKE '%" . $search_text . "%' )";
		}

		$limit = 20;
		$start = ($page - 1) * $limit;

		$query = "SELECT * FROM `zacres_agent` WHERE  `Title`!='' " . $sub_query . " ORDER BY `id` DESC ";
		$agent_data = $this->master_model->customQueryArray($query);

		$total_count = count($agent_data);
		$pages = ceil($total_count / $limit);

		$query = $query . ' limit ' . $start . ',' . $limit;

		$agent_data = $this->master_model->customQueryArray($query);


		$query = "SELECT * FROM `zacres_users` WHERE  Active=0";
		$inactive_user = $this->master_model->customQueryArray($query);
		$inactive_user_count = count($inactive_user);


		$query = "SELECT * FROM `zacres_users` WHERE  Active=1";
		$active_user = $this->master_model->customQueryArray($query);
		$active_user_count = count($active_user);

		$query = "SELECT * FROM `zacres_users` WHERE  Active=2";
		$block_user = $this->master_model->customQueryArray($query);
		$block_user_count = count($block_user);


		$data = array();
		$data['agent_data'] = $agent_data;
		$data['page'] = $page;
		$data['pages'] = $pages;
		$data['total_count'] = $total_count;
		$data['active_user_count'] = $active_user_count;
		$data['block_user_count'] = $block_user_count;
		$data['inactive_user_count'] = $inactive_user_count;
		$data['service_provider_type'] = $service_provider_type;

		$this->load->view('pm/header');
		$this->load->view('pm/users_list', $data);
		$this->load->view('pm/footer');
	}

	public function properties()
	{
		if (!$this->session->userdata('pm_id')) {
			redirect(base_url() . 'Admin');
		}

		$page = 1;
		if ($_GET['page']) {
			$page = $_GET['page'];
		}

		$sub_query = "";

		if ($_GET['search_text']) {
			$search_text = $_GET['search_text'];
			$sub_query .= " AND ( `Active` LIKE '%" . $search_text . "%' OR `Listing_Title_Name_Name` LIKE '%" . $search_text . "%' OR `Property_Type` LIKE '%" . $search_text . "%' OR `Property_Overview_Price` LIKE '%" . $search_text . "%' OR  `Property_Overview_Acreage` LIKE '%" . $search_text . "%' OR `Property_Address_Street_Name` LIKE '%" . $search_text . "%' OR `Property_Address_City_Name` LIKE '%" . $search_text . "%' OR `Property_Address_State` LIKE '%" . $search_text . "%' OR `Property_Address_Zip_Code` LIKE '%" . $search_text . "%' ) ";
		}

		$limit = 20;
		$start = ($page - 1) * $limit;

		$query = "SELECT * FROM `zacres` WHERE `Active`!='T' AND `Listing_Type`='Listing' " . $sub_query . " ORDER BY `id` DESC ";
		$property_data = $this->master_model->customQueryArray($query);

		$total_count = count($property_data);
		$pages = ceil($total_count / $limit);

		$query = $query . ' limit ' . $start . ',' . $limit;

		$property_data = $this->master_model->customQueryArray($query);


		$data = array();
		$data['property_data'] = $property_data;

		$data['pages'] = $pages;
		$data['total_count'] = $total_count;

		$data['totalData'] = $total_count;
		$data['num_of_record_per_page'] = $limit;
		$data['function'] = 'getUserList';
		$data['page'] = $page;

		$this->load->view('pm/header');
		$this->load->view('pm/property_list', $data);
		$this->load->view('pm/footer');
	}

	public function auctions()
	{
		if (!$this->session->userdata('pm_id')) {
			redirect(base_url() . 'Admin');
		}

		$page = 1;
		if ($_GET['page']) {
			$page = $_GET['page'];
		}

		$sub_query = "";

		if ($_GET['search_text']) {
			$search_text = $_GET['search_text'];
			$sub_query .= " AND ( `Active` LIKE '%" . $search_text . "%' OR `Listing_Title_Name_Name` LIKE '%" . $search_text . "%' OR `Property_Type` LIKE '%" . $search_text . "%' OR `Property_Overview_Price` LIKE '%" . $search_text . "%' OR  `Property_Overview_Acreage` LIKE '%" . $search_text . "%' OR `Property_Address_Street_Name` LIKE '%" . $search_text . "%' OR `Property_Address_City_Name` LIKE '%" . $search_text . "%' OR `Property_Address_State` LIKE '%" . $search_text . "%' OR `Property_Address_Zip_Code` LIKE '%" . $search_text . "%' ) ";
		}

		$limit = 20;
		$start = ($page - 1) * $limit;

		$query = "SELECT * FROM `zacres` WHERE `Active`!='T' AND `Listing_Type`='Auction' " . $sub_query . " ORDER BY `id` DESC ";
		$property_data = $this->master_model->customQueryArray($query);

		$total_count = count($property_data);
		$pages = ceil($total_count / $limit);

		$query = $query . ' limit ' . $start . ',' . $limit;

		$property_data = $this->master_model->customQueryArray($query);

		$data = array();
		$data['property_data'] = $property_data;

		$data['pages'] = $pages;
		$data['total_count'] = $total_count;

		$data['totalData'] = $total_count;
		$data['num_of_record_per_page'] = $limit;
		$data['function'] = 'getUserList';
		$data['page'] = $page;
		$this->load->view('pm/header');
		$this->load->view('pm/auction_list', $data);
		$this->load->view('pm/footer');
	}

	public function contact_us()
	{
		if (!$this->session->userdata('pm_id')) {
			redirect(base_url() . 'Admin');
		}

		$page = 1;
		if ($_GET['page']) {
			$page = $_GET['page'];
		}

		$sub_query = "";
		if ($_GET['search_text']) {
			$search_text = $_GET['search_text'];
			$sub_query .= " AND ( `Name` LIKE '%" . $search_text . "%' OR `Email` LIKE '%" . $search_text . "%' OR `State` LIKE '%" . $search_text . "%' OR `phone` LIKE '%" . $search_text . "%' OR `subject` LIKE '%" . $search_text . "%' ) ";
		}


		$limit = 20;
		$start = ($page - 1) * $limit;

		$query = "SELECT * FROM `contactme` WHERE `Email`!=''  " . $sub_query . " ORDER BY `Ident` DESC  ";
		$contacts_data = $this->master_model->customQueryArray($query);

		$total_count = count($contacts_data);
		$pages = ceil($total_count / $limit);

		$query = $query . ' limit ' . $start . ',' . $limit;

		$contacts_data = $this->master_model->customQueryArray($query);

		$query = "UPDATE `contactme` SET `watch`=1 WHERE 1 ";
		$affected = $this->master_model->query($query);


		$data = array();
		$data['contacts_data'] = $contacts_data;
		$data['page'] = $page;
		$data['pages'] = $pages;
		$data['total_count'] = $total_count;

		$this->load->view('pm/header');
		$this->load->view('pm/contacts_list', $data);
		$this->load->view('pm/footer');
	}

	public function deleteUser()
	{
		$id = $this->input->post('id');

		$flash_arr = array(
			'color' => 'red',
			'message' => 'Error.',
			'status' => 0
		);

		if (!empty($id)) {
			$query = "DELETE FROM `contactme` WHERE `Ident`=" . $id . " ";
			$affected = $this->master_model->query($query);

			if ($affected) {
				$flash_arr = array(
					'color' => 'green',
					'message' => 'Record deleted succesfully.',
					'status' => 1
				);
			}

		}

		echo json_encode($flash_arr);

	}

	public function activeDeactiveUser()
	{
		$uid = $this->input->post('uid');

		$AgentArr = array(
			'uid' => $uid
		);

		$user_data = $this->master_model->getRow('zacres_users', $AgentArr);
		$agent_data = $this->master_model->getRow('zacres_agent', $AgentArr);

		$user_position = $user_data->Active;

		if ($user_position == 1) {

			$data = array(
				'uid' => $uid,
				'Active' => 0
			);

			$agnet_arr = array(
				'id' => $agent_data->id,
				'uid' => $uid,
				'Active' => 'N'
			);



		} else {
			$data = array(
				'uid' => $uid,
				'Active' => 1
			);

			$agnet_arr = array(
				'id' => $agent_data->id,
				'uid' => $uid,
				'Active' => 'Y'
			);

		}

		$row = $this->master_model->save_user('zacres_users', $data);
		$row_agent = $this->master_model->save('zacres_agent', $agnet_arr);

		$main_array = array();
		$json_users_data = array();
		$json_agent_data = array();
		if ($row && $row_agent) {
			$json_users_data = $this->master_model->getRow('zacres_users', $AgentArr);
			$json_agent_data = $this->master_model->getRow('zacres_agent', $AgentArr);
		}


		$main_array['user_row'] = $json_users_data;
		$main_array['agent_row'] = $json_agent_data;

		if ($json_users_data->Active == 1) {
			$message = file_get_contents('https://zacres.com/account_verify_email.html');

			$to_email = $json_users_data->Email_Address;

			$message = str_replace('[email]', $to_email, $message);



			$this->load->library('email');

			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'zacres.com';
			$config['smtp_user'] = 'info@zacres.com';
			$config['smtp_pass'] = 'Li~.fD{3_(*h';
			$config['smtp_port'] = 25;

			$this->email->initialize($config);

			$this->email
				->from('info@zacres.com', 'zacres')
				->to($to_email)
				->subject('Account activation')
				->message($message)
				->set_mailtype('html');
			// send email
			$sent = $this->email->send();

		}

		echo json_encode($main_array);

	}

	public function deleteAccount()
	{
		$uid = $this->input->post('uid');

		$Userarr = array(
			'uid' => $uid,
			'Active' => 2
		);

		$row = $this->master_model->save_user('zacres_users', $Userarr);

		$getAgent = array();
		$getAgent['uid'] = $uid;
		$Agentrow = $this->master_model->getRow('zacres_agent', $getAgent);

		if ($Agentrow) {
			$Agentarr = array(
				'id' => $Agentrow->id,
				'uid' => $uid,
				'Active' => 'T'
			);

			$row_agent = $this->master_model->save('zacres_agent', $Agentarr);
		}


		$flash_arr = array(
			'color' => 'red',
			'message' => 'Error.',
			'status' => 0
		);

		if ($row && $row_agent) {
			$flash_arr = array(
				'color' => 'green',
				'message' => 'Record deleted successfully.',
				'status' => 1
			);
		}

		echo json_encode($flash_arr);

	}

	public function viewUser()
	{
		$uid = $this->uri->segment(3);

		$arr = array(
			'uid' => $uid
		);

		$userRow = $this->master_model->getRow('zacres_users', $arr);
		$agentRow = $this->master_model->getRow('zacres_agent', $arr);

		$data = array();
		$data['userRow'] = $userRow;
		$data['agentRow'] = $agentRow;

		$this->load->view('pm/header');
		$this->load->view('pm/viewUser', $data);
		$this->load->view('pm/footer');
	}

	public function viewContact()
	{

		$id = $this->uri->segment(3);

		$arr = array(
			'Ident' => $id
		);

		$contactRow = $this->master_model->getRow('contactme', $arr);

		$data = array();
		$data['contactRow'] = $contactRow;


		$this->load->view('pm/header');
		$this->load->view('pm/viewContact', $data);
		$this->load->view('pm/footer');
	}

	public function activeDeactiveProperty()
	{
		$pid = $this->input->post('pid');

		$propertyArr = array(
			'id' => $pid
		);

		$property_data = $this->master_model->getRow('zacres', $propertyArr);

		$property_position = $property_data->Active;

		if ($property_position == "N") {
			$data = array(
				'id' => $pid,
				'Active' => "Y"
			);

		} else {
			$data = array(
				'id' => $pid,
				'Active' => "N"
			);



		}

		$row = $this->master_model->save('zacres', $data);

		$main_array = array();
		$json_users_data = array();
		$json_agent_data = array();

		if ($row) {
			$json_property_data = $this->master_model->getRow('zacres', $propertyArr);
		}


		$main_array['property_row'] = $json_property_data;

		echo json_encode($main_array);

	}

	public function deleteProperty()
	{
		$pid = $this->input->post('pid');

		$propertyarr = array(
			'id' => $pid,
			'Active' => "T"
		);

		$row = $this->master_model->save('zacres', $propertyarr);

		$flash_arr = array(
			'color' => 'red',
			'message' => 'Error.',
			'status' => 0
		);

		if ($row) {
			$flash_arr = array(
				'color' => 'green',
				'message' => 'Record deleted successfully.',
				'status' => 1
			);
		}

		echo json_encode($flash_arr);

	}

	public function viewProperty()
	{
		$pid = $this->uri->segment(3);

		$arr = array(
			'id' => $pid
		);

		$propertyRow = $this->master_model->getRow('zacres', $arr);

		$main_photo_data = array();
		$other_photo_data = array();
		$brochure_photo_data = array();
		$video_data = array();
		$agent_data = array();

		if ($propertyRow) {
			$uid = $propertyRow->uid;

			$query = "SELECT * FROM `zacres_photo` WHERE `pid`=" . $pid . " AND `uid`=" . $uid . " AND `filetype`='main' ";
			$main_photo_data = $this->master_model->customQueryRow($query);

			$query = "SELECT * FROM `zacres_photo` WHERE `pid`=" . $pid . " AND `uid`=" . $uid . " AND `filetype`='other' ";
			$other_photo_data = $this->master_model->customQueryArray($query);

			$query = "SELECT * FROM `zacres_photo` WHERE `pid`=" . $pid . " AND `uid`=" . $uid . " AND `filetype`='brochure' ";
			$brochure_photo_data = $this->master_model->customQueryArray($query);

			$query = "SELECT * FROM `zacres_video` WHERE `pid`=" . $pid . " AND `uid`=" . $uid . "  ";
			$video_data = $this->master_model->customQueryArray($query);

			$query = "SELECT * FROM `zacres_agent` WHERE `uid`=" . $uid . "  ";
			$agent_data = $this->master_model->customQueryRow($query);
		}

		$data = array();
		$data['propertyRow'] = $propertyRow;
		$data['main_photo_data'] = $main_photo_data;
		$data['other_photo_data'] = $other_photo_data;
		$data['brochure_photo_data'] = $brochure_photo_data;
		$data['video_data'] = $video_data;
		$data['agentRow'] = $agent_data;

		$this->load->view('pm/header');
		$this->load->view('pm/viewProperty', $data);
		$this->load->view('pm/footer');
	}

	public function reviews()
	{

		if (!$this->session->userdata('pm_id')) {
			redirect(base_url() . 'Admin');
		}

		$page = 1;
		if ($_GET['page']) {
			$page = $_GET['page'];
		}

		if ($_GET['search_text']) {
			$search_text = $_GET['search_text'];
			$sub_query .= " AND (`title` LIKE '%" . $search_text . "%' OR `description` LIKE '%" . $search_text . "%' )";
		}

		$limit = 20;
		$start = ($page - 1) * $limit;

		$query = "SELECT * FROM `review` WHERE `id`>0  " . $sub_query . " ORDER BY `id` DESC ";
		$review_data = $this->master_model->customQueryArray($query);

		$total_count = count($review_data);
		$pages = ceil($total_count / $limit);

		$query = $query . ' limit ' . $start . ',' . $limit;

		$review_data = $this->master_model->customQueryArray($query);


		$data = array();
		$data['review_data'] = $review_data;
		$data['page'] = $page;
		$data['pages'] = $pages;
		$data['total_count'] = $total_count;

		$this->load->view('pm/header');
		$this->load->view('pm/review_list', $data);
		$this->load->view('pm/footer');
	}

	public function activeDeactiveReview()
	{
		$id = $this->input->post('id');

		$reviewArr = array(
			'id' => $id
		);

		$review_data = $this->master_model->getRow('review', $reviewArr);

		$review_position = $review_data->Active;

		if ($review_position == 1) {
			$data = array(
				'id' => $id,
				'Active' => 0
			);

		} else {
			$data = array(
				'id' => $id,
				'Active' => 1
			);

		}

		$row = $this->master_model->save('review', $data);

		$main_array = array();
		$json_review_data = array();

		if ($row) {
			$json_review_data = $this->master_model->getRow('review', $reviewArr);
		}


		$main_array['riview_row'] = $json_review_data;

		echo json_encode($main_array);

	}

	public function deleteReview()
	{
		$id = $this->input->post('id');

		$Reviewarr = array(
			'id' => $id,
			'Active' => 2
		);

		$row = $this->master_model->save('review', $Reviewarr);


		$flash_arr = array(
			'color' => 'red',
			'message' => 'Error.',
			'status' => 0
		);

		if ($row) {
			$flash_arr = array(
				'color' => 'green',
				'message' => 'Record deleted successfully.',
				'status' => 1
			);
		}

		echo json_encode($flash_arr);

	}

	public function viewReview()
	{
		$id = $this->uri->segment(3);

		$arr = array(
			'id' => $id
		);

		$reviewRow = $this->master_model->getRow('review', $arr);

		$data = array();
		$data['reviewRow'] = $reviewRow;

		$this->load->view('pm/header');
		$this->load->view('pm/viewReview', $data);
		$this->load->view('pm/footer');
	}

	public function getEdcautorDoctors()
	{

		if (isset($_POST['value'])) {
			$educatorId = $_POST['value'];
			$doctorsData = getDoctorByEducator($educatorId);
			$doctorsData = $doctorsData['doctorsData'];
			//pr($doctorsData['doctorsData']);
			//die();
			?>
			<option value="" id=""> ---Select---- </option>
			<?php
			if ($doctorsData) {
				foreach ($doctorsData as $key => $doctorsItem) {
					//pr($doctorsItem);
					$doctorName = $doctorsItem['first_name'] . ' ' . $doctorsItem['last_name'];
					$doctorId = $doctorsItem['id'];
					?>
					<option value="<?php echo $doctorId ?>" id="d_<?php echo $doctorId ?>"> <?php echo $doctorName ?> </option>
					<?php
				}
			}
		}
		die();

	}


	public function getEdcautorPatientTable()
	{
		if (isset($_POST['doctorId'])) {
			$educatorId = $_POST['educatorId'];
			$doctorId = $_POST['doctorId'];


			$getPatientByData = getPatientByEducatorAndDoctorId($educatorId, $doctorId);
			$patientData = $getPatientByData['patientData'];


			// pr($patientData);
			// die();

			if ($patientData) {
				?>
				<div>
					<!-- <div style="margin:5px;"> <label> Patient </label> </div> -->

					<table id="myTable" class="display" style="width: 100%;">
						<thead>
							<tr>
								<th>Sr </th>
								<!-- <th>Select  </th> -->
								<th>Name</th>
								<th>Age</th>
								<th>Gender</th>
								<th>Heart Rate</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sr = 1;
							$doctorIds = array();
							foreach ($patientData as $key => $patientItem) {
								//pr($doctorsItem);
								$patientName = $patientItem['first_name'] . ' ' . $patientItem['last_name'];
								$patientId = $patientItem['id'];
								$age = $patientItem['age'];
								$gender = $patientItem['gender'];
								$email = $patientItem['email'];
								$heart_rate = $patientItem['heart_rate'];
								//die();
								?>
								<tr>
									<td><?php echo $sr; ?></td>
									<!-- <td>
			<div class="checkbox">
			<label>
			<input type="checkbox" name="patientIds[]" value="<?php echo $patientId; ?>">
			</label>
			</div>
			</td> -->
									<td><?php echo $patientName; ?></td>
									<td><?php echo $age; ?></td>
									<td><?php echo $gender; ?></td>
									<td><?php echo $heart_rate; ?></td>
								</tr>
								<?php $sr++;
							} ?>
						</tbody>
					</table>
				</div>
				<?php
			}
			die();
		}
	}







	public function makeXls($patientData, $fileName)
	{
		set_include_path(get_include_path() . PATH_SEPARATOR . "..");
		include_once("xlsxwriter.class.php");

		$header = array(
			'Sr' => 'string',//text
			'Date' => 'string',//text
			'Patient Name' => 'string',//text								
			'Gender' => 'string',//text
			'Blood Pressure' => 'string',//text
			'BMI' => 'string',//text
			'Educator Name' => 'string',//text				
			'RM Name' => 'string',//text
			'City' => 'string',//text
		);


		$excelData[$sr] = array($item['date'], $item['patient_name'], $gender, $item['blood_pressure'], $item['bmi'], $educatorName, $rmName, $item['city']);



		$rows = array();
		for ($i = 0; $i <= 10; $i++) {
			//$rows[$i] = array('x101'.$i,'102'.$i,'103'.$i,'104'.$i,'105'.$i,'106'.$i,'2018-01-07'.$i,'2018-01-08'.$i);
		}

		$rows = $patientData;

		/*if($patientData){
			$sr = 0;
			foreach($patientData as $key=> $patientItem){
				//pr($doctorsItem);
				$patientName = $patientItem['name'];
				$patientId = $patientItem['id'];
				$age = $patientItem['age'];
				$genderId = $patientItem['gender'];	
				$height = $patientItem['height'];	
				$weight = $patientItem['weight'];	
				$wh_ratio = $patientItem['wh_ratio'];	
				$bmi = $patientItem['bmi'];	
				$date = $patientItem['date'];
				$waist_circumference = $patientItem['waist_circumference'];	
				$genderString = genderString($genderId);

				$rows[$sr] = array($patientName,$genderString,$age,$weight,$height,$waist_circumference,$bmi,$wh_ratio,$date);
				$sr++;
			}
		}*/

		$writer = new XLSXWriter();

		$writer->writeSheetHeader('Sheet1', $header);
		foreach ($rows as $row)
			$writer->writeSheetRow('Sheet1', $row);

		//$writer->writeSheet($rows,'Sheet1', $header);//or write the whole sheet in 1 call

		if ($fileName == '') {
			$fileName = 'hardiyam-' . time() . ".xlsx";
		}

		//$fileName = 'hardiyam-'.time().".xlsx";			
		$path = "xlsx/" . $fileName;
		$writer->writeToFile($path);
		//$writer->writeToFile('xlsx-simple.xlsx');
		//$writer->writeToStdOut();
		//echo $writer->writeToString();
	}

public function analytics()
{
	$this->load->view('pm/analytics');
}

}
