<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Information Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h4>Patient Information</h4>
    <form>
        <!-- HCP / Facility Information -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label">HCP Name</label>
                <select class="form-select" name="hcp_name"></select>
            </div>
            <div class="col-md-3">
                <label class="form-label">City</label>
                <select class="form-select" name="city"></select>
            </div>
            <div class="col-md-3">
                <label class="form-label">MSL Code</label>
                <input type="text" class="form-control" name="msl_code">
            </div>
            <div class="col-md-3">
                <label class="form-label">Speciality</label>
                <select class="form-select" name="speciality"></select>
            </div>
        </div>

        <!-- Patient Details -->
        <h5 class="mt-4">Patient Details</h5>
        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="patient_name">
            </div>
            <div class="col-md-3">
                <label class="form-label">Age</label>
                <select class="form-select" name="age">
                    <option value="">Select</option>
                    <!-- populate 0‑100+ -->
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Mobile Number</label>
                <input type="text" class="form-control" name="mobile">
            </div>
            <div class="col-md-3">
                <label class="form-label">Gender</label>
                <select class="form-select" name="gender"></select>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <label class="form-label">Prescription</label>
                <select class="form-select" name="prescription"></select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Obesity / Cardio</label>
                <select class="form-select" name="obesity_cardio"></select>
            </div>
        </div>

        <!-- Obesity Section -->
        <h5>Obesity Section</h5>
        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label">Weight (kg)</label>
                <input type="text" class="form-control" name="weight">
            </div>
            <div class="col-md-3">
                <label class="form-label">Height (cm)</label>
                <input type="text" class="form-control" name="height">
            </div>
            <div class="col-md-3">
                <label class="form-label">Waist Circumference (cm)</label>
                <input type="text" class="form-control" name="waist">
            </div>
        </div>

        <!-- Past History & Daily Activity -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h6>Past History</h6>
                <div class="form-check mb-1">
                    <input class="form-check-input" type="checkbox" id="ph_dm" name="history[]" value="Type 2 DM">
                    <label class="form-check-label" for="ph_dm">Type 2 DM</label>
                </div>
                <div class="form-check mb-1">
                    <input class="form-check-input" type="checkbox" id="ph_htn" name="history[]" value="Hypertension">
                    <label class="form-check-label" for="ph_htn">Hypertension</label>
                </div>
                <div class="form-check mb-1">
                    <input class="form-check-input" type="checkbox" id="ph_dyslip" name="history[]" value="Dyslipidemia">
                    <label class="form-check-label" for="ph_dyslip">Dyslipidemia</label>
                </div>
                <div class="form-check mb-1">
                    <input class="form-check-input" type="checkbox" id="ph_pcos" name="history[]" value="PCOS">
                    <label class="form-check-label" for="ph_pcos">PCOS</label>
                </div>
                <div class="form-check mb-1">
                    <input class="form-check-input" type="checkbox" id="ph_knee" name="history[]" value="Knee pain (Osteoarthritis)">
                    <label class="form-check-label" for="ph_knee">Knee pain (Osteoarthritis)</label>
                </div>
                <div class="form-check mb-1">
                    <input class="form-check-input" type="checkbox" id="ph_asthma" name="history[]" value="Asthma">
                    <label class="form-check-label" for="ph_asthma">Asthma</label>
                </div>
            </div>
            <div class="col-md-6">
                <h6>Daily Activity Limitation</h6>
                <div class="form-check mb-1">
                    <input class="form-check-input" type="checkbox" id="dal_bath" name="activity[]" value="Bathing">
                    <label class="form-check-label" for="dal_bath">Bathing</label>
                </div>
                <div class="form-check mb-1">
                    <input class="form-check-input" type="checkbox" id="dal_dress" name="activity[]" value="Dressing">
                    <label class="form-check-label" for="dal_dress">Dressing</label>
                </div>
                <div class="form-check mb-1">
                    <input class="form-check-input" type="checkbox" id="dal_walk" name="activity[]" value="Walking">
                    <label class="form-check-label" for="dal_walk">Walking</label>
                </div>
                <div class="form-check mb-1">
                    <input class="form-check-input" type="checkbox" id="dal_toilet" name="activity[]" value="Toileting">
                    <label class="form-check-label" for="dal_toilet">Toileting</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Exercise (30 mins/day):</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="exercise" id="exercise_yes" value="Yes">
                    <label class="form-check-label" for="exercise_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="exercise" id="exercise_no" value="No">
                    <label class="form-check-label" for="exercise_no">No</label>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Food habits:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="food" id="food_veg" value="Vegetarian">
                    <label class="form-check-label" for="food_veg">Vegetarian</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="food" id="food_nonveg" value="Non‑vegetarian">
                    <label class="form-check-label" for="food_nonveg">Non‑vegetarian</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Having Breakfast / week:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="breakfast" id="breakfast_le4" value="<=4 days">
                    <label class="form-check-label" for="breakfast_le4">≤4 days</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="breakfast" id="breakfast_gt4" value=">4 days">
                    <label class="form-check-label" for="breakfast_gt4">>4 days</label>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Sedentary hours / day:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="sedentary" id="sed_le8" value="<=8 hrs">
                    <label class="form-check-label" for="sed_le8">≤8 hrs</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="sedentary" id="sed_gt8" value=">8 hrs">
                    <label class="form-check-label" for="sed_gt8">>8 hrs</label>
                </div>
            </div>
        </div>

        <hr>
        <!-- Cardio Section -->
        <h5>Cardio Section</h5>
        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label">Blood Pressure</label>
                <input type="text" class="form-control" name="bp">
            </div>
            <div class="col-md-3">
                <label class="form-label">Urea</label>
                <input type="text" class="form-control" name="urea">
            </div>
            <div class="col-md-3">
                <label class="form-label">LV EF</label>
                <input type="text" class="form-control" name="lv_ef">
            </div>
            <div class="col-md-3">
                <label class="form-label">Heart Rate</label>
                <input type="text" class="form-control" name="heart_rate">
            </div>
            <div class="col-md-3 mt-2">
                <label class="form-label">NT Pro BNP</label>
                <input type="text" class="form-control" name="ntprobnp">
            </div>
            <div class="col-md-3 mt-2">
                <label class="form-label">EGFR</label>
                <input type="text" class="form-control" name="egfr">
            </div>
            <div class="col-md-3 mt-2">
                <label class="form-label">Potassium</label>
                <input type="text" class="form-control" name="potassium">
            </div>
            <div class="col-md-3 mt-2">
                <label class="form-label">Sodium</label>
                <input type="text" class="form-control" name="sodium">
            </div>
            <div class="col-md-3 mt-2">
                <label class="form-label">Uric Acid</label>
                <input type="text" class="form-control" name="uric_acid">
            </div>
            <div class="col-md-3 mt-2">
                <label class="form-label">Creatinine</label>
                <input type="text" class="form-control" name="creatinine">
            </div>
        </div>

        <!-- Medication Section (two‑col layout) -->
        <h5>Medication</h5>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">ARNI</label>
                <select class="form-select" name="arni"></select>
                <input type="text" class="form-control mt-1" placeholder="Remark (if not initiated)" name="arni_remark">
            </div>
            <div class="col-md-6">
                <label class="form-label">B Blockers</label>
                <select class="form-select" name="b_blockers"></select>
                <input type="text" class="form-control mt-1" placeholder="Remark (if not initiated)" name="bblockers_remark">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">MRA</label>
                <select class="form-select" name="mra"></select>
                <input type="text" class="form-control mt-1" placeholder="Remark (if not initiated)" name="mra_remark">
            </div>
            <div class="col-md-6">
                <label class="form-label">SGLT2 Inhibitors</label>
                <select class="form-select" name="sglt2"></select>
                <input type="text" class="form-control mt-1" placeholder="Remark (if not initiated)" name="sglt2_remark">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Anti Diabetic Therapy (Optional)</label>
            <select class="form-select" name="adt"></select>
        </div>

        <!-- Other / Misc Section (two‑col per row) -->
        <h5>Other Considerations</h5>
        <div class="row mb-2">
            <div class="col-md-6 mb-2">
                <label class="form-label">Vaccination:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="vaccination" id="vacc_yes" value="Yes"><label class="form-check-label" for="vacc_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="vaccination" id="vacc_no" value="No"><label class="form-check-label" for="vacc_no">No</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="vaccination" id="vacc_na" value="NA"><label class="form-check-label" for="vacc_na">NA</label>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label">Influenza:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="influenza" id="infl_yes" value="Yes"><label class="form-check-label" for="infl_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="influenza" id="infl_no" value="No"><label class="form-check-label" for="infl_no">No</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="influenza" id="infl_na" value="NA"><label class="form-check-label" for="infl_na">NA</label>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6 mb-2">
                <label class="form-label">Pneumococcal:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pneumo" id="pneumo_yes" value="Yes"><label class="form-check-label" for="pneumo_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pneumo" id="pneumo_no" value="No"><label class="form-check-label" for="pneumo_no">No</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pneumo" id="pneumo_na" value="NA"><label class="form-check-label" for="pneumo_na">NA</label>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label">Suitable for cardiac rehab:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rehab" id="rehab_yes" value="Yes"><label class="form-check-label" for="rehab_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rehab" id="rehab_no" value="No"><label class="form-check-label" for="rehab_no">No</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rehab" id="rehab_na" value="NA"><label class="form-check-label" for="rehab_na">NA</label>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6 mb-2">
                <label class="form-label">Use of NSAIDs (elderly):</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="nsaids" id="nsaids_yes" value="Yes"><label class="form-check-label" for="nsaids_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="nsaids" id="nsaids_no" value="No"><label class="form-check-label" for="nsaids_no">No</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="nsaids" id="nsaids_na" value="NA"><label class="form-check-label" for="nsaids_na">NA</label>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label">Patient kit given:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kit_given" id="kit_yes" value="Yes"><label class="form-check-label" for="kit_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kit_given" id="kit_no" value="No"><label class="form-check-label" for="kit_no">No</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kit_given" id="kit_na" value="NA"><label class="form-check-label" for="kit_na">NA</label>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Any Remark</label>
            <input type="text" class="form-control" name="remark">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
