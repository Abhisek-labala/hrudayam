<?php
include('head.php');
?>
<!-- Main Wrapper -->
<div class="main-wrapper">
   <!-- Header -->
   <?php
   include('header.php');
   ?>
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <style>
      /* Ensure dropdowns appear above other elements */
      .select2-container {
         z-index: 1051 !important;
      }

      /* Fix for input focus */
      .select2-search__field {
         width: 100% !important;
      }

      /* Clear separation between dropdowns */
      .select2-container--default .select2-selection--multiple {
         min-height: 38px;
         padding: 5px;
      }
   </style>
   <!-- /Header -->
   <!-- Sidebar -->
   <?php
   include('side_bar.php');
   ?>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
   <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
   <script>
      $(".chosen-select").chosen({
         no_results_text: "Oops, nothing found!"
      })
   </script>
   <style>
      .error-border {
         border: 2px solid red !important;
      }
   </style>
   <script>
      $(document).ready(function () {
         $('input[name="patientEnrolled"], input[name="ciplaBrandPrescribed"],input[name="prescription_available"] ').change(function () {
            updateFormFields();
         });
         updateFormFields();
         $('#hcp_name').on('change', function () {
            var doctorId = $(this).val();
            if (doctorId !== '') {
               // checkactivecamp();
               $.ajax({
                  url: '/Educator/getHCLDetails',  // backend PHP file
                  type: 'POST',
                  data: { doctor_id: doctorId },
                  dataType: 'json',
                  success: function (response) {
                     if (response.status === 'success') {
                        var city = response.city;
                        var speciality = response.speciality;
                        var state = response.state;
                        var state_id = response.state_id;
                        $('#msl_code').val(response.msl_code);
                        $('#city').html('<option value="' + city + '">' + city + '</option>');
                        $('#state').html('<option value="' + state_id + '">' + state + '</option>');
                        $('#speciality').html('<option value="' + speciality + '">' + speciality + '</option>');
                     } else {
                        $('#msl_code').val('');
                        alert('MSL Code not found');
                     }
                  },
                  error: function () {
                     alert('Something went wrong while fetching MSL Code');
                  }
               });
            } else {
               $('#msl_code').val('');
            }
         });
      });

      function updateFormFields() {
         var patientEnrolled = $('input[name="patientEnrolled"]:checked').val();
         var ciplaBrandPrescribed = $('input[name="ciplaBrandPrescribed"]:checked').val();
         var prescription_available = $('input[name="prescription_available"]:checked').val();
         // Condition 1: Both Yes - show everything
         if (patientEnrolled === 'Yes' && ciplaBrandPrescribed === 'Yes' && prescription_available === 'Yes') {
            // console.log('hii');
            $("#consentFormDiv").show();
            $("#prescriptionDiv").show();
            $("#patientKitDiv").hide();
            $("#ciplaBrandPrescribedDiv").show();
            $("#optionaldiv").show();
            $("#medicinediv").show();

            // Make required fields required
            $("#fileToUpload").prop('required', true);
            $("#consentForm").prop('required', false);
            $("input[name='patient_kit_enrolled']").prop('required', false);
         }
         else if (patientEnrolled === 'Yes' && ciplaBrandPrescribed === 'Yes' && prescription_available === 'No') {
            // console.log('gjvn');
            $("#consentFormDiv").hide();
            $("#prescriptionDiv").hide();
            $("#ciplaBrandPrescribedDiv").hide();
            // console.log($("#ciplaBrandPrescribedDiv").hide(););
            $("#optionaldiv").hide();
            $("#fileToUpload").prop('required', false);
            $("#consentForm").prop('required', false);
         }
         // Condition 2: Patient No, Cipla Yes - remove consent, add kit enrolled
         else if (patientEnrolled === 'No' && ciplaBrandPrescribed === 'Yes' && prescription_available === 'No') {
            $("#consentFormDiv").hide();
            $("#prescriptionDiv").show();
            $("#patientKitDiv").show();
            $("#ciplaBrandPrescribedDiv").hide();
            $("#optionaldiv").hide();
            $("#medicinediv").show();

            // Make fields required/not required
            $("#fileToUpload").prop('required', false);
            $("#consentForm").prop('required', false);
            $("input[name='patient_kit_enrolled']").prop('required', true);
         }
         else if (patientEnrolled === 'No' && ciplaBrandPrescribed === 'Yes' && prescription_available === 'Yes') {
            $("#consentFormDiv").hide();
            $("#prescriptionDiv").show();
            $("#patientKitDiv").show();
            $("#ciplaBrandPrescribedDiv").show();
            $("#optionaldiv").show();
            $("#medicinediv").show();

            // Make fields required/not required
            $("#fileToUpload").prop('required', false);
            $("#consentForm").prop('required', false);
            $("input[name='patient_kit_enrolled']").prop('required', true);
         }
         // Condition 3: Both No - remove both uploads
         else if (patientEnrolled === 'No' && ciplaBrandPrescribed === 'No' && prescription_available === 'No') {
            $("#consentFormDiv").hide();
            $("#prescriptionDiv").hide();
            $("#patientKitDiv").hide();
            //   $("#ciplaBrandPrescribedDiv").hide();
            $("#medicinediv").hide();
            $("#medicine").removeAttr('required');
            $("#optionaldiv").show();
            $('#prescribeddatashow').hide();

            // Make fields not required
            $("#fileToUpload").prop('required', false);
            $("#consentForm").prop('required', false);
            $("input[name='patient_kit_enrolled']").prop('required', false);
         }
      }

   </script>

   <style>
      .mandatory {
         color: red;
         font-size: 16px;
         font-weight: 500;
         margin-left: 2px;
      }
   </style>

   <!-- /Sidebar -->
   <!-- Page Wrapper -->
   <div class="page-wrapper" style="min-height: 653px;">
      <div class="content container-fluid">
         <!-- Page Header -->
         <?php include('breadcum.php'); ?>
         <!-- /Page Header -->
         <?php
         include('alerts.php');
         ?>

         <?php
         $educatorId = $this->session->userdata('educator_id');
         $getStartCampDetailsByeducatord = getStartCampDetailsByeducatord($educatorId);
         ///pr($getStartCampDetailsByeducatord);
         //die();
         
         $campData = $getStartCampDetailsByeducatord['campData'];
         $campId = $campData->id;
         $campNameId = 'Camp ' . $campData->camp_id;
         ?>

         <form action="Patient-Inquiry-Post" name="createPatientInquiry" id="createPatientInquiry" method="post"
            enctype="multipart/form-data">
            <input type="hidden" name='campId' id='campId' value='<?php echo $campId ?>'>

            <div class="card mb-4">
               <div class="card-header thembutton text-white">
                  <h5 class="mb-0">HCP Details</h5>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-6 col-lg-6">
                        <div class="mb-3 row">
                           <label class="col-form-label col-md-4" for="hcp_name">HCP Name <span
                                 class='mandatory'>*</span></label>
                           <div class="col-md-8">
                              <select class="form-select form-control" name="hcp_name" id="hcp_name" required>
                                 <option selected="selected" value="">-- Select --</option>
                                 <?php
                                 $educatorId = $this->session->userdata('educator_id');
                                 $query = "SELECT * FROM `doctors_new` WHERE `educator_id` ='" . $educatorId . "' And `name`!='' ORDER BY `name`";
                                 $educatorDoctor = $this->master_model->customQueryArray($query);
                                 if ($educatorDoctor) {
                                    foreach ($educatorDoctor as $jey => $doctorItem) {
                                       $doctorID = $doctorItem['id'];
                                       $doctorName = $doctorItem['name'];
                                       ?>
                                       <option value="<?php echo ($doctorID); ?>">
                                          <?php echo htmlspecialchars($doctorName); ?>
                                       </option>
                                    <?php }
                                 } else { ?>
                                    <option selected="selected" value="1">Tr Raghu</option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6">
                        <div class="mb-3 row">
                           <label class="col-form-label col-md-4" for="msl_code">MSL Code<span
                                 class='mandatory'>*</span></label>
                           <div class="col-md-8">
                              <input type="text" maxlength="50" class="form-control" name="msl_code" id="msl_code"
                                 value="" required>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6 col-lg-6">
                        <div class="mb-3 row">
                           <label class="col-form-label col-md-4" for="city">State <span
                                 class='mandatory'>*</span></label>
                           <div class="col-md-8">
                              <select class="form-select form-control" name="state" id="state" required>
                                 <option selected="selected" value="">-- Select --</option>
                                 <?php
                                 $getAllState = getAllState();
                                 $allState = $getAllState['allState'];
                                 foreach ($allState as $stateKey => $Item) {
                                    $stateName = $Item['state'];
                                    $stateCode = $Item['id'];
                                    ?>
                                    <option value="<?php echo ($stateCode); ?>">
                                       <?php echo htmlspecialchars($stateName); ?>
                                    </option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6">
                        <div class="mb-3 row">
                           <label class="col-form-label col-md-4" for="city">City<span
                                 class='mandatory'>*</span></label>
                           <div class="col-md-8">
                              <select class="form-select form-control" name="city" id="city" required>
                                 <option selected="selected" value="">-- Select --</option>
                                 <?php
                                 /* $getAllCity = getAllCity();
                                 $getAllCity = $getAllCity['allCities'];
                                 foreach($getAllCity as $cityKey => $cityItem){
                                    $cityName = $cityItem['city_name'];
                                 ?>	
                              <option value="<?php echo htmlspecialchars($cityName); ?>">
                                 <?php echo htmlspecialchars($cityName); ?>
                              </option>
                              <?php } */ ?>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6 col-lg-6">
                        <div class="mb-3 row">
                           <label class="col-form-label col-md-4" for="speciality">Speciality<span
                                 class='mandatory'>*</span></label>
                           <div class="col-md-8">
                              <select class="form-select form-control" name="speciality" id="speciality" required>
                                 <option value="">-- Select --</option>
                                 <option value="Obesity">Obesity</option>
                                 <option value="Heart">Heart</option>
                              </select>
                           </div>
                        </div>
                     </div>



                  </div>
               </div>
               <div class="card mb-4">
                  <div class="card-header thembutton text-white">
                     <h5 class="mb-0">Patient Details </h5>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-6 col-lg-6">
                           <div class="mb-3 row">
                              <label class="col-form-label col-md-4" for="patient_name">Patient Name<span
                                    class='mandatory'>*</span></label>
                              <div class="col-md-8">
                                 <input type="text" maxlength="50" class="form-control" name="patient_name"
                                    id="patient_name" value="" required>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                           <div class="mb-3 row">
                              <label class="col-form-label col-md-4" for="age">Age<span
                                    class='mandatory'>*</span></label>
                              <div class="col-md-8">
                                 <select class="form-select form-control" name="age" id="age" required>
                                    <option value="">-- Select --</option>
                                    <?php for ($g = 1; $g <= 100; $g++) { ?>
                                       <option value="<?php echo $g; ?>"><?php echo $g; ?></option>
                                    <?php } ?>
                                    <option value="100+">100+</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6 col-lg-6">
                           <div class="mb-3 row">
                              <label class="col-form-label col-md-4" for="mobile_number">Mobile Number<span
                                    class='mandatory'>*</span></label>
                              <div class="col-md-8">
                                 <input type="text" maxlength="10" class="form-control" name="mobile_number"
                                    id="mobile_number" value="" required inputmode="numeric">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                           <div class="mb-3 row">
                              <label class="col-form-label col-md-4" for="gender">Gender<span
                                    class='mandatory'>*</span></label>
                              <div class="col-md-8">
                                 <select class="form-select form-control" name="gender" id="gender" required>
                                    <option value="">-- Select --</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4 col-lg-6">
                           <div class="mb-3 row">
                              <label class="col-form-label col-md-4" for="gender">Cipla Brand Prescribed<span
                                    class='mandatory'>*</span></label>
                              <div class="col-md-6">
                                 <span class="radio">
                                    <label><input type="radio" name="ciplaBrandPrescribed" id="ciplaBrandPrescribed"
                                          value="Yes"> Yes</label>
                                 </span>
                                 <span class="radio">
                                    <label><input type="radio" name="ciplaBrandPrescribed" id="ciplaBrandPrescribed"
                                          value="No"> No</label>
                                 </span>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-6" id="prescriptionDiv">
                           <div class="mb-3 row">
                              <label class="col-form-label col-md-4" for="mobile_number">Upload Prescription<span
                                    class='mandatory'>*</span></label>
                              <div class="col-md-8">
                                 <input type="file" accept="image/*" name="fileToUpload[]" id="fileToUpload"
                                    style="width:100%;" required="" multiple>
                                 <div id="prescriptionPreview" style="margin-top: 10px; display: none;"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4 col-lg-6">
                           <div class="mb-3 row">
                              <label class="col-form-label col-md-4" for="gender">Prescription Available<span
                                    class='mandatory'>*</span></label>
                              <div class="col-md-6">
                                 <span class="radio">
                                    <label><input type="radio" name="prescription_available" id="prescription_available"
                                          value="Yes"> Yes</label>
                                 </span>
                                 <span class="radio">
                                    <label><input type="radio" name="prescription_available" id="prescription_available"
                                          value="No"> No</label>
                                 </span>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4 col-lg-6" id="prescribeddatashow" style="display:none;">
                           <div class="mb-3 row">
                              <label class="col-form-label col-md-4" for="prescribeddatashow">Cipla Brand
                                 Prescribed</label>
                              <div class="col-md-6">
                                 <select class="form-select form-control" name="prescribedselect" id="prescribedselect">
                                    <option value="">Select an Option</option>
                                    <option value="Purchase Bill Available">Purchase Bill Available</option>
                                    <option value="Observed Only Cipla Brand">Observed Only Cipla Brand</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-6" id="followupdiv">
                           <div class="mb-3 row">
                              <label class="col-form-label col-md-4" for="followupdiv">Upload Purchase Bill </label>
                              <div class="col-md-6">
                                 <input type="file" accept="image/*" name="purchasebill" id="purchasebill"
                                    style="width:100%;" multiple="multiple">
                                 <div id="purchasebillPreview" style="margin-top: 10px; display: none;"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6 col-lg-6">
                           <div class="mb-3 row">
                              <label class="col-form-label col-md-4" for="speciality">Patient Enrolled<span
                                    class='mandatory'>*</span></label>
                              <div class="col-md-8">
                                 <span class="radio">
                                    <label><input type="radio" name="patientEnrolled" value="Yes"> Yes</label>
                                 </span>
                                 <span class="radio">
                                    <label><input type="radio" name="patientEnrolled" value="No"> No</label>
                                 </span>
                              </div>
                           </div>
                        </div>

                        <div class="row" id="patientKitDiv" style="display:none;">
                           <div class="col-md-6 col-lg-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-4" for="patient_kit_enrolled">Kit Enrolled<span
                                       class='mandatory'>*</span></label>
                                 <div class="col-md-8">
                                    <span class="radio">
                                       <label><input type="radio" name="patient_kit_enrolled" value="Yes"> Yes</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="patient_kit_enrolled" value="No"> No</label>
                                    </span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-6" id="medicinediv">
                           <div class="mb-3 row">
                              <label class="col-form-label col-md-4" for="medicine">Medicine<span
                                    class='mandatory'>*</span></label>
                              <div class="col-md-8">
                                 <select class="form-control select2" name="medicine[]" id="medicine"
                                    multiple="multiple" required style="width: 100%;">
                                    <option value="">-- Select Medicine --</option>
                                    <?php
                                    $medicines = medicines();
                                    foreach ($medicines as $meds): ?>
                                       <option value="<?= $meds['name'] ?>"><?= htmlspecialchars($meds['name']) ?></option>
                                    <?php endforeach; ?>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6 col-lg-6" id="consentFormDiv">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-4" for="mobile_number">Upload Consent Form<span
                                       class='mandatory'>*</span></label>
                                 <div class="col-md-8">
                                    <input type="file" accept="image/*" name="consentForm" id="consentForm"
                                       style="width:100%;" required="" multiple="multiple">
                                    <div id="consentPreview" style="margin-top: 10px; display: none;"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-4" for="Compititor">Competitor<span
                                       class='mandatory'>*</span></label>
                                 <div class="col-md-8">
                                    <select class="form-control select2" name="Compititor[]" id="Compititor"
                                       multiple="multiple" required style="width: 100%;">
                                       <option value="">-- Select Competitor --</option>
                                       <option value="N/A">N/A</option>
                                       <?php
                                       $Compititors = Compititors();
                                       foreach ($Compititors as $med): ?>
                                          <option value="<?= $med['name'] ?>"><?= htmlspecialchars($med['name']) ?>
                                          </option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
               <!-- <div class="row"> 
                  <div class='h25'></div>
                  </div>
                  
                  
                  <div class="row">
                  <div class="col-12">
                  <div style="text-align: right;">
                  <button type="button" name="submit" id="submit" class="btn btn-primary thembutton thembutton">Next</button>
                  </div>                                    
                  </div>
                  </div> -->
               <div class="row">
                  <div class='h25'></div>
               </div>
               <!-- Cardio Start -->
               <div id='ciplaBrandPrescribedDiv'>
                  <div class="card mb-4">
                     <div class="card-header thembutton text-white">
                        <h5 class="mb-0">Cardio</h5>
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-4 col-lg-4">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-6" for="date_of_discharge">Date of
                                    Discharge</label>
                                 <div class="col-md-6">
                                    <input type="text" maxlength="10" class="form-control datepicker"
                                       name="date_of_discharge" id="date_of_discharge"
                                       value="<?php echo date('Y-m-d') ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4 col-lg-4">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-5" for="blood_pressure">Blood Pressure<span
                                       class='mandatory'>*</span></label>
                                 <div class="col-md-7">
                                    <input type="text" placeholder="Systolic /Diastolic (mm Hg)" maxlength="10"
                                       class="form-control" name="blood_pressure" id="blood_pressure" value="">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4 col-lg-4">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3" for="urea">Urea</label>
                                 <div class="col-md-9">
                                    <input type="text" placeholder="(mg/dL)" maxlength="10" class="form-control"
                                       name="urea" id="urea" value="">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6 col-lg-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3" for="lv_ef">LV EF</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(%)" maxlength="10" class="form-control"
                                       name="lv_ef" id="lv_ef">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3" for="heart_rate">Heart Rate<span
                                       class='mandatory'>*</span></label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="bpm" maxlength="10" class="form-control"
                                       name="heart_rate" id="heart_rate">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- 2 -->
                        <div class="row">
                           <div class='col-md-6 col-lg-6'>
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">NT Pro BNP</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(pg/mL)" maxlength="50" class="form-control"
                                       name="nt_pro_bnp" id="nt_pro_bnp">
                                 </div>
                              </div>
                           </div>
                           <div class='col-md-6 col-lg-6'>
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">EGFR</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(mL/min/1.73m2)" maxlength="10" class="form-control"
                                       name="egfr" id="egfr">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class='col-md-6 col-lg-6'>
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">Potassium<span
                                       class='mandatory'>*</span></label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(mmol/L)" maxlength="50" class="form-control"
                                       name="potassium" id="potassium">
                                 </div>
                              </div>
                           </div>
                           <div class='col-md-6 col-lg-6'>
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">Sodium<span class='mandatory'>*</span></label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(mmol/L)" maxlength="10" class="form-control"
                                       name="sodium" id="sodium">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class='col-md-6 col-lg-6'>
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">Uric Acid</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(mg/dL)" maxlength="50" class="form-control"
                                       name="uric_acid" id="uric_acid">
                                 </div>
                              </div>
                           </div>
                           <div class='col-md-6 col-lg-6'>
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">Creatinine</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(mg/dL)" maxlength="10" class="form-control"
                                       name="creatinine" id="creatinine">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4 col-lg-4">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">CRP</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(mg/L)" maxlength="10" class="form-control"
                                       name="crp" id="crp">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4 col-lg-4">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">UACR</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(mg/g)" maxlength="10" class="form-control"
                                       name="uacr" id="uacr">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4 col-lg-4">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">Iron</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(mcg/dL)" maxlength="10" class="form-control"
                                       name="iron" id="iron">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4 col-lg-4">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">HB</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(g/dL)" maxlength="10" class="form-control"
                                       name="hb" id="hb">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4 col-lg-4">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">LDL</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(mg/dL)" maxlength="10" class="form-control"
                                       name="ldl" id="ldl">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4 col-lg-4">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">HDL</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(mg/dL)" maxlength="10" class="form-control"
                                       name="hdl" id="hdl">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6 col-lg-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">Triglycerides<span
                                       class='mandatory'>*</span></label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(mg/dL)" maxlength="10" class="form-control"
                                       name="triglycerid" id="triglycerid" value="">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-4">Total Cholesterol<span
                                       class='mandatory'>*</span></label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(mg/dL)" maxlength="10" class="form-control"
                                       name="total_cholesterol" id="total_cholesterol" value="">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">HBA1c<span class='mandatory'>*</span></label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(%)" maxlength="10" class="form-control"
                                       name="hba1c" id="hba1c" value="">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">SGOT</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(U/L)" maxlength="10" class="form-control"
                                       name="sgot" id="sgot" value="">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">SGPT</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(U/L)" maxlength="10" class="form-control"
                                       name="sgpt" id="sgpt" value="">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">VIT D</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(ng/mL)" maxlength="10" class="form-control"
                                       name="vit_d" id="vit_d" value="">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">T3</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(ng/mL)" maxlength="10" class="form-control"
                                       name="t3" id="t3" value="">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">T4</label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="(ng/mL)" maxlength="10" class="form-control"
                                       name="t4" id="t4" value="">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           
                           <div class="col-md-6 col-lg-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3" for="hypertension_angina_ckd">Hypertension,
                                    Angina, CKD<span class='mandatory'>*</span></label>
                                 <div class="col-md-8">
                                    <select class="form-select form-control" name="hypertension_angina_ckd"
                                       id="hypertension_angina_ckd">
                                       <option value="">-- Select--</option>
                                       <option value="Vericiguat">Vericiguat</option>
                                       <option value="CCBs">CCBs</option>
                                       <option value="Diuretics">Diuretics</option>
                                       <option value="Nitrates">Nitrates</option>
                                       <option value="Trimetazidine">Trimetazidine</option>
                                       <option value="Other">Other</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12 col-lg-12">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3" for="anti_diabetic_therapy">Anti Diabetic
                                    Therapy (Optional)</label>
                                 <div class="col-md-8">
                                    <input type="text" class="form-control" name="anti_diabetic_therapy"
                                       id="anti_diabetic_therapy">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="h25"></div>
                  </div>
                  <div class="card mb-4">
                     <div class="card-header thembutton text-white">
                        <h5 class="mb-0">Medication</h5>
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <!-- ARNI Section -->
                           <div class="col-md-4 col-lg-4">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">ARNI</label>
                                 <div class="col-md-8">
                                    <select class="form-select form-control" name="arni" id="arni"
                                       onchange="toggleArniRemark();">
                                       <option value="">-- Select--</option>
                                       <option value="sacubitrilOrvalsartan">Sacubitril/Valsartan</option>
                                       <option value="remark">Remark</option>
                                    </select>
                                    <div id='arni_remark_div' style='display:none;'>
                                       <input type="text" maxlength="50" placeholder="ARNI Remark"
                                          class="form-control mt-2" name="arni_remark" id="arni_remark">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- B Blockers Section -->
                           <div class="col-md-4 col-lg-4">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-4">B Blockers</label>
                                 <div class="col-md-8">
                                    <select class="form-select form-control" name="b_blockers" id="b_blockers"
                                       onchange='toggleBlockersRemark()'>
                                       <option value="">-- Select--</option>
                                       <option value="metoprolol">Metoprolol</option>
                                       <option value="bisoprolol">Bisoprolol</option>
                                       <option value="remark">Remark</option>
                                    </select>
                                    <div id='blockers_remark_div' style='display:none;'>
                                       <input type="text" maxlength="50" placeholder="B Blockers Remark"
                                          class="form-control mt-2" name="b_blockers_remark" id="b_blockers_remark">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- MRA Section -->
                           <div class="col-md-4 col-lg-4">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">MRA</label>
                                 <div class="col-md-8">
                                    <select class="form-select form-control" name="mra" id="mra"
                                       onchange='toggleMraRemark()'>
                                       <option value="">-- Select--</option>
                                       <option value="torsemideAndeplerenone">Torsemide + Eplerenone</option>
                                       <option value="torsemideAndspironolactone">Torsemide + Spironolactone</option>
                                       <option value="eplerenone">Eplerenone</option>
                                       <option value="remark">Remark</option>
                                    </select>
                                    <div id='mra_remark_div' style='display:none;'>
                                       <input type="text" maxlength="50" placeholder="MRA Remark"
                                          class="form-control mt-2" name="mra_remark" id="mra_remark">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3" for="sglt2_inhibitors">SGLT2 Inhibitors</label>
                                 <div class="col-md-8">
                                    <select class="form-select form-control" name="sglt2_inhibitors"
                                       id="sglt2_inhibitors">
                                       <option value="">-- Select--</option>
                                       <option value="Empagliflozin">Empagliflozin</option>
                                       <option value="Dapagliflozin">Dapagliflozin</option>
                                       <option value="Other">Other</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        <!-- 3 -->
                        <!-- 4 -->
                        <div class="row">
                           <!-- Vaccination -->
                           <div class="col-md-12 col-lg-12">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">Vaccination</label>
                                 <div class="col-md-8">
                                    <span class="radio">
                                       <label><input type="radio" name="vaccination" value="Yes"> Yes</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="vaccination" value="No"> No</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="vaccination" value="na" checked="checked">
                                          N/A</label>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <!-- Influenza -->
                           <div class="col-md-12 col-lg-12">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">Influenza</label>
                                 <div class="col-md-8">
                                    <span class="radio">
                                       <label><input type="radio" name="influenza" value="Yes"> Yes</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="influenza" value="No"> No</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="influenza" value="na" checked="checked">
                                          N/A</label>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <!-- Pneumococcal -->
                           <div class="col-md-12 col-lg-12">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">Pneumococcal</label>
                                 <div class="col-md-8">
                                    <span class="radio">
                                       <label><input type="radio" name="pneumococcal" value="Yes"> Yes</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="pneumococcal" value="No"> No</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="pneumococcal" value="na" checked="checked">
                                          N/A</label>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <!-- Suitable for Cardiac Rehab -->
                           <div class="col-md-12 col-lg-12">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">Suitable for cardiac rehab</label>
                                 <div class="col-md-8">
                                    <span class="radio">
                                       <label><input type="radio" name="cardiac_rehab" value="Yes"> Yes</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="cardiac_rehab" value="No"> No</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="cardiac_rehab" value="na" checked="checked">
                                          N/A</label>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <!-- Use of NSAIDs -->
                           <div class="col-md-12 col-lg-12">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">Use of NSAIDs (elderly)</label>
                                 <div class="col-md-8">
                                    <span class="radio">
                                       <label><input type="radio" name="nsaids_use" value="Yes"> Yes</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="nsaids_use" value="No"> No</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="nsaids_use" value="na" checked="checked">
                                          N/A</label>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <!-- Patient Kit Given -->
                           <div class="col-md-12 col-lg-12">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">Patient kit given</label>
                                 <div class="col-md-8">
                                    <span class="radio">
                                       <label><input type="radio" name="patient_kit_given" value="Yes"> Yes</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="patient_kit_given" value="No"> No</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="patient_kit_given" value="na" checked="checked">
                                          N/A</label>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <!-- Any Remark -->
                           <div class="col-md-12 col-lg-12">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">Any remark</label>
                                 <div class="col-md-8">
                                    <input type="text" maxlength="100" class="form-control" name="remark" id="remark"
                                       placeholder="Enter any remark">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class='h25'></div>
                        </div>
                        <!-- <div class="row">
                        <div class="col-12">
                        <div style="text-align: right;">
                        <button type="button" name="submit" id="submit" class="btn btn-primary thembutton">Next</button>
                        </div>                                    
                        </div>
                        </div>
                        
                        <div class="row"> 
                        <div class='h25'></div>
                        </div> -->
                        <!-- 4 -->
                        <!-- 5 -->
                     </div>
                  </div>
               </div>
               <div class="card mb-4">

                  <div class="card-body" id="optionaldiv">
                     <div>
                        <div class="row">
                           <div class="col-md-3 col-lg-3">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-4">Weight <span class='mandatory'>*</span></label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="Weight In Kg" class="form-control" name="weight"
                                       id="weight" maxlength="10" onkeydown="calculateBMI()">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-3 col-lg-3">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-4">Height <span class='mandatory'>*</span></label>
                                 <div class="col-md-8">
                                    <input type="text" placeholder="Height In Cm" class="form-control" name="height"
                                       id="height" maxlength="10" onkeydown="calculateBMI()">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-5">Waist Circumference:</label>
                                 <div class="col-md-7">
                                    <input type="text" placeholder="Waist circumference In Cm" maxlength="10"
                                       class="form-control" onkeydown="calculateWH()" name="waist_circumference_remark"
                                       id="waist_circumference_remark">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6 col-lg-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">BMI <span class='mandatory'>*</span> </label>
                                 <div class="col-md-8">
                                    <input type="text" maxlength="10" class="form-control" name="bmi" id="bmi"
                                       placeholder="BMI In kg/m2">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-3">W-HtR</label>
                                 <div class="col-md-8">
                                    <input type="text" maxlength="10" class="form-control" name="waist_to_height_ratio"
                                       id="waist_to_height_ratio">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class='h25'></div>
                        </div>
                        <div class="row">
                           <div class="col-md-5 col-lg-5" style="background-color: #f3f3f3;">
                              <div class='row'>
                                 <div class="h25"></div>
                              </div>
                              <div class="row">
                                 <div class="col-12">
                                    <div class='subheading'>Past History </div>
                                 </div>
                              </div>
                              <div class='row'>
                                 <div class="h25"></div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12 col-lg-12">
                                    <div class="mb-3 row">
                                       <label class="col-form-label col-md-6">Type 2 DM<span
                                             class='mandatory'>*</span></label>
                                       <div class="col-md-5">
                                          <span class="radio">
                                             <label><input type="radio" name="type_2_dm" value="Yes"> Yes</label>
                                          </span>
                                          <span class="radio">
                                             <label><input type="radio" name="type_2_dm" value="No"> No</label>
                                          </span>
                                          <!-- <div class="checkbox">
                                             <label>
                                                <input type="checkbox" name="type_2_dm" value="Yes"> Yes
                                             </label>
                                             </div> -->
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 col-lg-12">
                                    <div class="mb-3 row">
                                       <label class="col-form-label col-md-6">Hypertension<span
                                             class='mandatory'>*</span></label>
                                       <div class="col-md-5">
                                          <span class="radio">
                                             <label><input type="radio" name="hypertension" value="Yes"> Yes</label>
                                          </span>
                                          <span class="radio">
                                             <label><input type="radio" name="hypertension" value="No"> No</label>
                                          </span>
                                          <!-- <div class="checkbox">
                                             <label>
                                                <input type="checkbox" name="hypertension" value="Yes"> Yes
                                             </label>
                                             </div> -->
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 col-lg-12">
                                    <div class="mb-3 row">
                                       <label class="col-form-label col-md-6">Dyslipidemia<span
                                             class='mandatory'>*</span></label>
                                       <div class="col-md-5">
                                          <span class="radio">
                                             <label><input type="radio" name="dyslipidemia" value="Yes"> Yes</label>
                                          </span>
                                          <span class="radio">
                                             <label><input type="radio" name="dyslipidemia" value="No"> No</label>
                                          </span>
                                          <!-- <div class="checkbox">
                                             <label>
                                                <input type="checkbox" name="dyslipidemia" value="Yes"> Yes
                                             </label>
                                             </div> -->
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 col-lg-12">
                                    <div class="mb-3 row">
                                       <label class="col-form-label col-md-6">PCO<span
                                             class='mandatory'>*</span></label>
                                       <div class="col-md-5">
                                          <span class="radio">
                                             <label><input type="radio" name="pco" value="Yes"> Yes</label>
                                          </span>
                                          <span class="radio">
                                             <label><input type="radio" name="pco" value="No"> No</label>
                                          </span>
                                          <!-- <div class="checkbox">
                                             <label>
                                                <input type="checkbox" name="pco" value="Yes"> Yes
                                             </label>
                                             </div> -->
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 col-lg-12">
                                    <div class="mb-3 row">
                                       <label class="col-form-label col-md-6">Knee pain (Osteoarthritis)<span
                                             class='mandatory'>*</span></label>
                                       <div class="col-md-5">
                                          <span class="radio">
                                             <label><input type="radio" name="knee_pain" value="Yes"> Yes</label>
                                          </span>
                                          <span class="radio">
                                             <label><input type="radio" name="knee_pain" value="No"> No</label>
                                          </span>
                                          <!-- <div class="checkbox">
                                             <label>
                                                <input type="checkbox" name="knee_pain" value="Yes"> Yes
                                             </label>
                                             </div> -->
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 col-lg-12">
                                    <div class="mb-3 row">
                                       <label class="col-form-label col-md-6">Asthma<span
                                             class='mandatory'>*</span></label>
                                       <div class="col-md-5">
                                          <span class="radio">
                                             <label><input type="radio" name="asthma" value="Yes"> Yes</label>
                                          </span>
                                          <span class="radio">
                                             <label><input type="radio" name="asthma" value="No"> No</label>
                                          </span>
                                          <!-- <div class="checkbox">
                                             <label>
                                                <input type="checkbox" name="asthma" value="Yes"> Yes
                                             </label>
                                             </div> -->
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-1 col-lg-1">
                           </div>
                           <div class="col-md-5 col-lg-5" style="background-color: #f3f3f3;">
                              <div class='row'>
                                 <div class="h25"></div>
                              </div>
                              <div class="row">
                                 <div class="col-12">
                                    <div class='subheading'>Daily activity limitation</div>
                                 </div>
                              </div>
                              <div class='row'>
                                 <div class="h25"></div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12 col-lg-12">
                                    <div class="mb-3 row">
                                       <label class="col-form-label col-md-6">Bathing<span
                                             class='mandatory'>*</span></label>
                                       <div class="col-md-5">
                                          <span class="radio">
                                             <label><input type="radio" name="adl_bathing" value="Yes"> Yes</label>
                                          </span>
                                          <span class="radio">
                                             <label><input type="radio" name="adl_bathing" value="No"> No</label>
                                          </span>
                                          <!-- <div class="checkbox">
                                             <label>
                                                <input type="checkbox" name="adl_bathing" value="Yes"> Yes
                                             </label>
                                             </div> -->
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 col-lg-12">
                                    <div class="mb-3 row">
                                       <label class="col-form-label col-md-6">Dressing<span
                                             class='mandatory'>*</span></label>
                                       <div class="col-md-5">
                                          <span class="radio">
                                             <label><input type="radio" name="adl_dressing" value="Yes"> Yes</label>
                                          </span>
                                          <span class="radio">
                                             <label><input type="radio" name="adl_dressing" value="No"> No</label>
                                          </span>
                                          <!-- <div class="checkbox">
                                             <label>
                                                <input type="checkbox" name="adl_dressing" value="Yes"> Yes
                                             </label>
                                             </div> -->
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 col-lg-12">
                                    <div class="mb-3 row">
                                       <label class="col-form-label col-md-6">Walking<span
                                             class='mandatory'>*</span></label>
                                       <div class="col-md-5">
                                          <span class="radio">
                                             <label><input type="radio" name="adl_walking" value="Yes"> Yes</label>
                                          </span>
                                          <span class="radio">
                                             <label><input type="radio" name="adl_walking" value="No"> No</label>
                                          </span>
                                          <!-- <div class="checkbox">
                                             <label>
                                                <input type="checkbox" name="adl_walking" value="Yes"> Yes
                                             </label>
                                             </div> -->
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 col-lg-12">
                                    <div class="mb-3 row">
                                       <label class="col-form-label col-md-6">Toileting<span
                                             class='mandatory'>*</span></label>
                                       <div class="col-md-5">
                                          <span class="radio">
                                             <label><input type="radio" name="adl_toileting" value="Yes"> Yes</label>
                                          </span>
                                          <span class="radio">
                                             <label><input type="radio" name="adl_toileting" value="No"> No</label>
                                          </span>
                                          <!-- <div class="checkbox">
                                             <label>
                                                <input type="checkbox" name="adl_toileting" value="Yes"> Yes
                                             </label>
                                             </div> -->
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class='row'>
                           <div class="h25"></div>
                        </div>
                        <!-- 5 -->
                        <!-- 6 -->
                        <div class="row">
                           <!-- Exercise -->
                           <div class="col-md-6 col-lg-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-5">Exercise (30mins/day):</label>
                                 <div class="col-md-5">
                                    <span class="radio">
                                       <label><input type="radio" name="exercise_30mins" value="YES"> YES</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="exercise_30mins" value="No"> No</label>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <!-- Having Breakfast -->
                           <div class="col-md-6 col-lg-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-5">Having Breakfast/week:</label>
                                 <div class="col-md-5">
                                    <span class="radio">
                                       <label><input type="radio" name="breakfast_days" value="≤4 days"> ≤4 days</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="breakfast_days" value=">4 days"> >4 days</label>
                                    </span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <!-- Food habits -->
                           <div class="col-md-6 col-lg-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-5">Food habits:</label>
                                 <div class="col-md-7">
                                    <span class="radio">
                                       <label><input type="radio" name="food_habits" value="Vegetarian">
                                          Vegetarian</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="food_habits" value="Non-vegetarian">
                                          Non-vegetarian</label>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <!-- Sedentary Hours -->
                           <div class="col-md-6 col-lg-6">
                              <div class="mb-3 row">
                                 <label class="col-form-label col-md-5">Sedentary hours/day:</label>
                                 <div class="col-md-5">
                                    <span class="radio">
                                       <label><input type="radio" name="sedentary_hours" value="≤8 hours"> ≤8
                                          hours</label>
                                    </span>
                                    <span class="radio">
                                       <label><input type="radio" name="sedentary_hours" value=">8 hours"> >8
                                          hours</label>
                                    </span>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
               <div class="card-body mb-4">
                  <div class="mb-3 row">
                     <!-- <label class="col-form-label col-md-2"> </label> -->
                     <div class="col-md-12" style="text-align: center;">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary thembutton"
                           onclick="return validateForm();">Submit</button>
                     </div>
                  </div>


         </form>

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
   document.addEventListener("DOMContentLoaded", function () {
      const prescribedSelect = document.getElementById("prescribedselect");
      const followupDiv = document.getElementById("followupdiv");

      // Initially hide the followup div
      followupDiv.style.display = "none";

      prescribedSelect.addEventListener("change", function () {
         if (this.value === "Purchase Bill Available") {
            followupDiv.style.display = "block";
         } else if (this.value === "Observed Only Cipla Brand") {
            followupDiv.style.display = "none";
         }
         else {
            followupDiv.style.display = "none";
         }
      });
   });
   $('input[name="ciplaBrandPrescribed"]:radio').change(function () {
      //alert(this.value);
      var ciplaBrandPrescribedValue = this.value;
      if (ciplaBrandPrescribedValue == "Yes") {
         $("#ciplaBrandPrescribedDiv").css("display", "block");
      } else {
         $("#ciplaBrandPrescribedDiv").css("display", "none");
         $("#prescribeddatashow").css("display", "block");
      }
   });
   $('input[name="prescription_available"]:radio').change(function () {
      //alert(this.value);
      var prescription_available = this.value;
      if (prescription_available == "Yes") {
         $("#ciplaBrandPrescribedDiv").css("display", "block");
         $("#prescribeddatashow").css("display", "none");
         $("#followupdiv").css("display", "none");
      } else {
         $("#ciplaBrandPrescribedDiv").css("display", "none");
         $("#prescribeddatashow").css("display", "block");
         $("#consentFormDiv").css("display", "none");
         $("#optionaldiv").css("display", "none");
         $("#prescriptionDiv").css("display", "none");
      }
   });
   $('input[name="patient_kit_enrolled"]:radio').change(function () {
      //alert(this.value);
      var patient_kit_enrolled = this.value;
      if (patient_kit_enrolled == "Yes") {
         $("#prescriptionDiv").css("display", "block");
      } else {
         $("#prescriptionDiv").css("display", "none");
      }
   });


   function toggleArniRemark() {
      console.log('toggleArniRemark');
      const selectElement = $('#arni option:selected').val();
      const remarkDiv = document.getElementById("arni_remark_div");
      const remarkInput = document.getElementById("arni_remark");

      console.log(selectElement);

      if (selectElement === "remark") {
         remarkDiv.style.display = "block";
      } else {
         remarkDiv.style.display = "none";
         remarkInput.value = ""; // Clear input if hidden
      }
   }

   function toggleBlockersRemark() {
      console.log('toggleBlockersRemark');
      const selectElement = $('#b_blockers option:selected').val();
      const remarkDiv = document.getElementById("blockers_remark_div");
      const remarkInput = document.getElementById("b_blockers_remark");

      console.log(selectElement);

      if (selectElement === "remark") {
         remarkDiv.style.display = "block";
      } else {
         remarkDiv.style.display = "none";
         remarkInput.value = ""; // Clear input if hidden
      }
   }

   function toggleMraRemark() {
      const selectElement = $('#mra option:selected').val();
      const remarkDiv = document.getElementById("mra_remark_div");
      const remarkInput = document.getElementById("mra_remark");

      if (selectElement === "remark") {
         remarkDiv.style.display = "block";
      } else {
         remarkDiv.style.display = "none";
         remarkInput.value = ""; // Clear input if hidden
      }
   }
</script>
<script>
   function isAlphabetOnly(value) {
      return /^[a-zA-Z\s]+$/.test(value);  // Allows only letters and spaces
   }

   function validateAlphabetOnly(value, fieldName) {
      if (!value || value.trim() === '') {
         alert(fieldName + " is required.");
         return false;
      }
      if (!isAlphabetOnly(value)) {
         alert(fieldName + " must contain only alphabetic characters (A-Z or a-z).");
         return false;
      }
      return true;
   }

   function isNumber(value) {
      return /^-?\d+(\.\d+)?$/.test(value);  // Accepts integers and floats
   }

   function isAlphanumeric(value) {
      return /^[a-zA-Z0-9\s]+$/.test(value);  // Letters, numbers, and space
   }

   function validateField(value, fieldName) {
      if (!value || value.trim() === '') {
         alert(fieldName + " is required.");
         return false;
      }
      return true;
   }

   function validateNumberField(value, fieldName) {
      if (!validateField(value, fieldName)) return false;
      if (!isNumber(value)) {
         alert(fieldName + " must be a valid number.");
         return false;
      }
      return true;
   }

   function validateAlphanumeric(value, fieldName) {
      if (!validateField(value, fieldName)) return false;
      if (!isAlphanumeric(value)) {
         alert(fieldName + " must be alphanumeric (letters and numbers only).");
         return false;
      }
      return true;
   }

   function validateFileInput(filePath, fieldName) {
      if (filePath === "") {
         alert("Please upload " + fieldName + ".");
         return false;
      }

      // Allowed file extensions
      const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;

      if (!allowedExtensions.exec(filePath)) {
         alert("Invalid file format for " + fieldName + ". Allowed formats: JPG, JPEG, PNG, PDF.");
         return false;
      }

      return true;
   }

   function validateDateField(dateStr, fieldName) {
      if (dateStr.trim() === "") {
         alert("Please enter " + fieldName + ".");
         return false;
      }

      // Check format: YYYY-MM-DD
      const regex = /^\d{4}-\d{2}-\d{2}$/;
      if (!regex.test(dateStr)) {
         alert("Invalid date format for " + fieldName + ". Use YYYY-MM-DD.");
         return false;
      }

      const date = new Date(dateStr);
      const isValidDate = !isNaN(date.getTime());

      if (!isValidDate) {
         alert("Invalid date entered for " + fieldName + ".");
         return false;
      }

      // Optional: prevent future date
      const today = new Date();
      today.setHours(0, 0, 0, 0); // Ignore time part

      // if (date > today) {
      //     alert(fieldName + " cannot be a future date.");
      //     return false;
      // }

      if (date <= today) {
         alert(fieldName + " cannot be a future date.");
         return false;
      }

      return true;
   }



   function validateForm() {
      var patientEnrolled = $('input[name="patientEnrolled"]:checked').val();
      var ciplaBrandPrescribed = $('input[name="ciplaBrandPrescribed"]:checked').val();
      var prescription_available = $('input[name="prescription_available"]:checked').val();
      // Alphanumeric Validations
      if (!validateAlphanumeric(document.getElementById("hcp_name").value, "HCP Name")) return false;
      if (!validateAlphanumeric(document.getElementById("msl_code").value, "MSL Code")) return false;
      if (!validateAlphanumeric(document.getElementById("state").value, "State ")) return false;
      if (!validateAlphanumeric(document.getElementById("city").value, "City")) return false;
      // if (!validateAlphanumeric(document.getElementById("speciality").value, "Speciality")) return false;
      //if (!validateNumberField(document.getElementById("speciality").value, "Speciality")) return false;

      if (!document.querySelector('input[name="patientEnrolled"]:checked')) {
         alert("Please select an option for Patient Enrolled.");
         return false;
      }


      if (!validateAlphabetOnly(document.getElementById("patient_name").value, "Patient Name")) return false;
      if (!validateNumberField(document.getElementById("age").value, "Age")) return false;
      //   if (!validateNumberField(document.getElementById("mobile_number").value, "Mobile Number")) return false;
      if (!validateAlphanumeric(document.getElementById("gender").value, "Gender")) return false;
      //if (!validateNumberField(document.getElementById("gender").value, "Gender")) return false;

      // File
      // Product

      // if (!validateAlphabetOnly(document.getElementById("Compititor").value, "Compititor")) return false;


      // File
      if (patientEnrolled === 'Yes' && ciplaBrandPrescribed === 'Yes' && prescription_available === 'Yes') {
         if (!validateFileInput(document.getElementById("fileToUpload").value, "Prescription File")) return false;
         if (!validateFileInput(document.getElementById("consentForm").value, "Consent File")) return false;
         // Validate cardio section
         if (!validateCardioSection()) return false;
         if (!validateAlphabetOnly(document.getElementById("medicine").value, "Medicine")) return false;
      }
      if (patientEnrolled === 'Yes' && ciplaBrandPrescribed === 'Yes' && prescription_available === 'No') {
         if (!validateAlphabetOnly(document.getElementById("medicine").value, "Medicine")) return false;
      }
      // Condition 2: Patient No, Cipla Yes - validate prescription only
      else if (patientEnrolled === 'No' && ciplaBrandPrescribed === 'Yes') {
         // if (!validateFileInput(document.getElementById("fileToUpload").value, "Prescription File")) return false;
         if (!document.querySelector('input[name="patient_kit_enrolled"]:checked')) {
            alert("Please select an option for Patient Kit Enrolled.");
            return false;
         }
         // Validate cardio section
         // if (!validateCardioSection()) return false;
         if (!validateAlphabetOnly(document.getElementById("medicine").value, "Medicine")) return false;
      }
      // Condition 3: Both No - no uploads required
      else if (patientEnrolled === 'No' && ciplaBrandPrescribed === 'No') {
         const prescriptionFile = document.getElementById("fileToUpload").files.length;
         const consentFile = document.getElementById("consentForm").files.length;

         if (prescriptionFile > 0 || consentFile > 0) {
            alert("The uploaded file format is not supported. Please upload a valid image file (JPG, PNG, JPEG).");
            return false;
         }
      }

      var ciplaBrandPrescribedStatus = 'No';

      if (!document.querySelector('input[name="ciplaBrandPrescribed"]:checked')) {
         alert("Please select an option for Cipla Brand Prescribed.");
         return false;
      } else {
         var ciplaBrandPrescribedVal = $('input[name="ciplaBrandPrescribed"]:checked').val();
         if (ciplaBrandPrescribedVal == 'Yes') {
            var ciplaBrandPrescribedStatus = 'Yes';
         } else {
            var ciplaBrandPrescribedStatus = 'No';
         }
      }

      console.log('ciplaBrandPrescribedStatus' + ciplaBrandPrescribedStatus);

      // if(ciplaBrandPrescribedStatus=="Yes"){

      //         // Numeric Validations (float/integer allowed)
      // //if (!validateDateField(document.getElementById("date_of_discharge").value, "Date of Discharge")) return false;
      // if (!validateNumberField(document.getElementById("blood_pressure").value, "Blood Pressure")) return false;
      // //if (!validateNumberField(document.getElementById("urea").value, "Urea")) return false;
      // //if (!validateNumberField(document.getElementById("lv_ef").value, "LV EF")) return false;
      // if (!validateNumberField(document.getElementById("heart_rate").value, "Heart Rate")) return false;
      // //if (!validateNumberField(document.getElementById("nt_pro_bnp").value, "NT-proBNP")) return false;
      // //if (!validateNumberField(document.getElementById("egfr").value, "eGFR")) return false;
      // if (!validateNumberField(document.getElementById("potassium").value, "Potassium")) return false;

      // /*if(document.getElementById("sodium").value!=''){
      // if (!validateNumberField(document.getElementById("sodium").value, "Sodium")) return false;
      // }*/

      // if (!validateNumberField(document.getElementById("sodium").value, "Sodium")) return false;


      // /*if (!validateNumberField(document.getElementById("uric_acid").value, "Uric Acid")) return false;
      // if (!validateNumberField(document.getElementById("creatinine").value, "Creatinine")) return false;
      // if (!validateNumberField(document.getElementById("crp").value, "CRP")) return false;
      // if (!validateNumberField(document.getElementById("uacr").value, "UACR")) return false;
      // if (!validateNumberField(document.getElementById("iron").value, "Iron")) return false;*/

      // /*if (!validateNumberField(document.getElementById("hb").value, "HB")) return false;
      // if (!validateNumberField(document.getElementById("ldl").value, "LDL")) return false;
      // if (!validateNumberField(document.getElementById("hdl").value, "HDL")) return false;*/
      // if (!validateNumberField(document.getElementById("triglycerid").value, "Triglycerides")) return false;
      // if (!validateNumberField(document.getElementById("total_cholesterol").value, "Total Cholesterol")) return false;
      // if (!validateNumberField(document.getElementById("hba1c").value, "HbA1c")) return false;
      // /*if (!validateNumberField(document.getElementById("sgot").value, "SGOT")) return false;
      // if (!validateNumberField(document.getElementById("sgpt").value, "SGPT")) return false;
      // if (!validateNumberField(document.getElementById("vit_d").value, "Vitamin D")) return false;
      // if (!validateNumberField(document.getElementById("t3").value, "T3")) return false;
      // if (!validateNumberField(document.getElementById("t4").value, "T4")) return false;*/

      // if (!validateAlphanumeric(document.getElementById("hypertension_angina_ckd").value, "Hypertension Angina Ckd")) return false;


      // /*if(document.getElementById("anti_diabetic_therapy").value!=''){
      // if (!validateAlphanumeric(document.getElementById("anti_diabetic_therapy").value, "Anti Diabetic Therapy")) return false;
      // }*/

      // /*if (!validateAlphabetOnly(document.getElementById("arni").value, "ARNI")) return false;
      // if (!validateAlphabetOnly(document.getElementById("b_blockers").value, "B Blockers")) return false;
      // if (!validateAlphabetOnly(document.getElementById("mra").value, "MRA")) return false;*/

      // /*if(document.getElementById("arni").value=='remark'){

      //     if (!validateAlphanumeric(document.getElementById("arni_remark").value, "ARNI Remark")) return false;
      // }

      // if(document.getElementById("b_blockers").value=='remark'){

      //     if (!validateAlphanumeric(document.getElementById("b_blockers_remark").value, "B Blockers Remark")) return false;
      // }

      // if(document.getElementById("mra").value=='remark'){

      //     if (!validateAlphanumeric(document.getElementById("mra_remark").value, "MRA Remark")) return false;
      // }*/




      // // Validate radio button selections
      // if (!document.querySelector('input[name="vaccination"]:checked')) {
      //     alert("Please select an option for Vaccination.");
      //     return false;
      // }
      // if (!document.querySelector('input[name="influenza"]:checked')) {
      //     alert("Please select an option for Influenza.");
      //     return false;
      // }
      // if (!document.querySelector('input[name="pneumococcal"]:checked')) {
      //     alert("Please select an option for Pneumococcal.");
      //     return false;
      // }
      // if (!document.querySelector('input[name="cardiac_rehab"]:checked')) {
      //     alert("Please select an option for Cardiac Rehab.");
      //     return false;
      // }
      // if (!document.querySelector('input[name="nsaids_use"]:checked')) {
      //     alert("Please select an option for NSAIDs Use.");
      //     return false;
      // }
      // if (!document.querySelector('input[name="patient_kit_given"]:checked')) {
      //     alert("Please select an option for Patient Kit Given.");
      //     return false;
      // }

      // if(document.getElementById("remark").value!=''){
      // if (!validateAlphabetOnly(document.getElementById("remark").value, "Any Remark")) return false;
      // }

      // if (!validateNumberField(document.getElementById("weight").value, "Weight")) return false;
      // if (!validateNumberField(document.getElementById("height").value, "Height")) return false;
      // //if (!validateNumberField(document.getElementById("waist_circumference_remark").value, "Waist Circumference")) return false;
      // if (!validateNumberField(document.getElementById("bmi").value, "BMI")) return false;
      // //if (!validateNumberField(document.getElementById("waist_to_height_ratio").value, "Waist-to-Height Ratio")) return false;


      // if (!document.querySelector('input[name="type_2_dm"]:checked')) {
      //     alert("Please select an option for Type 2 DM.");
      //     return false;
      // }

      // if (!document.querySelector('input[name="hypertension"]:checked')) {
      //     alert("Please select an option for Hypertension.");
      //     return false;
      // }


      // if (!document.querySelector('input[name="dyslipidemia"]:checked')) {
      //     alert("Please select an option for Dyslipidemia");
      //     return false;
      // }


      // if (!document.querySelector('input[name="pco"]:checked')) {
      //     alert("Please select an option for PCO.");
      //     return false;
      // }


      // if (!document.querySelector('input[name="knee_pain"]:checked')) {
      //     alert("Please select an option for Knee pain (Osteoarthritis).");
      //     return false;
      // }

      // if (!document.querySelector('input[name="asthma"]:checked')) {
      //     alert("Please select an option for Asthma.");
      //     return false;
      // }



      // if (!document.querySelector('input[name="adl_bathing"]:checked')) {
      //     alert("Please select an option for Bathing.");
      //     return false;
      // }

      // if (!document.querySelector('input[name="adl_dressing"]:checked')) {
      //     alert("Please select an option for Dressing.");
      //     return false;
      // }

      // if (!document.querySelector('input[name="adl_walking"]:checked')) {
      //     alert("Please select an option for Walking.");
      //     return false;
      // }

      // if (!document.querySelector('input[name="adl_toileting"]:checked')) {
      //     alert("Please select an option for Toileting.");
      //     return false;
      // }



      //              /*if (!document.querySelector('input[name="exercise_30mins"]:checked')) {
      //                  alert("Please select an option for Exercise 30 mins.");
      //                  return false;
      //              }

      //              if (!document.querySelector('input[name="breakfast_days"]:checked')) {
      //                  alert("Please select an option for Breakfast Days.");
      //                  return false;
      //              }

      //              if (!document.querySelector('input[name="food_habits"]:checked')) {
      //                  alert("Please select an option for Food Habits.");
      //                  return false;
      //              }

      //              if (!document.querySelector('input[name="sedentary_hours"]:checked')) {
      //                  alert("Please select an option for Sedentary Hours.");
      //                  return false;
      //              }*/
      //      }
      return true; // All passed 

      console.log('All passed');

      // return false; // All passed 
   }
</script>
<script>
   $(document).ready(function () {
      $('#state').on('change', function () {
         var state = $(this).val();
         $('#city').html('<option value=""> ---Select City---- </option>');

         $.ajax({
            url: '/Welcome/getStateCity',
            type: 'POST',
            data: { state: state },
            success: function (response) {
               $('#city').html(response);
            },
            error: function () {
               console.log('error');
               $('#result').html('An error occurred.');
            }
         });
      });
   });
</script>
<script>
   // Calculate BMI when height or weight changes
   function calculateBMI() {
      const myTimeout = setTimeout(calculateBMICore, 500);
   }

   function calculateWH() {
      const myTimeout = setTimeout(calculateWHRatio, 500);
   }

   function calculateBMICore() {
      var heightInput = $("#height").val().trim();
      var weightInput = $("#weight").val().trim();
      var bmiInput = $("#bmi").val();

      var heightCm = parseFloat(heightInput);
      var weightKg = parseFloat(weightInput);

      console.log('heightCm : ' + heightCm);
      console.log('weightKg : ' + weightKg);

      if (heightCm != '' && heightCm != 0 && weightKg != '' && weightKg != 0) {

         if (!isNaN(heightCm) && !isNaN(weightKg) && heightCm > 0) {
            console.log('heightCm : ' + heightCm);

            if (weightKg > 0 && heightCm > 0) {
               var heightM = heightCm / 100; // convert cm to meters

               console.log('heightM : ' + heightM);
               console.log('heightCm : ' + heightCm);
               console.log('weightKg : ' + weightKg);
               var heightInMeter = (heightM * heightM);
               var heightInMeter = heightInMeter.toFixed(2)
               console.log('heightInMeter : ' + heightInMeter);
               //bmi.toFixed(2)

               //let bmi = weight / (heightM * heightM);
               var bmi = weightKg / (heightInMeter);
               bmi.toFixed(2);

               console.log('bmi: ' + bmi);
               //$('#bmi').text(bmi.toFixed(2));
               $('#bmi').val(bmi.toFixed(2));
            }


         } else {
            console.log('false');
            //bmiInput.value = "";
            $("#bmi").val('');
         }
      } else {
         $("#bmi").val('');
      }
   }

   function calculateWHRatio() {
      var heightCm = $("#height").val().trim();
      var Waist_circumference = $("#waist_circumference_remark").val().trim();
      $("#waist_to_height_ratio").val('');

      console.log('heightCm : ' + heightCm);
      console.log('Waist_circumference : ' + Waist_circumference);

      if (heightCm != '' && heightCm != 0 && Waist_circumference != '' && Waist_circumference != 0) {
         var WHRatio = Waist_circumference / (heightCm);
         var WHRatio = WHRatio.toFixed(2);
         console.log('WHRatio' + WHRatio);
         $("#waist_to_height_ratio").val(WHRatio);
      } else {
         $("#waist_to_height_ratio").val('');
      }
   }
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
   $(document).ready(function () {
      // Initialize Medicine dropdown with unique settings
      $('#medicine').select2({
         placeholder: "Select medicines",
         allowClear: true,
         width: '100%',
         dropdownParent: $('#medicine').parent() // Ensures proper dropdown positioning
      });

      // Initialize Competitor dropdown with unique settings
      $('#Compititor').select2({
         placeholder: "Select competitors",
         allowClear: true,
         width: '100%',
         dropdownParent: $('#Compititor').parent() // Ensures proper dropdown positioning
      });

      // Fix for dropdown visibility
      $(document).on('select2:open', (e) => {
         // This ensures the search box gets focus only for the currently opened dropdown
         document.querySelector(`#${e.target.id} + .select2-container .select2-search__field`).focus();
      });
   });
   function handleImagePreview(inputId, previewContainerId) {
      const input = document.getElementById(inputId);
      const previewContainer = document.getElementById(previewContainerId);

      input.addEventListener('change', function (event) {
         const files = event.target.files;
         previewContainer.innerHTML = ''; // Clear previous previews

         if (files.length === 0) {
            previewContainer.style.display = 'none';
            return;
         }

         let hasImage = false;

         Array.from(files).forEach(file => {
            if (!file.type.startsWith('image/')) return;

            hasImage = true;
            const reader = new FileReader();
            reader.onload = function (e) {
               const img = document.createElement('img');
               img.src = e.target.result;
               img.style.maxWidth = '100px';
               img.style.margin = '5px';
               img.style.border = '1px solid #ccc';
               img.style.borderRadius = '4px';
               previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
         });

         previewContainer.style.display = hasImage ? 'block' : 'none';
      });
   }

   // Apply preview to all 3 upload sections
   handleImagePreview('consentForm', 'consentPreview');
   handleImagePreview('fileToUpload', 'prescriptionPreview');
   handleImagePreview('purchasebill', 'purchasebillPreview');
</script>