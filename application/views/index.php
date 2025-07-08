<?php 
include('header.php');
echo "Welcome To Site";
die();
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
								<h1>Login</h1>
								<p class="account-subtitle">Access to our dashboard</p>
								
								<!-- Form -->
								<form action="index.html">
									<div class="mb-3">
										<input class="form-control" type="text" placeholder="Email">
									</div>
									<div class="mb-3">
										<input class="form-control" type="text" placeholder="Password">
									</div>
									<div class="mb-3">
										<button class="btn btn-primary w-100" type="submit">Login</button>
									</div>
								</form>
								<!-- /Form -->
								
								<div class="text-center forgotpass"><a href="forgot-password.html">Forgot Password?</a></div>
								<div class="login-or">
									<span class="or-line"></span>
									<span class="span-or">or</span>
								</div>
								  
								
								
								<div class="text-center dont-have">Don’t have an account? <a href="register.php">Register</a></div>
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