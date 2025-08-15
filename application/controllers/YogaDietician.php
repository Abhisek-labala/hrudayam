<?php
defined('BASEPATH') or exit('No direct script access allowed');

class YogaDietician extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $status = 1;
        if ($status == 0) {
            echo "Invalid Access";
            die();
        }
    }

    public function dashboard()
    {
        $this->load->view('yogadietician/dashboard');
    }

    public function digitalPatientList()
    {
        $this->load->view('yogadietician/patient-list');
    }
    public function logout()
    {
        $this->session->unset_userdata('digital_yoga_dietician_id');
        redirect(base_url() . '/Digital-YogaDieticial-login');
    }
    public function changePassword()
    {
        $this->load->view('yogadietician/change-password');
    }

    public function changePasswordPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $oldPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];

            if (!$oldPassword) {
                $this->session->set_flashdata('error', 'Old Password Empty');
                redirect(base_url() . '/Digital-YogaDieticial-change-password');
            }

            if (!$newPassword) {
                $this->session->set_flashdata('error', 'New Password Empty');
                redirect(base_url() . '/Digital-YogaDieticial-change-password');
            }

            $educatorId = $this->session->userdata('digital_yoga_dietician_id');
            // echo $educatorId;die;

            $query = "SELECT * FROM `digital_yoga_dietician` WHERE `password`='" . $oldPassword . "' and `id`='" . $educatorId . "';";
            $educatorData = $this->master_model->customQueryArray($query);

            if ($educatorData) {

                $educatorPasswordData = array();
                $educatorPasswordData['id'] = $educatorId;
                $educatorPasswordData['password'] = $newPassword;
                $row = $this->master_model->save('digital_yoga_dietician', $educatorPasswordData);
                unset($educatorPasswordData);

                $this->session->set_flashdata('message', 'Password update Successfully');
                redirect(base_url() . '/Digital-YogaDieticial-change-password');

            } else {
                $this->session->set_flashdata('error', 'Password Not Matched');
                redirect(base_url() . '/Digital-YogaDieticial-change-password');
            }


        }
    }

    public function followupform()
    {
        $this->load->view('yogadietician/patientfollowupform');
    }

    public function followupformpost()
    {
        $day = $this->input->post('day', TRUE);
        $patient_id = $this->input->post('patient_id', TRUE);
        $daydata = [
            'day' => $day,
            'patient_id' => $patient_id
        ];
        $inserted = $this->db->insert('feedback_submitted', $daydata);
        if ($day === '7') {
            $patient_id = $this->input->post('patient_id', TRUE);

            $day7_meds = $this->input->post('day7_meds', TRUE);
            $day7_meds_reason = $this->input->post('day7_meds_reason', TRUE);

            $day7_doctor = $this->input->post('day7_doctor', TRUE);
            $day7_doctor_reason = $this->input->post('day7_doctor_reason', TRUE);

            $day7_bp = $this->input->post('day7_bp', TRUE);
            $day7_bp_value = $this->input->post('day7_bp_value', TRUE);
            $day7_bp_remarks = $this->input->post('day7_bp_remarks', TRUE);

            $day7_weight = $this->input->post('day7_weight', TRUE);

            $day7_breathless = $this->input->post('day7_breathless', TRUE);

            $day7_yoga_schedule = $this->input->post('day7_yoga_schedule', TRUE);
            $day7_yoga_schedule_reason = $this->input->post('day7_yoga_schedule_reason', TRUE);

            $day7_yoga_tried = $this->input->post('day7_yoga_tried', TRUE);
            $day7_yoga_difficult = $this->input->post('day7_yoga_difficult', TRUE);
            $day7_yoga_difficult_reason = $this->input->post('day7_yoga_difficult_reason', TRUE);

            $day7_yoga_required = $this->input->post('day7_yoga_required', TRUE);
            $day7_yoga_planned_date = $this->input->post('day7_yoga_planned_date', TRUE);
            $day7_yoga_required_reason = $this->input->post('day7_yoga_required_reason', TRUE);

            $callremark_7 = $this->input->post('callremark_7', TRUE);
            $callconnect_subremark_7 = $this->input->post('callconnect_subremark_7', TRUE);
            $noresponse_subremark_7 = $this->input->post('noresponse_subremark_7', TRUE);

            $data = [
                'patient_id' => $patient_id,
                'day7_meds' => $day7_meds,
                'day7_meds_reason' => $day7_meds_reason,
                'day7_doctor' => $day7_doctor,
                'day7_doctor_reason' => $day7_doctor_reason,
                'day7_bp' => $day7_bp,
                'day7_bp_value' => $day7_bp_value,
                'day7_bp_remarks' => $day7_bp_remarks,
                'day7_weight' => $day7_weight,
                'day7_breathless' => $day7_breathless,
                'day7_yoga_schedule' => $day7_yoga_schedule,
                'day7_yoga_schedule_reason' => $day7_yoga_schedule_reason,
                'day7_yoga_tried' => $day7_yoga_tried,
                'day7_yoga_difficult' => $day7_yoga_difficult,
                'day7_yoga_difficult_reason' => $day7_yoga_difficult_reason,
                'day7_yoga_required' => $day7_yoga_required,
                'day7_yoga_planned_date' => $day7_yoga_planned_date,
                'day7_yoga_required_reason' => $day7_yoga_required_reason,
                'callremark_7' => $callremark_7,
                'callconnect_subremark_7' => $callconnect_subremark_7,
                'noresponse_subremark_7' => $noresponse_subremark_7
            ];

            $inserted = $this->db->insert('day7_followup', $data);

            if ($inserted) {
                $this->session->set_flashdata('success', 'Day 7 Follow-up saved successfully!');
                redirect('Digital-yoga-Patient-List');
            } else {
                $this->session->set_flashdata('error', 'Failed to save Day 7 follow-up.');
                redirect('Digital-yoga-Patient-List');
            }
        }
        if ($day === '45') {
            $patient_id = $this->input->post('patient_id', TRUE);

            $day45_meds = $this->input->post('day45_meds', TRUE);
            $day45_meds_reason = $this->input->post('day45_meds_reason', TRUE);

            $day45_doctor = $this->input->post('day45_doctor', TRUE);
            $day45_doctor_reason = $this->input->post('day45_doctor_reason', TRUE);

            $day45_bp = $this->input->post('day45_bp', TRUE);
            $day45_bp_value = $this->input->post('day45_bp_value', TRUE);
            $day45_bp_remarks = $this->input->post('day45_bp_remarks', TRUE);

            $day45_weight = $this->input->post('day45_weight', TRUE);

            $day45_breathless = $this->input->post('day45_breathless', TRUE);

            $day45_yoga_schedule = $this->input->post('day45_yoga_schedule', TRUE);
            $day45_yoga_schedule_reason = $this->input->post('day45_yoga_schedule_reason', TRUE);

            $day45_yoga_tried = $this->input->post('day45_yoga_tried', TRUE);
            $day45_yoga_difficult = $this->input->post('day45_yoga_difficult', TRUE);
            $day45_yoga_difficult_reason = $this->input->post('day45_yoga_difficult_reason', TRUE);

            $day45_yoga_required = $this->input->post('day45_yoga_required', TRUE);
            $day45_yoga_planned_date = $this->input->post('day45_yoga_planned_date', TRUE);
            $day45_yoga_required_reason = $this->input->post('day45_yoga_required_reason', TRUE);

            $callremark_45 = $this->input->post('callremark_45', TRUE);
            $callconnect_subremark_45 = $this->input->post('callconnect_subremark_45', TRUE);
            $noresponse_subremark_45 = $this->input->post('noresponse_subremark_45', TRUE);

            $data = [
                'patient_id' => $patient_id,
                'day45_meds' => $day45_meds,
                'day45_meds_reason' => $day45_meds_reason,
                'day45_doctor' => $day45_doctor,
                'day45_doctor_reason' => $day45_doctor_reason,
                'day45_bp' => $day45_bp,
                'day45_bp_value' => $day45_bp_value,
                'day45_bp_remarks' => $day45_bp_remarks,
                'day45_weight' => $day45_weight,
                'day45_breathless' => $day45_breathless,
                'day45_yoga_schedule' => $day45_yoga_schedule,
                'day45_yoga_schedule_reason' => $day45_yoga_schedule_reason,
                'day45_yoga_tried' => $day45_yoga_tried,
                'day45_yoga_difficult' => $day45_yoga_difficult,
                'day45_yoga_difficult_reason' => $day45_yoga_difficult_reason,
                'day45_yoga_required' => $day45_yoga_required,
                'day45_yoga_planned_date' => $day45_yoga_planned_date,
                'day45_yoga_required_reason' => $day45_yoga_required_reason,
                'callremark_45' => $callremark_45,
                'callconnect_subremark_45' => $callconnect_subremark_45,
                'noresponse_subremark_45' => $noresponse_subremark_45
            ];

            $inserted = $this->db->insert('day45_followup', $data);

            if ($inserted) {
                $this->session->set_flashdata('success', 'Day 45 Follow-up saved successfully!');
                redirect('Digital-yoga-Patient-List');
            } else {
                $this->session->set_flashdata('error', 'Failed to save Day 45 follow-up.');
                redirect('Digital-yoga-Patient-List');
            }
        }
         if ($day === '90') {
            $patient_id = $this->input->post('patient_id', TRUE);

            $day90_meds = $this->input->post('day90_meds', TRUE);
            $day90_meds_reason = $this->input->post('day90_meds_reason', TRUE);

            $day90_doctor = $this->input->post('day90_doctor', TRUE);
            $day90_doctor_reason = $this->input->post('day90_doctor_reason', TRUE);

            $day90_bp = $this->input->post('day90_bp', TRUE);
            $day90_bp_value = $this->input->post('day90_bp_value', TRUE);
            $day90_bp_remarks = $this->input->post('day90_bp_remarks', TRUE);

            $day90_weight = $this->input->post('day90_weight', TRUE);

            $day90_breathless = $this->input->post('day90_breathless', TRUE);

            $day90_yoga_schedule = $this->input->post('day90_yoga_schedule', TRUE);
            $day90_yoga_schedule_reason = $this->input->post('day90_yoga_schedule_reason', TRUE);

            $day90_yoga_tried = $this->input->post('day90_yoga_tried', TRUE);
            $day90_yoga_difficult = $this->input->post('day90_yoga_difficult', TRUE);
            $day90_yoga_difficult_reason = $this->input->post('day90_yoga_difficult_reason', TRUE);

            $day90_yoga_required = $this->input->post('day90_yoga_required', TRUE);
            $day90_yoga_planned_date = $this->input->post('day90_yoga_planned_date', TRUE);
            $day90_yoga_required_reason = $this->input->post('day90_yoga_required_reason', TRUE);

            $callremark_90 = $this->input->post('callremark_90', TRUE);
            $callconnect_subremark_90 = $this->input->post('callconnect_subremark_90', TRUE);
            $noresponse_subremark_90 = $this->input->post('noresponse_subremark_90', TRUE);

            $data = [
                'patient_id' => $patient_id,
                'day90_meds' => $day90_meds,
                'day90_meds_reason' => $day90_meds_reason,
                'day90_doctor' => $day90_doctor,
                'day90_doctor_reason' => $day90_doctor_reason,
                'day90_bp' => $day90_bp,
                'day90_bp_value' => $day90_bp_value,
                'day90_bp_remarks' => $day90_bp_remarks,
                'day90_weight' => $day90_weight,
                'day90_breathless' => $day90_breathless,
                'day90_yoga_schedule' => $day90_yoga_schedule,
                'day90_yoga_schedule_reason' => $day90_yoga_schedule_reason,
                'day90_yoga_tried' => $day90_yoga_tried,
                'day90_yoga_difficult' => $day90_yoga_difficult,
                'day90_yoga_difficult_reason' => $day90_yoga_difficult_reason,
                'day90_yoga_required' => $day90_yoga_required,
                'day90_yoga_planned_date' => $day90_yoga_planned_date,
                'day90_yoga_required_reason' => $day90_yoga_required_reason,
                'callremark_90' => $callremark_90,
                'callconnect_subremark_90' => $callconnect_subremark_90,
                'noresponse_subremark_90' => $noresponse_subremark_90
            ];

            $inserted = $this->db->insert('day90_followup', $data);

            if ($inserted) {
                $this->session->set_flashdata('success', 'Day 90 Follow-up saved successfully!');
                redirect('Digital-yoga-Patient-List');
            } else {
                $this->session->set_flashdata('error', 'Failed to save Day 90 follow-up.');
                redirect('Digital-yoga-Patient-List');
            }
        }

    }

    public function createPatientInquiry()
	{				
		$this->load->view('digitaleducator/create-patient-inquiry-new');	
	}

    	public function createPatientInquiryPost()
{
    if(!$this->session->userdata('digital_educator_id')){
        redirect('Digital-Educator-login');
    }
	// pr($_POST);die;
    $educatorId = $this->session->userdata('digital_educator_id');

    // Allowed image extensions
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $ciplaPrescribed = $_POST['ciplaBrandPrescribed'] ?? 'No';
    $patientEnrolled = $_POST['patientEnrolled'] ?? 'No';
    $prescription_available = $_POST['prescription_available'] ?? 'No';

    $prescriptionFilename = '';
    $consentFilename = '';

    // Handle uploads based on conditions
    if ($ciplaPrescribed === 'Yes' && $patientEnrolled === 'Yes' && $prescription_available === 'Yes') {
        // Prescription required
        if (empty($_FILES['fileToUpload']['name'])) {
            $this->session->set_flashdata('error', "Please upload Prescription.");
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }

        // Consent required
        if (empty($_FILES['consentForm']['name'])) {
            $this->session->set_flashdata('error', "Please upload Consent Form.");
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }

       $prescriptionFilenames = [];
			foreach ($_FILES['fileToUpload']['name'] as $key => $name) {
				$tmpName = $_FILES['fileToUpload']['tmp_name'][$key];
				$extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

				if (!in_array($extension, $allowedExtensions)) {
					$this->session->set_flashdata('error', "Invalid prescription file format: $name");
					redirect(base_url() . '/DigitalEducator-Patient-Inquiry');
					return;
				}

				$filename = time() . '_' . uniqid() . '_' . basename($name);
				$destination = $uploadDir . $filename;

				if (!move_uploaded_file($tmpName, $destination)) {
					$this->session->set_flashdata('error', "Failed to upload prescription file: $name");
					redirect(base_url() . '/DigitalEducator-Patient-Inquiry');
					return;
				}

				$prescriptionFilenames[] = $filename;
			}

			$prescriptionFilename = implode(',', $prescriptionFilenames);

        // Validate and upload consent form
        $consentExtension = strtolower(pathinfo($_FILES['consentForm']['name'], PATHINFO_EXTENSION));
        if (!in_array($consentExtension, $allowedExtensions)) {
            $this->session->set_flashdata('error', 'Invalid consent form file format.');
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }
        $consentFilename = 'Consent_'.time().'_'.uniqid().'_'.basename($_FILES['consentForm']['name']);
        $consentPath = $uploadDir . $consentFilename;
        if (!move_uploaded_file($_FILES['consentForm']['tmp_name'], $consentPath)) {
            die("Error: Failed to upload Consent Form.");
        }
		   // Medicine
    if (!empty($_POST['medicine'])) {
        $medicineString = implode(',', $_POST['medicine']);
    }
    }
	else if ($ciplaPrescribed === 'Yes' && $patientEnrolled === 'Yes' && $prescription_available === 'No') {
		   // Medicine
    if (!empty($_POST['medicine'])) {
        $medicineString = implode(',', $_POST['medicine']);
    }
    }
    else if ($ciplaPrescribed === 'Yes' && $patientEnrolled === 'No' && $prescription_available === 'No') {
        // Consent form should not be uploaded
        if (!empty($_FILES['consentForm']['name'])) {
            $this->session->set_flashdata('error', 'Consent form not required. Please remove it.');
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }
		   // Medicine
    if (!empty($_POST['medicine'])) {
        $medicineString = implode(',', $_POST['medicine']);
    }
}
    else if ($ciplaPrescribed === 'Yes' && $patientEnrolled === 'No' && $prescription_available === 'Yes') {
        // Prescription required
        if (empty($_FILES['fileToUpload']['name'])) {
            $this->session->set_flashdata('error', "Please upload Prescription.");
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }

        $prescriptionFilenames = [];
			foreach ($_FILES['fileToUpload']['name'] as $key => $name) {
				$tmpName = $_FILES['fileToUpload']['tmp_name'][$key];
				$extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

				if (!in_array($extension, $allowedExtensions)) {
					$this->session->set_flashdata('error', "Invalid prescription file format: $name");
					redirect(base_url() . '/DigitalEducator-Patient-Inquiry');
					return;
				}

				$filename = time() . '_' . uniqid() . '_' . basename($name);
				$destination = $uploadDir . $filename;

				if (!move_uploaded_file($tmpName, $destination)) {
					$this->session->set_flashdata('error', "Failed to upload prescription file: $name");
					redirect(base_url() . '/DigitalEducator-Patient-Inquiry');
					return;
				}

				$prescriptionFilenames[] = $filename;
			}

			$prescriptionFilename = implode(',', $prescriptionFilenames);

        // Consent form should not be uploaded
        if (!empty($_FILES['consentForm']['name'])) {
            $this->session->set_flashdata('error', 'Consent form not required. Please remove it.');
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }
		   // Medicine
    if (!empty($_POST['medicine'])) {
        $medicineString = implode(',', $_POST['medicine']);
    }
    }
    else if ($ciplaPrescribed === 'No' && $patientEnrolled === 'No') {
        
    }
	$prescribedselect=$_POST['prescribedselect']??'No';
	if($prescribedselect != 'No' && $prescribedselect==='Purchase Bill Available')
	{
		 if (empty($_FILES['purchasebill']['name'])) {
            $this->session->set_flashdata('error', "Please upload purchasebill.");
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }
		 $purchasebillExt = strtolower(pathinfo($_FILES['purchasebill']['name'], PATHINFO_EXTENSION));
        if (!in_array($purchasebillExt, $allowedExtensions)) {
            $this->session->set_flashdata('error', 'Invalid purchasebill format.');
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }
        $purchasebillname = 'purchasebill_'.time().'_'.uniqid().'_'.basename($_FILES['purchasebill']['name']);
        $purchasebillpath = $uploadDir . $purchasebillname;
        if (!move_uploaded_file($_FILES['purchasebill']['tmp_name'], $purchasebillpath)) {
            die("Error: Failed to upload purchasebill.");
        }
	}
	// echo 'hii';die;
    // Prepare data array
    $patientFormData = array();
	$patientFormData['cipla_brand_prescribed_no_option']=$prescribedselect ??'';
	$patientFormData['prescription_available']=$prescription_available ??'';
	$patientFormData['purchase_bill']=$purchasebillname?? '';
    $patientFormData['prescription_file'] = $prescriptionFilename;
    $patientFormData['consent_form_file'] = $consentFilename;
    $patientFormData['digital_educator_id'] = $educatorId;
    $patientFormData['camp_id'] = $_POST['campId'] ?? '';
    $patientFormData['hcp_name'] = $_POST['hcp_name'] ?? '';
    $patientFormData['msl_code'] = $_POST['msl_code'] ?? '';
    // $patientFormData['medicine_header'] = $_POST['medicine_header'] ?? '';
    $patientFormData['city'] = $_POST['city'] ?? '';
    $patientFormData['state'] = $_POST['state'] ?? '';
    $patientFormData['speciality'] = $_POST['speciality'] ?? '';
    $patientFormData['patient_name'] = $_POST['patient_name'] ?? '';
    $patientFormData['patient_enrolled'] = $patientEnrolled;
    $patientFormData['patient_kit_enrolled'] = $_POST['patient_kit_enrolled'] ?? '';
    $patientFormData['age'] = $_POST['age'] ?? '';
    $patientFormData['mobile_number'] = $_POST['mobile_number'] ?? '';
    $patientFormData['gender'] = $_POST['gender'] ?? '';
    $patientFormData['date_of_discharge'] = $_POST['date_of_discharge'] ?? '';
    $patientFormData['cipla_brand_prescribed'] = $ciplaPrescribed;

    $patientFormData['blood_pressure'] = $_POST['blood_pressure'] ?? '';
    $patientFormData['urea'] = $_POST['urea'] ?? '';
    $patientFormData['lv_ef'] = $_POST['lv_ef'] ?? '';
    $patientFormData['heart_rate'] = $_POST['heart_rate'] ?? '';
    $patientFormData['nt_pro_bnp'] = $_POST['nt_pro_bnp'] ?? '';
    $patientFormData['egfr'] = $_POST['egfr'] ?? '';
    $patientFormData['potassium'] = $_POST['potassium'] ?? '';
    $patientFormData['sodium'] = $_POST['sodium'] ?? '';
    $patientFormData['uric_acid'] = $_POST['uric_acid'] ?? '';
    $patientFormData['creatinine'] = $_POST['creatinine'] ?? '';
    $patientFormData['crp'] = $_POST['crp'] ?? '';
    $patientFormData['uacr'] = $_POST['uacr'] ?? '';
    $patientFormData['iron'] = $_POST['iron'] ?? '';

    $patientFormData['hb'] = $_POST['hb'] ?? '';
    $patientFormData['ldl'] = $_POST['ldl'] ?? '';
    $patientFormData['hdl'] = $_POST['hdl'] ?? '';
    $patientFormData['triglycerid'] = $_POST['triglycerid'] ?? '';
    $patientFormData['total_cholesterol'] = $_POST['total_cholesterol'] ?? '';
    $patientFormData['hba1c'] = $_POST['hba1c'] ?? '';
    $patientFormData['sgot'] = $_POST['sgot'] ?? '';
    $patientFormData['sgpt'] = $_POST['sgpt'] ?? '';
    $patientFormData['vit_d'] = $_POST['vit_d'] ?? '';
    $patientFormData['t3'] = $_POST['t3'] ?? '';
    $patientFormData['t4'] = $_POST['t4'] ?? '';
    $patientFormData['anti_diabetic_therapy'] = $_POST['anti_diabetic_therapy'] ?? '';

    $patientFormData['arni'] = $_POST['arni'] ?? '';
    $patientFormData['b_blockers'] = $_POST['b_blockers'] ?? '';
    $patientFormData['mra'] = $_POST['mra'] ?? '';

    $patientFormData['arni_remark'] = $_POST['arni_remark'] ?? '';
    $patientFormData['b_blockers_remark'] = $_POST['b_blockers_remark'] ?? '';
    $patientFormData['mra_remark'] = $_POST['mra_remark'] ?? '';

    $patientFormData['remark'] = $_POST['remark'] ?? '';

    $patientFormData['weight'] = $_POST['weight'] ?? '';
    $patientFormData['height'] = $_POST['height'] ?? '';
    $patientFormData['waist_circumference_remark'] = $_POST['waist_circumference_remark'] ?? '';
    $patientFormData['bmi'] = $_POST['bmi'] ?? '';
    $patientFormData['waist_to_height_ratio'] = $_POST['waist_to_height_ratio'] ?? '';

    // Radio buttons
    $patientFormData['vaccination'] = $_POST['vaccination'] ?? '';
    $patientFormData['influenza'] = $_POST['influenza'] ?? '';
    $patientFormData['pneumococcal'] = $_POST['pneumococcal'] ?? '';
    $patientFormData['cardiac_rehab'] = $_POST['cardiac_rehab'] ?? '';
    $patientFormData['nsaids_use'] = $_POST['nsaids_use'] ?? '';
    $patientFormData['patient_kit_given'] = $_POST['patient_kit_given'] ?? '';
    $patientFormData['exercise_30mins'] = $_POST['exercise_30mins'] ?? '';
    $patientFormData['breakfast_days'] = $_POST['breakfast_days'] ?? '';
    $patientFormData['food_habits'] = $_POST['food_habits'] ?? '';
    $patientFormData['sedentary_hours'] = $_POST['sedentary_hours'] ?? '';

    $patientFormData['type_2_dm'] = $_POST['type_2_dm'] ?? '';
    $patientFormData['hypertension'] = $_POST['hypertension'] ?? '';
    $patientFormData['dyslipidemia'] = $_POST['dyslipidemia'] ?? '';
    $patientFormData['pco'] = $_POST['pco'] ?? '';
    $patientFormData['knee_pain'] = $_POST['knee_pain'] ?? '';
    $patientFormData['asthma'] = $_POST['asthma'] ?? '';

    $patientFormData['adl_bathing'] = $_POST['adl_bathing'] ?? '';
    $patientFormData['adl_dressing'] = $_POST['adl_dressing'] ?? '';
    $patientFormData['adl_walking'] = $_POST['adl_walking'] ?? '';
    $patientFormData['adl_toileting'] = $_POST['adl_toileting'] ?? '';
	$patientFormData['medicine'] = $medicineString ?? '';
 

    // Competitor
    if (!empty($_POST['Compititor'])) {
        $CompititorString = implode(',', $_POST['Compititor']);
        $patientFormData['Compititor'] = $CompititorString;
    }

    $patientFormData['date'] = date('Y-m-d');

    // Save data to DB
    $inquiry_id = $this->master_model->save('patient_inquiry_new', $patientFormData);

    if ($inquiry_id) {
        $this->session->set_flashdata('message', 'Patient information submitted successfully');
    } else {
        $this->session->set_flashdata('error', 'Try again! Patient information not created');
    }

    redirect(base_url() . '/DigitalEducator-Patient-Inquiry');
}

public function getHCLDetails(){
		$mslCode = "";
		$status = "fail";
		$doctorId =  $_POST['doctor_id'];
	 	$status = "success";

		$stock_view_query = "SELECT * FROM `doctors_new` WHERE `id` = '".$doctorId."'";				
		$DoctorDetails 	= $this->master_model->customQueryRow($stock_view_query); 

		$mslCode = $DoctorDetails->msl_code;
		$city =$DoctorDetails->city;
		$speciality =$DoctorDetails->speciality;
		$state =$DoctorDetails->state;

		$statename = "select * from `state_list` where state='".$state."'";
		$statedetails =$this->master_model->customQueryRow($statename);
		
		$state_id=$statedetails->id;
	   
		echo   json_encode(array('status'=>$status,'msl_code'=>$mslCode,'city'=>$city,'speciality'=>$speciality,'state'=>$state ,'state_id'=>$state_id));
	   die();
   }
	
}