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
							$educatorData = getAllEducator();
							$educatorData = $educatorData['educatorData'];
							?>
                            
                    <table id="myTable" class="display">
                    <thead>
                    <tr>
                    <th>Sr </th>                   
                    <th>Name</th>  
                    <th>Password</th>  
                    <!-- <th>E-mail</th>  
                    <th>Mobile</th> 
                    <th>City</th> 
                    <th>State</th>                     -->
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $sr = 1;
                    $educatorIds = array();
                    foreach($educatorData as $educatorItem){
                    //pr($educatorItem);
					$educatorName = $educatorItem['first_name'].' '.$educatorItem['last_name'];
					$password = $educatorItem['password'];
					$educatorEmail = $educatorItem['email'];
					$educatorMobile = $educatorItem['mobile'];
					$educatorCity = $educatorItem['city'];
					$educatorState = $educatorItem['state'];
					$educatorId = $educatorItem['id'];
					
                    //die();
                    ?>
                    <tr>
                    <td><?php echo $sr;?></td>                    
                    <td><?php echo $educatorName;?></td> 
                    <td><?php echo htmlentities($password);?></td> 
                    <!-- <td><?php echo $educatorMobile;?></td> 
                    <td><?php echo $educatorCity;?></td> 
                    <td><?php echo $educatorState;?></td> -->
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
