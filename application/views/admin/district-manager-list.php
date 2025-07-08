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
							$districtManagerData = getAllDistrictManager();
							$districtManagerData = $districtManagerData['districtManagerData'];
							?>
                            
                    <table id="myTable" class="display">
                    <thead>
                    <tr>
                    <th>Sr </th>                   
                    <th>Name</th>  
                    <th>E-mail</th>  
                    <th>Mobile</th> 
                    <th>City</th> 
                    <th>State</th>                    
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $sr = 1;
                    $districtManagerIds = array();
                    foreach($districtManagerData as $districtManagerItem){
                    //pr($districtManagerItem);
					$districtManagerName = $districtManagerItem['first_name'].' '.$districtManagerItem['last_name'];
					$districtManagerEmail = $districtManagerItem['email'];
					$districtManagerMobile = $districtManagerItem['mobile'];
					$districtManagerCity = $districtManagerItem['city'];
					$districtManagerState = $districtManagerItem['state'];
					$districtManagerId = $districtManagerItem['id'];
					
                    //die();
                    ?>
                    <tr>
                    <td><?php echo $sr;?></td>                    
                    <td><?php echo $districtManagerName;?></td> 
                    <td><?php echo $districtManagerEmail;?></td> 
                    <td><?php echo $districtManagerMobile;?></td> 
                    <td><?php echo $districtManagerCity;?></td> 
                    <td><?php echo $districtManagerState;?></td>                    
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
