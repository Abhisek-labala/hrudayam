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
							<div class="card-header">
								<h4 class="card-title">Distric Manager Registration</h4>
							</div>
							<div class="card-body">
								<form action="Create-District-Manager-Post" name="createDoctor" id="districtManager" method="post" enctype="multipart/form-data" >
									<div class="mb-3 row">
										<label class="col-form-label col-md-2">First Name</label>
										<div class="col-md-10">
											<input type="text" maxlength="50" class="form-control" name="first_name" id="first_name">
										</div>
									</div>
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2">Last Name</label>
										<div class="col-md-10">
											<input type="text" maxlength="50" class="form-control" name="last_name" id="last_name">
										</div>
									</div>

									<div class="mb-3 row">
										<label class="col-form-label col-md-2">Email</label>
										<div class="col-md-10">
											<input type="email" maxlength="50" class="form-control" name="email" id="email">
										</div>
									</div>
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2">Password</label>
										<div class="col-md-10">
											<input type="password" maxlength="12" class="form-control" name="password" id="password">
										</div>
									</div>
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2">Mobile</label>
										<div class="col-md-10">
											<input type="text" maxlength="10" class="form-control" name="mobile" id="mobile">
										</div>
									</div>
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2">City</label>
										<div class="col-md-10">
											<input type="text" maxlength="50" class="form-control" name="city" id="city">
										</div>
									</div>
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2">State</label>
										<div class="col-md-10">
											<input type="text" maxlength="50" class="form-control" name="state" id="state">
										</div>
									</div>
                                    
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2">Address </label>
										<div class="col-md-10">
											<textarea maxlength="200" rows="5" cols="5" class="form-control" placeholder="Enter text here" name="address" id="address"></textarea>
										</div>
									</div>
                                    
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2">About Manager </label>
										<div class="col-md-10">
											<textarea maxlength="200" rows="5" cols="5" class="form-control" placeholder="Enter text here" name="about" id="about"></textarea>
										</div>
									</div>
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2">Profile Image</label>
										<div class="col-md-10">
											<input class="form-control" type="file" name="profile_image" id="profile_image">
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