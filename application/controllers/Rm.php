<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rm extends CI_Controller {

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
			if ( ! $this->session->userdata('rm_id'))
			{   
				redirect(base_url().'/rm-login');			
			}	
		}
	

	
	public function index()
	{
		if($this->session->userdata('rm_id')){
		redirect('rm-dashboard');				
		}else{
		  redirect('rm-login');
		}
	}
	
	
	public function rmDashBoard()
	{	
		//echo "rmDashBoard ";	
		//die();	 
		$this->load->view('rm/dashboard');	
	}


	public function rmDashBoardFilter()
	{	
		//echo "rmDashBoard ";	
		//die();	 
		$this->load->view('rm/dashboard_filter');	
	} 
	
	public function rmDashBoardTable()
	{	
		//echo "rmDashBoard ";	
		//die();	 
		$this->load->view('rm/dashboardTable');
	}
	
	
	// public function createPatientInquiryOld()
	// {				
	// 	$this->load->view('rm/create-patient-inquiry');	
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
		// pr($DoctorDetails);
	   // die();		
	   
		echo   json_encode(array('status'=>$status,'msl_code'=>$mslCode,'city'=>$city,'speciality'=>$speciality));
	   die();
   }
	

	public function patientList()
	{				
		$this->load->view('rm/patient-list');	
	}
	
	
	public function createPatientInquiry()
	{				
		$this->load->view('rm/create-patient-inquiry-new');	
	}



	function clean_input($data) {
		return htmlspecialchars(trim($data));
	}
	


	public function createPatientInquiryPost()
	{
		
		if(!$this->session->userdata('rm_id')){
			redirect('rm-login');
		}

		$rmId = $this->session->userdata('rm_id');

		function clean_input($data) {
			return htmlspecialchars(trim($data));
		}


foreach ($_POST as $field) {
    $_POST[$field] = clean_input($_POST[$field]);    
}

// Required fields
// $requiredFields = ['Doctor', 'msl_code', 'first_name', 'gender', 'weight', 'height','Waist_circumference', 'bmi', 'WH_Ratio'];

// // Validate required fields
// foreach ($requiredFields as $field) {
//     if (empty($_POST[$field])) {
// 		$field = str_replace('_',' ',$field);
//         //die("Error: '$field' is required.");
// 		$this->session->set_flashdata('error',"Error: $field is required.");
// 		redirect(base_url().'/Patient-Information');
// 		die();
//     }
// }


if(!isset($_FILES['fileToUpload']['name'])){
	$this->session->set_flashdata('error',"Please Upload Prescription.");
	redirect(base_url().'/Patient-Information');
	die();
}

$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
$fileExtension = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
if (!in_array($fileExtension, $allowedExtensions)) {
		$this->session->set_flashdata('error','The uploaded file format is not supported. Please upload a valid image file (JPG, PNG, JPEG).');
		redirect(base_url().'/Patient-Information');
		die();
}

// Assign values to array
$patientFormData = array();


$patientFormData['rm_id']                = $rmId;
$patientFormData['hcp_name']                = $_POST['hcp_name'] ?? '';
$patientFormData['msl_code']                = $_POST['msl_code'] ?? '';
$patientFormData['city']                    = $_POST['city'] ?? '';
$patientFormData['state']                    = $_POST['state'] ?? '';
$patientFormData['speciality']              = $_POST['speciality'] ?? '';
$patientFormData['patient_name']            = $_POST['patient_name'] ?? '';
$patientFormData['patient_enrolled']            = $_POST['patientEnrolled'] ?? '';
$patientFormData['age']                     = $_POST['age'] ?? '';
$patientFormData['mobile_number']           = $_POST['mobile_number'] ?? '';
$patientFormData['gender']                  = $_POST['gender'] ?? '';
$patientFormData['medicine']                = $_POST['medicine'] ?? '';
$patientFormData['date_of_discharge']       = $_POST['date_of_discharge'] ?? '';
$patientFormData['cipla_brand_prescribed']       = $_POST['ciplaBrandPrescribed'] ?? '';

$patientFormData['blood_pressure']          = $_POST['blood_pressure'] ?? '';
$patientFormData['urea']                    = $_POST['urea'] ?? '';
$patientFormData['lv_ef']                   = $_POST['lv_ef'] ?? '';
$patientFormData['heart_rate']              = $_POST['heart_rate'] ?? '';
$patientFormData['nt_pro_bnp']              = $_POST['nt_pro_bnp'] ?? '';
$patientFormData['egfr']                    = $_POST['egfr'] ?? '';
$patientFormData['potassium']               = $_POST['potassium'] ?? '';
$patientFormData['sodium']                  = $_POST['sodium'] ?? '';
$patientFormData['uric_acid']               = $_POST['uric_acid'] ?? '';
$patientFormData['creatinine']              = $_POST['creatinine'] ?? '';
$patientFormData['crp']                     = $_POST['crp'] ?? '';
$patientFormData['uacr']                    = $_POST['uacr'] ?? '';
$patientFormData['iron']                    = $_POST['iron'] ?? '';

$patientFormData['hb']                      = $_POST['hb'] ?? '';
$patientFormData['ldl']                     = $_POST['ldl'] ?? '';
$patientFormData['hdl']                     = $_POST['hdl'] ?? '';
$patientFormData['triglycerid']             = $_POST['triglycerid'] ?? '';
$patientFormData['total_cholesterol']       = $_POST['total_cholesterol'] ?? '';
$patientFormData['hba1c']                   = $_POST['hba1c'] ?? '';
$patientFormData['sgot']                    = $_POST['sgot'] ?? '';
$patientFormData['sgpt']                    = $_POST['sgpt'] ?? '';
$patientFormData['vit_d']                   = $_POST['vit_d'] ?? '';
$patientFormData['t3']                      = $_POST['t3'] ?? '';
$patientFormData['t4']                      = $_POST['t4'] ?? '';
$patientFormData['anti_diabetic_therapy']   = $_POST['anti_diabetic_therapy'] ?? '';

$patientFormData['arni']                    = $_POST['arni'] ?? '';
$patientFormData['b_blockers']              = $_POST['b_blockers'] ?? '';
$patientFormData['mra']                     = $_POST['mra'] ?? '';

$patientFormData['arni_remark']                    = $_POST['arni_remark'] ?? '';
$patientFormData['b_blockers_remark']              = $_POST['b_blockers_remark'] ?? '';
$patientFormData['mra_remark']                     = $_POST['mra_remark'] ?? '';


$patientFormData['remark']                  = $_POST['remark'] ?? '';

$patientFormData['weight']                  = $_POST['weight'] ?? '';
$patientFormData['height']                  = $_POST['height'] ?? '';
$patientFormData['waist_circumference_remark'] = $_POST['waist_circumference_remark'] ?? '';
$patientFormData['bmi']                     = $_POST['bmi'] ?? '';
$patientFormData['waist_to_height_ratio']   = $_POST['waist_to_height_ratio'] ?? '';

// Radio buttons
$patientFormData['vaccination']            = $_POST['vaccination'] ?? '';
$patientFormData['influenza']              = $_POST['influenza'] ?? '';
$patientFormData['pneumococcal']           = $_POST['pneumococcal'] ?? '';
$patientFormData['cardiac_rehab']          = $_POST['cardiac_rehab'] ?? '';
$patientFormData['nsaids_use']             = $_POST['nsaids_use'] ?? '';
$patientFormData['patient_kit_given']      = $_POST['patient_kit_given'] ?? '';
$patientFormData['exercise_30mins']        = $_POST['exercise_30mins'] ?? '';
$patientFormData['breakfast_days']         = $_POST['breakfast_days'] ?? '';
$patientFormData['food_habits']            = $_POST['food_habits'] ?? '';
$patientFormData['sedentary_hours']        = $_POST['sedentary_hours'] ?? '';


$patientFormData['type_2_dm']        = $_POST['type_2_dm'] ?? '';
$patientFormData['hypertension']        = $_POST['hypertension'] ?? '';
$patientFormData['dyslipidemia']        = $_POST['dyslipidemia'] ?? '';
$patientFormData['pco']        = $_POST['pco'] ?? '';
$patientFormData['knee_pain']        = $_POST['knee_pain'] ?? '';
$patientFormData['asthma']        = $_POST['asthma'] ?? '';

$patientFormData['adl_bathing']        = $_POST['adl_bathing'] ?? '';
$patientFormData['adl_dressing']       = $_POST['adl_dressing'] ?? '';
$patientFormData['adl_walking']        = $_POST['adl_walking'] ?? '';
$patientFormData['adl_toileting']     = $_POST['adl_toileting'] ?? '';
$patientFormData['date']     = date('Y-m-d');


$uploadDir = 'uploads/';
$filename = time().basename($_FILES['fileToUpload']['name']);
$uploadPath = $uploadDir . $filename;
if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadPath)) {
    die("Error: Failed to upload prescription file.");
}

$patientFormData['prescription_file'] = $filename;

$filename = 'Consent-'.time().basename($_FILES['consentForm']['name']);
$uploadPath = $uploadDir .$filename;
if (!move_uploaded_file($_FILES['consentForm']['tmp_name'], $uploadPath)) {
    die("Error: Failed to upload Consent Form.");
}

$patientFormData['consent_form_file'] = $filename;



//pr($patientInquiryData);		
$inquiry_id = $this->master_model->save('patient_inquiry_new',$patientFormData); 
		
unset($patientFormData);

if($inquiry_id){
$this->session->set_flashdata('message','Patient information submitted successfully');
}else{
	$this->session->set_flashdata('error','Try again ! Patient information not created');
}

redirect(base_url().'/Patient-Information');	

		
	}


	
	public function createPatientInquiryPostOld()
	{
		
		if(!$this->session->userdata('rm_id')){
			redirect('rm-login');
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

// 		$rmId = $this->session->userdata('rm_id');
		
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
		$patientInquiryData['rm_id'] = $rmId;

	
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
	
	
	public function changePassword()
	{				
		$this->load->view('rm/change-password');	
	}
	
	public function changePasswordPost()
	{				
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			 $oldPassword = $_POST['currentPassword'];
			 $newPassword = $_POST['newPassword'];
			
			if(!$oldPassword){
			$this->session->set_flashdata('error','Old Password Empty');
			redirect(base_url().'/rm-change-password');
			}
			
			if(!$newPassword){
			$this->session->set_flashdata('error','New Password Empty');
			redirect(base_url().'/rm-change-password');
			}
			
			$rmId = $this->session->userdata('rm_id');
			
			$query = "SELECT * FROM `rm_name` WHERE `password`='".$oldPassword."' and `id`='".$rmId."';";
			$rmData = $this->master_model->customQueryArray($query);
			
			if($rmData){	
					
				$rmPasswordData = array();
				$rmPasswordData['id'] = $rmId;
				$rmPasswordData['password'] = $newPassword;	
				$row = $this->master_model->save('rm_name',$rmPasswordData);
				unset($rmPasswordData);
				
				$this->session->set_flashdata('message','Password update Successfully');
				redirect(base_url().'/rm-change-password');
					
			}else{
			$this->session->set_flashdata('error','Password Not Matched');
			redirect(base_url().'/rm-change-password');
			}
		
		
		}
	}
	
	
	 
	public function logout(){
		$this->session->unset_userdata('rm_id');
		redirect(base_url().'/rm-login'); 
	}
public function analytics()
{
	$this->load->view('rm/analytics');
}

}


	


	
