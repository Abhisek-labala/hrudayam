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
								<form action="Assign-Educator-Post" name="createeducator" id="createeducator" method="post" enctype="multipart/form-data" >
									
<?php 
$districtManagers = array();
$districtManagerData = getAllDistrictManager();
$districtManagerData = $districtManagerData['districtManagerData'];
//pr($educatorData);
//die();

if($districtManagerData){ 
foreach($districtManagerData as $districtManagerItem){
$id = $districtManagerItem['id'];
$name = $districtManagerItem['first_name'].' '.$districtManagerItem['last_name'];
$districtManagers[$id]=  array('id'=>$id,'name'=>$name);											
}  
} 
?>

<!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      -->                              
                                    
<div class="mb-3 row">
<label class="col-form-label col-md-2">From Distric Manager</label>
<div class="col-md-10">
<select name="mapFrom" id="mapFrom"  class="form-select form-control" onchange="showEducator(this.value)">
    <option value="">-- Select --</option>
    <!--<option value="all">All</option>-->
    <option selected="selected"  value="0">Un-Map</option>	
    <?php 
    if($districtManagers){
        foreach($districtManagers as $districtManagersItems){														
    ?>				
    <option value="<?php echo $districtManagersItems['id'];?>">
    <?php echo $districtManagersItems['name'];?>
    </option>                                                
    <?php } } ?>			
</select>
</div>
</div>
                                    
                            
<?php 
//$doctorsData = getAllEducator();
//pr($doctorsData);
//die();
//$educatorData = $educatorData['educatorData'];
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
<label class="col-form-label col-md-2">To Distric Manager</label>
<div class="col-md-10">
<select name="mapTo" id="mapTo"  class="form-select form-control">
<option value="">-- Select --</option>
<!--<option value="all">All</option>-->
<option selected="selected"  value="0">Un-Map</option>	
<?php 
if($districtManagers){
foreach($districtManagers as $districtManagersItems){														
?>				
<option value="<?php echo $districtManagersItems['id'];?>">
<?php echo $districtManagersItems['name'];?>
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
   function showEducator(DmId) {
    //var educatorId =  $('#educatorId').val();
	var DmName = $('#mapFrom :selected').text().trim();
	
	$('#doctorListDiv').html('<p>loading data.</p>');
    $.ajax({
      url: 'https://doctor.tasainnovation.com/Admin/getEducatorByManager', // Replace with your actual endpoint
      type: 'POST',
	  // dataType: 'json',
	  data: { DmId: DmId,DmName: DmName },
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
showEducator(0)
</script>