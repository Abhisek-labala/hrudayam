<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'Welcome';
//$route['default_controller'] = 'Admin/adminLogin';
$route['campreport_excel']='/Common/campreport_excel';
//////////admin///////////////
//$route['admin-login'] = "Welcome";
$route['admin-login']      		= "Welcome/adminLogin";
$route['admin-login-Post'] 	 	= "Welcome/adminLoginAuth";

$route['admin-dashboard']   	= "Admin/adminDashBoard";
//$route['admin-dashboard']   	= "Admin/adminDashBoardTable";

//$route['admin-dashboard']   	= "Admin/createEducator"; 
$route['Create-Educator']   	= "Admin/createEducator";
$route['Create-Educator-Post']  = "Admin/createEducatorPost";

$route['Create-Doctor']  		= "Admin/createDoctor";
$route['Create-Doctor-Post']  	= "Admin/createDoctorPost";

$route['Create-District-Manager']  = "Admin/createDistrictManager";
$route['Create-District-Manager-Post']    = "Admin/createDistrictManagerPost"; 


$route['Create-Zone-Manager']  = "Admin/createZoneManager";
$route['Create-Zone-Post']    = "Admin/createZoneManagerPost"; 

$route['Assign-District-Manager']       = "Admin/assignDistrictManagerView";
$route['Assign-District-Manager-Post']  = "Admin/assignDistrictManagerPost";

$route['Assign-Educator']       = "Admin/assignEducatorView";
$route['Assign-Educator-Post']  = "Admin/assignEducatorPost";

$route['Map-Educator-To-Doctor']       = "Admin/mapEducatorToDoctorView";
$route['Map-Educator-To-Doctor-Post']  = "Admin/mapEducatorToDoctorPost";


$route['Doctors-List']       		= "Admin/doctorsList";
$route['Educators-List']     		= "Admin/educatorsList";
$route['Zone-Manager-List']  		= "Admin/zoneManagerList";
$route['District-Manager-List']  	= "Admin/districtManagerList";

$route['admin-change-password']             = "Admin/changePassword";
$route['admin-change-password-post']        = "Admin/changePasswordPost";


$route['admin-logout']             = "Admin/logout";
//////////admin///////////////

///////////PM/////
$route['pm-login']      		= "Welcome/pmLogin";
$route['Pm-login']      		= "Welcome/pmLogin";
$route['pm-login-Post'] 	 	= "Welcome/pmLoginAuth";
$route['pm-dashboard']   	    = "Pm/dashBoard";
$route['Pm-dashboard']   	    = "Pm/dashBoard";
$route['Pm-campreport']         ="Pm/campreport";
$route['Pm-Create-Educator']   	    = "Pm/CreateEducator";
$route['Pm-Create-Educator-Post']   	    = "Pm/createEducatorPost";
$route['Pm-Get-Educators']   	    = "Pm/getEducators";
$route['Pm-Create-DE']   	    = "Pm/CreateDigitalEducator";
$route['Pm-Create-DigiEducator-Post']   	    = "Pm/createDigiEducatorPost";
$route['Pm-Get-DigiEducators']   	    = "Pm/digigetEducators";
$route['Pm-Delete-DigiEducator/(:num)'] = "Pm/deletedigiEducator/$1";
$route['Pm-Get-Doctors']   	    = "Pm/getDoctors";
$route['Pm-Delete-Educator/(:num)'] = "Pm/deleteEducator/$1";
$route['Pm-Delete-Doctor/(:num)'] = "Pm/deleteDoctor/$1";
$route['Pm-Delete-Rm/(:num)'] = "Pm/deleteRM/$1";
$route['Pm-Create-Doctor']   	    = "Pm/createDoctor";
$route['Pm-Create-Doctor-Post']   	    = "Pm/createDoctorPost";
$route['Pm-Get-cities']   	    = "Pm/getcities";
$route['Pm-Get-zones']   	    = "Pm/getZones";
$route['Pm-Create-RM']   	    = "Pm/createRm";
$route['Pm-Get-Rm']   	    = "Pm/getRm";
$route['Pm-Create-Rm-Post']   	    = "Pm/createRmPost";
$route['PM-Assign-EDUCATOR']    ="Pm/assignEducatorView";
$route['pm-Assign-Educator-Post']    ="Pm/pmassignEducatorPost";
$route['PM-Assign-digital-educator-Rm']    ="Pm/assigndigiEducatorView";
$route['pm-Assign-DigitalEducator-Post']    ="Pm/pmassignDigitalEducatorPost";
$route['pm-Assign-Hcp-Post']    ="Pm/pmassignHcpPost";
$route['PM-Assign-HCP']      ="Pm/assignHcpView";
$route['pm-Analytics']      ="Pm/analytics";
$route['Assign-digital-educator']      ="Pm/assigndigital";
$route['pm-feedback']      ="Pm/feedback";
$route['pm-feedbackform']      ="Pm/feedbackform";
$route['assign_digitaleducator_post']      ="Pm/assign_digitaleducator_post";
$route['pm-logout']             = "Pm/logout";
$route['Pm-logout']             = "Pm/logout";
///////////Pm/////

///////////Mis/////
$route['mis-login']      		= "Welcome/misLogin";
$route['Mis-login']      		= "Welcome/misLogin";
$route['mis-login-Post'] 	 	= "Welcome/misLoginAuth";
$route['mis-dashboard']   	    = "Mis/dashBoard";
$route['Mis-campreport']         ="Mis/campreport";
$route['Mis-dashboard']   	    = "Mis/dashBoard";
$route['mis-logout']             = "Mis/logout";
$route['Mis-logout']             = "Mis/logout";
$route['MIS-Create-Educator']   	    = "Mis/CreateEducator";
$route['MIS-Create-Educator-Post']   	    = "Mis/createEducatorPost";
$route['MIS-Get-Educators']   	    = "Mis/getEducators";
$route['Mis-Create-DE']   	    = "Mis/CreateDigitalEducator";
$route['Mis-Create-DigiEducator-Post']   	    = "Mis/createDigiEducatorPost";
$route['Mis-Get-DigiEducators']   	    = "Mis/digigetEducators";
$route['MIS-Get-Doctors']   	    = "Mis/getDoctors";
$route['Mis-Delete-DigiEducator/(:num)'] = "Mis/deletedigiEducator/$1";
$route['MIS-Delete-Educator/(:num)'] = "Mis/deleteEducator/$1";
$route['MIS-Delete-Doctor/(:num)'] = "Mis/deleteDoctor/$1";
$route['MIS-Delete-Rm/(:num)'] = "Mis/deleteRM/$1";
$route['MIS-Create-Doctor']   	    = "Mis/createDoctor";
$route['MIS-Create-Doctor-Post']   	    = "Mis/createDoctorPost";
$route['MIS-Get-cities']   	    = "Mis/getcities";
$route['MIS-Get-zones']   	    = "Mis/getZones";
$route['MIS-Create-RM']   	    = "Mis/createRm";
$route['MIS-Get-Rm']   	    = "Mis/getRm";
$route['MIS-Create-Rm-Post']   	    = "Mis/createRmPost";
$route['MIS-Assign-EDUCATOR']    ="Mis/assignEducatorView";
$route['MIS-Assign-Educator-Post']    ="Mis/MisassignEducatorPost";
$route['mis-Assign-digital-educator-Rm']    ="Mis/assigndigiEducatorView";
$route['mis-Assign-DigitalEducator-Post']    ="Mis/misassignDigitalEducatorPost";
$route['mis-Assign-digital-educator']      ="Mis/assigndigital";
$route['mis-feedback']      ="Mis/feedback";
$route['mis-feedbackform']      ="Mis/feedbackform";
$route['mis-assign_digitaleducator_post']      ="Mis/misassign_digitaleducator_post";
$route['MIS-Assign-Hcp-Post']    ="Mis/MisassignHcpPost";
$route['MIS-Assign-HCP']      ="Mis/assignHcpView";
///////////Mis/////


///////////Educator//////////////
$route['Educator-login']      		 = "Welcome/educatorLogin";
$route['educator-login']      		 = "Welcome/educatorLogin";
$route['Analytics-Dashboard']  = "Educator/analyticDashboard";
$route['Educator-login-Post'] 	     = "Welcome/educatorLoginAuth";
$route['Educator-Dashboard']   	     = "Educator/educatorDashBoard";
//$route['Educator-Dashboard']   	     = "Educator/createPatientInquiry";
$route['Patient-Inquiry']            = "Educator/createPatientInquiry";
//$route['Patient-Inquiry']            = "Educator/createPatientInquiry";
$route['Patient-Information']            = "Educator/createPatientInquiry";
//$route['Patient-Information-New']            = "Educator/createPatientInquiryNew";
$route['Patient-Inquiry-Post']       = "Educator/createPatientInquiryPost";
$route['Patient-List']       = "Educator/patientList";


$route['educator-change-password']             = "Educator/changePassword";
$route['educator-change-password-post']        = "Educator/changePasswordPost";
$route['educator-follow-up-form']        = "Educator/educatorfollowupform";


$route['Educator-logout']            = "Educator/logout";
//////////Educator///////////////


///////////DIGITAL EDUCATOR/////////////
$route['Digital-Educator-login'] ='Welcome/digitaleducatorLogin';
$route['Digital-Educator-login-Post'] ='Welcome/loginAuth';
$route['Digital-Educator-Dashboard'] ='DigitalEducator/dashboard';
$route['digital-Patient-List']       = "DigitalEducator/digitalPatientList";
$route['Digital-Educator-logout']            = "DigitalEducator/logout";
$route['Digital-educator-change-password']             = "DigitalEducator/changePassword";
$route['Digital-educator-change-password-post']        = "DigitalEducator/changePasswordPost";
$route['Digital-educator-follow-up-form']        = "DigitalEducator/followupform";
$route['Digital-educator-follow-up-form-post']        = "DigitalEducator/followupformpost";
$route['DigitalEducator-Patient-Inquiry']            = "DigitalEducator/createPatientInquiry";
$route['DigitalEducator-Patient-Inquiry-Post']       = "DigitalEducator/createPatientInquiryPost";

///////////DIGITAL EDUCATOR/////////////

////////YOGA DIETOICIAL//////////////////
$route['Digital-YogaDieticial-login'] ='Welcome/digitalYogaDieticialLogin';
$route['Digital-YogaDieticial-login-Post'] ='Welcome/loginAuth2';
$route['Digital-YogaDieticial-Dashboard'] ='DigitalYogaDieticial/dashboard';
$route['digital-Patient-List2']       = "DigitalYogaDieticial/digitalPatientList";
$route['Digital-YogaDieticial-logout']            = "DigitalYogaDieticial/logout";
$route['Digital-YogaDieticial-change-password']             = "DigitalYogaDieticial/changePassword";
$route['Digital-YogaDieticial-change-password-post']        = "DigitalYogaDieticial/changePasswordPost";
$route['Digital-YogaDieticial-follow-up-form']        = "DigitalYogaDieticial/followupform";
$route['Digital-YogaDieticial-follow-up-form-post']        = "DigitalYogaDieticial/followupformpost";
$route['DigitalYogaDieticial-Patient-Inquiry']            = "DigitalYogaDieticial/createPatientInquiry";
$route['DigitalYogaDieticial-Patient-Inquiry-Post']       = "DigitalYogaDieticial/createPatientInquiryPost";

// //////////////////YOGA DIETOICIAL////////////////


///////////RM//////////////
$route['RM-login']      		 = "Welcome/rmLogin";
$route['rm-login']      		 = "Welcome/rmLogin";
$route['rm-login-Post'] 	     = "Welcome/rmLoginAuth"; 
//$route['Educator-Dashboard']    = "Educator/educatorDashBoard";

$route['RM-Dashboard']   	     = "Rm/rmDashBoard";
$route['rm-dashboard']   	     = "Rm/rmDashBoard";
$route['rm-Analytics']   	     = "Rm/analytics";

//$route['RM-Dashboard']   	     = "Rm/rmDashBoardFilter";
//$route['rm-dashboard']   	     = "Rm/rmDashBoardFilter";



$route['RM-Dashboard-Table']   	     = "Rm/rmDashBoardTable";
$route['rm-educator-list']   	     = "Rm/rmDashBoardTable";
$route['Rm-Educator-List']   	     = "Rm/rmDashBoardTable"; 

//$route['Patient-Inquiry']            = "Educator/createPatientInquiry";
//$route['Patient-Inquiry']            = "Educator/createPatientInquiry";
//$route['RM-Information']            = "Educator/createPatientInquiry";
//$route['Patient-Information-New']            = "Educator/createPatientInquiryNew";
//$route['RM-Inquiry-Post']       = "Educator/createPatientInquiryPost";

//$route['RM-Patient-List']       = "Educator/patientList";


$route['rm-change-password']             = "Rm/changePassword";
$route['rm-change-password-post']        = "Rm/changePasswordPost";


$route['RM-logout']            = "Rm/logout";
$route['rm-logout']            = "Rm/logout";
//////////Educator///////////////








$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;  



/*
$route['Independent-Investment-Research-Data-Tools-about-us'] = "content/aboutUs";

$route['Marketindex/(:any)/(:any)'] = "Marketindex/index"; 

$route['Mutual-Funds-List/(.+)'] = "MutualFunds/mutualList";
*/

/*$route['luxury-home-with-land-for-sale-listings-about-us'] = "Home/about_us";

$route['farm-country-homes-with-land-for-sale-contact-us'] = "Home/contact_us";

$route['homes-with-land-buyer-seller-agreement-privacy-policy'] = "Home/user_agreement";

$route['copyright'] = "Home/copyright_infringement";

$route['top-real-estate-agents-companies'] = "Home/newsletter_agent";

$route['top-mortgage-brokers-and-lenders-title-insurance-companies-closing-attorney'] = "Home/newsletter";

$route['Luxury-homes-estates-for-sale'] = "Home/property_by_type";

$route['Homes-for-Sale-Farms-for-sale-land-for-sale'] = "Home/property_list";

$route['Homes-for-Sale-Farms-for-sale-land-for-sale-map'] = "Home/property_list_map";

$route['For-Sale-(:any)/(.+)'] = "Home/property_detail";

$route['luxury-home-land-farm-buyer-Service'] = "Home/buyer_list";

$route['for-sale-by-owner'] = "Home/seller_list";

$route['top-agents'] = "Home/agent_list";

$route['real-estate-service/mortgage-brokers-lenders-title-insurance-home-builder'] = "Home/service_provider_list";

$route['top-agents-profile/(.+)'] = "Home/agent_details";

$route['luxury-home-land-farm-(:any)/(.+)'] = "Home/buyer_details";

$route['for-sale-by-owner-(:any)/(.+)'] = "Home/seller_details";

$route['top-(:any)/(.+)'] = "Home/service_provider_details";

$route['land-farm-home-auction-calendar'] = "Home/auction_property_list";

$route['(:any)-auction/(:any)/(:any)'] = "Home/auction_property_detail"; 

$route['property/(:any)/image-gallery'] = "Home/property_more_image"; */  
