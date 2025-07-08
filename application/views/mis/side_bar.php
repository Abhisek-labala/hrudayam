<div class="sidebar" id="sidebar">
   <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 593px;">
      <!-- <div class="sidebar-inner slimscroll" style="overflow: hidden; width: 100%; height: 593px;"> -->
      <div class="sidebar-inner slimscroll" style="overflow: hidden; width: 100%; height: 593px;overflow-y: scroll;">
         <div id="sidebar-menu" class="sidebar-menu">
            <ul>
               <!-- <li class="menu-title"> 
                  <span>Main</span>
               </li> -->
               <li> 
                  <a href="<?php echo base_url();?>mis-dashboard"><i class="fa fa-home"></i> <span>Dashboard</span></a>
               </li>


					<li class="submenu">
					<a href="#"><i class="fa fa-document"></i> <span> ADD/DELETE </span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">
							
                     <li> 
                        <a href="<?php echo base_url();?>MIS-Create-Educator"> <span> EDUCATOR</span></a>
                     </li>

                     <li> 
							   <a href="<?php echo base_url();?>MIS-Create-Doctor"> <span>  HCP</span></a>
							</li>                    

                      <li> 
							   <a href="<?php echo base_url();?>MIS-Create-RM"><span> RM</span></a>
							</li>
						</ul>
					</li>

					<li class="submenu">
					<a href="#"><i class="fa fa-document"></i> <span> Assign </span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">
							<li> 
							<a href="<?php echo base_url();?>MIS-Assign-EDUCATOR"><span>EDUCATOR</span></a>
							</li>
							<li> 
							<a href="<?php echo base_url();?>MIS-Assign-HCP"><span>HCP</span></a>
							</li>
						</ul>
					</li>

					<li class="submenu">
					<!-- <a href="#"><i class="fa fa-document"></i> <span> List </span> <span class="menu-arrow"></span></a> -->
						<ul style="display: none;">
							<!------Working---------->
                     <!-- <li> 
							<a href="<?php echo base_url();?>Doctors-List"> <span>Doctors</span></a>
							</li>
							<li> 
							<a href="<?php echo base_url();?>Educators-List"> <span>Edcators </span></a>
							</li> -->
                     <!------Working---------->


							<!-- <li> 
							<a href="<?php echo base_url();?>Zone-Manager-List"> <span>Zone Managers  </span></a>
							</li>
							<li> 
							<a href="<?php echo base_url();?>District-Manager-List"> <span> District Managers </span></a>
							</li> -->
						</ul>
					</li>
					
				<!-- <li> 
                  <a href="<?php echo base_url();?>mis-change-password"><i class="fa fa-key"></i> <span>Change Password</span></a>
               </li> -->

			   <li> 
                  <a href="<?php echo base_url();?>mis-logout"><i class="fa fa-sign-out" aria-hidden="true"></i> 
				  <span>Logout</span></a>
               </li>

			   


               
               <!-- <li> 
                  <a href="<?php echo base_url();?>doctor-list.html"><i class="fa fa-user-plus"></i> <span>Doctors</span></a>
               </li>
               <li> 
                  <a href="<?php echo base_url();?>patient-list.html"><i class="fa fa-user"></i> <span>Patients</span></a>
               </li>
               <li> 
                  <a href="<?php echo base_url();?>reviews.html"><i class="fa fa-star-o"></i> <span>Reviews</span></a>
               </li>
               <li> 
                  <a href="<?php echo base_url();?>transactions-list.html"><i class="fa fa-activity"></i> <span>Transactions</span></a>
               </li>
               <li> 
                  <a href="<?php echo base_url();?>settings.html"><i class="fa fa-vector"></i> <span>Settings</span></a>
               </li>
               <li class="submenu">
                  <a href="#"><i class="fa fa-document"></i> <span> Reports</span> <span class="menu-arrow"></span></a>
                  <ul style="display: none;">
                     <li><a href="<?php echo base_url();?>invoice-report.html">Invoice Reports</a></li>
                  </ul>
               </li>
               <li class="menu-title"> 
                  <span>Pages</span>
               </li>
               <li> 
                  <a href="<?php echo base_url();?>profile.html"><i class="fa fa-user-plus"></i> <span>Profile</span></a>
               </li>
               <li class="submenu">
                  <a href="#"><i class="fa fa-document"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
                  <ul style="display: none;">
                     <li><a href="<?php echo base_url();?>login.html"> Login </a></li>
                     <li><a href="<?php echo base_url();?>register.html"> Register </a></li>
                     <li><a href="<?php echo base_url();?>forgot-password.html"> Forgot Password </a></li>
                     <li><a href="<?php echo base_url();?>lock-screen.html"> Lock Screen </a></li>
                  </ul>
               </li>
               <li class="submenu">
                  <a href="#"><i class="fa fa-warning"></i> <span> Error Pages </span> <span class="menu-arrow"></span></a>
                  <ul style="display: none;">
                     <li><a href="<?php echo base_url();?>error-404.html">404 Error </a></li>
                     <li><a href="<?php echo base_url();?>error-500.html">500 Error </a></li>
                  </ul>
               </li>
               <li> 
                  <a href="<?php echo base_url();?>blank-page.html"><i class="fa fa-file"></i> <span>Blank Page</span></a>
               </li>
               <li class="menu-title"> 
                  <span>UI Interface</span>
               </li>
               <li> 
                  <a href="<?php echo base_url();?>components.html"><i class="fa fa-vector"></i> <span>Components</span></a>
               </li>
               <li class="submenu">
                  <a href="#" class="active subdrop"><i class="fa fa-layout"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
                  <ul style="display: block;">
                     <li><a class="active" href="<?php echo base_url();?>form-basic-inputs.html">Basic Inputs </a></li>
                     <li><a href="<?php echo base_url();?>form-input-groups.html">Input Groups </a></li>
                     <li><a href="<?php echo base_url();?>form-horizontal.html">Horizontal Form </a></li>
                     <li><a href="<?php echo base_url();?>form-vertical.html"> Vertical Form </a></li>
                     <li><a href="<?php echo base_url();?>form-mask.html"> Form Mask </a></li>
                     <li><a href="<?php echo base_url();?>form-validation.html"> Form Validation </a></li>
                  </ul>
               </li>
               <li class="submenu">
                  <a href="#"><i class="fa fa-table"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
                  <ul style="display: none;">
                     <li><a href="<?php echo base_url();?>tables-basic.html">Basic Tables </a></li>
                     <li><a href="<?php echo base_url();?>data-tables.html">Data Table </a></li>
                  </ul>
               </li>
               <li class="submenu">
                  <a href="javascript:void(0);"><i class="fa fa-code"></i> <span>Multi Level</span> <span class="menu-arrow"></span></a>
                  <ul style="display: none;">
                     <li class="submenu">
                        <a href="javascript:void(0);"> <span>Level 1</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                           <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                           <li class="submenu">
                              <a href="javascript:void(0);"> <span> Level 2</span> <span class="menu-arrow"></span></a>
                              <ul style="display: none;">
                                 <li><a href="javascript:void(0);">Level 3</a></li>
                                 <li><a href="javascript:void(0);">Level 3</a></li>
                              </ul>
                           </li>
                           <li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
                        </ul>
                     </li>
                     <li>
                        <a href="javascript:void(0);"> <span>Level 1</span></a>
                     </li>
                  </ul>
               </li>
            </ul> -->
         </div>
      </div>
      <div class="slimScrollBar" style="background: rgb(204, 204, 204); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 325.903px;"></div>
      <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
   </div>
</div>

