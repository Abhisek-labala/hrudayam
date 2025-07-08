<?php 
include('head.php');
?>
<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Header -->
    <?php 
        include('header.php');
        ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php 
        include('side_bar.php');
        ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>

<script>
$(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!"
})
</script>

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
                            <form action="Patient-Inquiry-Post" name="createEducator" id="createEducator" method="post" enctype="multipart/form-data" >
                                <?php 
                                    $educatorId = $this->session->userdata('educator_id');
                                    $educatorDoctor = getDoctorByEducator($educatorId);
                                    $educatorDoctor = $educatorDoctor['doctorsData'];
                                    //pr($educatorDoctor);
                                    ?>
                                <div class ="row">
                                    <div class='col-md-12 col-md-6 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-2">HCP Name</label>
                                            <div class="col-md-10">
                                                <!--<input type="text" maxlength="50" class="form-control" name="Doctor" id="Doctor" required>
                                                    -->
                                                <select class="form-select form-control" name='Doctor' id='Doctor' required>
                                                     <option selected="selected" id='doc_0' value="">-- Select --</option>
                                                    <?php 
                                                        foreach($educatorDoctor as $jey=>$doctorItem){
                                                        $doctorId = $doctorItem['id'];
                                                        $doctorName = $doctorItem['first_name'];
                                                        ?>	
                                                    <option value="<?php echo $doctorId?>" id='doc_<?php echo $doctorId?>'><?php echo $doctorName?></option>
                                                    <?php } ?>	
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md-12 col-md-6 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-2">Palace</label>
                                            <div class="col-md-10">
                                                    <select class="form-select form-control" name='city' id='city' required>
                                                    <option selected="selected" id='doc_0' value="">-- Select --</option>
                                                    <?php 
                                                    $getAllCity = getAllCity();
                                                    $getAllCity  = $getAllCity['allCities'];
                                                    foreach($getAllCity as $cityKey=>$cityItem){
                                                    $city_code = $cityItem['city_code'];
                                                    $city_name = $cityItem['city_name'];
                                                    ?>	
                                                    <option value="<?php echo $city_code?>" id='doc_<?php echo $city_code?>'><?php echo $city_name?></option>
                                                    <?php } ?>	
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class ="row">                                    
                                    <div class='col-md-12 col-md-6 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-2">MSL Code</label>
                                            <div class="col-md-10">
                                                <input type="text" maxlength="50" class="form-control" name="msl_code" id="msl_code" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-md-12 col-md-6 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-2">P Code</label>
                                            <div class="col-md-10">
                                                <input type="text" maxlength="50" class="form-control" name="p_code" id="p_code" required>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class ="row">
                                    
                                    <div class='col-md-12 col-md-6 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-3">Speciality</label>
                                            <div class="col-md-9">
                                                <!-- <input type="text" maxlength="50" class="form-control" name="speciality" id="speciality" required> -->
                                                <select class="form-select form-control" name='speciality' id='cispecialityty' required>
                                                <option selected="selected" id='sp_0' value="">-- Select --</option>
                                                <option  id='sp_0' value="1">Obesity</option>
                                                <option  id='sp_0' value="2">Heart</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-md-12 col-md-6 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-2">Name</label>
                                            <div class="col-md-10">
                                                <input type="text" maxlength="50" class="form-control" name="first_name" id="first_name" required>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class ="row">                                    
                                    <div class='col-md-12 col-md-3 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Height</label>
                                            <div class="col-md-8">
                                                <input type="text" maxlength="10" class="form-control" name="height" id="height" onkeydown="calculateBMI()"  Palceholde='Please Enter Height In Meter'  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md-12 col-md-3 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Weight</label>
                                            <div class="col-md-8">
                                                <input type="text" maxlength="10" class="form-control" name="weight" id="weight" onkeydown="calculateBMI()" Palceholde='Please Enter Weight In kg' required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class='col-md-12 col-md-3 col-lg-4'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-3">Age</label>
                                            <div class="col-md-8">
                                                <select class="form-select form-control" name='age' id='age' required>
                                                    <option selected="selected" id='0' value="">-- Select --</option>
                                                    <?php 
                                                        for($g=1;$g<=100;$g++){
                                                        ?>		
                                                    <option value="<?php echo $g?>" id='gender_<?php echo $g?>'><?php echo $g?></option>
                                                    <?php } ?>	
                                                    <option id='100+'>100+</option>
                                                </select>
                                                <!-- <input type="text" maxlength="10" class="form-control" name="age" id="age" required> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md-12 col-md-3 col-lg-4'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-6">Blood Pressure</label>
                                            <div class="col-md-6">
                                                <input type="text" maxlength="10" class="form-control" name="bp" id="bp" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md-12 col-md-3 col-lg-4'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-3">Urea</label>
                                            <div class="col-md-9">
                                                <input type="text" maxlength="10" class="form-control" name="urea" id="urea" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class='col-md-12 col-md-3 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-3">LV EF</label>
                                            <div class="col-md-8">
                                                <input type="text" maxlength="10" class="form-control" name="lv_ef" id="lv_ef" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md-12 col-md-3 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-3">Heart Rate</label>
                                            <div class="col-md-8">
                                                <input type="text" maxlength="10" class="form-control" name="heart_rate" id="heart_rate" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class='col-md-12 col-md-3 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-3">NT Pro BNP</label>
                                            <div class="col-md-8">
                                                <input type="text" maxlength="50" class="form-control" name="nt_pro_bnp" id="nt_pro_bnp" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md-12 col-md-3 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-3">EGFR</label>
                                            <div class="col-md-8">
                                                <input type="text" maxlength="10" class="form-control" name="egfr" id="egfr" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class='col-md-12 col-md-3 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-3">Potassium</label>
                                            <div class="col-md-8">
                                                <input type="text" maxlength="50" class="form-control" name="potassium" id="potassium" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md-12 col-md-3 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-3">Sodium</label>
                                            <div class="col-md-8">
                                                <input type="text" maxlength="10" class="form-control" name="sodium" id="sodium" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class='col-md-12 col-md-3 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-3">Uric Acid</label>
                                            <div class="col-md-8">
                                                <input type="text" maxlength="50" class="form-control" name="uric_acid" id="uric_acid" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md-12 col-md-3 col-lg-6'>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-3">Creatinine</label>
                                            <div class="col-md-8">
                                                <input type="text" maxlength="10" class="form-control" name="creatinine" id="creatinine" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-md-3 col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-3">BMI</label>
                                            <div class="col-md-8">
                                                <input type="text" maxlength="10" class="form-control" name="bmi" id="bmi">
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-12 col-md-12 col-lg-12">
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-12"> 
                                            <span style="font-weight: 600;    font-size: 18px;">Waist circumference </span></label>                                            
                                        </div>
                                    </div>
                                </div>


                                <div class="row">                                    
                                    <div class="col-md-12 col-md-3 col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-3">Waist To Height Ratio</label>
                                            <div class="col-md-6">
                                                <input type="text" maxlength="10" class="form-control" name="waist_to_height_ratio" id="waist_to_height_ratio">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-12 col-md-3 col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-3">Prescription</label>
                                            <div class="col-md-6">
                                            <input type="file" accept="image/*" capture="camera" name="fileToUpload" id="fileToUpload" style="width:100%;" required="" multiple="multiple">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-md-3 col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-3"> Product </label>
                                            <div class="col-md-6">
                                                    <!-- <select class="form-control chosen-select" data-placeholder="Begin typing a name to filter..." multiple name="medicine" id="medicine"> -->
                                                    <select class="form-control" name="medicine" id="medicine">                                                    
                                                    <option selected="selected" id='doc_0' value="">-- Select Medicine --</option>
                                                    <option value="Rosulip 40">Rosulip 40</option>
                                                    <option value="Arnicor">Arnicor</option>
                                                    <option value="Linacip E">Linacip E</option>
                                                    <option value="Metolar XR">Metolar XR</option>
                                                    <option value="Metolar Trio">Metolar Trio</option>
                                                    <option value="Dytor Plus">Dytor Plus</option>
                                                    <option value="Dytor">Dytor</option>
                                                    <option value="Dytor E">Dytor E</option>
                                                    <option value="Eplerite">Eplerite</option>
                                                    <option value="Cresar AM">Cresar AM</option>
                                                    <option value="Cresar CT">Cresar CT</option>
                                                    <option value="Empacip">Empacip</option>
                                                    <option value="Empacip S">Empacip S</option>
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-form-label col-md-2"> </label>
                                    <div class="col-md-10">
                                        <button type="submit" name="submit" id="submit" class="btn btn-primary" onclick="return patientInquirey();">Submit</button>
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

function validateFileInput(inputId, fieldName) {
    const fileInput = document.getElementById(inputId);
    const files = fileInput.files;

    if (!files || files.length === 0) {
        alert(fieldName + " is required.");
        return false;
    }

    const allowedExtensions = ['jpeg', 'jpg', 'png'];
    for (let i = 0; i < files.length; i++) {
        const fileName = files[i].name;
        const fileExt = fileName.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes(fileExt)) {
            alert("Invalid file type in " + fieldName + ". Allowed types: .jpeg, .jpg, .png");
            return false;
        }
    }

    return true;
}

    function patientInquirey() {
        // Alphanumeric Validations
        if (!validateAlphanumeric(document.getElementById("Doctor").value, "HCP Name")) return false;
        if (!validateAlphanumeric(document.getElementById("city").value, "Palace")) return false;
        if (!validateAlphanumeric(document.getElementById("msl_code").value, "MSL Code")) return false;
        if (!validateNumberField(document.getElementById("p_code").value, "P Code")) return false;
        if (!validateAlphanumeric(document.getElementById("cispecialityty").value, "Speciality")) return false;
        if (!validateAlphabetOnly(document.getElementById("first_name").value, "Name")) return false;

        // Numeric Validations (float/integer allowed)
        if (!validateNumberField(document.getElementById("height").value, "Height")) return false;
        if (!validateNumberField(document.getElementById("weight").value, "Weight")) return false;
        if (!validateNumberField(document.getElementById("age").value, "Age")) return false;
        if (!validateNumberField(document.getElementById("bp").value, "Blood Pressure")) return false;

        if (!validateNumberField(document.getElementById("urea").value, "Urea")) return false;
        if (!validateNumberField(document.getElementById("lv_ef").value, "LV EF")) return false;
        if (!validateNumberField(document.getElementById("heart_rate").value, "Heart Rate")) return false;
        if (!validateNumberField(document.getElementById("nt_pro_bnp").value, "NT Pro BNP")) return false;
        if (!validateNumberField(document.getElementById("egfr").value, "EGFR")) return false;
        if (!validateNumberField(document.getElementById("potassium").value, "Potassium")) return false;
        if (!validateNumberField(document.getElementById("sodium").value, "Sodium")) return false;
        if (!validateNumberField(document.getElementById("uric_acid").value, "Uric Acid")) return false;
        if (!validateNumberField(document.getElementById("creatinine").value, "Creatinine")) return false;
        if (!validateNumberField(document.getElementById("waist_to_height_ratio").value, "Waist To Height Ratio")) return false;

        // File
        if (!validateFileInput(document.getElementById("fileToUpload").value, "Prescription File")) return false;
        // Product
        if (!validateAlphanumeric(document.getElementById("medicine").value, "Product")) return false;
        

        return true; // All passed
    }
</script>

<script>
    // Calculate BMI when height or weight changes
    function calculateBMI() {
		const myTimeout = setTimeout(calculateBMICore, 500);
	}
	
	function calculateBMICore() {		
		var heightInput = $("#height").val().trim();
        var weightInput = $("#weight").val().trim();
        var bmiInput = $("#bmi").val();

        var heightCm = parseFloat(heightInput);
        var weightKg = parseFloat(weightInput);
		
		console.log('heightCm : '+heightCm);
		console.log('weightKg : '+weightKg);
		
		if(heightCm!='' && heightCm!=0 && weightKg!='' && weightKg!=0){

       if (!isNaN(heightCm) && !isNaN(weightKg) && heightCm > 0) {
            //const heightM = heightCm / 100; // convert to meters
			console.log('true');
			var heightM = heightCm;
            var bmi = weightKg / (heightM * heightM);			
            var bmi = bmi.toFixed(2);
			console.log('bmi'+bmi);
			$("#bmi").val(bmi);
        } else {
			console.log('false');
            //bmiInput.value = "";
			$("#bmi").val('');
        }
		}else{
			$("#bmi").val('');
	    }
    }    
</script>