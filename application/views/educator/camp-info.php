<?php 
   include('head.php');
   ?>
<!-- Main Wrapper -->
<div class="main-wrapper">
   <!-- Header -->
   <?php 
      include('header.php');
      ?>
   <!-- /Header -->
   <!-- Sidebar -->
   <?php 
      include('side_bar.php');
      ?>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
   <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
   <script>
      $(".chosen-select").chosen({
        no_results_text: "Oops, nothing found!"
      })
   </script>
   <style>
      .error-border {
      border: 2px solid red !important;
      }
   </style>
   <script>
      $(document).ready(function() {
         $('#hcp_name').on('change', function() {
            var doctorId = $(this).val();
            if (doctorId !== '') {
               $.ajax({
                  url: '/Educator/getHCLDetails',  // backend PHP file
                  type: 'POST',
                  data: { doctor_id: doctorId },
                  dataType: 'json',
                  success: function(response) {
                     if (response.status === 'success') {
                       var city = response.city;
                       var speciality = response.speciality;
                        $('#msl_code').val(response.msl_code);
                        $('#city').html('<option value="'+city+'">'+city+'</option>');
                        $('#speciality').html('<option value="'+speciality+'">'+speciality+'</option>');                                       
                        //$('#speciality').html('<option value="Adilabad">Adilabad</option>');                    
                        //$('#msl_code').val(response);
                     } else {
                        $('#msl_code').val('');
                        alert('MSL Code not found');
                     }
                  },
                  error: function() {
                     alert('Something went wrong while fetching MSL Code');
                  }
               });
            } else {
               $('#msl_code').val('');
            }
         });
      });
      
   </script>

   <style>
   .mandatory {
    color: red;
    font-size: 16px;
    font-weight: 500;
    margin-left: 2px;
}
   </style>

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
         <form action="Patient-Inquiry-Post" name="createPatientInquiry" id="createPatientInquiry" method="post" enctype="multipart/form-data">
            <div class="card mb-4">
               <div class="card-header thembutton text-white">
                  <h5 class="mb-0">OnGoing Camp Details</h5>
               </div>
               <div class="card-body">
                   <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Select Doctor</label>
                           <select class="form-control" id="doctor_dropdown" name="doctor">
                              <option value="">Loading doctors...</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12 col-lg-12">

                     <?php
                              $educatorId = $this->session->userdata('educator_id');
                              $date= date('Y-m-d');	
                              $query = "SELECT * FROM `camp` WHERE `edcator_id`='".$educatorId."' and date='".$date."' and in_time!='' and out_time='' limit 1";
                              $campData 	= $this->master_model->customQueryRow($query);                                                            
                     ?>
                                 <table id="myTable" class="display">
                                 <thead>
                                    <tr>
                                    <th>Sr </th>                   
                                    <th>Camp</th>
                                    <th>Date</th>		
                                    <th>In Time</th>				
                                    <th>Out Time</th>	
                                    <th>Remarks</th>	
                                    <th>Action </th>			
                                    <th>Execution Status </th>			
                                    </tr>
                                 </thead>

                                 <tbody> 
<?php 
for($c=1;$c<=3;$c++){

   $in_time = '';
   $out_time = '';
   $camp_id="";
   $remarks = "";

if($campData){
   $camp_id = $campData->id;
   $camp_name_id = $campData->camp_id;
   if($camp_name_id==$c){               
      $date = $campData->date;
      $in_time = $campData->in_time;
      $out_time = $campData->out_time;  
      $remarks = $campData->remarks;  
   }  else{
         $in_time = '';
         $out_time = '';
         $camp_id="";
         $remarks = "";
   }
}

?>
                                 <tr>
                                 <th><?php echo $c;?> </th>                   
                                 <th>Camp <?php echo $c;?></th>
                                 <th> <?php echo $date;?> </th>		
                                 <th> <?php echo $in_time;?> </th>				
                                 <th> <?php echo $out_time;?> </th>	
                                 <th>
                                     <select class="form-control remarks-dropdown" data-camp-id="<?php echo $camp_id; ?>">
                                       <option value="">Select Remark</option>
                                       <option value="Doctor on leave" <?php echo ($remarks == 'Doctor on leave') ? 'selected' : ''; ?>>Doctor on leave</option>
                                       <option value="Educator on leave" <?php echo ($remarks == 'Educator on leave') ? 'selected' : ''; ?>>Educator on leave</option>
                                    </select>
                                 </th>	
                                 <th>                                 
                                 <?php 
                                 if($camp_id){
                                 ?>
                                 <button type="button" class="btn btn-danger" onclick="stopCamp('<?php echo $camp_id;?>')">Stop</button>
                                 <?php }else{?>
                                    <button type="button" class="btn btn-primary" onclick="startCamp('<?php echo $c;?>')">Start</button>
                                 <?php }?>
                                  </th>			
                                  <th>
                                     <button type="button" class="btn btn-success" onclick="executed('<?php echo $camp_id;?>')">Executed</button>
                                  
                                     <button type="button" class="btn btn-danger" onclick="notexecuted('<?php echo $camp_id;?>')">Not Executed</button>
                                  </th>
                                 </tr>
                                 <?php } ?>


                                 </tbody>

                                 </table>
                      </div>
                  </div>
                                   
               </div>
            </div>
            
           
         </form>
        
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   function loadDoctors() {
    $.ajax({
        url: '/Educator/getDoctorsList',
        type: 'GET',
        dataType: 'json',
        success: function(doctorsData) {
            var options = '<option value="">-- Select Doctor --</option>';
            
            if(doctorsData && doctorsData.length > 0) {
                $.each(doctorsData, function(index, doctor) {
                    options += '<option value="'+doctor.id+'">'+doctor.name+'</option>';
                });
            } else {
                options = '<option value="">No doctors available</option>';
            }
            
            $('#doctor_dropdown').html(options);
        },
        error: function() {
            $('#doctor_dropdown').html('<option value="">Error loading doctors</option>');
        }
    });
}

// Doctor dropdown change event
$(document).ready(function() {
    // Load doctors when page loads
    loadDoctors();
    
    $('#doctor_dropdown').on('change', function() {
        var doctorId = $(this).val();
        if (doctorId !== '') {
            $.ajax({
                url: '/Educator/getHCLDetails',
                type: 'POST',
                data: { doctor_id: doctorId },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        var city = response.city;
                        var speciality = response.speciality;
                        $('#msl_code').val(response.msl_code);
                        $('#city').html('<option value="'+city+'">'+city+'</option>');
                        $('#speciality').html('<option value="'+speciality+'">'+speciality+'</option>');
                    } else {
                        $('#msl_code').val('');
                        alert('Doctor details not found');
                    }
                },
                error: function() {
                    alert('Something went wrong while fetching doctor details');
                }
            });
        } else {
            $('#msl_code').val('');
        }
    });
});
function startCamp(campId) {
   var doctorDropdown = $('#doctor_dropdown');
    var doctorId = doctorDropdown.val();
    var doctorName = doctorDropdown.find('option:selected').text();

    if (!doctorId) {
        alert('Please select a doctor first');
        return false;
    }
    $.ajax({
        url: '/Educator/startCamp',
        type: 'POST',
        data: {
            action: 'start',
            camp_id: campId,
            doctor_id: doctorId,
            doctor_name: doctorName
        },
        dataType: 'json',
        success: function(response) {
            alert(response.message);
            location.reload(); // Optional
        },
        error: function(xhr, status, error) {
            alert("An error occurred: " + error);
        }
    });
}

function stopCamp(campId) { 
   var remark = $('.remarks-dropdown[data-camp-id="'+campId+'"]').val();
    
    if (!remark) {
        if (!confirm("Are you sure you want to stop the camp without selecting a remark?")) {
            return false;
        }
    }
    $.ajax({
        url: '/Educator/stopCamp',
        type: 'POST',
        data: {
            action: 'stop',
            camp_id: campId,
            remarks: remark

        },
        dataType: 'json',
        success: function(response) {
            alert(response.message);
            location.reload(); // Optional
        },
        error: function(xhr, status, error) {
            alert("An error occurred: " + error);
        }
    });
}
function executed(campId)
{
    $.ajax({
        url: '/Educator/executed',
        type: 'POST',
        data: {
            execution_status: 'EXECUTED',
            camp_id: campId
        },
        dataType: 'json',
        success: function(response) {
            alert(response.message);
            location.reload(); // Optional
        },
        error: function(xhr, status, error) {
            alert("An error occurred: " + error);
        }
    });
}
function notexecuted(campId)
{
    var remark = $('.remarks-dropdown[data-camp-id="'+campId+'"]').val();
    
    if (!remark) {
        alert("Please select a remark before stopping the camp.")
            return false;
    }
    $.ajax({
        url: '/Educator/notexecuted',
        type: 'POST',
        data: {
            execution_status: 'NOT EXECUTED',
            camp_id: campId,
            remarks :remark
        },
        dataType: 'json',
        success: function(response) {
            alert(response.message);
            location.reload(); // Optional
        },
        error: function(xhr, status, error) {
            alert("An error occurred: " + error);
        }
    });

}
</script>
