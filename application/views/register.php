<?php 
include('header.php');
?>
<!-- Main Wrapper -->
<div class="main-wrapper login-body">
            <div class="login-wrapper">
            	<div class="container">
                	<div class="loginbox">
                    	<div class="login-left">
							<img class="img-fluid" src="images/logo-white.png" alt="Logo">
                        </div>
                        <div class="login-right">
							<div class="login-right-wrap">
								<h1>Register</h1>
								<p class="account-subtitle">Access to our dashboard</p>
								
								<!-- Form -->
								<form action="login.html">
									<div class="mb-3">
										<input class="form-control" type="text" placeholder="Name">
									</div>
									<div class="mb-3">
										<input class="form-control" type="text" placeholder="Email">
									</div>
									<div class="mb-3">
										<input class="form-control" type="text" placeholder="Password">
									</div>
									<div class="mb-3">
										<input class="form-control" type="text" placeholder="Confirm Password">
									</div>
									<div class="mb-0">
										<button class="btn btn-primary w-100" type="submit">Register</button>
									</div>
								</form>
								<!-- /Form -->
								
								<div class="login-or">
									<span class="or-line"></span>
									<span class="span-or">or</span>
								</div>						
								
								
								<div class="text-center dont-have">Already have an account? <a href="login.php">Login</a></div>
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