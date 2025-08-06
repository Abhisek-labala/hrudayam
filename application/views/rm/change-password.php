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
								<form action="<?php echo base_url();?>rm-change-password-post" name="changePassword" id="changePassword" method="post" enctype="multipart/form-data" >
									
                                    
                                    <div class="mb-3 row">
    <label class="col-form-label col-md-2">Current Password</label>
    <div class="col-md-10 position-relative">
        <input type="password" maxlength="12" class="form-control" name="currentPassword" id="currentPassword" required>
        <span class="toggle-password" data-target="currentPassword" style="position:absolute; right:15px; top:10px; cursor:pointer;">👁️</span>
    </div>
</div>

<div class="mb-3 row">
    <label class="col-form-label col-md-2">New Password</label>
    <div class="col-md-10 position-relative">
        <input type="password" maxlength="12" class="form-control" name="newPassword" id="newPassword" required>
        <span class="toggle-password" data-target="newPassword" style="position:absolute; right:15px; top:10px; cursor:pointer;">👁️</span>
    </div>
</div>

                                    
                                    
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2"> </label>
										<div class="col-md-10">
											<button type="submit" name="submit" id="submit" class="btn btn-primary thembutton" onclick="return ChangePassword();">Submit</button>
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
function ChangePassword() { 
    const currentPassword = document.getElementById("currentPassword").value.trim();
    const newPassword = document.getElementById("newPassword").value.trim();

    // Check if both fields are filled
    if (!currentPassword || !newPassword) {
        alert("Both current and new password fields are required.");
        return false;
    }

    // Check if new password is same as current
    if (currentPassword === newPassword) {
        alert("New password cannot be the same as the current password.");
        return false;
    }

    // Password must have at least 8 characters, one letter, one number, and one special character
    var passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;

    if (!passwordPattern.test(newPassword)) {
       // alert("New password must be at least 8 characters long and include at least one letter, one number, and one special character.");
        alert("Password must be at least 8 characters long and include at least one letter, one number, and one special character (allowed: @, $, !, %, *, #, ?, &).");
		
        return false;
    }

    return true; // All validations passed
}
document.querySelectorAll('.toggle-password').forEach(function (eyeIcon) {
    eyeIcon.addEventListener('click', function () {
        const targetId = this.getAttribute('data-target');
        const input = document.getElementById(targetId);
        if (input) {
            input.type = input.type === 'password' ? 'text' : 'password';
            this.textContent = input.type === 'password' ? '👁️' : '🙈';
        }
    });
});

</script>
