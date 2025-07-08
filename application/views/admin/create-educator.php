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
								<form action="Create-Educator-Post" name="createEducator" id="createEducator" method="post" enctype="multipart/form-data" >
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
										<label class="col-form-label col-md-2">State</label>
										<div class="col-md-10">
                                            <?php 
											$states = getIndianStates();
											?>
                                                <select class="form-control" name="state" id="state">
                                                <option value="" id=""> -- Select -- </option>
												<?php 
                                                foreach ($states as $code => $name) {?>
                                                <option value="<?php echo $code?>" id="<?php echo $code?>"> <?php echo $name?></option>
                                                <?php } ?>
                                                </select>											
										</div>
									</div>
                                    
                                      
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2">City</label>
										<div class="col-md-10">
											<input type="text" maxlength="50" class="form-control" name="city" id="city">
										</div>
									</div>
                                    
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2">Address </label>
										<div class="col-md-10">
											<textarea maxlength="200" rows="5" cols="5" class="form-control" placeholder="Enter text here" name="address" id="address"></textarea>
										</div>
									</div>
                                    
                                    
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-2">About </label>
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

<script>

// Utility validation functions
function isEmpty(value) {
    return value.trim() === "";
}

function isValidEmail(email) {
    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return pattern.test(email);
}

function isValidPassword(password) {
    const pattern = /^(?=.*[a-z])(?=.*[A-Z]).{5,}$/;
    return pattern.test(password);
}

function isValidMobile(mobile) {
    const pattern = /^\d{10}$/;
    return pattern.test(mobile);
}

function isValidCity(city) {
    const pattern = /^[A-Za-z\s]+$/;
    return pattern.test(city);
}

function isValidState(state) {
        const pattern = /^[A-Za-z\s]+$/;
        return pattern.test(state);
} 

function isValidImageFile(fileName) {
    if (fileName === "") return true; // Image is optional
    const pattern = /(\.jpg|\.jpeg|\.png)$/i;
    return pattern.test(fileName);
}

// Main form validation function
function submitEducator() {
    var isValid = true;
    var messages = [];

    const firstName = document.getElementById("first_name").value.trim();
    const lastName = document.getElementById("last_name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const mobile = document.getElementById("mobile").value.trim();
	const state = document.getElementById("state").value;
    const city = document.getElementById("city").value.trim();
    const profileImage = document.getElementById("profile_image").value;

    if (isEmpty(firstName)) {
        messages.push("First name is required.");
        isValid = false;
    }

    if (isEmpty(lastName)) {
        messages.push("Last name is required.");
        isValid = false;
    }

    if (!isValidEmail(email)) {
        messages.push("Invalid email address.");
        isValid = false;
    }

    if (!isValidPassword(password)) {
        messages.push("Password must be at least 5 characters long and include at least one uppercase and one lowercase letter.");
        isValid = false;
    }

    if (!isValidMobile(mobile)) {
        messages.push("Mobile number must be exactly 10 digits.");
        isValid = false;
    }
	
	if (!isValidState(state)) {
            messages.push("State must contain only letters and spaces.");
            isValid = false;
        }

    if (!isValidCity(city)) {
        messages.push("City must contain only alphabetic characters.");
        isValid = false;
    }

    if (!isValidImageFile(profileImage)) {
        messages.push("Profile image must be a .jpg or .png file.");
        isValid = false;
    }

    if (!isValid) {
        alert(messages.join("\n"));
        return false;
    } else {
        return true;
    }
}


</script>