<?php 
include('header.php');
?>
<!-- Main Wrapper -->
<div class="main-wrapper">
			
<!-- Sidebar -->
<?php 
include('side_bar.php');
?>

<script> 
function openNewWindow() {
    // Get all the filter values
    var zoneId = $('#zone').val() || '';
    var rmId = $('#rm').val() || '';
    var educatorId = $('#educator').val() || '';
    var campId = $('#campId').val() || '';
    var doctorId = $('#doctor').val() || '';
    var fromDate = $('#from_date').val() || '';
    var toDate = $('#to_date').val() || '';

    // Construct the URL with all parameters
    var url = '/Common/getEdcautorPatientTableReport?' + 
              'zoneId=' + encodeURIComponent(zoneId) + 
              '&rmId=' + encodeURIComponent(rmId) + 
              '&educatorId=' + encodeURIComponent(educatorId) + 
              '&campId=' + encodeURIComponent(campId) + 
              '&doctorId=' + encodeURIComponent(doctorId) + 
              '&fromDate=' + encodeURIComponent(fromDate) + 
              '&toDate=' + encodeURIComponent(toDate);

    // Open a new window with the report URL
    var reportWindow = window.open(url, '_blank', 'width=1200,height=800,scrollbars=yes,resizable=yes');
    
    // Focus the window if it exists
    if (reportWindow) {
        reportWindow.focus();
    }
}
function downloadExcel(file_name){
            if(file_name){
              var url = 'https://doctor.tasainnovation.com/xlsx/'+file_name;
              var popout = window.open(url);
            //   window.setTimeout(function(){
            //   popout.close();
            //   }, 1000);
          } 
      }

function getPatientData(){
		console.log('getPatientData call'); 

		$('#PatientData').html('');

		//var  zoneId = $('#zone').val();	
		// var  zoneId = '';	
		// var  rbmId = $('#rbm').val();				
		// var  abmId = $('#abm').val();	
		// var  educatorId = $('#educator').val();	
		// var  doctorId = $('#doctor').val();	
		// console.log('doctorId : '+doctorId );

		var zoneId = '';
        var rmId = '';       
        var educatorId = '';
        var doctorId = '';        
        var campId = '';        

        if ($('#zone').length)
        {
			var zonetype = $('#zone').prop('type');
			console.log('zonetype : '+zonetype);
			if(zonetype == 'text' || zonetype == 'hidden' ){
				var zoneId = $('#zone').val();
			}else{
				var zoneId = $('#zone option:selected').val();
			}
            
        }
        if ($('#rm').length)
        {
            var zonetype = $('#rbm').prop('type');
			console.log('zonetype : '+zonetype);
			if(zonetype == 'text' || zonetype == 'hidden' ){
				var rmId = $('#rbm').val();
			}else{
				var rmId = $('#rm option:selected').val();
			}
        }		
        
		
        // if ($('#educator').length)
        // {
        //     var educatorId = $('#educator option:selected').val();
        // }
        // if ($('#doctor').length)
        // {
        //     var doctorId = $('#doctor option:selected').val();
        // }

        if ($('#educator').length)
        {
            var zonetype = $('#educator').prop('type');
			console.log('educatorype : '+zonetype);
			if(zonetype == 'text' || zonetype == 'hidden' ){
				var educatorId = $('#educator').val();
			}else{
				var educatorId = $('#educator option:selected').val();
			}
        }

        if ($('#doctor').length)
        {
        var doctorId = $('#doctor option:selected').val();
        }

        // if ($('#campId').length)
        // {
        //     var zonetype = $('#campId').prop('type');
		// 	console.log('campype : '+zonetype);
		// 	if(zonetype == 'text' || zonetype == 'hidden' ){
		// 		var campId = $('#campId').val();
		// 	}else{
		// 		var campId = $('#rm option:selected').val();
		// 	}
        // }

        if ($('#campId').length)
        {
            var campId = $('#campId option:selected').val();
        }
        

		var fromDate = $('#from_date').val();
        var toDate = $('#to_date').val();
		
        

        // Clear existing RBM options
        // if ($('#zone').length)
        // {
        // $('#zone').html('<option value=""> ---Select Zone---- </option>');
        // }

        // if ($('#rbm').length)
        // {
        //     $('#rbm').html('<option value="">---Select RBM---- </option>');
        // }

        // if ($('#abm').length)
        // {
        //     $('#abm').html('<option value="">---Select ABM---- </option>');
        // }

        // if ($('#educator').length)
        // {
        //     $('#educator').html('<option value="">---Select Therapy Manager---- </option>');
        // }

        // if ($('#doctor').length)
        // {
        //     $('#doctor').html('<option value=""> ---Select HCP---- </option>');
        // }
		
		//console.log('rmId'+rmId);

if (fromDate && toDate && new Date(fromDate) > new Date(toDate)) {
        alert('From date cannot be greater than To date');
        return false;
    }

		$.ajax({
                    url: '/Common/getEdcautorPatientTable',
                    type: 'POST',
                    //data: { educatorId: educatorId,doctorId: doctorId },
					data: { zoneId: zoneId, rmId: rmId , educatorId: educatorId, campId: campId,doctorId: doctorId, fromDate: fromDate,toDate: toDate  },
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
</script>


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
                            
                            
                            
								<form action="Create-Educator-Post" name="createEducator" id="createEducator" method="post" enctype="multipart/form-data" >
								<?php 
                                $educatorId = $this->session->userdata('educator_id');
                                ?>
                                <input type='hidden' name='educator' id='educator' value='<?php echo $educatorId?>'>
                                
                                
                                <div class="mb-3 row">
                                    <label class="col-form-label col-md-2">Date Range</label>
                                    <div class="col-md-5">
                                        <label class="col-form-label">From Date</label>
                                        <input class="form-control" type="text" id="from_date" name="from_date" value='<?php echo date('Y-m-d');?>'>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="col-form-label">To Date</label>
                                        <input class="form-control" type="text" id="to_date" name="to_date" value='<?php echo date('Y-m-d');?>'>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="mb-3 row">
										<label class="col-form-label col-md-2">Camp</label>
										<div class="col-md-10">
                                            
                                                <select class="form-control" name="campId" id="campId">
                                                <option value="" id=""> -- Select -- </option>												
                                                </select>											
										</div>
									</div>
                                    
                                      
									<div class="mb-3 row">
										<label class="col-form-label col-md-2">HCP Name</label>
										<div class="col-md-10">
                                            
                                                <select class="form-control" name="doctor" id="doctor">
                                                <option value="" id=""> -- Select -- </option>												
                                                </select>											
										</div>
									</div>
                                    
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2"> </label>
										<div class="col-md-10">
											<button type="button" name="submit" id="submit" class="btn btn-primary" onclick="getPatientData();">Submit</button>
                                            <button type="button" class="btn btn-secondary" onclick="openNewWindow();">Export Report</button>
										</div>
									</div>
                                    

									<div class="mb-3 row">
										<label class="col-form-label col-md-2"></label>
										<div class="col-sm-12 col-md-12 col-lg-12">
										<div id='PatientData'></div>                                            										
										</div>
									</div> 
                                    
                                    
                                    
                                    
								</form>
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
  $("#from_date, #to_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        maxDate: new Date(),
        onSelect: function() {
            // When a date is selected, check if both dates are set
            if ($("#from_date").val() && $("#to_date").val()) {
                loadcamp();
            }
        }
    });

    $("#from_date, #to_date").on('change', function() {
    // Get current values
    var fromDate = $("#from_date").val();
    var toDate = $("#to_date").val();
    
    // If both dates are empty, don't do anything
    if (!fromDate && !toDate) return;
    
    // If one date is empty but the other has a value, set some defaults
    if (!fromDate && toDate) {
        // If toDate has value but fromDate is empty, set fromDate to toDate
        $("#from_date").val(toDate);
        fromDate = toDate;
    } else if (fromDate && !toDate) {
        // If fromDate has value but toDate is empty, set toDate to fromDate
        $("#to_date").val(fromDate);
        toDate = fromDate;
    }
    
    // Now both dates should have values, so we can call getPatientData
    getPatientData();
    loadcamp();
});
getPatientData();
  
  $(document).ready(function(){
    $('#zone').on('change', function(){
        var zoneId = $(this).val();

        // Clear existing RBM options
        $('#rm').html('<option value=""> ---Select RM---- </option>');
        //$('#abm').html('<option value=""> ---Select ABM---- </option>');
        $('#educator').html('<option value="">---Select Educator---- </option>');
        $('#campId').html('<option value=""> ---Select Camp---- </option>');
        $('#doctor').html('<option value=""> ---Select HCP---- </option>');

        if(zoneId !== ''){
            $.ajax({
                url: '/Common/getRmByZone', // backend PHP file
                type: 'POST',
                data: { zone_id: zoneId },
                success: function(response){
                    $('#rm').html(response);
                },
                error: function(){
                    $('#rm').html('<option value="">-- Error Loading --</option>');
                }
            });
        } else {
            $('#rm').html('<option value="">-- Select --</option>');
        }
    });
});



$(document).ready(function(){
    $('#rm').on('change', function(){
        var rmId = $(this).val();
		
        $('#campId').html('<option value=""> ---Select Camp---- </option>');
		$('#educator').html('<option value="">---Select Educator---- </option>');
        $('#doctor').html('<option value=""> ---Select HCP---- </option>');
		
        if(rmId !== ''){
            $.ajax({
                url: '/Common/getEducatorByRm', // backend PHP file
                type: 'POST',
                data: { rm_id: rmId },
                //data: { zoneId: zoneId, rbm_id: rbmId , abm_id: abmId, value: educatorId,doctorId: doctorId },
                success: function(response){
                    $('#educator').html(response);
                    //getPatientData();
                },
                error: function(){
                    $('#educator').html('<option value="">-- Error Loading --</option>');
                }
            });
        } else {
            $('#educator').html('<option value="">-- Select --</option>');
        }
    });
});


 $(document).ready(function(){
            $('#educator').on('change', function(){
                var educatorId = $(this).val();
                 var fromDate = $('#from_date').val();
                var toDate = $('#to_date').val();
                $('#PatientData').html(''); 

                $('#campId').html('<option value=""> ---Select Camp---- </option>');
                $('#doctor').html('<option value=""> ---Select HCP---- </option>');
                
                $.ajax({
                    url: '/Common/getEdcautorCamp',
                    type: 'POST',
                    data: { educator_id: educatorId,fromDate: fromDate, toDate: toDate  },
                    success: function(response){
                        $('#campId').html(response);
                    },
                    error: function(){
                        console.log('error');						
						$('#result').html('An error occurred.');
                    }
                });
            });
        });


        $(document).ready(function(){
            $('#campId').on('change', function(){
               //var educatorId = $(this).val();
                var campId = $(this).val();
                $('#PatientData').html(''); 
                
                $('#doctor').html('<option value=""> ---Select HCP---- </option>');
                getPatientData();
                $.ajax({
                    url: '/Common/getEdcautorDoctorsByCamp',
                    type: 'POST',
                    data: { campId: campId },
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
   $('#doctor').on('change',function()
        {
             getPatientData();
        });
        function loadcamp(){
                var educatorId = $('#educator').val();
                console.log('educatorId : '+educatorId);
                var fromDate = $('#from_date').val();
                var toDate = $('#to_date').val();
                $('#PatientData').html(''); 
                $('#doctor').html('<option value=""> ---Select HCP---- </option>');
                
                $.ajax({
                    url: '/Common/getEdcautorCamp',
                    type: 'POST',
                    data: { educator_id: educatorId,fromDate: fromDate, toDate: toDate  },
                    success: function(response){
                        $('#campId').html(response);
                    },
                    error: function(){
                        console.log('error');						
						$('#result').html('An error occurred.');
                    }
                });
        }
        

        loadcamp();

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