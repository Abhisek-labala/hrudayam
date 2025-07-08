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
								<form action="<?php echo base_url();?>admin-change-password-post" name="changePassword" id="changePassword" method="post" enctype="multipart/form-data" >
									
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2">Current Password</label>
										<div class="col-md-10">
											<input type="password" maxlength="12" class="form-control" name="currentPassword" id="currentPassword" required>
										</div>
									</div>
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2">New Password</label>
										<div class="col-md-10">
											<input type="password" maxlength="12" class="form-control" name="newPassword" id="newPassword" required>
										</div>
									</div>
                                    
                                    
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2"> </label>
										<div class="col-md-10">
											<button type="submit" name="submit" id="submit" class="btn btn-primary" onclick="return submitEducator();">Submit</button>
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
