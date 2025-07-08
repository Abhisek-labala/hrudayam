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
								<form action="Map-Educator-To-Doctor-Post" name="createEducator" id="createEducator" method="post" enctype="multipart/form-data" >
									
<?php 
$educators = array();
$educatorData = getAllEducator();
$educatorData = $educatorData['educatorData'];
if($educatorData){ 
foreach($educatorData as $educatorItem){
$id = $educatorItem['id'];
$name = $educatorItem['first_name'].' '.$educatorItem['last_name'];
$educators[$id]=  array('id'=>$id,'name'=>$name);											
}  
} 
?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
                                    
                                    
<div class="mb-3 row">
<label class="col-form-label col-md-2">From Edcutor</label>
<div class="col-md-10">
<select name="mapFrom" id="mapFrom"  class="form-select form-control" onchange="showDoctors(this.value)">
    <option value="">-- Select --</option>
    <!--<option value="all">All</option>-->
    <option selected="selected"  value="0">Un-Map</option>	
    <?php 
    if($educators){
        foreach($educators as $educatorsItems){														
    ?>				
    <option value="<?php echo $educatorsItems['id'];?>">
    <?php echo $educatorsItems['name'];?>
    </option>                                                
    <?php } } ?>			
</select>
</div>
</div>
                                    
                            
<?php 
$doctorsData = getAllDoctor();
//pr($doctorsData);
//die();
$doctorsData = $doctorsData['doctorsData'];
?>
        <div class="mb-3 row">
        <div id='doctorListDiv'>
        </div>
        </div>
                                    
<script>
/*$(document).ready( function () {
    $('#myTable').DataTable();
} );*/
</script>




                                    
                                    
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2"> Map To Edcutor</label>
										<div class="col-md-10">
											<select name="mapTo" id="mapTo" class="form-select form-control">
												<option selected="selected" value="">-- Select --</option>
												 <option value="0">Un-Map</option>
                                                <?php 
												if($educators){
													foreach($educators as $educatorsItems){														
												?>				
                                                <option value="<?php echo $educatorsItems['id'];?>">
												<?php echo $educatorsItems['name'];?>
                                                </option>                                                
                                                <?php } } ?>			
											</select>
										</div>
									</div>
                                    
                                    
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2"> </label>
										<div class="col-md-10">
											<button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
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
   function showDoctors(EducatorId) {
    //var EducatorId =  $('#EducatorId').val();
	var MapEducatorName = $('#mapFrom :selected').text().trim();
	
	$('#doctorListDiv').html('<p>loading data.</p>');
    $.ajax({
      url: 'https://doctor.tasainnovation.com/Admin/getDoctorByEducator', // Replace with your actual endpoint
      type: 'POST',
	  // dataType: 'json',
	  data: { EducatorId: EducatorId,MapEducatorName: MapEducatorName },
      success: function (response) {
        // Assuming response is HTML table
        $('#doctorListDiv').html(response);
		 $('#myTable').DataTable({searching: true, paging: false, info: false,"pageLength": 50});
      },
      error: function (xhr, status, error) {
        console.error('AJAX Error:', error);
        $('#doctorListDiv').html('<p>Error loading data.</p>');
      }
    }); 
	
  }
</script>

<script>
showDoctors(0)
</script>