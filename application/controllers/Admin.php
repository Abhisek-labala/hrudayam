<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
			if ( ! $this->session->userdata('admin_id'))
			{   
				redirect(base_url().'/admin-login');			
			}	
		}
	

	
	public function index()
	{
		if($this->session->userdata('admin_id')){
			redirect('admin-dashboard');			
		}else{
		  redirect('admin-login');
		}
	}
	
	
	public function adminDashBoard()
	{
		//die();
		if(!$this->session->userdata('admin_id')){
			redirect('admin-login');
		}		
		$this->load->view('admin/dashboard');	
	}

	public function adminDashBoardTable()
	{
		if(!$this->session->userdata('admin_id')){
			redirect('admin-login');
		}
		
		$query = "SELECT * FROM `patient_inquiry_new` WHERE `educator_id`!='' ORDER BY `date` desc";
		$patient_inquiry_Data = $this->master_model->customQueryArray($query);
		$sr = 1;
		
		$excelData = array();
		$patientInquiryData = array();
		
		foreach($patient_inquiry_Data as $key=>$item){
		
		$educator_id = $item['educator_id'];
		
		$query = "SELECT * FROM `educator` WHERE `id` = '".$educator_id."'";
		$educatorData 	= $this->master_model->customQueryRow($query); 
		$educatorName =  $educatorData->first_name;
		$rmId =  $educatorData->rm_id;
		
		$query = "SELECT * FROM `rm_name` WHERE `id` = '".$rmId."'";
		$rmNameData 	= $this->master_model->customQueryRow($query); 
		$rmName =  $rmNameData->name; 
		
		$gender = ($item['gender']==1)  ? 'Male' : 'Female'; 
		
		$excelData[$sr]= array($sr,$item['date'],$item['patient_name'],$gender,$item['blood_pressure'],$item['bmi'], $educatorName,$rmName,$item['city']);
		$patientInquiryData[] = array('date'=>$item['date'],'patient_name'=>$item['patient_name'],'gender'=>$gender,'blood_pressure'=>$item['blood_pressure'],'bmi'=>$item['bmi'],'educator_name'=>$educatorName,'rm_name'=>$rmName,'city'=>$item['city']);
		
		}
		
		$fileName = 'hardiyam-'.time().".xlsx";	
		
		$viewData['patient_inquiry_Data'] = $patientInquiryData;
	    $viewData['fileName'] = $fileName;
			
		$this->load->view('admin/dashboardTable',$viewData);
		
		$this->makeXls($excelData,$fileName);
		//die();	
	}
	
	
	public function createEducator()
	{				
		$this->load->view('admin/create-educator');	
	}
	
	public function createEducatorPost()
	{
		
		if(!$this->session->userdata('admin_id')){
			redirect('admin-login');
		}
		
		if(isset($_POST['submit'])){
		 $first_name     =  $_POST['first_name'];
		 $last_name      =  $_POST['last_name'];
		 $email          =  $_POST['email'];
		 $password       =  $_POST['password'];
		 $mobile         =  $_POST['mobile'];
		 $city           =  $_POST['city'];
		 $state          =  $_POST['state'];
		 $address        =  $_POST['address'];	
		 $about          =  $_POST['about'];	
		 $profile_image  =  $_POST['profile_image']; 	
		 
		 
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
	$allowedfileExtensions =  imageExtensionAllow();

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
		
		$educatorData = array();
		$educatorData['first_name'] = $first_name;
		$educatorData['last_name'] = $last_name;
		$educatorData['email'] = $email;
		$educatorData['password'] = $password;
		$educatorData['mobile'] = $mobile;
		$educatorData['city'] = $city;
		$educatorData['state'] = $state;
		$educatorData['address'] = $address;
		$educatorData['about'] = $about;
		if($profileImageName){
			$educatorData['profile_image'] = $profileImageName;
		}		
		$user_id = $this->master_model->save('educator',$educatorData); 
		unset($educatorData);
        
        if($user_id){
		$this->session->set_flashdata('message','Educator create successfully');
		}

		redirect(base_url().'/Create-Educator');	
	 
	 }		
		
	}
	
	
	
	public function createDoctor()
	{				
		$this->load->view('admin/create-doctor');	
	}
	
	public function createDoctorPost()
	{
		
		
		if(!$this->session->userdata('admin_id')){
			redirect('admin-login');
		}
		
		if(isset($_POST['submit'])){
		 $first_name     =  $_POST['first_name'];
		 $last_name      =  $_POST['last_name'];
		 $email          =  $_POST['email'];
		 $password       =  $_POST['password'];
		 $mobile         =  $_POST['mobile'];
		 $city           =  $_POST['city'];
		 $state          =  $_POST['state'];
		 $address        =  $_POST['address'];	
		 $about          =  $_POST['about'];	
		 $profile_image  =  $_POST['profile_image']; 	
		 
		 
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
	$allowedfileExtensions =  imageExtensionAllow();

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
		
		$educatorData = array();
		$educatorData['first_name'] = $first_name;
		$educatorData['last_name'] = $last_name;
		$educatorData['email'] = $email;
		$educatorData['password'] = $password;
		$educatorData['mobile'] = $mobile;
		$educatorData['city'] = $city;
		$educatorData['state'] = $state;
		$educatorData['address'] = $address;
		$educatorData['about'] = $about;
		if($profileImageName){
			$educatorData['profile_image'] = $profileImageName;
		}		
		$user_id = $this->master_model->save('doctors',$educatorData); 
		unset($educatorData);
        
        if($user_id){
		$this->session->set_flashdata('message','Doctor create successfully');
		}

		redirect(base_url().'/Create-Doctor');	
	 
	 }  		
		
	}



    
    public function createDistrictManager()
	{				
		$this->load->view('admin/create-district-manager');	
	}
	
	public function createDistrictManagerPost()
	{
		
		if(!$this->session->userdata('admin_id')){
			redirect('admin-login');
		}
		
		if(isset($_POST['submit'])){
		 $first_name     =  $_POST['first_name'];
		 $last_name      =  $_POST['last_name'];
		 $email          =  $_POST['email'];
		 $password       =  $_POST['password'];
		 $mobile         =  $_POST['mobile'];
		 $city           =  $_POST['city'];
		 $state          =  $_POST['state'];
		 $address        =  $_POST['address'];	
		 $about          =  $_POST['about'];	
		 $profile_image  =  $_POST['profile_image']; 	
		 
		 
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
	$allowedfileExtensions =  imageExtensionAllow();

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
		if($profileImageName){
			$educatorData['profile_image'] = $profileImageName;
		}		
		$user_id = $this->master_model->save('district_managers',$managerData); 
		unset($managerData);
        
        if($user_id){
		$this->session->set_flashdata('message','District manager create successfully');
		}

		redirect(base_url().'/Create-District-Manager');	
	 
	 }		
		
	} 
	
	
	
	public function createZoneManager()
	{				
		$this->load->view('admin/create-zone-manager');	
	}
	
	public function createZoneManagerPost()
	{
		
		if(!$this->session->userdata('admin_id')){
			redirect('admin-login');
		}
		
		if(isset($_POST['submit'])){
		 $first_name     =  $_POST['first_name'];
		 $last_name      =  $_POST['last_name'];
		 $email          =  $_POST['email'];
		 $password       =  $_POST['password'];
		 $mobile         =  $_POST['mobile'];
		 $city           =  $_POST['city'];
		 $state          =  $_POST['state'];
		 $address        =  $_POST['address'];	
		 $about          =  $_POST['about'];	
		 $profile_image  =  $_POST['profile_image']; 	
		 
		 
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
	$allowedfileExtensions =  imageExtensionAllow();

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
		if($profileImageName){
			$educatorData['profile_image'] = $profileImageName;
		}		
		$user_id = $this->master_model->save('zone_managers',$managerData); 
		unset($managerData);
        
        if($user_id){
		$this->session->set_flashdata('message','Zone manager create successfully');
		}

		redirect(base_url().'/Create-Zone-Manager');	
	 
	 }		
		
	}
	
	
	
	public function assignEducatorView()
	{				
		$this->load->view('admin/assign-educator-view');	
	}
	
	
	public function assignEducatorPost()
	{				
		//pr($_POST);
		
		//$_POST['mapFrom'];
		//$doctorIds = $_POST['doctorIds'];
		
		$mapTo = $_POST['mapTo'];
		if($mapTo!=''){
		if(isset($_POST['educatorId'])) {
			$doctorIds = $_POST['educatorId'];
			$count = count($doctorIds);
			if($count==0){
					$this->session->set_flashdata('error','Please Select At one Dotctor To Map');
					redirect(base_url().'/Map-Educator-To-Doctor');	
					die();
			}
			
			
			foreach($doctorIds as $key=>$doctorItem){
				$mapArray = array();
				$mapArray['id'] = $doctorItem;
				$mapArray['abm_id'] = $mapTo;	
				//pr($mapArray);
				//die();			
				$row = $this->master_model->save('educator',$mapArray);
				unset($mapArray);
			}
			
			
			$this->session->set_flashdata('message','Map Successfully');
			redirect(base_url().'/Assign-Educator');
			die();
		}else{
			$this->session->set_flashdata('error','Please Select At one Dotctor To Map');
			redirect(base_url().'/Assign-Educator');	
			die();
		}
		}else{
		$this->session->set_flashdata('error','Educator Not Select');
	    redirect(base_url().'/Assign-Educator');			
		}	
		
	}
	
	
	
	
	
	public function mapEducatorToDoctorView()
	{				
		$this->load->view('admin/map-edcator-to-doctor-view');	
	}
	
	
	public function mapEducatorToDoctorPost()
	{				
		//pr($_POST);
		
		//$_POST['mapFrom'];
		//$doctorIds = $_POST['doctorIds'];
		
		$mapTo = $_POST['mapTo'];
		if($mapTo!=''){
		if(isset($_POST['doctorIds'])) {
			$doctorIds = $_POST['doctorIds'];
			$count = count($doctorIds);
			if($count==0){
					$this->session->set_flashdata('error','Please Select At one Dotctor To Map');
					redirect(base_url().'/Map-Educator-To-Doctor');	
					die();
			}
			
			
			foreach($doctorIds as $key=>$doctorItem){
				$mapArray = array();
				$mapArray['id'] = $doctorItem;
				$mapArray['educator_id'] = $mapTo;	
				//pr($mapArray);
				//die();			
				$row = $this->master_model->save('doctors',$mapArray);
				unset($mapArray);
			}
			
			
			$this->session->set_flashdata('message','Map Successfully');
			redirect(base_url().'/Map-Educator-To-Doctor');
			die();
		}else{
			$this->session->set_flashdata('error','Please Select At one Dotctor To Map');
			redirect(base_url().'/Map-Educator-To-Doctor');	
			die();
		}
		}else{
		$this->session->set_flashdata('error','Educator Not Select');
	    redirect(base_url().'/Map-Educator-To-Doctor');			
		}	
		
	}
	
	public function getDoctorByEducator(){
	$educatorId = trim($_POST['EducatorId']);	
	$mapEdcuatorName = trim($_POST['MapEducatorName']);
	
	/*$EducatorDetails =  getEducatorDetails($educatorId);
	$mapEdcuatorName= "";	
	if($EducatorDetails['educatorData']){
		$first_name = $EducatorDetails['educatorData']->first_name;
		$last_name  = $EducatorDetails['educatorData']->last_name;
		$mapEdcuatorName= $first_name.' '.$last_name;
	}*/
	
	if($educatorId=='all'){
		$doctorsData = getAllDoctor();
	}
	else{
		$doctorsData = getDoctorByEducator($educatorId);
	}
	
	$doctorsData = $doctorsData['doctorsData']; 
	
	
	//pr($doctorsData);
	//die();
	
	if($doctorsData) { 
        ?>      
        <div>
        <div style="margin:5px;"> <label> Doctors </label> </div>
          
        <table id="myTable" class="display">
        <thead>
        <tr>
        <th>Sr  </th>
        <th>Select  </th>
        <th>Name</th>
        <th>Educator</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $sr = 1;
        $doctorIds = array();
        foreach($doctorsData as $doctorsItem){
		//pr($doctorsItem);
		$doctorName = $doctorsItem['first_name'].' '.$doctorsItem['last_name'];
		$doctorId = $doctorsItem['id'];
		//die();
		?>
        <tr>
        <td><?php echo $sr;?></td>
        <td>
        <div class="checkbox">
        <label>
        <input type="checkbox" name="doctorIds[]" value="<?php echo $doctorId;?>">
        </label>
        </div>
        </td>
        <td><?php echo $doctorName;?></td>
        <td><?php echo $mapEdcuatorName;?></td>
        </tr>        
        <?php $sr++; } ?>        
        </tbody>
        </table>   
        </div>  
        <?php   
     }
	 die();
	}
	
	
	public function assignDistrictManagerView()
	{				
		$this->load->view('admin/assign-district-manager-view');	
	}
	
	
	public function assignDistrictManagerPost()
	{				
		//pr($_POST); 
		
		//$_POST['mapFrom'];
		//$doctorIds = $_POST['doctorIds'];
		
		$mapTo = $_POST['mapTo'];
		if($mapTo!=''){
		if(isset($_POST['managerId'])) {
			$doctorIds = $_POST['managerId'];
			$count = count($doctorIds);
			if($count==0){
					$this->session->set_flashdata('error','Please Select At one Manager To Map');
					redirect(base_url().'/Assign-District-Manager');	
					die();
			}
			
			
			foreach($doctorIds as $key=>$doctorItem){
				$mapArray = array();
				$mapArray['id'] = $doctorItem;
				$mapArray['zonal_manager_id'] = $mapTo;	
				//pr($mapArray);
				//die();			
				$row = $this->master_model->save('district_managers',$mapArray);
				unset($mapArray);
			}
			
			
			$this->session->set_flashdata('message','Map Successfully');
			redirect(base_url().'/Assign-District-Manager');
			die();
		}else{
			$this->session->set_flashdata('error','Please Select At one Dotctor To Map');
			redirect(base_url().'/Assign-District-Manager');	
			die();
		}
		}else{
		$this->session->set_flashdata('error','Manager Not Select');
	    redirect(base_url().'/Assign-District-Manager');			
		}	
		
	}
	
	
	public function getManagerByzone(){
	$zoneId = trim($_POST['zoneId']);	
	$mapMapzoneName = trim($_POST['MapzoneName']);
	
	$zoneManagerData = getDistrictManagerByZone($zoneId);
	$zoneManagerData = $zoneManagerData['zoneManagerData']; 
	
	
	//pr($zoneManagerData);
   //die();
	
	if($zoneManagerData) { 
        ?>      
        <div>
        <div style="margin:5px;"> <label> Distric Manager </label> </div>
          
        <table id="myTable" class="display">
        <thead>
        <tr>
        <th>Sr  </th>
        <th>Select  </th>
        <th>Name</th>
        <th>Zone Manager</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $sr = 1;
        $zoneManagerIds = array();
        foreach($zoneManagerData as $zoneManagerItem){
		//pr($doctorsItem);
		$managerName = $zoneManagerItem['first_name'].' '.$zoneManagerItem['last_name'];
		$managerId = $zoneManagerItem['id'];
		//die();
		?>
        <tr>
        <td><?php echo $sr;?></td>
        <td>
        <div class="checkbox">
        <label>
        <input type="checkbox" name="managerId[]" value="<?php echo $managerId;?>">
        </label>
        </div>
        </td>
        <td><?php echo $managerName;?></td>
        <td><?php echo $mapMapzoneName;?></td>
        </tr>        
        <?php $sr++; } ?>        
        </tbody>
        </table>   
        </div>  
        <?php   
     }
	 die();
	}
	
	
	
	public function getEducatorByManager(){
	$dmId = trim($_POST['DmId']);	
	$mapdmName = trim($_POST['DmName']);
	
	$educatorData = getEducatorByDm($dmId);
	$educatorData = $educatorData['educatorData']; 
	
	
	//pr($dmManagerData);
   //die();
	
	if($educatorData) { 
        ?>      
        <div>
        <div style="margin:5px;"> <label> Educator </label> </div>
          
        <table id="myTable" class="display">
        <thead>
        <tr>
        <th>Sr  </th>
        <th>Select  </th>
        <th>Name</th>
        <th>Manager</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $sr = 1;
        $dmManagerIds = array();
        foreach($educatorData as $educatorItem){
		//pr($doctorsItem);
		$educatorName = $educatorItem['first_name'].' '.$educatorItem['last_name'];
		$educatorId = $educatorItem['id'];
		//die();
		?>
        <tr>
        <td><?php echo $sr;?></td>
        <td>
        <div class="checkbox">
        <label>
        <input type="checkbox" name="educatorId[]" value="<?php echo $educatorId;?>">
        </label>
        </div>
        </td>
        <td><?php echo $educatorName;?></td>
        <td><?php echo $mapdmName;?></td>
        </tr>        
        <?php $sr++; } ?>        
        </tbody>
        </table>   
        </div>  
        <?php   
     }
	 die();
	}
	
	
	
	public function doctorsList()
	{				
		$this->load->view('admin/doctors-list');	
	}
	
	public function educatorsList()
	{				
		$this->load->view('admin/educators-list');	
	}
	
	public function zoneManagerList()
	{				
		$this->load->view('admin/zone-manager-list');	
	}
	
	public function districtManagerList()
	{				
		$this->load->view('admin/district-manager-list');	
	}
	
	public function changePassword()
	{				
		$this->load->view('admin/change-password');	
	}
	
	public function changePasswordPost()
	{				
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			 $oldPassword = $_POST['currentPassword'];
			 $newPassword = $_POST['newPassword'];
			
			if(!$oldPassword){
			$this->session->set_flashdata('error','Old Password Empty');
			redirect(base_url().'/admin-change-password');
			}
			
			if(!$newPassword){
			$this->session->set_flashdata('error','New Password Empty');
			redirect(base_url().'/admin-change-password');
			}
			
			$adminId = $this->session->userdata('admin_id');
			
			$query = "SELECT * FROM `admin` WHERE `password`='".$oldPassword."' and `id`='".$adminId."';";
			$adminData = $this->master_model->customQueryArray($query);
			
			if($adminData){	
					
				$adminData = array();
				$adminData['id'] = $adminId;
				$adminData['password'] = $newPassword;	
				$row = $this->master_model->save('admin',$adminData);
				unset($adminData);
				
				$this->session->set_flashdata('message','Password update Successfully');
				redirect(base_url().'/admin-change-password');
					
			}else{
			$this->session->set_flashdata('error','Password Not Matched');
			redirect(base_url().'/admin-change-password');
			}
		
		
		}
	}
	
	
	
	
	
	
	
	
	
	
	public function logout(){
		$this->session->unset_userdata('admin_id');
		redirect(base_url().'/admin-login');
	}
	

	public function getEdcautorDoctors(){

		if (isset($_POST['value'])) {
			$educatorId = $_POST['value'];
			$doctorsData = getDoctorByEducator($educatorId);
			$doctorsData = $doctorsData['doctorsData'];
			//pr($doctorsData['doctorsData']);
			//die();
			?>
			<option value="" id=""> ---Select---- </option>
			<?php 
			if($doctorsData) { 
				foreach($doctorsData as $key=> $doctorsItem){
					//pr($doctorsItem);
					$doctorName = $doctorsItem['first_name'].' '.$doctorsItem['last_name'];					
					$doctorId = $doctorsItem['id'];
					?>
					<option value="<?php echo $doctorId?>" id="d_<?php echo $doctorId?>"> <?php echo $doctorName?> </option>	
					<?php
				}
			}
		}
		die();

	}


	public function getEdcautorPatientTable(){
		if (isset($_POST['doctorId'])) {
			$educatorId = $_POST['educatorId'];
			$doctorId = $_POST['doctorId'];
			
		
		$getPatientByData = getPatientByEducatorAndDoctorId($educatorId,$doctorId);
		$patientData = $getPatientByData['patientData']; 
		
		
		// pr($patientData);
		// die();
		
		if($patientData) { 
			?>      
			<div>
			<!-- <div style="margin:5px;"> <label> Patient </label> </div> -->
			  
			<table id="myTable" class="display" style="width: 100%;">
			<thead>
			<tr>
			<th>Sr  </th>
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
			foreach($patientData as $key=> $patientItem){
			//pr($doctorsItem);
			$patientName = $patientItem['first_name'].' '.$patientItem['last_name'];
			$patientId = $patientItem['id'];
			$age = $patientItem['age'];
			$gender = $patientItem['gender'];			
			$email = $patientItem['email'];
			$heart_rate = $patientItem['heart_rate'];
			//die();
			?>
			<tr>
			<td><?php echo $sr;?></td>
			<!-- <td>
			<div class="checkbox">
			<label>
			<input type="checkbox" name="patientIds[]" value="<?php echo $patientId;?>">
			</label>
			</div>
			</td> -->
			<td><?php echo $patientName;?></td>
			<td><?php echo $age;?></td>
			<td><?php echo $gender;?></td>
			<td><?php echo $heart_rate;?></td>
			</tr>        
			<?php $sr++; } ?>        
			</tbody>
			</table>   
			</div>  
			<?php   
		 }
		 die();
		}
	} 
	
	public function makeXls($patientData,$fileName){
			set_include_path( get_include_path().PATH_SEPARATOR."..");
			include_once("xlsxwriter.class.php");
			
			$header = array(
				'Sr'=>'string',//text
				'Date'=>'string',//text
				'Patient Name'=>'string',//text								
				'Gender'=>'string',//text
				'Blood Pressure'=>'string',//text
				'BMI'=>'string',//text
				'Educator Name'=>'string',//text				
				'RM Name'=>'string',//text
				'City'=>'string',//text
				);
				

$excelData[$sr]= array($item['date'],$item['patient_name'],$gender,$item['blood_pressure'],$item['bmi'], $educatorName,$rmName,$item['city']);
		


			$rows = array();
			for($i=0;$i<=10;$i++){
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
			foreach($rows as $row)
			$writer->writeSheetRow('Sheet1', $row);

			//$writer->writeSheet($rows,'Sheet1', $header);//or write the whole sheet in 1 call
            
			if($fileName==''){
				$fileName = 'hardiyam-'.time().".xlsx";		
			}
			
			//$fileName = 'hardiyam-'.time().".xlsx";			
			$path ="xlsx/".$fileName;
			$writer->writeToFile($path);
			//$writer->writeToFile('xlsx-simple.xlsx');
			//$writer->writeToStdOut();
			//echo $writer->writeToString();
	}
	
	
	
}
