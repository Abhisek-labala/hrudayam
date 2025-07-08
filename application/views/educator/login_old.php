<?php 
die();
include('head.php');
?>
<!-- Main Wrapper -->
<div class="main-wrapper login-body">
            <div class="login-wrapper">
            	<div class="container">
                	<div class="loginbox">
                    	<div class="login-left">
							<img class="img-fluid" src="<?php echo base_url();?>/uploads/logo.png" alt="Logo">
                        </div>
                        <div class="login-right">
							<div class="login-right-wrap">
								<h1>Educator Login</h1>
								<p class="account-subtitle">Access to our dashboard</p>
                                
								<?php /*if(session()->getFlashdata('error')){ ?>
                                <p style="color:red"><?= session()->getFlashdata('error') ?></p>
                                <?php }*/ ?>
								
								<!-- Form -->
								<form action="<?php echo base_url();?><?php echo $indexPage?>/Educator-login-Post" name="educatorlogin" id="educatorlogin" method="Post">
									<div class="mb-3">
										<input class="form-control" type="text" placeholder="Email" name="email" id="email" required>
									</div>
									<div class="mb-3">
										<input class="form-control" type="Password" placeholder="Password" name="password" id="password" required>
									</div>
									<div class="mb-3">
										<button class="btn btn-primary w-100" type="submit">Login</button>
									</div>
								</form>
								<!-- /Form -->
								
								<!-- <div class="text-center forgotpass"><a href="#">Forgot Password?</a></div>
								<div class="login-or">
									<span class="or-line"></span>
									<span class="span-or">or</span>
								</div> -->
						    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- /Main Wrapper -->
		<?php
include('footer-login.php'); 
?>