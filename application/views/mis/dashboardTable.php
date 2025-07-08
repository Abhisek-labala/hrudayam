<?php 
include('header.php');
?>
<!-- Main Wrapper -->
<div class="main-wrapper">
			
<!-- Sidebar -->
<?php 
include('side_bar.php');
?>
<!-- /Sidebar -->
		
		
		<!-- Page Wrapper -->
		<div class="page-wrapper" style="min-height: 653px;">
			<div class="content container-fluid">
			
				<!-- Page Header -->
				<?php include('breadcum.php');?>
				<!-- /Page Header -->

				<?php 
				include('alerts.php');
				?>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<!--<div class="card-header">
								<h4 class="card-title">Basic Inputs</h4>
							</div>-->
							<div class="card-body">
								<div class='row'>
                                <div class='col-md-12 col-lg-12'>
                                <table id='myTable'>
                                    <thead>
                                            <th>Sr</th>
                                            <th>Date</th>
                                            <th>Patient Name</th>
                                            <th>Gender</th>
                                            <th>Blood Pressure</th>
                                            <th>BMI</th>
                                            <th>Educator Name</th>
                                            <th>RM Name</th>
                                            <th>City.</th>
                                    </thead>
                                    <tbody>
<?php 
//$query = "SELECT * FROM `patient_inquiry_new` WHERE `educator_id`!='' ORDER BY `date` desc";
//$patient_inquiry_Data = $this->master_model->customQueryArray($query);
$sr = 1;

$excelData = array();
foreach($patient_inquiry_Data as $key=>$item){

        /*$educator_id = $item['educator_id'];

        $query = "SELECT * FROM `educator` WHERE `id` = '".$educator_id."'";
        $educatorData 	= $this->master_model->customQueryRow($query); 
        $educatorName =  $educatorData->first_name;
        $rmId =  $educatorData->rm_id;

        $query = "SELECT * FROM `rm_name` WHERE `id` = '".$rmId."'";
        $rmNameData 	= $this->master_model->customQueryRow($query); 
        $rmName =  $rmNameData->name; 

        $gender = ($item['gender']==1)  ? 'Male' : 'Female'; 
		
		$excelData[$sr]= array($sr,$item['date'],$item['patient_name'],$gender,$item['blood_pressure'],$item['bmi'], $educatorName,$rmName,$item['city']);
		*/
		
		 //Admin::makeXls($excelData);  
		
?>

                                            <tr>
                                               <td><?php  echo $sr?></td>
                                               <td> <?php echo $item['date']?> </td>
                                               <td><?php echo $item['patient_name']?></td>
                                               <td><?php echo $item['gender'];?></td>
                                               <td><?php echo $item['blood_pressure']?></td>
                                               <td><?php echo $item['bmi']?></td>
                                               <td><?php echo $item['educator_name']; ?></td>
                                               <td><?php echo $item['rm_name'];?></td>
                                               <td><?php echo $item['city']?></td>
                                            </tr>
                                            <?php } ?>
                                    </tbody>
                                </table>
                                </div>
                                
<div style="margin-top: 20px;margin-bottom: 20px;">		
<span onclick="downloadExcel('<?php echo $fileName; ?>')" style="color: red;cursor: hand;">
Export To Excel &nbsp; <i class="fa fa-file-excel-o" aria-hidden="true"></i> 
</span>			  
</div>
                                
                                </div>
							</div>
						</div>
                        
						
					</div>
				</div>
			
			</div>			
		</div>		
	
	</div>
	<!-- /Main Wrapper -->
		<?php
include('footer.php');
?>

<script>

  function downloadExcel(file_name){
            if(file_name){
              var url = 'https://doctor.tasainnovation.com/xlsx/'+file_name;
              var popout = window.open(url);
            //   window.setTimeout(function(){
            //   popout.close();
            //   }, 1000);
          } 
      }


  $(document).ready(function(){
            $('#educator').on('change', function(){
                var selectedValue = $(this).val();
                $('#PatientData').html('');  

                $.ajax({
                    url: 'https://doctor.tasainnovation.com/Admin/getEdcautorDoctors',
                    type: 'POST',
                    data: { value: selectedValue },
                    success: function(response){
                        $('#doctor').html(response);
                    },
                    error: function(){
                        console.log('error');						
						$('#result').html('An error occurred.');
                    }
                });
            });
        });

	
	function getPatientData(doctorId){
		if(doctorId){
			$('#PatientData').html('');
			var  educatorId = $('#educatorId').val();	
		$.ajax({
                    url: 'https://doctor.tasainnovation.com/Admin/getEdcautorPatientTable',
                    type: 'POST',
                    //data: { educatorId: educatorId,doctorId: doctorId },
					data: { doctorId: doctorId },
                    success: function(response){
                        $('#PatientData').html(response);
						$('#myTable').DataTable({searching: false, paging: false, info: false,"pageLength": 50});
                    },
                    error: function(){
                        console.log('error');						
						$('#PatientData').html('An error occurred.');
                    }
                });
		}
	
	}	

</script>

<script>

// Utility validation functions
function isEmpty(value) {
    return value.trim() === "";
}

function isValidEmail(email) {
    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return pattern.test(email);
}

function isValidPassword(password) {
    const pattern = /^(?=.*[a-z])(?=.*[A-Z]).{5,}$/;
    return pattern.test(password);
}

function isValidMobile(mobile) {
    const pattern = /^\d{10}$/;
    return pattern.test(mobile);
}

function isValidCity(city) {
    const pattern = /^[A-Za-z\s]+$/;
    return pattern.test(city);
}

function isValidState(state) {
        const pattern = /^[A-Za-z\s]+$/;
        return pattern.test(state);
} 

function isValidImageFile(fileName) {
    if (fileName === "") return true; // Image is optional
    const pattern = /(\.jpg|\.jpeg|\.png)$/i;
    return pattern.test(fileName);
}

// Main form validation function
function submitEducator() {
    var isValid = true;
    var messages = [];

    const firstName = document.getElementById("first_name").value.trim();
    const lastName = document.getElementById("last_name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const mobile = document.getElementById("mobile").value.trim();
	const state = document.getElementById("state").value;
    const city = document.getElementById("city").value.trim();
    const profileImage = document.getElementById("profile_image").value;

    if (isEmpty(firstName)) {
        messages.push("First name is required.");
        isValid = false;
    }

    if (isEmpty(lastName)) {
        messages.push("Last name is required.");
        isValid = false;
    }

    if (!isValidEmail(email)) {
        messages.push("Invalid email address.");
        isValid = false;
    }

    if (!isValidPassword(password)) {
        messages.push("Password must be at least 5 characters long and include at least one uppercase and one lowercase letter.");
        isValid = false;
    }

    if (!isValidMobile(mobile)) {
        messages.push("Mobile number must be exactly 10 digits.");
        isValid = false;
    }
	
	if (!isValidState(state)) {
            messages.push("State must contain only letters and spaces.");
            isValid = false;
        }

    if (!isValidCity(city)) {
        messages.push("City must contain only alphabetic characters.");
        isValid = false;
    }

    if (!isValidImageFile(profileImage)) {
        messages.push("Profile image must be a .jpg or .png file.");
        isValid = false;
    }

    if (!isValid) {
        alert(messages.join("\n"));
        return false;
    } else {
        return true;
    }
}


</script>