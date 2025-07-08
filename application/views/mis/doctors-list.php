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
                            
                            <?php 
							$doctorsData = getAllDoctor();
							$doctorsData = $doctorsData['doctorsData'];
							?>
                            
                    <table id="myTable" class="display">
                    <thead>
                    <tr>
                    <th>Sr </th>                   
                    <th>Name</th>  
                    <!-- <th>E-mail</th>  
                    <th>Mobile</th>  -->
                    <th>City</th> 
                    <th>State</th>                    
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $sr = 1;
                    $doctorIds = array();
                    foreach($doctorsData as $doctorsItem){
                    //pr($doctorsItem);
					$doctorName = $doctorsItem['name'];
					// $doctorEmail = $doctorsItem['email'];
					// $doctorMobile = $doctorsItem['mobile'];
					$doctorCity = $doctorsItem['city'];
					$doctorState = $doctorsItem['state'];
					$doctorId = $doctorsItem['id'];
					
                    //die();
                    ?>
                    <tr>
                    <td><?php echo $sr;?></td>                    
                    <td><?php echo $doctorName;?></td> 
                    <!-- <td><?php echo $doctorEmail;?></td> 
                    <td><?php echo $doctorMobile;?></td>  -->
                    <td><?php echo $doctorCity;?></td> 
                    <td><?php echo $doctorState;?></td>                    
                    </tr>        
                    <?php $sr++; } ?>        
                    </tbody>
                    </table>
								
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
