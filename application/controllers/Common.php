<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

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
			
			$status=1;
			
			/*if ( $this->session->userdata('admin_id'))
			{   
				$status=1;	
			}
			
			if ( $this->session->userdata('zbm_id'))
			{   
				$status=1;	
			}
			
			if ( $this->session->userdata('rbm_id'))
			{   
				$status=1;	
			}
			
			if ( $this->session->userdata('abm_id'))
			{   
				$status=1;	
			}
			
			if ( $this->session->userdata('educator_id'))
			{   
				$status=1;	
			}	*/	
			
			if ($status==0)
			{   
				 echo "Invalid Access";
				 die();
				//redirect(base_url().'/educator-login');			
			}	
		}
	

	
	// public function index()
	// {
	// 	if($this->session->userdata('admin_id')){
	// 		redirect('admin-dashboard');			
	// 	}else{
	// 	  redirect('admin-login');
	// 	}
	// }
	
	

	public function getEdcautorDoctors(){

		if (isset($_POST['educator_id'])) {
			
			// $educatorId = $_POST['value'];
			// $doctorsData = getDoctorByEducator($educatorId);
			// $doctorsData = $doctorsData['doctorsData'];

			//pr($doctorsData['doctorsData']);
			//die();

			$educatorId = $_POST['educator_id'];
			if($educatorId!='all'){
				$query = "SELECT * FROM `doctors_new` WHERE educator_id='".$educatorId."' And `name`!='' ORDER BY `name`";
			}else{
				$query = "SELECT * FROM `doctors_new` WHERE `name`!='' ORDER BY `name`";
			}
			$doctorsData = $this->master_model->customQueryArray($query);
			
			?>

			<option value="" id=""> ---Select---- </option>
			<option value="all" id="all"> ---All---- </option>
			<?php 
			if($doctorsData) { 
				foreach($doctorsData as $key=> $doctorsItem){
					//pr($doctorsItem);
					$doctorName = $doctorsItem['name'];					
					$doctorId = $doctorsItem['id'];
					?>
					<option value="<?php echo $doctorId?>" id="d_<?php echo $doctorId?>"> <?php echo $doctorName?> </option>	
					<?php
				}
			}
		}
		die();

	}

	public function getEdcautorDoctorsByCamp(){

		if (isset($_POST['campId'])) {
			
			$educatorId = $_POST['educatorId'];
			// $doctorsData = getDoctorByEducator($educatorId);
			// $doctorsData = $doctorsData['doctorsData'];

			//pr($doctorsData['doctorsData']);
			//die();

			$campId = $_POST['campId'];

			//$query = "SELECT * FROM `patient_inquiry_new` WHERE `camp_id`='".$campId."'";		
			//$doctorsData = $this->master_model->customQueryArray($query);

			if($educatorId!='all'){
                $query = "SELECT * FROM `doctors_new` WHERE educator_id='".$educatorId."'  And `name`!='' ORDER BY `name`";
                // echo $query;die;
			}else{
				$query = "SELECT * FROM `doctors_new` WHERE `name`!='' ORDER BY `name`";
			}

			// $query = "SELECT * FROM `doctors_new` WHERE id IN (SELECT `hcp_name` FROM `patient_inquiry_new` WHERE `camp_id`='".$campId."' AND `educator_id`= '".$educatorId."') ORDER BY `name`";
			// echo $query;die;
            $doctorsData = $this->master_model->customQueryArray($query);
			
			?>

			<option value="" id=""> ---Select---- </option>
			<!-- <option value="all" id="all"> ---All---- </option> -->
			<?php 
			if($doctorsData) { 
				foreach($doctorsData as $key=> $doctorsItem){
					//pr($doctorsItem);
					$doctorName = $doctorsItem['name'];					
					$doctorId = $doctorsItem['id'];
					?>
					<option value="<?php echo $doctorId?>" id="d_<?php echo $doctorId?>"> <?php echo $doctorName?> </option>	
					<?php
				}
			}
		}
		die();

	}


	public function getEdcautorCamp(){

		if (isset($_POST['educator_id'])) {
			
			// $educatorId = $_POST['value'];
			// $doctorsData = getDoctorByEducator($educatorId);
			// $doctorsData = $doctorsData['doctorsData'];

			//pr($doctorsData['doctorsData']);
			//die();

			$educatorId = $_POST['educator_id'];
			$fromDate = $_POST['fromDate'];
			$toDate = $_POST['toDate'];

			// if($educatorId!='all'){
			// 	$query = "SELECT * FROM `camp` WHERE edcator_id='".$educatorId."' And `date`='".$date."' ORDER BY `id`";
			// }else{
			// 	$query = "SELECT * FROM `camp` WHERE edcator_id='".$educatorId."' And `date`='".$date."' ORDER BY `id`";
			// }
			$query = "SELECT camp_id  FROM `camp` WHERE edcator_id='".$educatorId."' And `date`BETWEEN '$fromDate' AND '$toDate' group by camp_id";
			$doctorsData = $this->master_model->customQueryArray($query);
			?>

			<option value="" id=""> ---Select---- </option>
			<!-- <option value="all" id="all"> ---All---- </option> -->
			<?php 
			if($doctorsData) { 
				foreach($doctorsData as $key=> $doctorsItem){
					//pr($doctorsItem);
					$campName = $doctorsItem['camp_id'];					
					$campId = $doctorsItem['id'];
					?>
					<option value="<?php echo $campId?>" id="c_<?php echo $doctorId?>"> Camp <?php echo $campName?> </option>	
					<?php
				}
			}
		}
		die();

	}

	
	

	public function getRmByZone(){

		if ($this->session->userdata('type'))
		{   
			 $loginType = $this->session->userdata('type');		
		}

		if (isset($_POST['zone_id'])) {
			
			$zone_id = $_POST['zone_id'];
			if($zone_id!='all'){
			$query = "SELECT * FROM `rm_name` WHERE `zone_id` ='".$zone_id."' And `name`!='' ORDER BY `name`";
			}else{
				$query = "SELECT * FROM `rm_name` WHERE  `name`!='' ORDER BY `name`";
			}
			//$query = "SELECT * FROM `doctors` WHERE `first_name`!='' ORDER BY `first_name`";
			$regional_branch_Data = $this->master_model->customQueryArray($query);			  
			?>
			<option value="" id=""> ---Select RM---- </option>
			<!-- <option value="all" id=""> ---All---- </option> -->
			<?php 
			if($regional_branch_Data) { 
				foreach($regional_branch_Data as $key=> $regional_branch_Data_Item){
					//pr($doctorsItem);
					$name = $regional_branch_Data_Item['name'];					
					$id = $regional_branch_Data_Item['id'];
					?>
					<option value="<?php echo $id?>" id="d_<?php echo $id?>"> <?php echo $name?> </option>	
					<?php
				}
			}
		}
		die();

	}

	
    public function getEducatorByRm(){

		if (isset($_POST['rm_id'])) {
			$rm_id = $_POST['rm_id'];

			if($abm_id!='all'){
				$query = "SELECT * FROM `educator` WHERE `rm_id` ='".$rm_id."' And `first_name`!='' ORDER BY `first_name`";
			}else{
				$query = "SELECT * FROM `educator` WHERE `first_name`!='' ORDER BY `first_name`";
			}

			
			//$query = "SELECT * FROM `doctors` WHERE `first_name`!='' ORDER BY `first_name`";
			$educatorData= $this->master_model->customQueryArray($query);			  
			?>
			<option value="" id=""> ---Select Educator---- </option>
			<!-- <option value="all" id=""> ---All---- </option> -->
			<?php 
			if($educatorData) { 
				foreach($educatorData as $key=> $item){
					//pr($doctorsItem);
					$name = $item['first_name'];					
					$id = $item['id'];
					?>
					<option value="<?php echo $id?>" id="d_<?php echo $id?>"> <?php echo $name?> </option>	
					<?php
				}
			}
		}
		die();

	}


public function getEdcautorPatientTable() {
    date_default_timezone_set("Asia/Calcutta");
    
    // Initialize where conditions array
    $whereConditions = [];
    
    // Get all filter values from POST
    $fromDate = $_POST['fromDate'] ?? '';
    $toDate = $_POST['toDate'] ?? '';
    $educatorId = $_POST['educatorId'] ?? '';
    $doctorId = $_POST['doctorId'] ?? '';
    $campId = $_POST['campId'] ?? '';
    $zoneId = $_POST['zoneId'] ?? '';
    $rmId = $_POST['rmId'] ?? '';
    
    // Base query
    $query = "SELECT pin.* FROM `patient_inquiry_new` pin";
    
    // Add date range condition (mandatory)
    if (!empty($fromDate) && !empty($toDate)) {
        $whereConditions[] = "pin.`date` BETWEEN '$fromDate' AND '$toDate'";
    } else {
        // Default to today if no dates provided
        $today = date('Y-m-d');
        $whereConditions[] = "pin.`date` = '$today'";
    }
    
    // Add educator filter if provided
    if (!empty($educatorId)) {
        $whereConditions[] = "pin.`educator_id` = '$educatorId'";
    }
    
    // Add doctor filter if provided
    if (!empty($doctorId)) {
        $whereConditions[] = "pin.`hcp_name` = '$doctorId'";
    }
    
    // Add camp filter if provided
    if (!empty($campId)) {
        $whereConditions[] = "pin.`camp_id` = '$campId'";
    }
    
    // If zone or RM is selected but not educator, we need to join with educator table
    if ((!empty($zoneId) || (!empty($rmId)))) {
        $query .= " LEFT JOIN `educator` e ON pin.`educator_id` = e.`id`";
        
        if (!empty($zoneId)) {
        // For zone filtering, we need to join through rm table since zone_id is in rm table
        $query .= " LEFT JOIN `rm_name` r ON e.`rm_id` = r.`id`";
        $whereConditions[] = "r.`zone_id` = '$zoneId'";
    }
    
    if (!empty($rmId)) {
        // For RM filtering, we can use the direct relationship in educator table
        $whereConditions[] = "e.`rm_id` = '$rmId'";
    }
    }
    
    // Combine all where conditions
    if (!empty($whereConditions)) {
        $query .= " WHERE " . implode(" AND ", $whereConditions);
    }
    
    // Add sorting
    $query .= " AND `patient_name`!='' ORDER BY pin.`patient_name`";
    
    // Execute query
    $patientData = $this->master_model->customQueryArray($query);
    
    // Rest of your display code remains the same...
    if($patientData) { 
        ?>      
        <div style="overflow:scroll">
        <table id="myTable" class="display" style="width: 100%;">
        <thead>
        <tr>
                <th>Sr</th>
                <th>Date</th>
                <th>Patient Name</th>
                <th>Mobile Number</th>
                <th>Gender</th>
                <th>Blood Pressure</th>
                <th>BMI</th>
                <th>Educator Name</th>
                <th>RM Name</th>
                <th>City</th>					
        </tr>
        </thead>
        <tbody>
        <?php 
        $sr = 1;
        $doctorIds = array();	
                
        $fileName = 'hardiyam-'.time().".xlsx";			
        $uniqueXlsxFileName = uniqueXlsxFileName();	
        $filename = "hardiyam-" . $uniqueXlsxFileName;
        
        
        $getAllEducator = getAllEducator();
        $educatorDataIdWise = $getAllEducator['educatorDataIdWise'];
        
        $getAllRM = getAllRM();
        $rmManagerDataIdWise = $getAllRM['rmManagerDataIdWise'];
        
        $getAllCity = getAllCity();
        $citiesDataCityCodeWise = $getAllCity['citiesDataCityCodeWise'];
        $citiesDataIdWise = $getAllCity['citiesDataIdWise'];
        
        
        $excelData = array();
        foreach($patientData as $key=> $item){						
        $genderId = $item['gender'];
        $genderString = genderString($genderId);
        
        $educator_id = $item['educator_id'];
        
        $educatorName = "";
        $rmId = "";
        if(isset($educatorDataIdWise[$educator_id])){
        $educatorName = $educatorDataIdWise[$educator_id]['first_name'];
        $rmId = $educatorDataIdWise[$educator_id]['rm_id'];
        }
        
        $rmName = "";
        if(isset($rmManagerDataIdWise[$rmId])){
        $rmName = $rmManagerDataIdWise[$rmId]['name'];
        }

        $city= "";
        $cityId = $item['city'];
        if(isset($citiesDataCityCodeWise[$cityId])){
            $city= $citiesDataCityCodeWise[$cityId]['city_name'];
        }else{				
            $city= $citiesDataIdWise[$cityId]['city_name'];
        }
        $id=$item['id'];
        
        $excelData[$sr]= array($sr,$item['date'],$item['patient_name'],$genderString,$item['blood_pressure'],$item['bmi'], $educatorName,$rmName,$city);
        ?>
        <tr>
            <td><?php echo $sr;?></td>		
            <td> <?php echo $item['date']?> </td>
            <td><?php echo $item['patient_name']?></td>
            <td><?php echo $item['mobile_number']?></td>
            <td><?php echo $genderString;?></td>
            <td><?php echo $item['blood_pressure']?></td>
            <td><?php echo $item['bmi']?></td>
            <td><?php echo $educatorName; ?></td>
            <td><?php echo $rmName;?></td>
            <td><?php echo $city?></td>	

        
        </tr>        
        <?php $sr++; } ?> 
        </tbody>			
        </table> 
        </div>  
        <?php   
     }else{?>
        <div>
        Data Not Found
        
        </div>
     
     <?php 
     }
     die();
}

	
public function getEdcautorPatientTableReport() {
    // Get all filter parameters from GET request
    $fromDate = $this->input->get('fromDate');
    $toDate = $this->input->get('toDate');
    $educatorId = $this->input->get('educatorId');
    $doctorId = $this->input->get('doctorId');
    $zoneId = $this->input->get('zoneId');
    $rmId = $this->input->get('rmId');
    $campId = $this->input->get('campId');
    
    // Build your query with all filters
    $query = "SELECT 
	 e.first_name AS educator_name,
     e.emp_id AS emp_id,
     f.camp_id AS camp,
    rm.name AS rm_name,
    pin.msl_code,
	dn.name AS doctor_name,
    pin.city AS city_name,
    pin.speciality,
    sl.state AS state_name,
    pin.uuid as unique_patient_id,
    pin.patient_name,
    pin.age,
    pin.mobile_number,
    pin.gender,
    pin.medicine,
    pin.date_of_discharge,
    pin.blood_pressure,
    pin.urea,
    pin.lv_ef,
    pin.heart_rate,
    pin.nt_pro_bnp,
    pin.egfr,
    pin.potassium,
    pin.sodium,
    pin.uric_acid,
    pin.creatinine,
    pin.crp,
    pin.uacr,
    pin.iron,
    pin.hb,
    pin.ldl,
    pin.hdl,
    pin.triglycerid,
    pin.total_cholesterol,
    pin.hba1c,
    pin.sgot,
    pin.sgpt,
    pin.vit_d,
    pin.t3,
    pin.t4,
    pin.anti_diabetic_therapy,
    pin.arni,
    pin.b_blockers,
    pin.mra,
    pin.arni_remark,
    pin.b_blockers_remark,
    pin.mra_remark,
    pin.remark,
    pin.weight,
    pin.height,
    pin.waist_circumference_remark,
    pin.bmi,
    pin.waist_to_height_ratio,
    pin.vaccination,
    pin.influenza,
    pin.pneumococcal,
    pin.cardiac_rehab,
    pin.nsaids_use,
    pin.patient_kit_given,
    pin.exercise_30mins,
    pin.breakfast_days,
    pin.food_habits,
    pin.sedentary_hours,
    pin.prescription_file,
    pin.type_2_dm,
    pin.hypertension,
    pin.dyslipidemia,
    pin.pco,
    pin.knee_pain,
    pin.asthma,
    pin.adl_bathing,
    pin.adl_dressing,
    pin.adl_walking,
    pin.adl_toileting,
    pin.patient_enrolled,
    pin.patient_kit_enrolled,
    pin.Compititor,
    pin.consent_form_file,
    pin.cipla_brand_prescribed,
    pin.cipla_brand_prescribed_no_option,
    pin.prescription_available,
    pin.purchase_bill,
    pin.date
FROM `patient_inquiry_new` pin 
LEFT JOIN `camp` f on f.id = pin.camp_id
LEFT JOIN `educator` e ON pin.educator_id = e.id 
LEFT JOIN `doctors_new` dn ON dn.id = pin.hcp_name 
LEFT JOIN `rm_name` rm ON e.rm_id = rm.id
-- LEFT JOIN `all_cities` c ON pin.city = c.id OR pin.city = c.city_code
LEFT JOIN `state_list` sl ON sl.id = pin.state
WHERE ";
			//   echo $query;die;
    
    if($educatorId) {
        $query .= " pin.`educator_id`='$educatorId' AND";
    }
    if($campId) {
        $query .= " pin.`camp_id`='$campId' AND";
    }
    if($zoneId) {
        $query .= " rm.`zone_id` ='$zoneId' AND";
    }
    if($rmId) {
        $query .= " rm.`id` ='$rmId' AND";
    }
    if($doctorId) {
        $query .= " pin.`hcp_name`='$doctorId' AND";
    }
    
    $query .= " `patient_name`!='' AND pin.`date` BETWEEN '$fromDate' AND '$toDate' ORDER BY pin.`date` ;";
    // echo $query;die;
    $patientData = $this->master_model->customQueryArray($query);
    
    // Load a view for the report
    $data['patientData'] = $patientData;
    $data['fromDate'] = $fromDate;
    $data['toDate'] = $toDate;
    $data['uploads_url'] = base_url('uploads/'); 
    $this->load->view('patient_report_view', $data);
}
public function getEdcautorDailyTableReport() {
    // Get all filter parameters from GET request
    $fromDate = $this->input->get('fromDate');
    $toDate = $this->input->get('toDate');
    $educatorId = $this->input->get('educatorId');
    $doctorId = $this->input->get('doctorId');
    $zoneId = $this->input->get('zoneId');
    $rmId = $this->input->get('rmId');
    $campId = $this->input->get('campId');
    
    // Build your query with all filters
    $query = "SELECT 
        pin.date,
        pin.msl_code,
        c.city_name AS hq,
        sl.state AS state_name,
        rm.name AS rm_name,
        dn.name AS doctor_name,
        e.first_name AS educator_name,
        e.emp_id AS employee_id,
        COUNT(pin.id) as total_patient,
        SUM(CASE WHEN cipla_brand_prescribed = 'yes' THEN 1 ELSE 0 END) as total_rx,
        SUM(CASE WHEN patient_enrolled = 'yes' THEN 1 ELSE 0 END) as patient_enrolled,
        SUM(CASE WHEN FIND_IN_SET ('Arnicor', medicine) > 0  THEN 1 ELSE 0 END) as `arnicor(Innova)`,
        SUM(CASE WHEN FIND_IN_SET ('Dytor', medicine) > 0 THEN 1 ELSE 0 END) as `dytor(Magna)`,
        SUM(CASE WHEN FIND_IN_SET ('Dytor Plus', medicine) > 0 THEN 1 ELSE 0 END) as `dytor_plus(Magna)`,
        SUM(CASE WHEN FIND_IN_SET ('Empacip', medicine) > 0 THEN 1 ELSE 0 END) as `empacip(Ascend)`
    FROM `patient_inquiry_new` pin 
    LEFT JOIN `educator` e ON pin.educator_id = e.id 
    LEFT JOIN `doctors_new` dn ON dn.id = pin.hcp_name 
    LEFT JOIN `rm_name` rm ON e.rm_id = rm.id
    LEFT JOIN `all_cities` c ON pin.city = c.id OR pin.city = c.city_code
    LEFT JOIN `state_list` sl ON sl.id = pin.state
    WHERE ";
    
    if($educatorId) {
        $query .= " pin.`educator_id`='$educatorId' AND";
    }
    if($campId) {
        $query .= " pin.`camp_id`='$campId' AND";
    }
    if($zoneId) {
        $query .= " rm.`zone_id` ='$zoneId' AND";
    }
    if($rmId) {
        $query .= " rm.`id` ='$rmId' AND";
    }
    if($doctorId) {
        $query .= " pin.`hcp_name`='$doctorId' AND";
    }
    
    $query .= " pin.`date` BETWEEN '$fromDate' AND '$toDate' 
    GROUP BY pin.date, pin.msl_code, c.city_name, sl.state, rm.name, dn.name, e.first_name, e.emp_id
    ORDER BY pin.date";

    // echo $query;die;
    
    $patientData = $this->master_model->customQueryArray($query);
    
    // Load a view for the report
    $data['patientData'] = $patientData;
    $data['fromDate'] = $fromDate;
    $data['toDate'] = $toDate;
    $this->load->view('daily_report_view', $data);
}
	public function campreport_excel()
{
	$this->load->view('camp_report');
}
}
