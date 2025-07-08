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
							$zonaManagerData = getAllZonaManager();
							$zonaManagerData = $zonaManagerData['zonaManagerData'];
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
                    $zonaManagerIds = array();
                    foreach($zonaManagerData as $zonaManagerItem){
                    //pr($zonaManagerItem);
					$zonaManagerName = $zonaManagerItem['first_name'].' '.$zonaManagerItem['last_name'];
					$zonaManagerEmail = $zonaManagerItem['email'];
					$zonaManagerMobile = $zonaManagerItem['mobile'];
					$zonaManagerCity = $zonaManagerItem['city'];
					$zonaManagerState = $zonaManagerItem['state'];
					$zonaManagerId = $zonaManagerItem['id'];
					
                    //die();
                    ?>
                    <tr>
                    <td><?php echo $sr;?></td>                    
                    <td><?php echo $zonaManagerName;?></td> 
                    <td><?php echo $zonaManagerEmail;?></td> 
                    <td><?php echo $zonaManagerMobile;?></td> 
                    <td><?php echo $zonaManagerCity;?></td> 
                    <td><?php echo $zonaManagerState;?></td>                    
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
