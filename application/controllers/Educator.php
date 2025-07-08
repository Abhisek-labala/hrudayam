<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Educator extends CI_Controller {

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
	 
	 function __construct(){
			parent:: __construct();					
			$this->load->library('session');
			if ( ! $this->session->userdata('educator_id'))
			{   
				redirect(base_url().'/educator-login');			
			}	
		}
	

	
	public function index()
	{
		if($this->session->userdata('educator_id')){
			//redirect('educator-dashboard');	
			redirect('Patient-Information');	
				
		}else{
		  redirect('educator-login');
		}
	}
	
	
	public function educatorDashBoard()
	{			
		$this->load->view('educator/dashboard');	
	}

	public function dashBoardFilter()
	{
			
		$this->load->view('admin/dashboard');	
	}
	
	
	// public function createPatientInquiryOld()
	// {				
	// 	$this->load->view('educator/create-patient-inquiry');	
	// }


	public function getHCLDetails(){
		$mslCode = "";
		$status = "fail";
		$doctorId =  $_POST['doctor_id'];
	//	$DoctorDetails = getDoctorDetails($doctorId);
	// if($DoctorDetails['doctorsData']){
	// 	$doctorsData = $DoctorDetails['doctorsData'];
	// 	$mslCode = $doctorsData->msl_code;
	 	$status = "success";
	// }

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
	

	public function patientList()
	{				
		$this->load->view('educator/patient-list');	
	}


	public function campinfo()
	{				
		$this->load->view('educator/camp-info');	
	}
	
	
	public function createPatientInquiry()
	{				
		$this->load->view('educator/create-patient-inquiry-new');	
	}

	



	function clean_input($data) {
		return htmlspecialchars(trim($data));
	}
	

	public function createPatientInquiryPost()
{
    if(!$this->session->userdata('educator_id')){
        redirect('educator-login');
    }
	// pr($_POST);die;
    $educatorId = $this->session->userdata('educator_id');

    // Allowed image extensions
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $ciplaPrescribed = $_POST['ciplaBrandPrescribed'] ?? 'No';
    $patientEnrolled = $_POST['patientEnrolled'] ?? 'No';

    $prescriptionFilename = '';
    $consentFilename = '';

    // Handle uploads based on conditions
    if ($ciplaPrescribed === 'Yes' && $patientEnrolled === 'Yes') {
        // Prescription required
        if (empty($_FILES['fileToUpload']['name'])) {
            $this->session->set_flashdata('error', "Please upload Prescription.");
            redirect(base_url().'/Patient-Information');
            die();
        }

        // Consent required
        if (empty($_FILES['consentForm']['name'])) {
            $this->session->set_flashdata('error', "Please upload Consent Form.");
            redirect(base_url().'/Patient-Information');
            die();
        }

        // Validate and upload prescription
        $prescriptionExtension = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
        if (!in_array($prescriptionExtension, $allowedExtensions)) {
            $this->session->set_flashdata('error', 'Invalid prescription file format.');
            redirect(base_url().'/Patient-Information');
            die();
        }
        $prescriptionFilename = time().'_'.uniqid().'_'.basename($_FILES['fileToUpload']['name']);
        $prescriptionPath = $uploadDir . $prescriptionFilename;
        if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $prescriptionPath)) {
            die("Error: Failed to upload prescription file.");
        }

        // Validate and upload consent form
        $consentExtension = strtolower(pathinfo($_FILES['consentForm']['name'], PATHINFO_EXTENSION));
        if (!in_array($consentExtension, $allowedExtensions)) {
            $this->session->set_flashdata('error', 'Invalid consent form file format.');
            redirect(base_url().'/Patient-Information');
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
    else if ($ciplaPrescribed === 'Yes' && $patientEnrolled === 'No') {
        // Prescription required
        if (empty($_FILES['fileToUpload']['name'])) {
            $this->session->set_flashdata('error', "Please upload Prescription.");
            redirect(base_url().'/Patient-Information');
            die();
        }

        // Validate and upload prescription only
        $prescriptionExtension = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
        if (!in_array($prescriptionExtension, $allowedExtensions)) {
            $this->session->set_flashdata('error', 'Invalid prescription file format.');
            redirect(base_url().'/Patient-Information');
            die();
        }

        $prescriptionFilename = time().'_'.uniqid().'_'.basename($_FILES['fileToUpload']['name']);
        $prescriptionPath = $uploadDir . $prescriptionFilename;
        if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $prescriptionPath)) {
            die("Error: Failed to upload prescription file.");
        }

        // Consent form should not be uploaded
        if (!empty($_FILES['consentForm']['name'])) {
            $this->session->set_flashdata('error', 'Consent form not required. Please remove it.');
            redirect(base_url().'/Patient-Information');
            die();
        }
		   // Medicine
    if (!empty($_POST['medicine'])) {
        $medicineString = implode(',', $_POST['medicine']);
    }
    }
    else if ($ciplaPrescribed === 'No' && $patientEnrolled === 'No') {
        // Neither file should be uploaded
        if (!empty($_FILES['fileToUpload']['name']) || !empty($_FILES['consentForm']['name'])) {
            $this->session->set_flashdata('error', 'No uploads required. Please remove Prescription and Consent files.');
            redirect(base_url().'/Patient-Information');
            die();
        }
    }

    // Prepare data array
    $patientFormData = array();

    $patientFormData['prescription_file'] = $prescriptionFilename;
    $patientFormData['consent_form_file'] = $consentFilename;
    $patientFormData['educator_id'] = $educatorId;
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

    redirect(base_url() . '/Patient-Information');
}


// public function createPatientInquiryPost()
// 	{
		
		

// 		if(!$this->session->userdata('educator_id')){
// 			redirect('educator-login');
// 		}

// 		$educatorId = $this->session->userdata('educator_id');

// 		function clean_input($data) {
// 			return htmlspecialchars(trim($data));
// 		}


// foreach ($_POST as $field) {
//     if($field!='medicine'){
// 	//$_POST[$field] = clean_input($_POST[$field]); 
// 	}   
// }

// // pr($_POST);
// // die();

// // Required fields
// // $requiredFields = ['Doctor', 'msl_code', 'first_name', 'gender', 'weight', 'height','Waist_circumference', 'bmi', 'WH_Ratio'];

// // // Validate required fields
// // foreach ($requiredFields as $field) {
// //     if (empty($_POST[$field])) {
// // 		$field = str_replace('_',' ',$field);
// //         //die("Error: '$field' is required.");
// // 		$this->session->set_flashdata('error',"Error: $field is required.");
// // 		redirect(base_url().'/Patient-Information');
// // 		die();
// //     }
// // }


// // if(!isset($_FILES['fileToUpload']['name'])){
// // 	$this->session->set_flashdata('error',"Please Upload Prescription.");
// // 	redirect(base_url().'/Patient-Information');
// // 	die();
// // }

// // $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
// // $fileExtension = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
// // if (!in_array($fileExtension, $allowedExtensions)) {
// // 		$this->session->set_flashdata('error','The uploaded file format is not supported. Please upload a valid image file (JPG, PNG, JPEG).');
// // 		redirect(base_url().'/Patient-Information');
// // 		die();
// // }
//  $ciplaPrescribed = $_POST['ciplaBrandPrescribed'] ?? 'No';
//     $patientEnrolled = $_POST['patientEnrolled'] ?? 'No';

//     $allowedExtensions = ['jpg', 'jpeg', 'png'];
//     $uploadDir = 'uploads/';
//     if (!is_dir($uploadDir)) {
//         mkdir($uploadDir, 0755, true);
//     }

//     // FILE VALIDATION + UPLOAD LOGIC
//     $prescriptionFilename = '';
//     $consentFilename = '';

//     if ($ciplaPrescribed === 'Yes' && $patientEnrolled === 'Yes') {
//         // Prescription required
//         if (empty($_FILES['fileToUpload']['name'])) {
//             $this->session->set_flashdata('error', "Please upload Prescription.");
//             redirect(base_url().'/Patient-Information');
//             die();
//         }

//         // Consent required
//         if (empty($_FILES['consentForm']['name'])) {
//             $this->session->set_flashdata('error', "Please upload Consent Form.");
//             redirect(base_url().'/Patient-Information');
//             die();
//         }

//         // Validate and upload prescription
//         $prescriptionExtension = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
//         if (!in_array($prescriptionExtension, $allowedExtensions)) {
//             $this->session->set_flashdata('error', 'Invalid prescription file format.');
//             redirect(base_url().'/Patient-Information');
//             die();
//         }
//         $prescriptionFilename = time().'_'.uniqid().'_'.basename($_FILES['fileToUpload']['name']);
//         $prescriptionPath = $uploadDir . $prescriptionFilename;
//         if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $prescriptionPath)) {
//             die("Error: Failed to upload prescription file.");
//         }

//         // Validate and upload consent form
//         $consentExtension = strtolower(pathinfo($_FILES['consentForm']['name'], PATHINFO_EXTENSION));
//         if (!in_array($consentExtension, $allowedExtensions)) {
//             $this->session->set_flashdata('error', 'Invalid consent form file format.');
//             redirect(base_url().'/Patient-Information');
//             die();
//         }
//         $consentFilename = 'Consent_'.time().'_'.uniqid().'_'.basename($_FILES['consentForm']['name']);
//         $consentPath = $uploadDir . $consentFilename;
//         if (!move_uploaded_file($_FILES['consentForm']['tmp_name'], $consentPath)) {
//             die("Error: Failed to upload Consent Form.");
//         }
//     }

//     else if ($ciplaPrescribed === 'Yes' && $patientEnrolled === 'No') {
//         // Prescription required
//         if (empty($_FILES['fileToUpload']['name'])) {
//             $this->session->set_flashdata('error', "Please upload Prescription.");
//             redirect(base_url().'/Patient-Information');
//             die();
//         }

//         // Validate and upload prescription only
//         $prescriptionExtension = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
//         if (!in_array($prescriptionExtension, $allowedExtensions)) {
//             $this->session->set_flashdata('error', 'Invalid prescription file format.');
//             redirect(base_url().'/Patient-Information');
//             die();
//         }

//         $prescriptionFilename = time().'_'.uniqid().'_'.basename($_FILES['fileToUpload']['name']);
//         $prescriptionPath = $uploadDir . $prescriptionFilename;
//         if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $prescriptionPath)) {
//             die("Error: Failed to upload prescription file.");
//         }

//         // Consent form should not be uploaded
//         if (!empty($_FILES['consentForm']['name'])) {
//             $this->session->set_flashdata('error', 'Consent form not required. Please remove it.');
//             redirect(base_url().'/Patient-Information');
//             die();
//         }
//     }

//     else if ($ciplaPrescribed === 'No' && $patientEnrolled === 'No') {
//         // Neither file should be uploaded
//         if (!empty($_FILES['fileToUpload']['name']) || !empty($_FILES['consentForm']['name'])) {
//             $this->session->set_flashdata('error', 'No uploads required. Please remove Prescription and Consent files.');
//             redirect(base_url().'/Patient-Information');
//             die();
//         }
//     }
// // Assign values to array
// $patientFormData = array();



// $patientFormData['prescription_file'] = $prescriptionFilename;
// $patientFormData['consent_form_file'] = $consentFilename;
// $patientFormData['educator_id']                = $educatorId;
// $patientFormData['camp_id']                = $_POST['campId'] ?? '';
// $patientFormData['hcp_name']                = $_POST['hcp_name'] ?? '';
// $patientFormData['msl_code']                = $_POST['msl_code'] ?? '';
// $patientFormData['city']                    = $_POST['city'] ?? '';
// $patientFormData['state']                    = $_POST['state'] ?? '';
// $patientFormData['speciality']              = $_POST['speciality'] ?? '';
// $patientFormData['patient_name']            = $_POST['patient_name'] ?? '';
// $patientFormData['patient_enrolled']            = $_POST['patientEnrolled'] ?? '';
// $patientFormData['patient_kit_enrolled']            = $_POST['patient_kit_enrolled'] ?? '';
// $patientFormData['age']                     = $_POST['age'] ?? '';
// $patientFormData['mobile_number']           = $_POST['mobile_number'] ?? '';
// $patientFormData['gender']                  = $_POST['gender'] ?? '';
// //$patientFormData['medicine']                = $_POST['medicine'] ?? '';
// $patientFormData['date_of_discharge']       = $_POST['date_of_discharge'] ?? '';
// $patientFormData['cipla_brand_prescribed']       = $_POST['ciplaBrandPrescribed'] ?? '';

// $patientFormData['blood_pressure']          = $_POST['blood_pressure'] ?? '';
// $patientFormData['urea']                    = $_POST['urea'] ?? '';
// $patientFormData['lv_ef']                   = $_POST['lv_ef'] ?? '';
// $patientFormData['heart_rate']              = $_POST['heart_rate'] ?? '';
// $patientFormData['nt_pro_bnp']              = $_POST['nt_pro_bnp'] ?? '';
// $patientFormData['egfr']                    = $_POST['egfr'] ?? '';
// $patientFormData['potassium']               = $_POST['potassium'] ?? '';
// $patientFormData['sodium']                  = $_POST['sodium'] ?? '';
// $patientFormData['uric_acid']               = $_POST['uric_acid'] ?? '';
// $patientFormData['creatinine']              = $_POST['creatinine'] ?? '';
// $patientFormData['crp']                     = $_POST['crp'] ?? '';
// $patientFormData['uacr']                    = $_POST['uacr'] ?? '';
// $patientFormData['iron']                    = $_POST['iron'] ?? '';

// $patientFormData['hb']                      = $_POST['hb'] ?? '';
// $patientFormData['ldl']                     = $_POST['ldl'] ?? '';
// $patientFormData['hdl']                     = $_POST['hdl'] ?? '';
// $patientFormData['triglycerid']             = $_POST['triglycerid'] ?? '';
// $patientFormData['total_cholesterol']       = $_POST['total_cholesterol'] ?? '';
// $patientFormData['hba1c']                   = $_POST['hba1c'] ?? '';
// $patientFormData['sgot']                    = $_POST['sgot'] ?? '';
// $patientFormData['sgpt']                    = $_POST['sgpt'] ?? '';
// $patientFormData['vit_d']                   = $_POST['vit_d'] ?? '';
// $patientFormData['t3']                      = $_POST['t3'] ?? '';
// $patientFormData['t4']                      = $_POST['t4'] ?? '';
// $patientFormData['anti_diabetic_therapy']   = $_POST['anti_diabetic_therapy'] ?? '';

// $patientFormData['arni']                    = $_POST['arni'] ?? '';
// $patientFormData['b_blockers']              = $_POST['b_blockers'] ?? '';
// $patientFormData['mra']                     = $_POST['mra'] ?? '';

// $patientFormData['arni_remark']                    = $_POST['arni_remark'] ?? '';
// $patientFormData['b_blockers_remark']              = $_POST['b_blockers_remark'] ?? '';
// $patientFormData['mra_remark']                     = $_POST['mra_remark'] ?? '';


// $patientFormData['remark']                  = $_POST['remark'] ?? '';

// $patientFormData['weight']                  = $_POST['weight'] ?? '';
// $patientFormData['height']                  = $_POST['height'] ?? '';
// $patientFormData['waist_circumference_remark'] = $_POST['waist_circumference_remark'] ?? '';
// $patientFormData['bmi']                     = $_POST['bmi'] ?? '';
// $patientFormData['waist_to_height_ratio']   = $_POST['waist_to_height_ratio'] ?? '';

// // Radio buttons
// $patientFormData['vaccination']            = $_POST['vaccination'] ?? '';
// $patientFormData['influenza']              = $_POST['influenza'] ?? '';
// $patientFormData['pneumococcal']           = $_POST['pneumococcal'] ?? '';
// $patientFormData['cardiac_rehab']          = $_POST['cardiac_rehab'] ?? '';
// $patientFormData['nsaids_use']             = $_POST['nsaids_use'] ?? '';
// $patientFormData['patient_kit_given']      = $_POST['patient_kit_given'] ?? '';
// $patientFormData['exercise_30mins']        = $_POST['exercise_30mins'] ?? '';
// $patientFormData['breakfast_days']         = $_POST['breakfast_days'] ?? '';
// $patientFormData['food_habits']            = $_POST['food_habits'] ?? '';
// $patientFormData['sedentary_hours']        = $_POST['sedentary_hours'] ?? '';


// $patientFormData['type_2_dm']        = $_POST['type_2_dm'] ?? '';
// $patientFormData['hypertension']        = $_POST['hypertension'] ?? '';
// $patientFormData['dyslipidemia']        = $_POST['dyslipidemia'] ?? '';
// $patientFormData['pco']        = $_POST['pco'] ?? '';
// $patientFormData['knee_pain']        = $_POST['knee_pain'] ?? '';
// $patientFormData['asthma']        = $_POST['asthma'] ?? '';

// $patientFormData['adl_bathing']        = $_POST['adl_bathing'] ?? '';
// $patientFormData['adl_dressing']       = $_POST['adl_dressing'] ?? '';
// $patientFormData['adl_walking']        = $_POST['adl_walking'] ?? '';
// $patientFormData['adl_toileting']     = $_POST['adl_toileting'] ?? '';
// $patientFormData['adl_toileting']     = $_POST['adl_toileting'] ?? '';


// //pr($patientFormData);
// //die();
// // process Medicine Data 
// if($_POST['medicine']){
// 	$selectedMedicine = $_POST['medicine'];
// 	// foreach ($selectedMedicine as $Medicine) {
// 	// 	echo htmlspecialchars($Medicine) . "<br>";
// 	// }

// 	$medicineString = implode(',', $selectedMedicine);
// 	$patientFormData['medicine']                = $medicineString;
// }
// if($_POST['Compititor']){
// 	$selectedCompititor = $_POST['Compititor'];
// 	// }

// 	$CompititorString = implode(',', $selectedCompititor);
// 	$patientFormData['Compititor']                = $CompititorString;
// }

// $patientFormData['date']     = date('Y-m-d');


// // $uploadDir = 'uploads/';
// // $filename = time().basename($_FILES['fileToUpload']['name']);
// // $uploadPath = $uploadDir . $filename;
// // if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadPath)) {
// //     die("Error: Failed to upload prescription file.");
// // }

// // $patientFormData['prescription_file'] = $filename;

// $filename = 'Consent-'.time().basename($_FILES['consentForm']['name']);
// $uploadPath = $uploadDir .$filename;
// if (!move_uploaded_file($_FILES['consentForm']['tmp_name'], $uploadPath)) {
//     die("Error: Failed to upload Consent Form.");
// }

// $patientFormData['consent_form_file'] = $filename;



// //pr($patientInquiryData);		
// $inquiry_id = $this->master_model->save('patient_inquiry_new',$patientFormData); 
		
// unset($patientFormData);

// if($inquiry_id){
// $this->session->set_flashdata('message','Patient information submitted successfully');
// }else{
// 	$this->session->set_flashdata('error','Try again ! Patient information not created');
// }

// redirect(base_url().'/Patient-Information');	

		
// 	}


	
	public function createPatientInquiryPostOld()
	{
		
		if(!$this->session->userdata('educator_id')){
			redirect('educator-login');
		}
		
		
// 	$errors = array();

//     // Validate fields
//     if (!isRequired($_POST['Doctor'])) $errors[] = "Doctor name is required.";
//     if (!isRequired($_POST['palace'])) $errors[] = "Place is required.";
//     if (!isRequired($_POST['hcp_name'])) $errors[] = "HCP Name is required.";
//     if (!isRequired($_POST['msl_code'])) $errors[] = "MSL Code is required.";
//     if (!isRequired($_POST['p_code'])) $errors[] = "P Code is required.";
//     if (!isRequired($_POST['speciality'])) $errors[] = "Speciality is required.";
//     if (!isRequired($_POST['first_name'])) $errors[] = "First name is required.";
//     if (!isNumeric($_POST['height'])) $errors[] = "Height must be numeric.";
//     if (!isNumeric($_POST['weight'])) $errors[] = "Weight must be numeric.";
//     if (!isRequired($_POST['age'])) $errors[] = "Age is required.";
//     if (!isRequired($_POST['bp'])) $errors[] = "Blood pressure is required.";
//     if (!isNumeric($_POST['urea'])) $errors[] = "Urea must be numeric.";
//     if (!isNumeric($_POST['lv_ef'])) $errors[] = "LV EF must be numeric.";
//     if (!isNumeric($_POST['heart_rate'])) $errors[] = "Heart rate must be numeric.";
//     if (!isNumeric($_POST['nt_pro_bnp'])) $errors[] = "NT Pro BNP must be numeric.";
//     if (!isNumeric($_POST['egfr'])) $errors[] = "EGFR must be numeric.";
//     if (!isNumeric($_POST['potassium'])) $errors[] = "Potassium must be numeric.";
//     if (!isNumeric($_POST['sodium'])) $errors[] = "Sodium must be numeric.";
//     if (!isNumeric($_POST['uric_acid'])) $errors[] = "Uric Acid must be numeric.";
//     if (!isNumeric($_POST['creatinine'])) $errors[] = "Creatinine must be numeric.";

//     // Optional numeric fields
//     if (!isOptionalNumeric($_POST['bmi'])) $errors[] = "BMI must be numeric if provided.";
//     if (!isOptionalNumeric($_POST['waist_to_height_ratio'])) $errors[] = "Waist-to-height ratio must be numeric if provided.";

//     if (!isRequired($_POST['gender'])) $errors[] = "Gender is required.";
    
//     // Email validation
//     if (!isOptionalEmail($_POST['email'])) $errors[] = "Invalid email format.";
    
//     // Mobile number validation
//     if (!isOptionalMobile($_POST['mobile'])) $errors[] = "Invalid mobile number format.";

//     if (!isRequired($_POST['state'])) $errors[] = "State is required.";
//     if (!isRequired($_POST['city'])) $errors[] = "City is required.";
//     if (!isRequired($_POST['address'])) $errors[] = "Address is required.";

//     // Handle file upload
//     if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
//         $allowedTypes = array('image/jpeg', 'image/png', 'image/jpg');
//         if (!in_array($_FILES['profile_image']['type'], $allowedTypes)) {
//             $errors[] = "Only JPG, JPEG, PNG files are allowed for profile image.";
//         }
//     }

//     // Final decision
//     if (!empty($errors)) {
//         // Handle errors
//         foreach ($errors as $error) {
//             echo "<p style='color:red;'>$error</p>";
//         }
//     } else {
//         // Proceed with processing / DB insertion
//         echo "<p style='color:green;'>Form submitted successfully!</p>";
//         // Save to DB, handle file upload, etc.
//     }
		
		
// 		pr($_POST);
// 		die();

// 		$educatorId = $this->session->userdata('educator_id');
		
// 		if(isset($_POST['submit'])){
// 		 $first_name     =  $_POST['first_name'];
// 		 $last_name      =  $_POST['last_name'];
// 		 $age      		=  $_POST['age'];
// 		 $gender     	 =  $_POST['gender'];
// 		 $email          =  $_POST['email'];		 
// 		 $mobile         =  $_POST['mobile'];
// 		 $city           =  $_POST['city'];
// 		 $state          =  $_POST['state'];
// 		 $address        =  $_POST['address'];			
// 		 $height        =  $_POST['height'];			
// 		 $weight        =  $_POST['weight'];			
// 		 $bmi           =  $_POST['bmi'];			
// 		 $waist_to_height_ratio        =  $_POST['waist_to_height_ratio'];			
// 		 $profile_image  =  $_POST['profile_image']; 	
		 
		 
// // Required fields
// $required_fields = array('first_name', 'last_name', 'age', 'gender', 'email', 'mobile', 'city', 'state', 'address', 'height', 'weight', 'bmi', 'waist_to_height_ratio');
// $errors = array();

// // Validate required fields
// foreach ($required_fields as $field) {
// if (empty($_POST[$field])) {
// 	$errors[] = ucfirst($field) . " is required.";
// } else {
// 	$field = sanitize_input($_POST[$field]);
// }
// }	 
		 
		 
// // Handle file upload if exists
// $profileImageName = '';
// if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
//     $fileTmpPath = $_FILES['profile_image']['tmp_name'];
//     $fileName = $_FILES['profile_image']['name'];
//     $fileSize = $_FILES['profile_image']['size'];
//     $fileType = $_FILES['profile_image']['type'];
//     $fileNameCmps = explode(".", $fileName);
//     $fileExtension = strtolower(end($fileNameCmps));

//     //$allowedfileExtensions = array('jpg', 'jpeg', 'png');
// 	$allowedfileExtensions =  imageExtensionAllow();

//     if (in_array($fileExtension, $allowedfileExtensions)) {
//         $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
//         $uploadFileDir = './uploads/';
//         $dest_path = $uploadFileDir . $newFileName;

//         /*if (!is_dir($uploadFileDir)) {
//             mkdir($uploadFileDir, 0777, true);
//         }*/

//         if (move_uploaded_file($fileTmpPath, $dest_path)) {
//             $profileImageName = $newFileName;
//         } else {
//             $errors[] = "There was an error uploading the file.";
//         }
//     } else {
//         $errors[] = "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
//     }
// }

// 		if (!empty($errors)) {
// 			foreach ($errors as $error) {
// 				echo "<p style='color:red;'>$error</p>";
// 			}
// 			exit;
// 		}
		

$Doctor = $_POST['Doctor'];
$palace = $_POST['palace'];
$hcp_name = $_POST['hcp_name'];
$msl_code = $_POST['msl_code'];
$p_code = $_POST['p_code'];
$speciality = $_POST['speciality'];
$first_name = $_POST['first_name'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$age = $_POST['age'];
$bp = $_POST['bp'];
$urea = $_POST['urea'];
$lv_ef = $_POST['lv_ef'];
$heart_rate = $_POST['heart_rate'];
$nt_pro_bnp = $_POST['nt_pro_bnp'];
$egfr = $_POST['egfr'];
$potassium = $_POST['potassium'];
$sodium = $_POST['sodium'];
$uric_acid = $_POST['uric_acid'];
$creatinine = $_POST['creatinine'];

		$doctorId = $Doctor;
		$patientInquiryData = array();
		$patientInquiryData['first_name'] = $first_name;
		//$patientInquiryData['last_name'] = $last_name;
		$patientInquiryData['age'] = $age;
		$patientInquiryData['gender'] = $gender;
		$patientInquiryData['email'] = $email;		
		$patientInquiryData['mobile'] = $mobile;
		$patientInquiryData['city'] = $city;
		$patientInquiryData['state'] = $state;
		$patientInquiryData['address'] = $address;
		$patientInquiryData['height'] = $height;
		$patientInquiryData['weight'] = $weight;
		$patientInquiryData['bmi'] = $bmi;
		$patientInquiryData['waist_to_height_ratio'] = $waist_to_height_ratio;		
		$patientInquiryData['doctor_id'] = $doctorId;
		$patientInquiryData['educator_id'] = $educatorId;

	
		$patientInquiryData['palace'] = $palace;
		$patientInquiryData['hcp_name'] = $hcp_name;
		$patientInquiryData['msl_code'] = $msl_code;
		$patientInquiryData['p_code'] = $p_code;
		$patientInquiryData['speciality'] = $speciality;
		$patientInquiryData['bp'] = $bp;
		$patientInquiryData['urea'] = $urea;
		$patientInquiryData['lv_ef'] = $lv_ef;
		$patientInquiryData['heart_rate'] = $heart_rate;
		$patientInquiryData['nt_pro_bnp'] = $nt_pro_bnp;
		$patientInquiryData['egfr'] = $egfr;
		$patientInquiryData['potassium'] = $potassium;
		$patientInquiryData['sodium'] = $sodium;
		$patientInquiryData['uric_acid'] = $uric_acid;
		$patientInquiryData['creatinine'] = $creatinine;
		
		if($profileImageName){
			$patientInquiryData['profile_image'] = $profileImageName;
		}

		//pr($patientInquiryData);		
		$inquiry_id = $this->master_model->save('patient_inquiry',$patientInquiryData); 
		
		unset($patientInquiryData);
        
        if($inquiry_id){
		$this->session->set_flashdata('message','Patient inquiry create successfully');
		}else{
			$this->session->set_flashdata('error','Try again ! Patient inquiry not created');
		}

		redirect(base_url().'/Patient-Inquiry');		 
		
		
	}
	
	public function getDoctorsList()
{
    $educatorId = $this->session->userdata('educator_id');			
    $query = "SELECT id, name FROM `doctors_new` WHERE `educator_id`='".$educatorId."'";
    $doctorsData = $this->master_model->customQueryArray($query);

    if(!$doctorsData){
        echo json_encode(array());
        die();
    }
    
    echo json_encode($doctorsData);
    die();
}
	
	public function changePassword()
	{				
		$this->load->view('educator/change-password');	
	}
	
	public function changePasswordPost()
	{				
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			 $oldPassword = $_POST['currentPassword'];
			 $newPassword = $_POST['newPassword'];
			
			if(!$oldPassword){
			$this->session->set_flashdata('error','Old Password Empty');
			redirect(base_url().'/educator-change-password');
			}
			
			if(!$newPassword){
			$this->session->set_flashdata('error','New Password Empty');
			redirect(base_url().'/educator-change-password');
			}
			
			$educatorId = $this->session->userdata('educator_id');
			
			$query = "SELECT * FROM `educator` WHERE `password`='".$oldPassword."' and `id`='".$educatorId."';";
			$educatorData = $this->master_model->customQueryArray($query);
			
			if($educatorData){	
					
				$educatorPasswordData = array();
				$educatorPasswordData['id'] = $educatorId;
				$educatorPasswordData['password'] = $newPassword;	
				$row = $this->master_model->save('educator',$educatorPasswordData);
				unset($educatorPasswordData);
				
				$this->session->set_flashdata('message','Password update Successfully');
				redirect(base_url().'/educator-change-password');
					
			}else{
			$this->session->set_flashdata('error','Password Not Matched');
			redirect(base_url().'/educator-change-password');
			}
		
		
		}
	}

	public function stopCamp()
	{	
		$camp_id = $_POST['camp_id'];
		$remarks = $_POST['remarks'];

		$educatorId = $this->session->userdata('educator_id');			
		$query = "SELECT * FROM `camp` WHERE `edcator_id`='".$educatorId."' and id='".$camp_id."'";
		$campData = $this->master_model->customQueryArray($query);

		if(!$campData){
			$message = "Invalid Details";
			$data = array('message'=>$message);	
			echo json_encode($data);
			die();
		}

		$campData = array();		
		$campData['out_time'] = date('Y-m-d h:i:s'); 
		$campData['id'] = $camp_id; 
		$campData['remarks'] = $remarks; 
		$this->master_model->save('camp',$campData);
		$message = "Your Camp is End Now";
		$data = array('message'=>$message);	
		echo json_encode($data);
		die();
		
	}


	public function startCamp()
	{				
			$educatorId = $this->session->userdata('educator_id');
			$date= date('Y-m-d');	
			$doctorId=$_POST['doctor_id'];
			$doctorName=$_POST['doctor_name'];		
			$query = "SELECT * FROM `camp` WHERE `edcator_id`='".$educatorId."' and  date='".$date."' and  in_time!='' and out_time='' limit 1";
			$educatorData = $this->master_model->customQueryArray($query);
            //die();
			$camp_id = $_POST['camp_id'];
			
			if(!$educatorData){	
					$campData = array();
				    $campData['edcator_id'] = $educatorId;
				    $campData['date'] = date('Y-m-d');
				    $campData['in_time'] = date('Y-m-d h:i:s'); 
				    $campData['camp_id'] = $camp_id; 
				    $campData['hcp_id'] = $doctorId; 
				    $campData['hcp_name'] = $doctorName; 
				    $this->master_model->save('camp',$campData);
					
					$message = "Your Camp is Start";
					$data = array('message'=>$message);	
					echo json_encode($data);
					die();
					
			}else{
			 $message = "Please Close Previous Camp";
			 $data = array('message'=>$message);	
			 echo json_encode($data);
			 die();
			}	
		
	}
	
	
	 
	public function logout(){
		$this->session->unset_userdata('educator_id');
		redirect(base_url().'/Educator-login');
	}


	public function createDoctor(){
	   die();
		$handle = fopen("hridayam_doctors.csv", "r");
		$sr = 1;
		while (($row = fgetcsv($handle)) !== FALSE) {
		// do something with row values
		if($sr!=1){
		//print_r($row);
		//echo "<br>";
		//echo "<br>";
		//die();
		$mslCode  = $row[0];
		$drName  = $row[1];
		$status = $row[2];
		$city  = $row[3];
		$state  = $row[4];
		$zone  = $row[5];
		$rmName  = $row[6];
		$educatorId  = $row[7];	
		$educatorName  =  $row[8];	
		$zone = strtolower($zone);

		if($zone=='east'){
			$zoneString = "1";
		}
		if($zone=='west'){
			$zoneString = "2";
		}
		if($zone=='north'){
			$zoneString = "3";
		}
		if($zone=='south'){
			$zoneString = "4";
		}

		$statusString = ($status=='active') ? 1 : 2;
		
		$educator = "SELECT * FROM `doctors_new` WHERE `msl_code` = '".$mslCode."'";				
				$check_educator_data 	= $this->master_model->customQueryRow($educator); 

				if(!$check_educator_data){						
							//$password  = generateRandomPassword();
							$educatorData = array();
							$educatorData['msl_code'] = $mslCode;
							$educatorData['name'] = trim($drName);
							$educatorData['state'] = $state;
							$educatorData['city'] = $city;
							$educatorData['staus'] = $statusString;
							$educatorData['zone'] = $zoneString;			
							
							//pr($educatorData);
							//die();

							echo "educator_id : ".$educator_id = $this->master_model->save('doctors_new',$educatorData);
							echo "<br>";
							echo "<br>";
							//pr($educatorData); 
							//echo "<br>"; echo "<br>";
							unset($educatorData);
							//die();						
			    }
			//die();
		

		}
		$sr++;
		}
		fclose($handle);
    }

	public function createEducator(){
		//die();
		//$handle = fopen("hridayam_doctors.csv", "r");
		$handle = fopen("hridayam_doctors_2.csv", "r");
		$sr = 1;
		while (($row = fgetcsv($handle)) !== FALSE) {
		// do something with row values
		if($sr!=1){
		//print_r($row);
		//echo "<br>";
		//echo "<br>";
		//die();
		/*$mslCode  = $row[0];
		$drName  = $row[1];
		$status = $row[2];
		$city  = $row[3];
		$state  = $row[4];
		$zone  = $row[5];
		$rmName  = $row[6];
		$educatorId  = $row[7];	
		$educatorName  =  $row[8];	
		$zone = strtolower($zone);*/
		
		
		$mslCode  = trim($row[0]); 
		$drName  = $row[1];
		$speciality = $row[2];
		$status = $row[3];		
		$first_vist  = $row[4];
		$city  = $row[5];
		$state  = $row[6];
		$zone  = $row[7];
		$rmName  = $row[8];
		$educatorId  = $row[9];	
		$educatorName  =  $row[10];	
		$zone = strtolower($zone);
		

		// if($zone=='east'){
		// 	$zoneString = "1";
		// }
		// if($zone=='west'){
		// 	$zoneString = "2";
		// }
		// if($zone=='north'){
		// 	$zoneString = "3";
		// }
		// if($zone=='south'){
		// 	$zoneString = "4";
		// }

		// $statusString = ($status=='active') ? 1 : 2;
		
		$educator = "SELECT * FROM `educator` WHERE `emp_id` = '".$educatorId."'";				
				$check_educator_data 	= $this->master_model->customQueryRow($educator); 

				if(!$check_educator_data){						
							$password  = generateRandomPassword();
							$educatorData = array();
							$educatorData['emp_id'] = $educatorId;
							$educatorData['first_name'] = $educatorName;
							$educatorData['password'] = $password;
							//pr($educatorData);
							//die();

							echo "educator_id : ".$educator_id = $this->master_model->save('educator',$educatorData);
							echo "<br>";
							echo "<br>";
							//pr($educatorData); 
							//echo "<br>"; echo "<br>";
							unset($educatorData);
							//die();						
			    }
			//die();
		

		}
		$sr++;
		}
		fclose($handle);
    }
	


	public function mapDoctorToEducator(){
		die();
		//$handle = fopen("hridayam_doctors.csv", "r");
		$handle = fopen("hridayam_doctors_2.csv", "r");
		
		$sr = 1;
		while (($row = fgetcsv($handle)) !== FALSE) {
		// do something with row values
		if($sr!=1){
		//print_r($row);
		//echo "<br>";
		//echo "<br>";
		//die();
		/*$mslCode  = $row[0];
		$drName  = $row[1];
		$status = $row[2];
		$city  = $row[3];
		$state  = $row[4];
		$zone  = $row[5];
		$rmName  = $row[6];
		$educatorId  = $row[7];	
		$educatorName  =  $row[8];	
		$zone = strtolower($zone);*/
		
		
		$mslCode  = trim($row[0]); 
		$drName  = $row[1];
		$speciality = $row[2];
		$status = $row[3];		
		$first_vist  = $row[4];
		$city  = $row[5];
		$state  = $row[6];
		$zone  = $row[7];
		$rmName  = $row[8];
		$educatorId  = $row[9];	
		$educatorName  =  $row[10];	
		$zone = strtolower($zone);
		
		

		// if($zone=='east'){
		// 	$zoneString = "1";
		// }
		// if($zone=='west'){
		// 	$zoneString = "2";
		// }
		// if($zone=='north'){
		// 	$zoneString = "3";
		// }
		// if($zone=='south'){
		// 	$zoneString = "4";
		// }

		// $statusString = ($status=='active') ? 1 : 2;
		
		$educator = "SELECT * FROM `educator` WHERE `emp_id` = '".$educatorId."'";				
		$educator_data 	= $this->master_model->customQueryRow($educator); 

		$doctors_new = "SELECT * FROM `doctors_new` WHERE `msl_code` = '".$mslCode."'";				
		$doctors_data 	= $this->master_model->customQueryRow($doctors_new); 

				if($educator_data && $doctors_data){

					//pr($doctors_data);
					//die();
					
					$educatorID = $educator_data->id;
					$doctorID   = $doctors_data->id;

							$password  = generateRandomPassword();
							$educatorData = array();							
							$educatorData['educator_id'] = $educatorID;
							$educatorData['id'] = $doctorID;
							pr($educatorData);
							//die();

							$this->master_model->save('doctors_new',$educatorData);
							echo "<br>";
							echo "<br>";
							//pr($educatorData); 
							//echo "<br>"; echo "<br>";
							unset($educatorData);
							//die();						
			    }
			//die();
		

		}
		$sr++;
		}
		fclose($handle);
    }
	
	public function procress_hridayam_doctors_sheet_two(){
		die();
		
		ini_set('memory_limit', '256M');
		
		
		
		$lines = file("hridayam_doctors_2.csv");
		
		//print_r($lines);
		//die();
		
		/* loop through the array and explode each ine */
		for($i=0;$i<count($lines);$i++) { 
		
		if($i!=0)	{
		//$line_array = explode(",", $lines[$i]);	
		$row = explode(",", $lines[$i]);	
		
		//echo $row[0] . "<br/>";
		//echo $row[1] . "<br/>";
		//echo $row[2] . "<br/>";
		
		
		
		$mslCode  = trim($row[0]); 
		$drName  = $row[1];
		$speciality = $row[2];
		$status = $row[3];		
		$first_vist  = $row[4];
		$city  = $row[5];
		$state  = $row[6];
		$zone  = $row[7];
		$rmName  = $row[8];
		$educatorId  = $row[9];	
		$educatorName  =  $row[10];	
		$zone = strtolower($zone);
		
		 if($zone=='east'){
		 	$zoneString = "1";
		 }
		 if($zone=='west'){
		 	$zoneString = "2";
		 }
		 if($zone=='north'){
		 	$zoneString = "3";
		 }
		 if($zone=='south'){
		 	$zoneString = "4";
		 }

		 $statusString = ($status=='Active') ? 1 : 2;
		
		
		$doctors_new = "SELECT * FROM `doctors_new` WHERE `msl_code` = '".trim($mslCode)."'";				
		$check_educator_data 	= $this->master_model->customQueryRow($doctors_new);
		//echo "<hr>";
		
			if(!$check_educator_data){
				
				$educatorData = array();
				$educatorData['msl_code'] = trim($mslCode);
				$educatorData['name'] = trim($drName);
				$educatorData['state'] = trim($state);
				$educatorData['city'] = trim($city);
				$educatorData['staus'] = trim($statusString);
				$educatorData['zone'] = trim($zoneString);
				$educatorData['speciality'] = trim($speciality);
				$educatorData['first_vist'] = trim($first_vist);
				pr($educatorData);
				$educator_id = $this->master_model->save('doctors_new',$educatorData);
				unset($educatorData);
				echo "<br>"; echo "<br>";
				print_r($row);	 
			}else{			
				//$doctorId = $check_educator_data->id;
				//$drName = $check_educator_data->name;
				
				/*$educatorData = array();
				$educatorData['msl_code'] = trim($mslCode);
				$educatorData['name'] = trim($drName);				
				$educatorData['speciality'] = trim($speciality);
				$educatorData['first_vist'] = trim($first_vist);
				$educatorData['id'] = $doctorId;
				pr($educatorData);
				echo "<br>";*/
				//$educator_id = $this->master_model->save('doctors_new',$educatorData);
				//unset($educatorData);
				
				//echo "mslCode : ".$mslCode;
				//echo "<br>"; echo "<br>";
				
				
			}
		
		
		}
		} 

		
		die();
		
		
		//die();
		$handle = fopen("hridayam_doctors_2.csv", "r");
		$sr = 1;
		//while(($row = fgetcsv($handle, 10000, ",", '\r')) !== false){
		while (($row = fgetcsv($handle,10240)) !== FALSE) {
			
		
		//$handle = fopen("file.csv", "r");
		//$data = fgetcsv($handle, 1000, ",");
		//echo $data[0];
		
		
		// do something with row values
		if($sr!=1){
		//print_r($row);
		//echo "<br>";
		//echo "<br>";
		//die();
		$mslCode  = $row[0];
		$drName  = $row[1];
		$speciality = $row[2];
		$status = $row[3];		
		$first_vist  = $row[4];
		$city  = $row[5];
		$state  = $row[6];
		$zone  = $row[7];
		$rmName  = $row[8];
		$educatorId  = $row[9];	
		$educatorName  =  $row[10];	
		$zone = strtolower($zone);
		
		// if($zone=='east'){
		// 	$zoneString = "1";
		// }
		// if($zone=='west'){
		// 	$zoneString = "2";
		// }
		// if($zone=='north'){
		// 	$zoneString = "3";
		// }
		// if($zone=='south'){
		// 	$zoneString = "4";
		// }

		// $statusString = ($status=='active') ? 1 : 2;
		
		$doctors_new = "SELECT * FROM `doctors_new` WHERE `msl_code` = '".$mslCode."'";				
		$check_educator_data 	= $this->master_model->customQueryRow($doctors_new);
			if(!$check_educator_data){
				
				/*$educatorData = array();
				$educatorData['msl_code'] = trim($mslCode);
				$educatorData['name'] = trim($drName);
				$educatorData['state'] = trim($state);
				$educatorData['city'] = trim($city);
				$educatorData['staus'] = trim($statusString);
				$educatorData['zone'] = trim($zoneString);
				$educatorData['speciality'] = trim($speciality);
				$educatorData['first_vist'] = trim($first_vist);	*/
				
				echo "<br>"; echo "<br>";
				print_r($row);	
			}else{			
				$doctorId = $check_educator_data->id;
				//$drName = $check_educator_data->name;
				
				/*$educatorData = array();
				$educatorData['msl_code'] = trim($mslCode);
				$educatorData['name'] = trim($drName);				
				$educatorData['speciality'] = trim($speciality);
				$educatorData['first_vist'] = trim($first_vist);
				$educatorData['id'] = $doctorId;
				pr($educatorData);
				echo "<br>";*/
				//$educator_id = $this->master_model->save('doctors_new',$educatorData);
				
				echo "mslCode : ".$mslCode;
				echo "<br>"; echo "<br>";
				
				
			}	
		}
		$sr++;
		}
		fclose($handle);
    }



	public function createRm(){
		die();
		ini_set('memory_limit', '256M');
		$lines = file("hridayam_doctors_2.csv");

		for($i=0;$i<count($lines);$i++) { 
		
		if($i!=0)	{
					//$line_array = explode(",", $lines[$i]);	
					$row = explode(",", $lines[$i]);	
					$mslCode  = trim($row[0]); 
					$drName  = $row[1];
					$speciality = $row[2];
					$status = $row[3];		
					$first_vist  = $row[4];
					$city  = $row[5];
					$state  = $row[6];
					$zone  = $row[7];
					$rmName  = $row[8];
					$educatorId  = $row[9];	
					$educatorName  =  $row[10];	
					$zone = strtolower($zone);

					if($zone=='east'){
					$zoneString = "1";
					}
					if($zone=='west'){
					$zoneString = "2";
					}
					if($zone=='north'){
					$zoneString = "3";
					}
					if($zone=='south'){
					$zoneString = "4";
					}

					$statusString = ($status=='Active') ? 1 : 2;
		
		
				$educator = "SELECT * FROM `rm_name` WHERE `name` = '".$rmName."'";				
				$rmdata 	= $this->master_model->customQueryRow($educator); 
 
				if(!$rmdata){
		
									$username = preg_replace('/\s+/', '', $rmName);
									$uniqueNumber = rand(10000, 99999);
									$username = $username.$uniqueNumber;
		
									//$rm_name_ID = $rm_name_data->id;
									$password  = generateRandomPassword();
									$rmData = array();							
									$rmData['name'] = $rmName;
									$rmData['username'] = $username;
									$rmData['password'] = $password;
									pr($rmData);
									//die();
									$this->master_model->save('rm_name',$rmData);
									echo "<br>";
									echo "<br>";
									//pr($educatorData); 
									//echo "<br>"; echo "<br>";
									unset($rmData);
									//die();						
					}
		
		
		  }
	    } 

		
		die();
		fclose($handle);
    }

	public function mapRmToEdcator(){
		die();
		ini_set('memory_limit', '256M');
		$lines = file("hridayam_doctors_2.csv");

		for($i=0;$i<count($lines);$i++) { 
		
		if($i!=0)	{
					//$line_array = explode(",", $lines[$i]);	
					$row = explode(",", $lines[$i]);	
					$mslCode  = trim($row[0]); 
					$drName  = $row[1];
					$speciality = $row[2];
					$status = $row[3];		
					$first_vist  = $row[4];
					$city  = $row[5];
					$state  = $row[6];
					$zone  = $row[7];
					$rmName  = $row[8];
					$educatorEmpId  = $row[9];	
					$educatorName  =  $row[10];	
					$zone = strtolower($zone);

					if($zone=='east'){
					$zoneString = "1";
					}
					if($zone=='west'){
					$zoneString = "2";
					}
					if($zone=='north'){
					$zoneString = "3";
					}
					if($zone=='south'){
					$zoneString = "4";
					}

					$statusString = ($status=='Active') ? 1 : 2;
		
		
					$educator = "SELECT * FROM `rm_name` WHERE `name` = '".$rmName."'";				
					$rmdata 	= $this->master_model->customQueryRow($educator); 
 
						if($rmdata){
							$rmId = $rmdata->id;
							
											$educator = "SELECT * FROM `educator` WHERE `emp_id` = '".$educatorEmpId."'";				
											$educatorData 	= $this->master_model->customQueryRow($educator); 
											$educatorId =  $educatorData->id;
											
											$educatorData = array();
											$educatorData['rm_id'] = $rmId;
											$educatorData['id'] = $educatorId;
											pr($educatorData); 
											//die();
											$this->master_model->save('educator',$educatorData);
											echo "<br>";
											echo "<br>";
											//pr($educatorData); 
											//echo "<br>"; echo "<br>";
											unset($educatorData);
											//die();						
						}			
		    }	
	    } 

		
		die();
		fclose($handle);
    }
	public function executed()
	{
		$camp_id = $_POST['camp_id'];
		$execution_status = $_POST['execution_status'];

		$educatorId = $this->session->userdata('educator_id');			
		$query = "SELECT * FROM `camp` WHERE `edcator_id`='".$educatorId."' and id='".$camp_id."'";
		$campData = $this->master_model->customQueryArray($query);

		if(!$campData){
			$message = "Camp is NOT Started";
			$data = array('message'=>$message);	
			echo json_encode($data);
			die();
		}

		$campData = array();		
		$campData['id'] = $camp_id; 
		$campData['execution_status'] = $execution_status; 
		$this->master_model->save('camp',$campData);
		$message = "Your Execution Status is Updated";
		$data = array('message'=>$message);	
		echo json_encode($data);
		die();
	}
	
	public function notexecuted()
	{
		$camp_id = $_POST['camp_id'];
		$execution_status = $_POST['execution_status'];
		$remarks = $_POST['remarks'];

		$educatorId = $this->session->userdata('educator_id');			
		$query = "SELECT * FROM `camp` WHERE `edcator_id`='".$educatorId."' and id='".$camp_id."'";
		$campData = $this->master_model->customQueryArray($query);

		if(!$campData){
			$message = "Camp is NOT Started";
			$data = array('message'=>$message);	
			echo json_encode($data);
			die();
		}

		$campData = array();
		$campData['id'] = $camp_id; 
		$campData['execution_status'] = $execution_status; 
		$campData['remarks'] = $remarks; 
		$this->master_model->save('camp',$campData);
		$message = "Your Execution Status is Updated";
		$data = array('message'=>$message);	
		echo json_encode($data);
		die();
	}

	public function activeCamp()
	{
		$educatorId = $this->session->userdata('educator_id');		
		$today = date('Y-m-d'); 	
		$query = "SELECT * FROM `camp` 
              WHERE `edcator_id` = '".$educatorId."' 
              AND `in_time` IS NOT NULL 
              AND (`out_time` IS NULL OR `out_time` = '')
              AND `date` = '".$today."'";
			//   echo $query;die;
		$campData = $this->master_model->customQueryArray($query);
		$status = "success";
		if(!$campData){
			$status = "fail";
			$message = "Invalid Details";
			$data = array('status'=>$status,'message'=>$message);	
			echo json_encode($data);
			die();
		}
		echo   json_encode(array('status'=>$status));
	   die();
	}
	public function getMedicinesByHeader()
	{
		$header = $_POST['header'];
		$header_view_query = "SELECT `medicine_name` FROM `medicines` WHERE `header` = '".$header."'";		
		$medicines 	= $this->master_model->customQueryArray($header_view_query); 
		$status='success';
		$medicine_names = array();
		foreach($medicines as $medicine) {
			  $medicine_list[] = array('name' => $medicine['medicine_name']);
		}
	   
		echo   json_encode(array('status'=>$status,'medicines'=>$medicine_list));
	   die();
	}

	public function analyticDashboard()
	{
		$this->load->view('educator/analytics');
	}
}
