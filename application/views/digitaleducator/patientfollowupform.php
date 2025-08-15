<?php
include('header.php');
?>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
    }

    .form-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        padding: 25px;
        margin-bottom: 30px;
    }

    .form-title {
        color: #2c3e50;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 2px solid #3498db;
    }

    .form-section {
        margin-bottom: 30px;
        padding: 20px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
    }

    .section-title {
        font-size: 1.2rem;
        color: #3498db;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .form-label {
        font-weight: 500;
        margin-top: 10px;
        color: #495057;
    }

    .checkbox-group {
        margin-left: 20px;
    }

    .checkbox-item {
        margin-right: 15px;
    }

    .form-text-input {
        max-width: 300px;
    }

    .required-field::after {
        content: " *";
        color: red;
    }

    .support-number {
        font-weight: bold;
        color: #e74c3c;
    }

    /* Tab styling */
    .nav-tabs {
        border-bottom: 2px solid #dee2e6;
        margin-bottom: 20px;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #495057;
        font-weight: 500;
        padding: 10px 20px;
    }

    .nav-tabs .nav-link.active {
        color: #3498db;
        border-bottom: 3px solid #3498db;
        background-color: transparent;
    }

    .tab-content {
        padding: 15px 0;
    }
</style>
</head>

<body>
    <div class="main-wrapper">

        <?php include('side_bar.php'); ?>
        <div class="page-wrapper">
            <div class="content container-fluid">

                <?php include('breadcum.php'); ?>
                <?php include('alerts.php'); ?>
                <?php
                $patientId = intval($_GET['patient_id']);
                $day3_meds = '';
                $day3_meds_reason = '';
                $day3_sugar = '';
                $day3_sugar_reason = '';
                $day3_bp = '';
                $day3_bp_reason = '';
                $day3_fluid = '';
                $day3_fluid_reason = '';
                $day3_support = [];
                $day3_call_remark = '';
                $callconnect_subremark_3 = '';
                $day3_sub_remark = '';
                $day7_meds = '';
                $day7_meds_reason = '';
                $day7_doctor = '';
                $day7_doctor_reason = '';
                $day7_bp = '';
                $day7_bp_value = '';
                $day7_bp_remarks = '';
                $day7_weight = '';
                $day7_breathless = '';
                $day7_yoga_schedule = '';
                $day7_yoga_schedule_reason = '';
                $day7_yoga_tried = '';
                $day7_yoga_difficult = '';
                $day7_yoga_difficult_reason = '';
                $day7_yoga_required = '';
                $day7_yoga_planned_date = '';
                $day7_yoga_required_reason = '';
                $day7_call_remark = '';
                $callconnect_subremark_7 = '';
                $day7_sub_remark = '';
                $day15_meds = '';
                $day15_meds_reason = '';
                $day15_stock = '';
                $day15_changes = '';
                $day15_bp = '';
                $day15_bp_value = '';
                $day15_weight = '';
                $day15_rbs = '';
                $day15_rbs_value = '';
                $day15_rbs_reason = '';
                $day15_fluid = '';
                $day15_urine = '';
                $day15_breathless = '';
                $day15_yoga = '';
                $day15_yoga_reason = '';
                $day15_call_remark = '';
                $callconnect_subremark_15 = '';
                $day15_sub_remark = '';
                $day30_meds = '';
                $day30_meds_reason = '';
                $day30_stock = '';
                $day30_changes = '';
                $day30_bp = '';
                $day30_bp_value = '';
                $day30_weight = '';
                $day30_rbs = '';
                $day30_rbs_value = '';
                $day30_rbs_reason = '';
                $day30_fluid = '';
                $day30_urine = '';
                $day30_breathless = '';
                $day30_yoga = '';
                $day30_yoga_reason = '';
                $day30_call_remark = '';
                $callconnect_subremark_30 = '';
                $day30_sub_remark = '';
                $day45_meds = '';
                $day45_meds_reason = '';
                $day45_doctor = '';
                $day45_doctor_reason = '';
                $day45_bp = '';
                $day45_bp_value = '';
                $day45_bp_remarks = '';
                $day45_weight = '';
                $day45_breathless = '';
                $day45_yoga_schedule = '';
                $day45_yoga_schedule_reason = '';
                $day45_yoga_tried = '';
                $day45_yoga_difficult = '';
                $day45_yoga_difficult_reason = '';
                $day45_yoga_required = '';
                $day45_yoga_planned_date = '';
                $day45_yoga_required_reason = '';
                $day45_call_remark = '';
                $callconnect_subremark_45 = '';
                $day45_sub_remark = '';
                $day60_meds = '';
                $day60_meds_reason = '';
                $day60_doctor = '';
                $day60_doctor_reason = '';
                $day60_bp = '';
                $day60_bp_value = '';
                $day60_rbs = '';
                $day60_rbs_value = '';
                $day60_weight = '';
                $day60_hba1c = '';
                $day60_hba1c_value = '';
                $day60_hba1c_last = '';
                $day60_challenges = '';
                $day60_challenges_reason = '';
                $day60_monitor = '';
                $day60_monitor_reason = '';
                $day60_water = '';
                $day60_urine = '';
                $day60_questions = '';
                $day60_help = '';
                $day60_yoga_remark = '';
                $day60_call_remark = '';
                $callconnect_subremark_60 = '';
                $day60_sub_remark = '';
                $day90_meds = '';
                $day90_meds_reason = '';
                $day90_doctor = '';
                $day90_doctor_reason = '';
                $day90_bp = '';
                $day90_bp_value = '';
                $day90_bp_remarks = '';
                $day90_weight = '';
                $day90_breathless = '';
                $day90_yoga_schedule = '';
                $day90_yoga_schedule_reason = '';
                $day90_yoga_tried = '';
                $day90_yoga_difficult = '';
                $day90_yoga_difficult_reason = '';
                $day90_yoga_required = '';
                $day90_yoga_planned_date = '';
                $day90_yoga_required_reason = '';
                $day90_call_remark = '';
                $callconnect_subremark_90 = '';
                $day90_sub_remark = '';
                $day120_meds = '';
                $day120_meds_reason = '';
                $day120_doctor = '';
                $day120_doctor_reason = '';
                $day120_bp = '';
                $day120_bp_value = '';
                $day120_rbs = '';
                $day120_rbs_value = '';
                $day120_weight = '';
                $day120_hba1c = '';
                $day120_hba1c_value = '';
                $day120_hba1c_last = '';
                $day120_challenges = '';
                $day120_challenges_reason = '';
                $day120_monitor = '';
                $day120_monitor_reason = '';
                $day120_water = '';
                $day120_urine = '';
                $day120_questions = '';
                $day120_help = '';
                $day120_yoga_remark = '';
                $day120_call_remark = '';
                $callconnect_subremark_120 = '';
                $day120_sub_remark = '';
                $day150_meds = '';
                $day150_meds_reason = '';
                $day150_stock = '';
                $day150_changes = '';
                $day150_bp = '';
                $day150_bp_value = '';
                $day150_weight = '';
                $day150_rbs = '';
                $day150_rbs_value = '';
                $day150_rbs_reason = '';
                $day150_fluid = '';
                $day150_urine = '';
                $day150_breathless = '';
                $day150_yoga = '';
                $day150_yoga_reason = '';
                $day150_call_remark = '';
                $callconnect_subremark_150 = '';
                $day150_sub_remark = '';
                $feeling_now = '';
                $yoga_helpful = '';
                $yoga_feedback = '';

                $instructor_support = '';
                $instructor_feedback = '';

                $diet_impact = '';
                $diet_feedback = '';

                $dietician_access = '';
                $dietician_feedback = '';

                $overall_experience = '';
                $experience_remarks = '';

                $final_feedback = '';

                $day180_call_remark = '';
                $callconnect_subremark_180 = '';
                $noresponse_subremark_180 = '';

                $day3_data_exists = false;
                $daysubmit = "SELECT distinct(day) from `feedback_submitted` where patient_id=$patientId order by CAST(day AS UNSIGNED) ASC";
                $dyasubmitdata = $this->master_model->customQueryArray($daysubmit);
                // pr($dyasubmitdata);die;
                if ($dyasubmitdata) {
                    if ($dyasubmitdata[0]['day'] === '3') {
                        $day3followup = "SELECT * from `day3_followup` where patient_id=$patientId order by id desc limit 1";
                        $day3followupdata = $this->master_model->customQueryRow($day3followup);
                        $day3_data_exists = !empty($day3followupdata);
                        $day3_meds = $day3_data_exists ? $day3followupdata->day3_meds : '';
                        $day3_meds_reason = $day3_data_exists ? $day3followupdata->day3_meds_reason : '';
                        $day3_sugar = $day3_data_exists ? $day3followupdata->day3_sugar : '';
                        $day3_sugar_reason = $day3_data_exists ? $day3followupdata->day3_sugar_reason : '';
                        $day3_bp = $day3_data_exists ? $day3followupdata->day3_bp : '';
                        $day3_bp_reason = $day3_data_exists ? $day3followupdata->day3_bp_reason : '';
                        $day3_fluid = $day3_data_exists ? $day3followupdata->day3_fluid : '';
                        $day3_fluid_reason = $day3_data_exists ? $day3followupdata->day3_fluid_reason : '';
                        $day3_support = $day3_data_exists ? explode(',', $day3followupdata->day3_support) : [];
                        $day3_call_remark = $day3_data_exists ? $day3followupdata->callremark_3 : '';
                        $callconnect_subremark_3 = $day3_data_exists ? $day3followupdata->callconnect_subremark_3 : '';
                        $day3_sub_remark = $day3_data_exists ? $day3followupdata->noresponse_subremark_3 : '';
                        $day3_ae_report=$day3_data_exists ? $day3followupdata->ae_report:'';
                        $dnd_or_dropout_conditions = [
                            'Option to DND the Patient',
                            'Wrong Number – DND the Patient',
                            'Dropout',
                        ];

                        // Check if Day 15 should be disabled
                        $disable_day3 = in_array($callconnect_subremark_3, $dnd_or_dropout_conditions) || $day3_sub_remark === 'Drop out';
                    }
                    if ($dyasubmitdata[1]['day'] === '7') {
                        $day7followup = "SELECT * from `day7_followup` where patient_id=$patientId order by id desc limit 1";
                        $day7followupdata = $this->master_model->customQueryRow($day7followup);
                        $day7_data_exists = !empty($day7followupdata);
                        $day7_meds = $day7_data_exists ? $day7followupdata->day7_meds : '';
                        $day7_meds_reason = $day7_data_exists ? $day7followupdata->day7_meds_reason : '';
                        $day7_doctor = $day7_data_exists ? $day7followupdata->day7_doctor : '';
                        $day7_doctor_reason = $day7_data_exists ? $day7followupdata->day7_doctor_reason : '';
                        $day7_bp = $day7_data_exists ? $day7followupdata->day7_bp : '';
                        $day7_bp_value = $day7_data_exists ? $day7followupdata->day7_bp_value : '';
                        $day7_bp_remarks = $day7_data_exists ? $day7followupdata->day7_bp_remarks : '';
                        $day7_weight = $day7_data_exists ? $day7followupdata->day7_weight : '';
                        $day7_breathless = $day7_data_exists ? $day7followupdata->day7_breathless : '';
                        $day7_yoga_schedule = $day7_data_exists ? $day7followupdata->day7_yoga_schedule : '';
                        $day7_yoga_schedule_reason = $day7_data_exists ? $day7followupdata->day7_yoga_schedule_reason : '';
                        $day7_yoga_tried = $day7_data_exists ? $day7followupdata->day7_yoga_tried : '';
                        $day7_yoga_difficult = $day7_data_exists ? $day7followupdata->day7_yoga_difficult : '';
                        $day7_yoga_difficult_reason = $day7_data_exists ? $day7followupdata->day7_yoga_difficult_reason : '';
                        $day7_yoga_required = $day7_data_exists ? $day7followupdata->day7_yoga_required : '';
                        $day7_yoga_planned_date = $day7_data_exists ? $day7followupdata->day7_yoga_planned_date : '';
                        $day7_yoga_required_reason = $day7_data_exists ? $day7followupdata->day7_yoga_required_reason : '';
                        $day7_call_remark = $day7_data_exists ? $day7followupdata->callremark_7 : '';
                        $callconnect_subremark_7 = $day7_data_exists ? $day7followupdata->callconnect_subremark_7 : '';
                        $day7_sub_remark = $day7_data_exists ? $day7followupdata->noresponse_subremark_7 : '';

                    }
                    if ($dyasubmitdata[2]['day'] === '15') {
                        $day15followup = "SELECT * from `day15_followup` where patient_id=$patientId order by id desc limit 1";
                        $day15followupdata = $this->master_model->customQueryRow($day15followup);
                        $day15_data_exists = !empty($day15followupdata);
                        // pr($day15followupdata);die;
                        $day15_meds = $day15_data_exists ? $day15followupdata->day15_meds : '';
                        $day15_meds_reason = $day15_data_exists ? $day15followupdata->day15_meds_reason : '';
                        $day15_stock = $day15_data_exists ? $day15followupdata->day15_stock : '';
                        $day15_changes = $day15_data_exists ? $day15followupdata->day15_changes : '';
                        $day15_bp = $day15_data_exists ? $day15followupdata->day15_bp : '';
                        $day15_bp_value = $day15_data_exists ? $day15followupdata->day15_bp_value : '';
                        $day15_weight = $day15_data_exists ? $day15followupdata->day15_weight : '';
                        $day15_rbs = $day15_data_exists ? $day15followupdata->day15_rbs : '';
                        $day15_rbs_value = $day15_data_exists ? $day15followupdata->day15_rbs_value : '';
                        $day15_rbs_reason = $day15_data_exists ? $day15followupdata->day15_rbs_reason : '';
                        $day15_fluid = $day15_data_exists ? $day15followupdata->day15_fluid : '';
                        $day15_urine = $day15_data_exists ? $day15followupdata->day15_urine : '';
                        $day15_breathless = $day15_data_exists ? $day15followupdata->day15_breathless : '';
                        $day15_yoga = $day15_data_exists ? $day15followupdata->day15_yoga : '';
                        $day15_yoga_reason = $day15_data_exists ? $day15followupdata->day15_yoga_reason : '';
                        $day15_call_remark = $day15_data_exists ? $day15followupdata->callremark_15 : '';
                        $callconnect_subremark_15 = $day15_data_exists ? $day15followupdata->callconnect_subremark_15 : '';
                        $day15_sub_remark = $day15_data_exists ? $day15followupdata->noresponse_subremark_15 : '';
                    }
                    if ($dyasubmitdata[3]['day'] === '30') {
                        $day30followup = "SELECT * from `day30_followup` where patient_id=$patientId order by id desc limit 1";
                        $day30followupdata = $this->master_model->customQueryRow($day30followup);
                        $day30_data_exists = !empty($day30followupdata);
                        // pr($day30followupdata);die;
                        $day30_meds = $day30_data_exists ? $day30followupdata->day30_meds : '';
                        $day30_meds_reason = $day30_data_exists ? $day30followupdata->day30_meds_reason : '';
                        $day30_stock = $day30_data_exists ? $day30followupdata->day30_stock : '';
                        $day30_changes = $day30_data_exists ? $day30followupdata->day30_changes : '';
                        $day30_bp = $day30_data_exists ? $day30followupdata->day30_bp : '';
                        $day30_bp_value = $day30_data_exists ? $day30followupdata->day30_bp_value : '';
                        $day30_weight = $day30_data_exists ? $day30followupdata->day30_weight : '';
                        $day30_rbs = $day30_data_exists ? $day30followupdata->day30_rbs : '';
                        $day30_rbs_value = $day30_data_exists ? $day30followupdata->day30_rbs_value : '';
                        $day30_rbs_reason = $day30_data_exists ? $day30followupdata->day30_rbs_reason : '';
                        $day30_fluid = $day30_data_exists ? $day30followupdata->day30_fluid : '';
                        $day30_urine = $day30_data_exists ? $day30followupdata->day30_urine : '';
                        $day30_breathless = $day30_data_exists ? $day30followupdata->day30_breathless : '';
                        $day30_yoga = $day30_data_exists ? $day30followupdata->day30_yoga : '';
                        $day30_yoga_reason = $day30_data_exists ? $day30followupdata->day30_yoga_reason : '';
                        $day30_call_remark = $day30_data_exists ? $day30followupdata->callremark_30 : '';
                        $callconnect_subremark_30 = $day30_data_exists ? $day30followupdata->callconnect_subremark_30 : '';
                        $day30_sub_remark = $day30_data_exists ? $day30followupdata->noresponse_subremark_30 : '';
                    }
                    if ($dyasubmitdata[4]['day'] === '45') {
                        $day45followup = "SELECT * from `day45_followup` where patient_id=$patientId order by id desc limit 1";
                        $day45followupdata = $this->master_model->customQueryRow($day45followup);
                        $day45_data_exists = !empty($day45followupdata);
                        $day45_meds = $day45_data_exists ? $day45followupdata->day45_meds : '';
                        $day45_meds_reason = $day45_data_exists ? $day45followupdata->day45_meds_reason : '';
                        $day45_doctor = $day45_data_exists ? $day45followupdata->day45_doctor : '';
                        $day45_doctor_reason = $day45_data_exists ? $day45followupdata->day45_doctor_reason : '';
                        $day45_bp = $day45_data_exists ? $day45followupdata->day45_bp : '';
                        $day45_bp_value = $day45_data_exists ? $day45followupdata->day45_bp_value : '';
                        $day45_bp_remarks = $day45_data_exists ? $day45followupdata->day45_bp_remarks : '';
                        $day45_weight = $day45_data_exists ? $day45followupdata->day45_weight : '';
                        $day45_breathless = $day45_data_exists ? $day45followupdata->day45_breathless : '';
                        $day45_yoga_schedule = $day45_data_exists ? $day45followupdata->day45_yoga_schedule : '';
                        $day45_yoga_schedule_reason = $day45_data_exists ? $day45followupdata->day45_yoga_schedule_reason : '';
                        $day45_yoga_tried = $day45_data_exists ? $day45followupdata->day45_yoga_tried : '';
                        $day45_yoga_difficult = $day45_data_exists ? $day45followupdata->day45_yoga_difficult : '';
                        $day45_yoga_difficult_reason = $day45_data_exists ? $day45followupdata->day45_yoga_difficult_reason : '';
                        $day45_yoga_required = $day45_data_exists ? $day45followupdata->day45_yoga_required : '';
                        $day45_yoga_planned_date = $day45_data_exists ? $day45followupdata->day45_yoga_planned_date : '';
                        $day45_yoga_required_reason = $day45_data_exists ? $day45followupdata->day45_yoga_required_reason : '';
                        $day45_call_remark = $day45_data_exists ? $day45followupdata->callremark_45 : '';
                        $callconnect_subremark_45 = $day45_data_exists ? $day45followupdata->callconnect_subremark_45 : '';
                        $day45_sub_remark = $day45_data_exists ? $day45followupdata->noresponse_subremark_45 : '';
                    }
                    if ($dyasubmitdata[5]['day'] === '60') {
                        $day60followup = "SELECT * from `day60_follow_up` where patient_id=$patientId order by id desc limit 1";
                        $day60followupdata = $this->master_model->customQueryRow($day60followup);
                        $day60_data_exists = !empty($day60followupdata);
                        $day60_meds = $day60_data_exists ? $day60followupdata->day60_meds : '';
                        $day60_meds_reason = $day60_data_exists ? $day60followupdata->day60_meds_reason : '';
                        $day60_doctor = $day60_data_exists ? $day60followupdata->day60_doctor : '';
                        $day60_doctor_reason = $day60_data_exists ? $day60followupdata->day60_doctor_reason : '';
                        $day60_bp = $day60_data_exists ? $day60followupdata->day60_bp : '';
                        $day60_bp_value = $day60_data_exists ? $day60followupdata->day60_bp_value : '';
                        $day60_rbs = $day60_data_exists ? $day60followupdata->day60_rbs : '';
                        $day60_rbs_value = $day60_data_exists ? $day60followupdata->day60_rbs_value : '';
                        $day60_weight = $day60_data_exists ? $day60followupdata->day60_weight : '';
                        $day60_hba1c = $day60_data_exists ? $day60followupdata->day60_hba1c : '';
                        $day60_hba1c_value = $day60_data_exists ? $day60followupdata->day60_hba1c_value : '';
                        $day60_hba1c_last = $day60_data_exists ? $day60followupdata->day60_hba1c_last : '';
                        $day60_challenges = $day60_data_exists ? $day60followupdata->day60_challenges : '';
                        $day60_challenges_reason = $day60_data_exists ? $day60followupdata->day60_challenges_reason : '';
                        $day60_monitor = $day60_data_exists ? $day60followupdata->day60_monitor : '';
                        $day60_monitor_reason = $day60_data_exists ? $day60followupdata->day60_monitor_reason : '';
                        $day60_water = $day60_data_exists ? $day60followupdata->day60_water : '';
                        $day60_urine = $day60_data_exists ? $day60followupdata->day60_urine : '';
                        $day60_questions = $day60_data_exists ? $day60followupdata->day60_questions : '';
                        $day60_help = $day60_data_exists ? $day60followupdata->day60_help : '';
                        $day60_yoga_remark = $day60_data_exists ? $day60followupdata->day60_yoga_remark : '';
                        $day60_call_remark = $day60_data_exists ? $day60followupdata->callremark_60 : '';
                        $callconnect_subremark_60 = $day60_data_exists ? $day60followupdata->callconnect_subremark_60 : '';
                        $day60_sub_remark = $day60_data_exists ? $day60followupdata->noresponse_subremark_60 : '';
                    }
                    if ($dyasubmitdata[6]['day'] === '90') {
                        $day90followup = "SELECT * from `day90_followup` where patient_id=$patientId order by id desc limit 1";
                        $day90followupdata = $this->master_model->customQueryRow($day90followup);
                        $day90_data_exists = !empty($day90followupdata);
                        $day90_meds = $day90_data_exists ? $day90followupdata->day90_meds : '';
                        $day90_meds_reason = $day90_data_exists ? $day90followupdata->day90_meds_reason : '';
                        $day90_doctor = $day90_data_exists ? $day90followupdata->day90_doctor : '';
                        $day90_doctor_reason = $day90_data_exists ? $day90followupdata->day90_doctor_reason : '';
                        $day90_bp = $day90_data_exists ? $day90followupdata->day90_bp : '';
                        $day90_bp_value = $day90_data_exists ? $day90followupdata->day90_bp_value : '';
                        $day90_bp_remarks = $day90_data_exists ? $day90followupdata->day90_bp_remarks : '';
                        $day90_weight = $day90_data_exists ? $day90followupdata->day90_weight : '';
                        $day90_breathless = $day90_data_exists ? $day90followupdata->day90_breathless : '';
                        $day90_yoga_schedule = $day90_data_exists ? $day90followupdata->day90_yoga_schedule : '';
                        $day90_yoga_schedule_reason = $day90_data_exists ? $day90followupdata->day90_yoga_schedule_reason : '';
                        $day90_yoga_tried = $day90_data_exists ? $day90followupdata->day90_yoga_tried : '';
                        $day90_yoga_difficult = $day90_data_exists ? $day90followupdata->day90_yoga_difficult : '';
                        $day90_yoga_difficult_reason = $day90_data_exists ? $day90followupdata->day90_yoga_difficult_reason : '';
                        $day90_yoga_required = $day90_data_exists ? $day90followupdata->day90_yoga_required : '';
                        $day90_yoga_planned_date = $day90_data_exists ? $day90followupdata->day90_yoga_planned_date : '';
                        $day90_yoga_required_reason = $day90_data_exists ? $day90followupdata->day90_yoga_required_reason : '';
                        $day90_call_remark = $day90_data_exists ? $day90followupdata->callremark_90 : '';
                        $callconnect_subremark_90 = $day90_data_exists ? $day90followupdata->callconnect_subremark_90 : '';
                        $day90_sub_remark = $day90_data_exists ? $day90followupdata->noresponse_subremark_90 : '';
                    }
                    if ($dyasubmitdata[7]['day'] === '120') {
                        $day120followup = "SELECT * from `day120_follow_up` where patient_id=$patientId order by id desc limit 1";
                        $day120followupdata = $this->master_model->customQueryRow($day120followup);
                        $day120_data_exists = !empty($day120followupdata);
                        $day120_meds = $day120_data_exists ? $day120followupdata->day120_meds : '';
                        $day120_meds_reason = $day120_data_exists ? $day120followupdata->day120_meds_reason : '';
                        $day120_doctor = $day120_data_exists ? $day120followupdata->day120_doctor : '';
                        $day120_doctor_reason = $day120_data_exists ? $day120followupdata->day120_doctor_reason : '';
                        $day120_bp = $day120_data_exists ? $day120followupdata->day120_bp : '';
                        $day120_bp_value = $day120_data_exists ? $day120followupdata->day120_bp_value : '';
                        $day120_rbs = $day120_data_exists ? $day120followupdata->day120_rbs : '';
                        $day120_rbs_value = $day120_data_exists ? $day120followupdata->day120_rbs_value : '';
                        $day120_weight = $day120_data_exists ? $day120followupdata->day120_weight : '';
                        $day120_hba1c = $day120_data_exists ? $day120followupdata->day120_hba1c : '';
                        $day120_hba1c_value = $day120_data_exists ? $day120followupdata->day120_hba1c_value : '';
                        $day120_hba1c_last = $day120_data_exists ? $day120followupdata->day120_hba1c_last : '';
                        $day120_challenges = $day120_data_exists ? $day120followupdata->day120_challenges : '';
                        $day120_challenges_reason = $day120_data_exists ? $day120followupdata->day120_challenges_reason : '';
                        $day120_monitor = $day120_data_exists ? $day120followupdata->day120_monitor : '';
                        $day120_monitor_reason = $day120_data_exists ? $day120followupdata->day120_monitor_reason : '';
                        $day120_water = $day120_data_exists ? $day120followupdata->day120_water : '';
                        $day120_urine = $day120_data_exists ? $day120followupdata->day120_urine : '';
                        $day120_questions = $day120_data_exists ? $day120followupdata->day120_questions : '';
                        $day120_help = $day120_data_exists ? $day120followupdata->day120_help : '';
                        $day120_yoga_remark = $day120_data_exists ? $day120followupdata->day120_yoga_remark : '';
                        $day120_call_remark = $day120_data_exists ? $day120followupdata->callremark_120 : '';
                        $callconnect_subremark_120 = $day120_data_exists ? $day120followupdata->callconnect_subremark_120 : '';
                        $day120_sub_remark = $day120_data_exists ? $day120followupdata->noresponse_subremark_120 : '';
                    }
                    if ($dyasubmitdata[8]['day'] === '150') {
                        $day150followup = "SELECT * from `day150_followup` where patient_id=$patientId order by id desc limit 1";
                        $day150followupdata = $this->master_model->customQueryRow($day150followup);
                        $day150_data_exists = !empty($day150followupdata);
                        // pr($day150followupdata);die;
                        $day150_meds = $day150_data_exists ? $day150followupdata->day150_meds : '';
                        $day150_meds_reason = $day150_data_exists ? $day150followupdata->day150_meds_reason : '';
                        $day150_stock = $day150_data_exists ? $day150followupdata->day150_stock : '';
                        $day150_changes = $day150_data_exists ? $day150followupdata->day150_changes : '';
                        $day150_bp = $day150_data_exists ? $day150followupdata->day150_bp : '';
                        $day150_bp_value = $day150_data_exists ? $day150followupdata->day150_bp_value : '';
                        $day150_weight = $day150_data_exists ? $day150followupdata->day150_weight : '';
                        $day150_rbs = $day150_data_exists ? $day150followupdata->day150_rbs : '';
                        $day150_rbs_value = $day150_data_exists ? $day150followupdata->day150_rbs_value : '';
                        $day150_rbs_reason = $day150_data_exists ? $day150followupdata->day150_rbs_reason : '';
                        $day150_fluid = $day150_data_exists ? $day150followupdata->day150_fluid : '';
                        $day150_urine = $day150_data_exists ? $day150followupdata->day150_urine : '';
                        $day150_breathless = $day150_data_exists ? $day150followupdata->day150_breathless : '';
                        $day150_yoga = $day150_data_exists ? $day150followupdata->day150_yoga : '';
                        $day150_yoga_reason = $day150_data_exists ? $day150followupdata->day150_yoga_reason : '';
                        $day150_call_remark = $day150_data_exists ? $day150followupdata->callremark_150 : '';
                        $callconnect_subremark_150 = $day150_data_exists ? $day150followupdata->callconnect_subremark_150 : '';
                        $day150_sub_remark = $day150_data_exists ? $day150followupdata->noresponse_subremark_150 : '';
                    }
                    if ($dyasubmitdata[9]['day'] === '180') {
                        $day180followup = "SELECT * from `day180_followup` where patient_id=$patientId order by id desc limit 1";
                        $day180followupdata = $this->master_model->customQueryRow($day180followup);
                        $day180_data_exists = !empty($day180followupdata);
                        $feeling_now = $day180_data_exists ? $day180followupdata->feeling_now : '';
                        $yoga_helpful = $day180_data_exists ? $day180followupdata->yoga_helpful : '';
                        $yoga_feedback = $day180_data_exists ? $day180followupdata->yoga_feedback : '';

                        $instructor_support = $day180_data_exists ? $day180followupdata->instructor_support : '';
                        $instructor_feedback = $day180_data_exists ? $day180followupdata->instructor_feedback : '';

                        $diet_impact = $day180_data_exists ? $day180followupdata->diet_impact : '';
                        $diet_feedback = $day180_data_exists ? $day180followupdata->diet_feedback : '';

                        $dietician_access = $day180_data_exists ? $day180followupdata->dietician_access : '';
                        $dietician_feedback = $day180_data_exists ? $day180followupdata->dietician_feedback : '';

                        $overall_experience = $day180_data_exists ? $day180followupdata->overall_experience : '';
                        $experience_remarks = $day180_data_exists ? $day180followupdata->experience_remarks : '';

                        $final_feedback = $day180_data_exists ? $day180followupdata->final_feedback : '';

                        $day180_call_remark = $day180_data_exists ? $day180followupdata->callremark_180 : '';
                        $callconnect_subremark_180 = $day180_data_exists ? $day180followupdata->callconnect_subremark_180 : '';
                        $noresponse_subremark_180 = $day180_data_exists ? $day180followupdata->noresponse_subremark_180 : '';
                    }

                }
                ?>
                <div class="form-container">
                    <h1 class="form-title">✅ Patient Follow-up Form</h1>
                    <ul class="nav nav-tabs" id="followUpTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="day3-tab" data-bs-toggle="tab" data-bs-target="#day3"
                                type="button" role="tab">Day 3</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo ($day3_data_exists && !$disable_day3)?  '' :'disabled text-muted' ; ?>" id="day7-tab" data-bs-toggle="tab" data-bs-target="#day7"
                                type="button" role="tab" <?php echo ($day3_data_exists && !$disable_day3) ? '' :'disabled' ; ?>>Day 7</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $day7_data_exists ?  '' :'disabled text-muted' ; ?>" id="day15-tab" data-bs-toggle="tab" data-bs-target="#day15"
                                type="button" role="tab" <?php echo $day7_data_exists ? '' :'disabled' ; ?>>Day 15</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $day15_data_exists ?  '' :'disabled text-muted' ; ?>" id="day30-tab" data-bs-toggle="tab" data-bs-target="#day30"
                                type="button" role="tab" <?php echo $day15_data_exists ? '' :'disabled' ; ?>>Day 30</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $day30_data_exists ?  '' :'disabled text-muted' ; ?>" id="day45-tab" data-bs-toggle="tab" data-bs-target="#day45"
                                type="button" role="tab" <?php echo $day30_data_exists ? '' :'disabled' ; ?>>Day 45</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $day45_data_exists ?  '' :'disabled text-muted' ; ?>" id="day60-tab" data-bs-toggle="tab" data-bs-target="#day60"
                                type="button" role="tab" <?php echo $day45_data_exists ? '' :'disabled' ; ?>>Day 60</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $day60_data_exists ?  '' :'disabled text-muted' ; ?>" id="day90-tab" data-bs-toggle="tab" data-bs-target="#day90"
                                type="button" role="tab" <?php echo $day60_data_exists ? '' :'disabled' ; ?>>Day 90</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $day90_data_exists ?  '' :'disabled text-muted' ; ?>" id="day120-tab" data-bs-toggle="tab" data-bs-target="#day120"
                                type="button" role="tab" <?php echo $day90_data_exists ? '' :'disabled' ; ?>>Day 120</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $day120_data_exists ?  '' :'disabled text-muted' ; ?>" id="day150-tab" data-bs-toggle="tab" data-bs-target="#day150"
                                type="button" role="tab" <?php echo $day120_data_exists ? '' :'disabled' ; ?>>Day 150</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $day150_data_exists ?  '' :'disabled text-muted' ; ?>" id="day180-tab" data-bs-toggle="tab" data-bs-target="#day180"
                                type="button" role="tab" <?php echo $day150_data_exists ? '' :'disabled' ; ?>>Day 180</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="followUpTabsContent">
                        <div class="tab-pane fade show active" id="day3" role="tabpanel" aria-labelledby="day3-tab">
                            <form id="day3form" method="POST" action="Digital-educator-follow-up-form-post">
                                <div class="form-section">
                                    <h2 class="section-title">📞 Day 3 Follow-up</h2>

                                    <input type="hidden" name="day" value="3">
                                    <input type="hidden" name="patient_id" value="<?php echo $patientId; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">1. Are you taking your prescribed medicines regularly
                                            and on time?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day3_meds"
                                                id="day3_meds_yes" value="Yes" <?php echo ($day3_meds === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day3_meds_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day3_meds"
                                                id="day3_meds_no" value="No" <?php echo ($day3_meds === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day3_meds_no">No</label>
                                        </div>
                                        <span id="day3_meds_reason"
                                            style="display: <?php echo ($day3_meds === 'No') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day3_meds_reason"
                                                value="<?php echo htmlspecialchars($day3_meds_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">2. Are you monitoring the following as
                                            advised?</label>
                                        <div class="checkbox-group">
                                            <div class="mb-2">
                                                <span>Daily sugar levels:</span>
                                                <div class="form-check form-check-inline checkbox-item">
                                                    <input class="form-check-input" type="radio" name="day3_sugar"
                                                        id="day3_sugar_yes" value="Yes" <?php echo ($day3_sugar === 'Yes') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="day3_sugar_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline checkbox-item">
                                                    <input class="form-check-input" type="radio" name="day3_sugar"
                                                        id="day3_sugar_no" value="No" <?php echo ($day3_sugar === 'No') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="day3_sugar_no">No</label>
                                                </div>
                                                <span id="day3_sugar_reason"
                                                    style="display: <?php echo ($day3_sugar === 'No') ? 'inline' : 'none'; ?>;">
                                                    → Reason: <input type="text" name="day3_sugar_reason"
                                                        value="<?php echo htmlspecialchars($day3_sugar_reason); ?>"
                                                        class="form-control form-control-sm d-inline form-text-input">
                                                </span>
                                            </div>

                                            <div class="mb-2">
                                                <span>Blood pressure:</span>
                                                <div class="form-check form-check-inline checkbox-item">
                                                    <input class="form-check-input" type="radio" name="day3_bp"
                                                        id="day3_bp_yes" value="Yes" <?php echo ($day3_bp === 'Yes') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="day3_bp_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline checkbox-item">
                                                    <input class="form-check-input" type="radio" name="day3_bp"
                                                        id="day3_bp_no" value="No" <?php echo ($day3_bp === 'No') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="day3_bp_no">No</label>
                                                </div>
                                                <span id="day3_bp_reason"
                                                    style="display: <?php echo ($day3_bp === 'No') ? 'inline' : 'none'; ?>;">
                                                    → Reason: <input type="text" name="day3_bp_reason"
                                                        value="<?php echo htmlspecialchars($day3_bp_reason); ?>"
                                                        class="form-control form-control-sm d-inline form-text-input">
                                                </span>
                                            </div>

                                            <div class="mb-2">
                                                <span>Fluid and salt intake:</span>
                                                <div class="form-check form-check-inline checkbox-item">
                                                    <input class="form-check-input" type="radio" name="day3_fluid"
                                                        id="day3_fluid_yes" value="Yes" <?php echo ($day3_fluid === 'Yes') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="day3_fluid_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline checkbox-item">
                                                    <input class="form-check-input" type="radio" name="day3_fluid"
                                                        id="day3_fluid_no" value="No" <?php echo ($day3_fluid === 'No') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="day3_fluid_no">No</label>
                                                </div>
                                                <span id="day3_fluid_reason"
                                                    style="display: <?php echo ($day3_fluid === 'No') ? 'inline' : 'none'; ?>;">
                                                    → Reason: <input type="text" name="day3_fluid_reason"
                                                        value="<?php echo htmlspecialchars($day3_fluid_reason); ?>"
                                                        class="form-control form-control-sm d-inline form-text-input">
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">3. Would you like us to arrange a yoga, physiotherapy,
                                            or dietitian call for support?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="checkbox" name="day3_support[]"
                                                id="day3_support_yoga" value="Yoga" <?php echo (in_array('Yoga', $day3_support)) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day3_support_yoga">Yoga</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="checkbox" name="day3_support[]"
                                                id="day3_support_physio" value="Physiotherapy" <?php echo (in_array('Physiotherapy', $day3_support)) ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day3_support_physio">Physiotherapy</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="checkbox" name="day3_support[]"
                                                id="day3_support_diet" value="Dietitian" <?php echo (in_array('Dietitian', $day3_support)) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day3_support_diet">Dietitian</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="checkbox" name="day3_support[]"
                                                id="day3_support_none" value="No" <?php echo (in_array('No', $day3_support)) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day3_support_none">No</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">4. In case you need any support, please feel free to
                                            call us on our toll-free number: <span
                                                class="support-number">18002670975</span></label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">1. AE REPORT?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="ae_report"
                                                id="ae_report_yes" value="Yes" <?php echo ($day3_ae_report === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="ae_report_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="ae_report"
                                                id="ae_report_no" value="No" <?php echo ($day3_ae_report === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="ae_report_no">No</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Call Remark</label>
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_3"
                                                    id="callremark_call_3" value="Call Connect" <?php echo ($day3_call_remark === 'Call Connect') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_call_3">Call
                                                    Connect</label>
                                            </div>
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_3"
                                                    id="callremark_no_3" value="No Response" <?php echo ($day3_call_remark === 'No Response') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_no_3">No
                                                    Response</label>
                                            </div>

                                            <div id="callremark_subremarks_3"
                                                style="display: <?php echo (!empty($day3_call_remark)) ? 'block' : 'none'; ?>;">
                                                <div class="mt-2">
                                                    <label class="form-label">Remarks:</label>
                                                    <div id="callconnect_subremarks_3"
                                                        style="display: <?php echo ($day3_call_remark === 'Call Connect') ? 'block' : 'none'; ?>;">
                                                        <select class="form-select form-select-sm"
                                                            name="callconnect_subremark_3">
                                                            <option value="">Select remark</option>
                                                            <option value="Option to DND the Patient" <?php echo ($callconnect_subremark_3 === 'Option to DND the Patient') ? 'selected' : ''; ?>>
                                                                Option to DND the Patient</option>
                                                            <option value="Journey Completed" <?php echo ($callconnect_subremark_3 === 'Journey Completed') ? 'selected' : ''; ?>>
                                                                Journey Completed</option>
                                                            <option value="Call Rescheduled by the Patient" <?php echo ($callconnect_subremark_3 === 'Call Rescheduled by the Patient') ? 'selected' : ''; ?>>
                                                                Call Rescheduled by the Patient</option>
                                                            <option value="Wrong Number – DND the Patient" <?php echo ($callconnect_subremark_3 === 'Wrong Number – DND the Patient') ? 'selected' : ''; ?>>
                                                                Wrong Number – DND the Patient</option>
                                                            <option value="Language Barrier" <?php echo ($callconnect_subremark_3 === 'Language Barrier') ? 'selected' : ''; ?>>
                                                                Language Barrier</option>
                                                            <option value="Call Completed" <?php echo ($callconnect_subremark_3 === 'Call Completed') ? 'selected' : ''; ?>>
                                                                Call Completed</option>
                                                            <option value="Call Disconnected by the Patient" <?php echo ($callconnect_subremark_3 === 'Call Disconnected by the Patient') ? 'selected' : ''; ?>>
                                                                Call Disconnected by the Patient</option>
                                                            <option value="Dropout" <?php echo ($callconnect_subremark_3 === 'Dropout') ? 'selected' : ''; ?>>
                                                                Dropout</option>
                                                        </select>
                                                    </div>
                                                    <div id="noresponse_subremarks_3"
                                                        style="display: <?php echo ($day3_call_remark === 'No Response') ? 'block' : 'none'; ?>;">
                                                        <select class="form-select form-select-sm"
                                                            name="noresponse_subremark_3">
                                                            <option value="">Select remark</option>
                                                            <option value="Ringing" <?php echo ($day3_sub_remark === 'Ringing') ? 'selected' : ''; ?>>
                                                                Ringing</option>
                                                            <option value="Call Busy" <?php echo ($day3_sub_remark === 'Call Busy') ? 'selected' : ''; ?>>
                                                                Call Busy</option>
                                                            <option value="Invalid Number" <?php echo ($day3_sub_remark === 'Invalid Number') ? 'selected' : ''; ?>>
                                                                Invalid Number</option>
                                                            <option value="Out of Service" <?php echo ($day3_sub_remark === 'Out of Service') ? 'selected' : ''; ?>>
                                                                Out of Service</option>
                                                            <option value="Switched Off" <?php echo ($day3_sub_remark === 'Switched Off') ? 'selected' : ''; ?>>
                                                                Switched Off</option>
                                                            <option value="Drop out" <?php echo ($day3_sub_remark === 'Drop out') ? 'selected' : ''; ?>>
                                                                Drop out</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit"
                                        class="btn btn-primary <?php echo $day3_data_exists ? 'btn-disabled' : ''; ?>"
                                        <?php echo $day3_data_exists ? 'disabled' : ''; ?>>
                                        <?php echo $day3_data_exists ? 'Already Submitted' : 'Submit Day 3 Follow-up'; ?>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="day7" role="tabpanel" aria-labelledby="day7-tab">
                            <div class="form-section">
                                <h2 class="section-title">🧘 Day 7 Follow-up</h2>

                                <form id="day7form" method="POST" action="Digital-educator-follow-up-form-post">
                                    <input type="hidden" name="day" value="7">
                                    <input type="hidden" name="patient_id" value="<?php echo $patientId; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">1. Are you taking your prescribed medicines
                                            regularly?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day7_meds"
                                                id="day7_meds_yes" value="Yes" <?php echo ($day7_meds === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day7_meds_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day7_meds"
                                                id="day7_meds_no" value="No" <?php echo ($day7_meds === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day7_meds_no">No</label>
                                        </div>
                                        <span id="day7_meds_reason"
                                            style="display: <?php echo ($day7_meds === 'No') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day7_meds_reason"
                                                value="<?php echo htmlspecialchars($day7_meds_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">2. Have you visited your doctor recently for a
                                            follow-up?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day7_doctor"
                                                id="day7_doctor_yes" value="Yes" <?php echo ($day7_doctor === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day7_doctor_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day7_doctor"
                                                id="day7_doctor_no" value="No" <?php echo ($day7_doctor === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day7_doctor_no">No</label>
                                        </div>
                                        <span id="day7_doctor_reason"
                                            style="display: <?php echo ($day7_doctor === 'No') ? 'inline' : 'none'; ?>">
                                            → Reason: <input type="text" name="day7_doctor_reason"
                                                value="<?php echo htmlspecialchars($day7_doctor_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">3. What was your latest blood pressure
                                            reading:</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day7_bp" id="day7_bp_yes"
                                                value="Yes" <?php echo ($day7_bp === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day7_bp_yes">Yes</label>
                                        </div>
                                        <span id="day7_bp_value"
                                            style="display: <?php echo ($day7_bp === 'Yes') ? 'inline' : 'none'; ?>;">
                                            → BP: <input type="text" name="day7_bp_value"
                                                value="<?php echo htmlspecialchars($day7_bp_value); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day7_bp" id="day7_bp_no"
                                                value="No" <?php echo ($day7_bp === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day7_bp_no">No</label>
                                        </div>
                                        <span id="day7_bp_remarks"
                                            style="display:<?php echo ($day7_bp === 'Yes') ? 'inline' : 'none'; ?>;">
                                            → Remarks: <input type="text" name="day7_bp_remarks"
                                                value="<?php echo htmlspecialchars($day7_bp_remarks); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">4. Do you know your current weight:</label>
                                        <input type="text" name="day7_weight"
                                            value="<?php echo htmlspecialchars($day7_weight); ?>"
                                            class="form-control form-control-sm d-inline form-text-input"> kg
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">5. Do you feel breathless?</label>
                                        <div class="checkbox-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day7_breathless"
                                                    id="day7_breathless_none" value="No breathlessness" <?php echo ($day7_breathless === 'No breathlessness') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day7_breathless_none">No
                                                    breathlessness</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day7_breathless"
                                                    id="day7_breathless_stairs" value="While climbing stairs" <?php echo ($day7_breathless === 'While climbing stairs') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day7_breathless_stairs">While
                                                    climbing stairs</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day7_breathless"
                                                    id="day7_breathless_sitting" value="While sitting" <?php echo ($day7_breathless === 'While sitting') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day7_breathless_sitting">While
                                                    sitting</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day7_breathless"
                                                    id="day7_breathless_clothes" value="While changing clothes" <?php echo ($day7_breathless === 'While changing clothes') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day7_breathless_clothes">While
                                                    changing clothes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day7_breathless"
                                                    id="day7_breathless_lie" value="Cannot lie down flat" <?php echo ($day7_breathless === 'Cannot lie down flat') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day7_breathless_lie">Cannot lie
                                                    down flat</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">6. Would you like to schedule a yoga session as part
                                            of your care plan?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day7_yoga_schedule"
                                                id="day7_yoga_schedule_yes" value="Yes" <?php echo ($day7_yoga_schedule === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day7_yoga_schedule_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day7_yoga_schedule"
                                                id="day7_yoga_schedule_no" value="No" <?php echo ($day7_yoga_schedule === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day7_yoga_schedule_no">No</label>
                                        </div>
                                        <span id="day7_yoga_schedule_reason" style="display: none;">
                                            → Reason: <input type="text" name="day7_yoga_schedule_reason"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">7. Have you tried any yoga or breathing exercises
                                            earlier?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day7_yoga_tried"
                                                id="day7_yoga_tried_yes" value="Yes" <?php echo ($day7_yoga_tried === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day7_yoga_tried_yes">Yes</label>
                                        </div>
                                        <span id="day7_yoga_tried_difficult" style="display: none;">
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="day7_yoga_difficult"
                                                    id="day7_yoga_difficult_yes" value="Yes" <?php echo ($day7_yoga_difficult === 'Yes') ? 'checked' : ''; ?>>
                                                <label class="form-check-label"
                                                    for="day7_yoga_difficult_yes">Difficulties?</label>
                                            </div>
                                            <span id="day7_yoga_difficult_reason"
                                                style="display:<?php echo ($day7_yoga_difficult === 'Yes') ? 'inline' : 'none'; ?>;">
                                                → Reason: <input type="text" name="day7_yoga_difficult_reason"
                                                    value="<?php echo htmlspecialchars($day7_yoga_difficult_reason); ?>"
                                                    class="form-control form-control-sm d-inline form-text-input">
                                            </span>
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day7_yoga_tried"
                                                id="day7_yoga_tried_no" value="No" <?php echo ($day7_yoga_tried === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day7_yoga_tried_no">No</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">8. Yoga Session Required?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day7_yoga_required"
                                                id="day7_yoga_required_yes" value="Yes" <?php echo ($day7_yoga_required === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day7_yoga_required_yes">Yes</label>
                                        </div>
                                        <span id="day7_yoga_planned_date"
                                            style="display: <?php echo ($day7_yoga_required === 'Yes') ? 'inline' : 'none'; ?>">
                                            → Planned date: <input type="text" name="day7_yoga_planned_date"
                                                value="<?php echo htmlspecialchars($day7_yoga_planned_date); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day7_yoga_required"
                                                id="day7_yoga_required_no" value="No" <?php echo ($day7_yoga_required === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day7_yoga_required_no">No</label>
                                        </div>
                                        <span id="day7_yoga_required_reason"
                                            style="display: <?php echo ($day7_yoga_required === 'No') ? 'inline' : 'none'; ?>">
                                            → Reason: <input type="text" name="day7_yoga_required_reason"
                                                value="<?php echo htmlspecialchars($day7_yoga_required_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Call Remark</label>
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_7"
                                                    id="callremark_call_7" value="Call Connect" <?php echo ($day7_call_remark === 'Call Connect') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_call_7">Call
                                                    Connect</label>
                                            </div>
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_7"
                                                    id="callremark_no_7" value="No Response" <?php echo ($day7_call_remark === 'No Response') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_no_7">No
                                                    Response</label>
                                            </div>

                                            <div id="callremark_subremarks_7"
                                                style="display: <?php echo ($day7_call_remark === 'Call Connect') ? 'block' : 'none'; ?>">
                                                <div class="mt-2">
                                                    <label class="form-label">Remarks:</label>
                                                    <div id="callconnect_subremarks_7" style="display: none;">
                                                        <select class="form-select form-select-sm"
                                                            name="callconnect_subremark_7">
                                                            <option value="">Select remark</option>
                                                            <option value="Option to DND the Patient" <?php echo ($callconnect_subremark_7 === 'Option to DND the Patient') ? 'selected' : ''; ?>>
                                                                Option to DND the Patient</option>
                                                            <option value="Journey Completed" <?php echo ($callconnect_subremark_7 === 'Journey Completed') ? 'selected' : ''; ?>>
                                                                Journey Completed</option>
                                                            <option value="Call Rescheduled by the Patient" <?php echo ($callconnect_subremark_7 === 'Call Rescheduled by the Patient') ? 'selected' : ''; ?>>
                                                                Call Rescheduled by the Patient</option>
                                                            <option value="Wrong Number – DND the Patient" <?php echo ($callconnect_subremark_7 === 'Wrong Number – DND the Patient') ? 'selected' : ''; ?>>
                                                                Wrong Number – DND the Patient</option>
                                                            <option value="Language Barrier" <?php echo ($callconnect_subremark_7 === 'Language Barrier') ? 'selected' : ''; ?>>
                                                                Language Barrier</option>
                                                            <option value="Call Completed" <?php echo ($callconnect_subremark_7 === 'Call Completed') ? 'selected' : ''; ?>>
                                                                Call Completed</option>
                                                            <option value="Call Disconnected by the Patient" <?php echo ($callconnect_subremark_7 === 'Call Disconnected by the Patient') ? 'selected' : ''; ?>>
                                                                Call Disconnected by the Patient</option>
                                                            <option value="Dropout" <?php echo ($callconnect_subremark_7 === 'Dropout') ? 'selected' : ''; ?>>
                                                                Dropout</option>
                                                        </select>
                                                    </div>
                                                    <div id="noresponse_subremarks_7"
                                                        style="display: <?php echo ($day7_call_remark === 'No Response') ? 'block' : 'none'; ?>;">
                                                        <select class="form-select form-select-sm"
                                                            name="noresponse_subremark_7">
                                                            <option value="">Select remark</option>
                                                            <option value="Ringing" <?php echo ($day7_sub_remark === 'Ringing') ? 'selected' : ''; ?>>
                                                                Ringing</option>
                                                            <option value="Call Busy" <?php echo ($day7_sub_remark === 'Call Busy') ? 'selected' : ''; ?>>
                                                                Call Busy</option>
                                                            <option value="Invalid Number" <?php echo ($day7_sub_remark === 'Invalid Number') ? 'selected' : ''; ?>>
                                                                Invalid Number</option>
                                                            <option value="Out of Service" <?php echo ($day7_sub_remark === 'Out of Service') ? 'selected' : ''; ?>>
                                                                Out of Service</option>
                                                            <option value="Switched Off" <?php echo ($day7_sub_remark === 'Switched Off') ? 'selected' : ''; ?>>
                                                                Switched Off</option>
                                                            <option value="Drop out" <?php echo ($day7_sub_remark === 'Drop out') ? 'selected' : ''; ?>>
                                                                Drop out</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit"
                                            class="btn btn-primary <?php echo $day7_data_exists ? 'btn-disabled' : ''; ?>"
                                            <?php echo $day7_data_exists ? 'disabled' : ''; ?>>
                                            <?php echo $day7_data_exists ? 'Already Submitted' : 'Submit Day 7 Follow-up'; ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="day15" role="tabpanel" aria-labelledby="day15-tab">
                            <div class="form-section">
                                <h2 class="section-title">🗓️ Day 15 Follow-up</h2>
                                <form id="day15form" method="POST" action="Digital-educator-follow-up-form-post">
                                    <input type="hidden" name="day" value="15">
                                    <input type="hidden" name="patient_id" value="<?php echo $patientId; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">1. Are you taking your medicines regularly as advised
                                            by your doctor?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_meds"
                                                id="day15_meds_yes" value="Yes" <?php echo ($day15_meds === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day15_meds_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_meds"
                                                id="day15_meds_no" value="No" <?php echo ($day15_meds === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day15_meds_no">No</label>
                                        </div>
                                        <span id="day15_meds_reason"
                                            style="display:  <?php echo ($day15_meds === 'No') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day15_meds_reason"
                                                value="<?php echo htmlspecialchars($day15_meds_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">2. Do you have enough stock of medicines?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_stock"
                                                id="day15_stock_yes" value="Yes" <?php echo ($day15_stock === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day15_stock_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_stock"
                                                id="day15_stock_no" value="No" <?php echo ($day15_stock === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day15_stock_no">No</label>
                                        </div>
                                        <span id="day15_meds_stock"
                                            style="display:  <?php echo ($day15_stock === 'No') ? 'inline' : 'none'; ?>;">
                                            → Please get a refill or consult your doctor.

                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">3. Has your doctor added or changed any medication
                                            recently?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_changes"
                                                id="day15_changes_yes" value="Yes" <?php echo ($day15_changes === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day15_changes_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_changes"
                                                id="day15_changes_no" value="No" <?php echo ($day15_changes === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day15_changes_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">4. Recent BP Reading:</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_bp"
                                                id="day15_bp_yes" value="Yes" <?php echo ($day15_bp === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day15_bp_yes">Yes→ BP:</label>
                                        </div>
                                        <span id="day15_bp_value"
                                            style="display:  <?php echo ($day15_bp === 'Yes') ? 'inline' : 'none'; ?>;">
                                            <input type="text" name="day15_bp_value"
                                                value="<?php echo htmlspecialchars($day15_bp_value); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_bp"
                                                id="day15_bp_no" value="No" <?php echo ($day15_bp === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day15_bp_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">5. Current weight:</label>
                                        <input type="text" name="day15_weight"
                                            value="<?php echo htmlspecialchars($day15_weight); ?>"
                                            class="form-control form-control-sm d-inline form-text-input">
                                        kg
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">6. Have you checked your blood sugar level (RBS)
                                            recently</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_rbs"
                                                id="day15_rbs_yes" value="Yes" <?php echo ($day15_rbs === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day15_rbs_yes">Yes</label>
                                        </div>
                                        <span id="day15_rbs_value" style="display: inline;">
                                            → <input type="text" name="day15_rbs_value"
                                                value="<?php echo htmlspecialchars($day15_rbs_value); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                            mg/dL
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_rbs"
                                                id="day15_rbs_no" value="No" <?php echo ($day15_rbs === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day15_rbs_no">No</label>
                                        </div>
                                        <span id="day15_rbs_reason" style="display: none;">
                                            → Reason: <input type="text" name="day15_rbs_reason"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">7. Can you tell me about your water/fluid intake and
                                            urine output over the past few days?</label>
                                        <br>
                                        <label class="form-label"> Fluid Intake:</label>
                                        <br>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_fluid"
                                                id="day15_fluid_adequate" value="Adequate" <?php echo ($day15_fluid === 'Adequate') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day15_fluid_adequate">Adequate</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_fluid"
                                                id="day15_fluid_increased" value="Increased" <?php echo ($day15_fluid === 'Increased') ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day15_fluid_increased">Increased</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_fluid"
                                                id="day15_fluid_decreased" value="Decreased" <?php echo ($day15_fluid === 'Decreased') ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day15_fluid_decreased">Decreased</label>
                                        </div>
                                        <br>
                                        <label class="form-label"> Urine Output:</label><br>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_urine"
                                                id="day15_urine_normal" value="Normal" <?php echo ($day15_urine === 'Normal') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day15_urine_normal">Normal</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_urine"
                                                id="day15_urine_increased" value="Increased" <?php echo ($day15_urine === 'Increased') ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day15_urine_increased">Increased</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_urine"
                                                id="day15_urine_reduced" value="Reduced" <?php echo ($day15_fluid === 'Reduced') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day15_urine_reduced">Reduced</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">8. How is your breathing (NYHA
                                            Classification)?</label>
                                        <div class="checkbox-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day15_breathless"
                                                    id="day15_breathless_none" value="No breathlessness" <?php echo ($day15_breathless === 'No breathlessness') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day15_breathless_none">No
                                                    breathlessness</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day15_breathless"
                                                    id="day15_breathless_stairs" value="While climbing stairs" <?php echo ($day15_breathless === 'No breathlessness') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day15_breathless_stairs">While
                                                    climbing stairs</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day15_breathless"
                                                    id="day15_breathless_sitting" value="While sitting" <?php echo ($day15_breathless === 'While sitting') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day15_breathless_sitting">While
                                                    sitting</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day15_breathless"
                                                    id="day15_breathless_clothes" value="While changing clothes" <?php echo ($day15_breathless === 'While changing clothes') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day15_breathless_clothes">While
                                                    changing clothes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day15_breathless"
                                                    id="day15_breathless_lie" value="Cannot lie down flat" <?php echo ($day15_breathless === 'Cannot lie down flat') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day15_breathless_lie">Cannot lie
                                                    down flat</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">9. Have you attended any yoga sessions yet</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_yoga"
                                                id="day15_yoga_yes" value="Yes" <?php echo ($day15_yoga === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day15_yoga_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day15_yoga"
                                                id="day15_yoga_no" value="No" <?php echo ($day15_yoga === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day15_yoga_no">No</label>
                                        </div>
                                        <span id="day15_yoga_reason"
                                            style="display: <?php echo ($day15_yoga === 'No') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day15_yoga_reason"
                                                value="<?php echo htmlspecialchars($day15_yoga_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Call Remark</label>
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_15"
                                                    id="callremark_call_15" value="Call Connect" <?php echo ($day15_call_remark === 'Call Connect') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_call_15">Call
                                                    Connect</label>
                                            </div>
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_15"
                                                    id="callremark_no_15" value="No Response" <?php echo ($day15_call_remark === 'No Response') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_no_15">No
                                                    Response</label>
                                            </div>

                                            <div id="callremark_subremarks_15"
                                                style="display: <?php echo ($day15_call_remark === 'Call Connect') ? 'block' : 'none'; ?>;">
                                                <div class="mt-2">
                                                    <label class="form-label">Remarks:</label>
                                                    <div id="callconnect_subremarks_15" style="display: none;">
                                                        <select class="form-select form-select-sm"
                                                            name="callconnect_subremark_15">
                                                            <option value="">Select remark</option>
                                                            <option value="Option to DND the Patient" <?php echo ($callconnect_subremark_15 === 'Option to DND the Patient') ? 'selected' : ''; ?>>
                                                                Option to DND the Patient</option>
                                                            <option value="Journey Completed" <?php echo ($callconnect_subremark_15 === 'Journey Completed') ? 'selected' : ''; ?>>
                                                                Journey Completed</option>
                                                            <option value="Call Rescheduled by the Patient" <?php echo ($callconnect_subremark_15 === 'Call Rescheduled by the Patient') ? 'selected' : ''; ?>>
                                                                Call Rescheduled by the Patient</option>
                                                            <option value="Wrong Number – DND the Patient" <?php echo ($callconnect_subremark_15 === 'Wrong Number – DND the Patient') ? 'selected' : ''; ?>>
                                                                Wrong Number – DND the Patient</option>
                                                            <option value="Language Barrier" <?php echo ($callconnect_subremark_15 === 'Language Barrier') ? 'selected' : ''; ?>>
                                                                Language Barrier</option>
                                                            <option value="Call Completed" <?php echo ($callconnect_subremark_15 === 'Call Completed') ? 'selected' : ''; ?>>
                                                                Call Completed</option>
                                                            <option value="Call Disconnected by the Patient" <?php echo ($callconnect_subremark_15 === 'Call Disconnected by the Patient') ? 'selected' : ''; ?>>
                                                                Call Disconnected by the Patient</option>
                                                            <option value="Dropout" <?php echo ($callconnect_subremark_15 === 'Dropout') ? 'selected' : ''; ?>>
                                                                Dropout</option>
                                                        </select>
                                                    </div>
                                                    <div id="noresponse_subremarks_15"
                                                        style="display: <?php echo ($day15_call_remark === 'No Response') ? 'block' : 'none'; ?>;">
                                                        <select class="form-select form-select-sm"
                                                            name="noresponse_subremark_15">
                                                            <option value="">Select remark</option>
                                                            <option value="Ringing" <?php echo ($day15_sub_remark === 'Ringing') ? 'selected' : ''; ?>>
                                                                Ringing</option>
                                                            <option value="Call Busy" <?php echo ($day15_sub_remark === 'Call Busy') ? 'selected' : ''; ?>>
                                                                Call Busy</option>
                                                            <option value="Invalid Number" <?php echo ($day15_sub_remark === 'Invalid Number') ? 'selected' : ''; ?>>
                                                                Invalid Number</option>
                                                            <option value="Out of Service" <?php echo ($day15_sub_remark === 'Out of Service') ? 'selected' : ''; ?>>
                                                                Out of Service</option>
                                                            <option value="Switched Off" <?php echo ($day15_sub_remark === 'Switched Off') ? 'selected' : ''; ?>>
                                                                Switched Off</option>
                                                            <option value="Drop out" <?php echo ($day15_sub_remark === 'Drop out') ? 'selected' : ''; ?>>
                                                                Drop out</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit"
                                            class="btn btn-primary <?php echo $day15_data_exists ? 'btn-disabled' : ''; ?>"
                                            <?php echo $day15_data_exists ? 'disabled' : ''; ?>>
                                            <?php echo $day15_data_exists ? 'Already Submitted' : 'Submit Day 15 Follow-up'; ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="day30" role="tabpanel" aria-labelledby="day30-tab">
                            <div class="form-section">
                                <h2 class="section-title">🗓️ Day 30 Follow-up</h2>
                                <form id="day30form" method="POST" action="Digital-educator-follow-up-form-post">
                                    <input type="hidden" name="day" value="30">
                                    <input type="hidden" name="patient_id" value="<?php echo $patientId; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">1. Are you taking your medicines regularly as advised
                                            by your doctor?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_meds"
                                                id="day30_meds_yes" value="Yes" <?php echo ($day30_meds === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day30_meds_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_meds"
                                                id="day30_meds_no" value="No" <?php echo ($day30_meds === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day30_meds_no">No</label>
                                        </div>
                                        <span id="day30_meds_reason"
                                            style="display:  <?php echo ($day30_meds === 'No') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day30_meds_reason"
                                                value="<?php echo htmlspecialchars($day30_meds_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">2. Do you have enough stock of medicines?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_stock"
                                                id="day30_stock_yes" value="Yes" <?php echo ($day30_stock === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day30_stock_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_stock"
                                                id="day30_stock_no" value="No" <?php echo ($day30_stock === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day30_stock_no">No</label>
                                        </div>
                                        <span id="day30_meds_stock"
                                            style="display:  <?php echo ($day30_stock === 'No') ? 'inline' : 'none'; ?>;">
                                            → Please get a refill or consult your doctor.

                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">3. Has your doctor added or changed any medication
                                            recently?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_changes"
                                                id="day30_changes_yes" value="Yes" <?php echo ($day30_changes === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day30_changes_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_changes"
                                                id="day30_changes_no" value="No" <?php echo ($day30_changes === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day30_changes_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">4. Recent BP Reading:</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_bp"
                                                id="day30_bp_yes" value="Yes" <?php echo ($day30_bp === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day30_bp_yes">Yes→ BP:</label>
                                        </div>
                                        <span id="day30_bp_value"
                                            style="display:  <?php echo ($day30_bp === 'Yes') ? 'inline' : 'none'; ?>;">
                                            <input type="text" name="day30_bp_value"
                                                value="<?php echo htmlspecialchars($day30_bp_value); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_bp"
                                                id="day30_bp_no" value="No" <?php echo ($day30_bp === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day30_bp_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">5. Current weight:</label>
                                        <input type="text" name="day30_weight"
                                            value="<?php echo htmlspecialchars($day30_weight); ?>"
                                            class="form-control form-control-sm d-inline form-text-input">
                                        kg
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">6. Have you checked your blood sugar level (RBS)
                                            recently</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_rbs"
                                                id="day30_rbs_yes" value="Yes" <?php echo ($day30_rbs === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day30_rbs_yes">Yes</label>
                                        </div>
                                        <span id="day30_rbs_value" style="display: inline;">
                                            → <input type="text" name="day30_rbs_value"
                                                value="<?php echo htmlspecialchars($day30_rbs_value); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                            mg/dL
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_rbs"
                                                id="day30_rbs_no" value="No" <?php echo ($day30_rbs === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day30_rbs_no">No</label>
                                        </div>
                                        <span id="day30_rbs_reason" style="display: none;">
                                            → Reason: <input type="text" name="day30_rbs_reason"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">7. Can you tell me about your water/fluid intake and
                                            urine output over the past few days?</label>
                                        <br>
                                        <label class="form-label"> Fluid Intake:</label>
                                        <br>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_fluid"
                                                id="day30_fluid_adequate" value="Adequate" <?php echo ($day30_fluid === 'Adequate') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day30_fluid_adequate">Adequate</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_fluid"
                                                id="day30_fluid_increased" value="Increased" <?php echo ($day30_fluid === 'Increased') ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day30_fluid_increased">Increased</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_fluid"
                                                id="day30_fluid_decreased" value="Decreased" <?php echo ($day30_fluid === 'Decreased') ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day30_fluid_decreased">Decreased</label>
                                        </div>
                                        <br>
                                        <label class="form-label"> Urine Output:</label><br>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_urine"
                                                id="day30_urine_normal" value="Normal" <?php echo ($day30_urine === 'Normal') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day30_urine_normal">Normal</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_urine"
                                                id="day30_urine_increased" value="Increased" <?php echo ($day30_urine === 'Increased') ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day30_urine_increased">Increased</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_urine"
                                                id="day30_urine_reduced" value="Reduced" <?php echo ($day30_fluid === 'Reduced') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day30_urine_reduced">Reduced</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">8. How is your breathing (NYHA
                                            Classification)?</label>
                                        <div class="checkbox-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day30_breathless"
                                                    id="day30_breathless_none" value="No breathlessness" <?php echo ($day30_breathless === 'No breathlessness') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day30_breathless_none">No
                                                    breathlessness</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day30_breathless"
                                                    id="day30_breathless_stairs" value="While climbing stairs" <?php echo ($day30_breathless === 'No breathlessness') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day30_breathless_stairs">While
                                                    climbing stairs</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day30_breathless"
                                                    id="day30_breathless_sitting" value="While sitting" <?php echo ($day30_breathless === 'While sitting') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day30_breathless_sitting">While
                                                    sitting</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day30_breathless"
                                                    id="day30_breathless_clothes" value="While changing clothes" <?php echo ($day30_breathless === 'While changing clothes') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day30_breathless_clothes">While
                                                    changing clothes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day30_breathless"
                                                    id="day30_breathless_lie" value="Cannot lie down flat" <?php echo ($day30_breathless === 'Cannot lie down flat') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day30_breathless_lie">Cannot lie
                                                    down flat</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">9. Have you attended any yoga sessions yet</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_yoga"
                                                id="day30_yoga_yes" value="Yes" <?php echo ($day30_yoga === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day30_yoga_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day30_yoga"
                                                id="day30_yoga_no" value="No" <?php echo ($day30_yoga === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day30_yoga_no">No</label>
                                        </div>
                                        <span id="day30_yoga_reason"
                                            style="display: <?php echo ($day30_yoga === 'No') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day30_yoga_reason"
                                                value="<?php echo htmlspecialchars($day30_yoga_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Call Remark</label>
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_30"
                                                    id="callremark_call_30" value="Call Connect" <?php echo ($day30_call_remark === 'Call Connect') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_call_30">Call
                                                    Connect</label>
                                            </div>
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_30"
                                                    id="callremark_no_30" value="No Response" <?php echo ($day30_call_remark === 'No Response') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_no_30">No
                                                    Response</label>
                                            </div>

                                            <div id="callremark_subremarks_30"
                                                style="display: <?php echo ($day30_call_remark === 'Call Connect') ? 'block' : 'none'; ?>;">
                                                <div class="mt-2">
                                                    <label class="form-label">Remarks:</label>
                                                    <div id="callconnect_subremarks_30" style="display: none;">
                                                        <select class="form-select form-select-sm"
                                                            name="callconnect_subremark_30">
                                                            <option value="">Select remark</option>
                                                            <option value="Option to DND the Patient" <?php echo ($callconnect_subremark_30 === 'Option to DND the Patient') ? 'selected' : ''; ?>>
                                                                Option to DND the Patient</option>
                                                            <option value="Journey Completed" <?php echo ($callconnect_subremark_30 === 'Journey Completed') ? 'selected' : ''; ?>>
                                                                Journey Completed</option>
                                                            <option value="Call Rescheduled by the Patient" <?php echo ($callconnect_subremark_30 === 'Call Rescheduled by the Patient') ? 'selected' : ''; ?>>
                                                                Call Rescheduled by the Patient</option>
                                                            <option value="Wrong Number – DND the Patient" <?php echo ($callconnect_subremark_30 === 'Wrong Number – DND the Patient') ? 'selected' : ''; ?>>
                                                                Wrong Number – DND the Patient</option>
                                                            <option value="Language Barrier" <?php echo ($callconnect_subremark_30 === 'Language Barrier') ? 'selected' : ''; ?>>
                                                                Language Barrier</option>
                                                            <option value="Call Completed" <?php echo ($callconnect_subremark_30 === 'Call Completed') ? 'selected' : ''; ?>>
                                                                Call Completed</option>
                                                            <option value="Call Disconnected by the Patient" <?php echo ($callconnect_subremark_30 === 'Call Disconnected by the Patient') ? 'selected' : ''; ?>>
                                                                Call Disconnected by the Patient</option>
                                                            <option value="Dropout" <?php echo ($callconnect_subremark_30 === 'Dropout') ? 'selected' : ''; ?>>
                                                                Dropout</option>
                                                        </select>
                                                    </div>
                                                    <div id="noresponse_subremarks_30"
                                                        style="display: <?php echo ($day30_call_remark === 'No Response') ? 'block' : 'none'; ?>;">
                                                        <select class="form-select form-select-sm"
                                                            name="noresponse_subremark_30">
                                                            <option value="">Select remark</option>
                                                            <option value="Ringing" <?php echo ($day30_sub_remark === 'Ringing') ? 'selected' : ''; ?>>
                                                                Ringing</option>
                                                            <option value="Call Busy" <?php echo ($day30_sub_remark === 'Call Busy') ? 'selected' : ''; ?>>
                                                                Call Busy</option>
                                                            <option value="Invalid Number" <?php echo ($day30_sub_remark === 'Invalid Number') ? 'selected' : ''; ?>>
                                                                Invalid Number</option>
                                                            <option value="Out of Service" <?php echo ($day30_sub_remark === 'Out of Service') ? 'selected' : ''; ?>>
                                                                Out of Service</option>
                                                            <option value="Switched Off" <?php echo ($day30_sub_remark === 'Switched Off') ? 'selected' : ''; ?>>
                                                                Switched Off</option>
                                                            <option value="Drop out" <?php echo ($day30_sub_remark === 'Drop out') ? 'selected' : ''; ?>>
                                                                Drop out</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit"
                                            class="btn btn-primary <?php echo $day30_data_exists ? 'btn-disabled' : ''; ?>"
                                            <?php echo $day30_data_exists ? 'disabled' : ''; ?>>
                                            <?php echo $day30_data_exists ? 'Already Submitted' : 'Submit Day 30 Follow-up'; ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="day45" role="tabpanel" aria-labelledby="day45-tab">
                            <div class="form-section">
                                <h2 class="section-title">🗓️ Day 45 Follow-up</h2>
                                <form id="day45form" method="POST" action="Digital-educator-follow-up-form-post">
                                    <input type="hidden" name="day" value="45">
                                    <input type="hidden" name="patient_id" value="<?php echo $patientId; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">1. Are you taking your prescribed medicines
                                            regularly?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day45_meds"
                                                id="day45_meds_yes" value="Yes" <?php echo ($day45_meds === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day45_meds_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day45_meds"
                                                id="day45_meds_no" value="No" <?php echo ($day45_meds === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day45_meds_no">No</label>
                                        </div>
                                        <span id="day45_meds_reason"
                                            style="display: <?php echo ($day45_meds === 'No') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day45_meds_reason"
                                                value="<?php echo htmlspecialchars($day45_meds_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">2. Have you visited your doctor recently for a
                                            follow-up?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day45_doctor"
                                                id="day45_doctor_yes" value="Yes" <?php echo ($day45_doctor === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day45_doctor_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day45_doctor"
                                                id="day45_doctor_no" value="No" <?php echo ($day45_doctor === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day45_doctor_no">No</label>
                                        </div>
                                        <span id="day45_doctor_reason"
                                            style="display: <?php echo ($day45_doctor === 'No') ? 'inline' : 'none'; ?>">
                                            → Reason: <input type="text" name="day45_doctor_reason"
                                                value="<?php echo htmlspecialchars($day45_doctor_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">3. What was your latest blood pressure
                                            reading:</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day45_bp"
                                                id="day45_bp_yes" value="Yes" <?php echo ($day45_bp === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day45_bp_yes">Yes</label>
                                        </div>
                                        <span id="day45_bp_value"
                                            style="display: <?php echo ($day45_bp === 'Yes') ? 'inline' : 'none'; ?>;">
                                            → BP: <input type="text" name="day45_bp_value"
                                                value="<?php echo htmlspecialchars($day45_bp_value); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day45_bp"
                                                id="day45_bp_no" value="No" <?php echo ($day45_bp === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day45_bp_no">No</label>
                                        </div>
                                        <span id="day45_bp_remarks"
                                            style="display:<?php echo ($day45_bp === 'Yes') ? 'inline' : 'none'; ?>;">
                                            → Remarks: <input type="text" name="day45_bp_remarks"
                                                value="<?php echo htmlspecialchars($day45_bp_remarks); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">4. Do you know your current weight:</label>
                                        <input type="text" name="day45_weight"
                                            value="<?php echo htmlspecialchars($day45_weight); ?>"
                                            class="form-control form-control-sm d-inline form-text-input"> kg
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">5. Do you feel breathless?</label>
                                        <div class="checkbox-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day45_breathless"
                                                    id="day45_breathless_none" value="No breathlessness" <?php echo ($day45_breathless === 'No breathlessness') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day45_breathless_none">No
                                                    breathlessness</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day45_breathless"
                                                    id="day45_breathless_stairs" value="While climbing stairs" <?php echo ($day45_breathless === 'While climbing stairs') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day45_breathless_stairs">While
                                                    climbing stairs</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day45_breathless"
                                                    id="day45_breathless_sitting" value="While sitting" <?php echo ($day45_breathless === 'While sitting') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day45_breathless_sitting">While
                                                    sitting</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day45_breathless"
                                                    id="day45_breathless_clothes" value="While changing clothes" <?php echo ($day45_breathless === 'While changing clothes') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day45_breathless_clothes">While
                                                    changing clothes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day45_breathless"
                                                    id="day45_breathless_lie" value="Cannot lie down flat" <?php echo ($day45_breathless === 'Cannot lie down flat') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day45_breathless_lie">Cannot lie
                                                    down flat</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">6. Would you like to schedule a yoga session as part
                                            of your care plan?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day45_yoga_schedule"
                                                id="day45_yoga_schedule_yes" value="Yes" <?php echo ($day45_yoga_schedule === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day45_yoga_schedule_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day45_yoga_schedule"
                                                id="day45_yoga_schedule_no" value="No" <?php echo ($day45_yoga_schedule === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day45_yoga_schedule_no">No</label>
                                        </div>
                                        <span id="day45_yoga_schedule_reason" style="display: none;">
                                            → Reason: <input type="text" name="day45_yoga_schedule_reason"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">45. Have you tried any yoga or breathing exercises
                                            earlier?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day45_yoga_tried"
                                                id="day45_yoga_tried_yes" value="Yes" <?php echo ($day45_yoga_tried === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day45_yoga_tried_yes">Yes</label>
                                        </div>
                                        <span id="day45_yoga_tried_difficult" style="display: none;">
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="day45_yoga_difficult"
                                                    id="day45_yoga_difficult_yes" value="Yes" <?php echo ($day45_yoga_difficult === 'Yes') ? 'checked' : ''; ?>>
                                                <label class="form-check-label"
                                                    for="day45_yoga_difficult_yes">Difficulties?</label>
                                            </div>
                                            <span id="day45_yoga_difficult_reason"
                                                style="display:<?php echo ($day45_yoga_difficult === 'Yes') ? 'inline' : 'none'; ?>;">
                                                → Reason: <input type="text" name="day45_yoga_difficult_reason"
                                                    value="<?php echo htmlspecialchars($day45_yoga_difficult_reason); ?>"
                                                    class="form-control form-control-sm d-inline form-text-input">
                                            </span>
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day45_yoga_tried"
                                                id="day45_yoga_tried_no" value="No" <?php echo ($day45_yoga_tried === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day45_yoga_tried_no">No</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">8. Yoga Session Required?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day45_yoga_required"
                                                id="day45_yoga_required_yes" value="Yes" <?php echo ($day45_yoga_required === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day45_yoga_required_yes">Yes</label>
                                        </div>
                                        <span id="day45_yoga_planned_date"
                                            style="display: <?php echo ($day45_yoga_required === 'Yes') ? 'inline' : 'none'; ?>">
                                            → Planned date: <input type="text" name="day45_yoga_planned_date"
                                                value="<?php echo htmlspecialchars($day45_yoga_planned_date); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day45_yoga_required"
                                                id="day45_yoga_required_no" value="No" <?php echo ($day45_yoga_required === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day45_yoga_required_no">No</label>
                                        </div>
                                        <span id="day45_yoga_required_reason"
                                            style="display: <?php echo ($day45_yoga_required === 'No') ? 'inline' : 'none'; ?>">
                                            → Reason: <input type="text" name="day45_yoga_required_reason"
                                                value="<?php echo htmlspecialchars($day45_yoga_required_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Call Remark</label>
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_45"
                                                    id="callremark_call_45" value="Call Connect" <?php echo ($day45_call_remark === 'Call Connect') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_call_45">Call
                                                    Connect</label>
                                            </div>
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_45"
                                                    id="callremark_no_45" value="No Response" <?php echo ($day45_call_remark === 'No Response') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_no_45">No
                                                    Response</label>
                                            </div>

                                            <div id="callremark_subremarks_45"
                                                style="display: <?php echo ($day45_call_remark === 'Call Connect') ? 'block' : 'none'; ?>">
                                                <div class="mt-2">
                                                    <label class="form-label">Remarks:</label>
                                                    <div id="callconnect_subremarks_45" style="display: none;">
                                                        <select class="form-select form-select-sm"
                                                            name="callconnect_subremark_45">
                                                            <option value="">Select remark</option>
                                                            <option value="Option to DND the Patient" <?php echo ($callconnect_subremark_45 === 'Option to DND the Patient') ? 'selected' : ''; ?>>
                                                                Option to DND the Patient</option>
                                                            <option value="Journey Completed" <?php echo ($callconnect_subremark_45 === 'Journey Completed') ? 'selected' : ''; ?>>
                                                                Journey Completed</option>
                                                            <option value="Call Rescheduled by the Patient" <?php echo ($callconnect_subremark_45 === 'Call Rescheduled by the Patient') ? 'selected' : ''; ?>>
                                                                Call Rescheduled by the Patient</option>
                                                            <option value="Wrong Number – DND the Patient" <?php echo ($callconnect_subremark_45 === 'Wrong Number – DND the Patient') ? 'selected' : ''; ?>>
                                                                Wrong Number – DND the Patient</option>
                                                            <option value="Language Barrier" <?php echo ($callconnect_subremark_45 === 'Language Barrier') ? 'selected' : ''; ?>>
                                                                Language Barrier</option>
                                                            <option value="Call Completed" <?php echo ($callconnect_subremark_45 === 'Call Completed') ? 'selected' : ''; ?>>
                                                                Call Completed</option>
                                                            <option value="Call Disconnected by the Patient" <?php echo ($callconnect_subremark_45 === 'Call Disconnected by the Patient') ? 'selected' : ''; ?>>
                                                                Call Disconnected by the Patient</option>
                                                            <option value="Dropout" <?php echo ($callconnect_subremark_45 === 'Dropout') ? 'selected' : ''; ?>>
                                                                Dropout</option>
                                                        </select>
                                                    </div>
                                                    <div id="noresponse_subremarks_45"
                                                        style="display: <?php echo ($day45_call_remark === 'No Response') ? 'block' : 'none'; ?>;">
                                                        <select class="form-select form-select-sm"
                                                            name="noresponse_subremark_45">
                                                            <option value="">Select remark</option>
                                                            <option value="Ringing" <?php echo ($day45_sub_remark === 'Ringing') ? 'selected' : ''; ?>>
                                                                Ringing</option>
                                                            <option value="Call Busy" <?php echo ($day45_sub_remark === 'Call Busy') ? 'selected' : ''; ?>>
                                                                Call Busy</option>
                                                            <option value="Invalid Number" <?php echo ($day45_sub_remark === 'Invalid Number') ? 'selected' : ''; ?>>
                                                                Invalid Number</option>
                                                            <option value="Out of Service" <?php echo ($day45_sub_remark === 'Out of Service') ? 'selected' : ''; ?>>
                                                                Out of Service</option>
                                                            <option value="Switched Off" <?php echo ($day45_sub_remark === 'Switched Off') ? 'selected' : ''; ?>>
                                                                Switched Off</option>
                                                            <option value="Drop out" <?php echo ($day45_sub_remark === 'Drop out') ? 'selected' : ''; ?>>
                                                                Drop out</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit"
                                            class="btn btn-primary <?php echo $day45_data_exists ? 'btn-disabled' : ''; ?>"
                                            <?php echo $day45_data_exists ? 'disabled' : ''; ?>>
                                            <?php echo $day45_data_exists ? 'Already Submitted' : 'Submit Day 45 Follow-up'; ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="day60" role="tabpanel" aria-labelledby="day60-tab">
                            <div class="form-section">
                                <h2 class="section-title">🗓️ Day 60 Follow-up</h2>
                                <form id="day60form" method="POST" action="Digital-educator-follow-up-form-post">
                                    <input type="hidden" name="day" value="60">
                                    <input type="hidden" name="patient_id" value="<?php echo $patientId; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">1. Are you taking your medicines regularly and on
                                            time?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_meds"
                                                id="day60_meds_yes" value="Yes" <?php echo ($day60_meds === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_meds_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_meds"
                                                id="day60_meds_no" value="No" <?php echo ($day60_meds === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_meds_no">No</label>
                                        </div>
                                        <span id="day60_meds_reason"
                                            style="display: <?php echo ($day60_meds === 'No') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day60_meds_reason"
                                                value="<?php echo htmlspecialchars($day60_meds_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">2. Recent blood pressure (BP) reading:</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_bp"
                                                id="day60_bp_yes" value="Yes" <?php echo ($day60_bp === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_bp_yes">Yes</label>
                                        </div>
                                        <span id="day60_bp_value"
                                            style="display: <?php echo ($day60_bp === 'Yes') ? 'inline' : 'none'; ?>;">
                                            → <input type="text" name="day60_bp_value"
                                                value="<?php echo htmlspecialchars($day60_bp_value); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_bp"
                                                id="day60_bp_no" value="No" <?php echo ($day60_bp === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_bp_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">3. Recent blood sugar level (RBS) reading:</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_rbs"
                                                id="day60_rbs_yes" value="Yes" <?php echo ($day60_rbs === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_rbs_yes">Yes</label>
                                        </div>
                                        <span id="day60_rbs_value"
                                            style="display:  <?php echo ($day60_rbs === 'Yes') ? 'inline' : 'none'; ?>;">
                                            → <input type="text" name="day60_rbs_value"
                                                value="<?php echo htmlspecialchars($day60_rbs_value); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                            mg/dL
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_rbs"
                                                id="day60_rbs_no" value="No" <?php echo ($day60_rbs === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_rbs_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">4. Current weight:</label>
                                        <input type="text" name="day60_weight"
                                            value="<?php echo htmlspecialchars($day60_weight); ?>"
                                            class="form-control form-control-sm d-inline form-text-input"> kg
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">5. Do you know your last HbA1c value?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_hba1c"
                                                id="day60_hba1c_yes" value="Yes" <?php echo ($day60_hba1c === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_hba1c_yes">Yes</label>
                                        </div>
                                        <span id="day60_hba1c_value"
                                            style="display:  <?php echo ($day60_hba1c === 'Yes') ? 'inline' : 'none'; ?>;">
                                            → <input type="text" name="day60_hba1c_value"
                                                value="<?php echo htmlspecialchars($day60_hba1c_value); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_hba1c"
                                                id="day60_hba1c_no" value="No" <?php echo ($day60_hba1c === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_hba1c_no">No</label>
                                        </div>
                                        <span id="day60_hba1c_last"
                                            style="display:  <?php echo ($day60_hba1c === 'No') ? 'inline' : 'none'; ?>;">
                                            → Last checked: <input type="text" name="day60_hba1c_last"
                                                value="<?php echo htmlspecialchars($day60_hba1c_last); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">6. Are you facing challenges in following the diet
                                            plan?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_challenges"
                                                id="day60_challenges_yes" value="Yes" <?php echo ($day60_challenges === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_challenges_yes">Yes</label>
                                        </div>
                                        <span id="day60_challenges_reason"
                                            style="display:  <?php echo ($day60_challenges === 'Yes') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day60_challenges_reason"
                                                value="<?php echo htmlspecialchars($day60_challenges_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_challenges"
                                                id="day60_challenges_no" value="No" <?php echo ($day60_challenges === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_challenges_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">7.Are you monitoring your daily fluid intake?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_monitor"
                                                id="day60_monitor_yes" value="Yes" <?php echo ($day60_monitor === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_monitor_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_monitor"
                                                id="day60_monitor_no" value="No" <?php echo ($day60_monitor === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_monitor_no">No</label>
                                        </div>
                                        <span id="day60_monitor_reason"
                                            style="display:  <?php echo ($day60_monitor === 'No') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day60_monitor_reason"
                                                value="<?php echo htmlspecialchars($day60_monitor_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">8.Can you tell me about your water/fluid intake and
                                            urine output over the past few days?</label><br>
                                        <label class="form-label">Water Intake:</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_water"
                                                id="day60_water_adequate" value="Adequate" <?php echo ($day60_water === 'Adequate') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_water_adequate">Adequate</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_water"
                                                id="day60_water_increased" value="Increased" <?php echo ($day60_water === 'Increased') ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day60_water_increased">Increased</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_water"
                                                id="day60_water_decreased" value="Decreased" <?php echo ($day60_water === 'Decreased') ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day60_water_decreased">Decreased</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Urine Output:</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_urine"
                                                id="day60_urine_normal" value="Normal" <?php echo ($day60_urine === 'Normal') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_urine_normal">Normal</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_urine"
                                                id="day60_urine_increased" value="Increased" <?php echo ($day60_urine === 'Increased') ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day60_urine_increased">Increased</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_urine"
                                                id="day60_urine_reduced" value="Reduced" <?php echo ($day60_urine === 'Reduced') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_urine_reduced">Reduced</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">9.Any question related to diet or lifestyle
                                            changes?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_questions"
                                                id="day60_questions_yes" value="Yes" <?php echo ($day60_questions === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_questions_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_questions"
                                                id="day60_questions_no" value="No" <?php echo ($day60_questions === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_questions_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">10.Would you like more help with meal planning or salt
                                            restriction?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_help"
                                                id="day60_help_yes" value="Yes" <?php echo ($day60_help === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_help_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_help"
                                                id="day60_help_no" value="No" <?php echo ($day60_help === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_help_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">11.Was there any follow-up with the doctor
                                            recently?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_doctor"
                                                id="day60_doctor_yes" value="Yes" <?php echo ($day60_doctor === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_doctor_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day60_doctor"
                                                id="day60_doctor_no" value="No" <?php echo ($day60_doctor === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day60_doctor_no">No</label>
                                        </div>
                                        <span id="day60_doctor_reason"
                                            style="display: <?php echo ($day60_doctor === 'No') ? 'inline' : 'none'; ?>;;">
                                            → Reason: <input type="text" name="day60_doctor_reason"
                                                value="<?php echo htmlspecialchars($day60_doctor_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">12.How are you feeling now do you need more yoga
                                            sessions??</label>
                                        <div class="form-group">
                                            <label>Remark:</label>
                                            <textarea name="day60_yoga_remark" class="form-control"
                                                rows="2"><?php echo htmlspecialchars($day60_yoga_remark); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Call Remark</label>
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_60"
                                                    id="callremark_call_60" value="Call Connect" <?php echo ($day60_call_remark === 'Call Connect') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_call_60">Call
                                                    Connect</label>
                                            </div>
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_60"
                                                    id="callremark_no_60" value="No Response" <?php echo ($day60_call_remark === 'No Response') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_no_60">No
                                                    Response</label>
                                            </div>
                                        </div>
                                        <div id="callremark_subremarks_60"
                                            style="display: <?php echo ($day60_call_remark === 'No Response') ? 'block' : 'none'; ?>;">
                                            <div class="mt-2">
                                                <label class="form-label">Remarks:</label>
                                                <div id="callconnect_subremarks_60" style="display: none;">
                                                    <select class="form-select form-select-sm"
                                                        name="callconnect_subremark_60">
                                                        <option value="">Select remark</option>
                                                        <option value="Option to DND the Patient" <?php echo ($callconnect_subremark_60 === 'Option to DND the Patient') ? 'selected' : ''; ?>>
                                                            Option to DND the Patient</option>
                                                        <option value="Journey Completed" <?php echo ($callconnect_subremark_60 === 'Journey Completed') ? 'selected' : ''; ?>>
                                                            Journey Completed</option>
                                                        <option value="Call Rescheduled by the Patient" <?php echo ($callconnect_subremark_60 === 'Call Rescheduled by the Patient') ? 'selected' : ''; ?>>
                                                            Call Rescheduled by the Patient</option>
                                                        <option value="Wrong Number – DND the Patient" <?php echo ($callconnect_subremark_60 === 'Wrong Number – DND the Patient') ? 'selected' : ''; ?>>
                                                            Wrong Number – DND the Patient</option>
                                                        <option value="Language Barrier" <?php echo ($callconnect_subremark_60 === 'Language Barrier') ? 'selected' : ''; ?>>
                                                            Language Barrier</option>
                                                        <option value="Call Completed" <?php echo ($callconnect_subremark_60 === 'Call Completed') ? 'selected' : ''; ?>>
                                                            Call Completed</option>
                                                        <option value="Call Disconnected by the Patient" <?php echo ($callconnect_subremark_60 === 'Call Disconnected by the Patient') ? 'selected' : ''; ?>>
                                                            Call Disconnected by the Patient</option>
                                                        <option value="Dropout" <?php echo ($callconnect_subremark_60 === 'Dropout') ? 'selected' : ''; ?>>
                                                            Dropout</option>
                                                    </select>
                                                </div>
                                                <div id="noresponse_subremarks_60"
                                                    style="display: <?php echo ($day60_call_remark === 'No Response') ? 'block' : 'none'; ?>;;">
                                                    <select class="form-select form-select-sm"
                                                        name="noresponse_subremark_60">
                                                        <option value="">Select remark</option>
                                                        <option value="Ringing" <?php echo ($day60_sub_remark === 'Ringing') ? 'selected' : ''; ?>>
                                                            Ringing</option>
                                                        <option value="Call Busy" <?php echo ($day60_sub_remark === 'Call Busy') ? 'selected' : ''; ?>>
                                                            Call Busy</option>
                                                        <option value="Invalid Number" <?php echo ($day60_sub_remark === 'Invalid Number') ? 'selected' : ''; ?>>
                                                            Invalid Number</option>
                                                        <option value="Out of Service" <?php echo ($day60_sub_remark === 'Out of Service') ? 'selected' : ''; ?>>
                                                            Out of Service</option>
                                                        <option value="Switched Off" <?php echo ($day60_sub_remark === 'Switched Off') ? 'selected' : ''; ?>>
                                                            Switched Off</option>
                                                        <option value="Drop out" <?php echo ($day60_sub_remark === 'Drop out') ? 'selected' : ''; ?>>
                                                            Drop out</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit"
                                            class="btn btn-primary <?php echo $day60_data_exists ? 'btn-disabled' : ''; ?>"
                                            <?php echo $day60_data_exists ? 'disabled' : ''; ?>>
                                            <?php echo $day60_data_exists ? 'Already Submitted' : 'Submit Day 60 Follow-up'; ?>
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="day90" role="tabpanel" aria-labelledby="day90-tab">
                            <div class="form-section">
                                <h2 class="section-title">🗓️ Day 90 Follow-up</h2>
                                <form id="day90form" method="POST" action="Digital-educator-follow-up-form-post">
                                    <input type="hidden" name="day" value="90">
                                    <input type="hidden" name="patient_id" value="<?php echo $patientId; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">1. Are you taking your prescribed medicines
                                            regularly?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day90_meds"
                                                id="day90_meds_yes" value="Yes" <?php echo ($day90_meds === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day90_meds_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day90_meds"
                                                id="day90_meds_no" value="No" <?php echo ($day90_meds === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day90_meds_no">No</label>
                                        </div>
                                        <span id="day90_meds_reason"
                                            style="display: <?php echo ($day90_meds === 'No') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day90_meds_reason"
                                                value="<?php echo htmlspecialchars($day90_meds_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">2. Have you visited your doctor recently for a
                                            follow-up?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day90_doctor"
                                                id="day90_doctor_yes" value="Yes" <?php echo ($day90_doctor === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day90_doctor_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day90_doctor"
                                                id="day90_doctor_no" value="No" <?php echo ($day90_doctor === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day90_doctor_no">No</label>
                                        </div>
                                        <span id="day90_doctor_reason"
                                            style="display: <?php echo ($day90_doctor === 'No') ? 'inline' : 'none'; ?>">
                                            → Reason: <input type="text" name="day90_doctor_reason"
                                                value="<?php echo htmlspecialchars($day90_doctor_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">3. What was your latest blood pressure
                                            reading:</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day90_bp"
                                                id="day90_bp_yes" value="Yes" <?php echo ($day90_bp === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day90_bp_yes">Yes</label>
                                        </div>
                                        <span id="day90_bp_value"
                                            style="display: <?php echo ($day90_bp === 'Yes') ? 'inline' : 'none'; ?>;">
                                            → BP: <input type="text" name="day90_bp_value"
                                                value="<?php echo htmlspecialchars($day90_bp_value); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day90_bp"
                                                id="day90_bp_no" value="No" <?php echo ($day90_bp === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day90_bp_no">No</label>
                                        </div>
                                        <span id="day90_bp_remarks"
                                            style="display:<?php echo ($day90_bp === 'Yes') ? 'inline' : 'none'; ?>;">
                                            → Remarks: <input type="text" name="day90_bp_remarks"
                                                value="<?php echo htmlspecialchars($day90_bp_remarks); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">4. Do you know your current weight:</label>
                                        <input type="text" name="day90_weight"
                                            value="<?php echo htmlspecialchars($day90_weight); ?>"
                                            class="form-control form-control-sm d-inline form-text-input"> kg
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">5. Do you feel breathless?</label>
                                        <div class="checkbox-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day90_breathless"
                                                    id="day90_breathless_none" value="No breathlessness" <?php echo ($day90_breathless === 'No breathlessness') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day90_breathless_none">No
                                                    breathlessness</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day90_breathless"
                                                    id="day90_breathless_stairs" value="While climbing stairs" <?php echo ($day90_breathless === 'While climbing stairs') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day90_breathless_stairs">While
                                                    climbing stairs</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day90_breathless"
                                                    id="day90_breathless_sitting" value="While sitting" <?php echo ($day90_breathless === 'While sitting') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day90_breathless_sitting">While
                                                    sitting</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day90_breathless"
                                                    id="day90_breathless_clothes" value="While changing clothes" <?php echo ($day90_breathless === 'While changing clothes') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day90_breathless_clothes">While
                                                    changing clothes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day90_breathless"
                                                    id="day90_breathless_lie" value="Cannot lie down flat" <?php echo ($day90_breathless === 'Cannot lie down flat') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day90_breathless_lie">Cannot lie
                                                    down flat</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">6. Would you like to schedule a yoga session as part
                                            of your care plan?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day90_yoga_schedule"
                                                id="day90_yoga_schedule_yes" value="Yes" <?php echo ($day90_yoga_schedule === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day90_yoga_schedule_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day90_yoga_schedule"
                                                id="day90_yoga_schedule_no" value="No" <?php echo ($day90_yoga_schedule === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day90_yoga_schedule_no">No</label>
                                        </div>
                                        <span id="day90_yoga_schedule_reason" style="display: none;">
                                            → Reason: <input type="text" name="day90_yoga_schedule_reason"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">90. Have you tried any yoga or breathing exercises
                                            earlier?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day90_yoga_tried"
                                                id="day90_yoga_tried_yes" value="Yes" <?php echo ($day90_yoga_tried === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day90_yoga_tried_yes">Yes</label>
                                        </div>
                                        <span id="day90_yoga_tried_difficult" style="display: none;">
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="day90_yoga_difficult"
                                                    id="day90_yoga_difficult_yes" value="Yes" <?php echo ($day90_yoga_difficult === 'Yes') ? 'checked' : ''; ?>>
                                                <label class="form-check-label"
                                                    for="day90_yoga_difficult_yes">Difficulties?</label>
                                            </div>
                                        </span>
                                        <span id="day90_yoga_difficult_reason"
                                            style="display:<?php echo ($day90_yoga_difficult === 'Yes') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day90_yoga_difficult_reason"
                                                value="<?php echo htmlspecialchars($day90_yoga_difficult_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day90_yoga_tried"
                                                id="day90_yoga_tried_no" value="No" <?php echo ($day90_yoga_tried === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day90_yoga_tried_no">No</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">8. Yoga Session Required?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day90_yoga_required"
                                                id="day90_yoga_required_yes" value="Yes" <?php echo ($day90_yoga_required === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day90_yoga_required_yes">Yes</label>
                                        </div>
                                        <span id="day90_yoga_planned_date"
                                            style="display: <?php echo ($day90_yoga_required === 'Yes') ? 'inline' : 'none'; ?>">
                                            → Planned date: <input type="text" name="day90_yoga_planned_date"
                                                value="<?php echo htmlspecialchars($day90_yoga_planned_date); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day90_yoga_required"
                                                id="day90_yoga_required_no" value="No" <?php echo ($day90_yoga_required === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day90_yoga_required_no">No</label>
                                        </div>
                                        <span id="day90_yoga_required_reason"
                                            style="display: <?php echo ($day90_yoga_required === 'No') ? 'inline' : 'none'; ?>">
                                            → Reason: <input type="text" name="day90_yoga_required_reason"
                                                value="<?php echo htmlspecialchars($day90_yoga_required_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Call Remark</label>
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_90"
                                                    id="callremark_call_90" value="Call Connect" <?php echo ($day90_call_remark === 'Call Connect') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_call_90">Call
                                                    Connect</label>
                                            </div>
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_90"
                                                    id="callremark_no_90" value="No Response" <?php echo ($day90_call_remark === 'No Response') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_no_90">No
                                                    Response</label>
                                            </div>

                                            <div id="callremark_subremarks_90"
                                                style="display: <?php echo ($day90_call_remark === 'Call Connect') ? 'block' : 'none'; ?>">
                                                <div class="mt-2">
                                                    <label class="form-label">Remarks:</label>
                                                    <div id="callconnect_subremarks_90" style="display: none;">
                                                        <select class="form-select form-select-sm"
                                                            name="callconnect_subremark_90">
                                                            <option value="">Select remark</option>
                                                            <option value="Option to DND the Patient" <?php echo ($callconnect_subremark_90 === 'Option to DND the Patient') ? 'selected' : ''; ?>>
                                                                Option to DND the Patient</option>
                                                            <option value="Journey Completed" <?php echo ($callconnect_subremark_90 === 'Journey Completed') ? 'selected' : ''; ?>>
                                                                Journey Completed</option>
                                                            <option value="Call Rescheduled by the Patient" <?php echo ($callconnect_subremark_90 === 'Call Rescheduled by the Patient') ? 'selected' : ''; ?>>
                                                                Call Rescheduled by the Patient</option>
                                                            <option value="Wrong Number – DND the Patient" <?php echo ($callconnect_subremark_90 === 'Wrong Number – DND the Patient') ? 'selected' : ''; ?>>
                                                                Wrong Number – DND the Patient</option>
                                                            <option value="Language Barrier" <?php echo ($callconnect_subremark_90 === 'Language Barrier') ? 'selected' : ''; ?>>
                                                                Language Barrier</option>
                                                            <option value="Call Completed" <?php echo ($callconnect_subremark_90 === 'Call Completed') ? 'selected' : ''; ?>>
                                                                Call Completed</option>
                                                            <option value="Call Disconnected by the Patient" <?php echo ($callconnect_subremark_90 === 'Call Disconnected by the Patient') ? 'selected' : ''; ?>>
                                                                Call Disconnected by the Patient</option>
                                                            <option value="Dropout" <?php echo ($callconnect_subremark_90 === 'Dropout') ? 'selected' : ''; ?>>
                                                                Dropout</option>
                                                        </select>
                                                    </div>
                                                    <div id="noresponse_subremarks_90"
                                                        style="display: <?php echo ($day90_call_remark === 'No Response') ? 'block' : 'none'; ?>;">
                                                        <select class="form-select form-select-sm"
                                                            name="noresponse_subremark_90">
                                                            <option value="">Select remark</option>
                                                            <option value="Ringing" <?php echo ($day90_sub_remark === 'Ringing') ? 'selected' : ''; ?>>
                                                                Ringing</option>
                                                            <option value="Call Busy" <?php echo ($day90_sub_remark === 'Call Busy') ? 'selected' : ''; ?>>
                                                                Call Busy</option>
                                                            <option value="Invalid Number" <?php echo ($day90_sub_remark === 'Invalid Number') ? 'selected' : ''; ?>>
                                                                Invalid Number</option>
                                                            <option value="Out of Service" <?php echo ($day90_sub_remark === 'Out of Service') ? 'selected' : ''; ?>>
                                                                Out of Service</option>
                                                            <option value="Switched Off" <?php echo ($day90_sub_remark === 'Switched Off') ? 'selected' : ''; ?>>
                                                                Switched Off</option>
                                                            <option value="Drop out" <?php echo ($day90_sub_remark === 'Drop out') ? 'selected' : ''; ?>>
                                                                Drop out</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit"
                                            class="btn btn-primary <?php echo $day90_data_exists ? 'btn-disabled' : ''; ?>"
                                            <?php echo $day90_data_exists ? 'disabled' : ''; ?>>
                                            <?php echo $day90_data_exists ? 'Already Submitted' : 'Submit Day 90 Follow-up'; ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="day120" role="tabpanel" aria-labelledby="day120-tab">
                            <div class="form-section">
                                <h2 class="section-title">🗓️ Day 120 Follow-up</h2>
                                <form id="day120form" method="POST" action="Digital-educator-follow-up-form-post">
                                    <input type="hidden" name="day" value="120">
                                    <input type="hidden" name="patient_id" value="<?php echo $patientId; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">1. Are you taking your medicines regularly and on
                                            time?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_meds"
                                                id="day120_meds_yes" value="Yes" <?php echo ($day120_meds === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_meds_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_meds"
                                                id="day120_meds_no" value="No" <?php echo ($day120_meds === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_meds_no">No</label>
                                        </div>
                                        <span id="day120_meds_reason"
                                            style="display: <?php echo ($day120_meds === 'No') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day120_meds_reason"
                                                value="<?php echo htmlspecialchars($day120_meds_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">2. Recent blood pressure (BP) reading:</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_bp"
                                                id="day120_bp_yes" value="Yes" <?php echo ($day120_bp === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_bp_yes">Yes</label>
                                        </div>
                                        <span id="day120_bp_value"
                                            style="display: <?php echo ($day120_bp === 'Yes') ? 'inline' : 'none'; ?>;">
                                            → <input type="text" name="day120_bp_value"
                                                value="<?php echo htmlspecialchars($day120_bp_value); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_bp"
                                                id="day120_bp_no" value="No" <?php echo ($day120_bp === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_bp_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">3. Recent blood sugar level (RBS) reading:</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_rbs"
                                                id="day120_rbs_yes" value="Yes" <?php echo ($day120_rbs === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_rbs_yes">Yes</label>
                                        </div>
                                        <span id="day120_rbs_value"
                                            style="display:  <?php echo ($day120_rbs === 'Yes') ? 'inline' : 'none'; ?>;">
                                            → <input type="text" name="day120_rbs_value"
                                                value="<?php echo htmlspecialchars($day120_rbs_value); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                            mg/dL
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_rbs"
                                                id="day120_rbs_no" value="No" <?php echo ($day120_rbs === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_rbs_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">4. Current weight:</label>
                                        <input type="text" name="day120_weight"
                                            value="<?php echo htmlspecialchars($day120_weight); ?>"
                                            class="form-control form-control-sm d-inline form-text-input"> kg
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">5. Do you know your last HbA1c value?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_hba1c"
                                                id="day120_hba1c_yes" value="Yes" <?php echo ($day120_hba1c === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_hba1c_yes">Yes</label>
                                        </div>
                                        <span id="day120_hba1c_value"
                                            style="display:  <?php echo ($day120_hba1c === 'Yes') ? 'inline' : 'none'; ?>;">
                                            → <input type="text" name="day120_hba1c_value"
                                                value="<?php echo htmlspecialchars($day120_hba1c_value); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_hba1c"
                                                id="day120_hba1c_no" value="No" <?php echo ($day120_hba1c === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_hba1c_no">No</label>
                                        </div>
                                        <span id="day120_hba1c_last"
                                            style="display:  <?php echo ($day120_hba1c === 'No') ? 'inline' : 'none'; ?>;">
                                            → Last checked: <input type="text" name="day120_hba1c_last"
                                                value="<?php echo htmlspecialchars($day120_hba1c_last); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">6. Are you facing challenges in following the diet
                                            plan?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_challenges"
                                                id="day120_challenges_yes" value="Yes" <?php echo ($day120_challenges === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_challenges_yes">Yes</label>
                                        </div>
                                        <span id="day120_challenges_reason"
                                            style="display:  <?php echo ($day120_challenges === 'Yes') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day120_challenges_reason"
                                                value="<?php echo htmlspecialchars($day120_challenges_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_challenges"
                                                id="day120_challenges_no" value="No" <?php echo ($day120_challenges === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_challenges_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">7.Are you monitoring your daily fluid intake?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_monitor"
                                                id="day120_monitor_yes" value="Yes" <?php echo ($day120_monitor === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_monitor_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_monitor"
                                                id="day120_monitor_no" value="No" <?php echo ($day120_monitor === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_monitor_no">No</label>
                                        </div>
                                        <span id="day120_monitor_reason"
                                            style="display:  <?php echo ($day120_monitor === 'No') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day120_monitor_reason"
                                                value="<?php echo htmlspecialchars($day120_monitor_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">8.Can you tell me about your water/fluid intake and
                                            urine output over the past few days?</label><br>
                                        <label class="form-label">Water Intake:</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_water"
                                                id="day120_water_adequate" value="Adequate" <?php echo ($day120_water === 'Adequate') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_water_adequate">Adequate</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_water"
                                                id="day120_water_increased" value="Increased" <?php echo ($day120_water === 'Increased') ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day120_water_increased">Increased</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_water"
                                                id="day120_water_decreased" value="Decreased" <?php echo ($day120_water === 'Decreased') ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day120_water_decreased">Decreased</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Urine Output:</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_urine"
                                                id="day120_urine_normal" value="Normal" <?php echo ($day120_urine === 'Normal') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_urine_normal">Normal</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_urine"
                                                id="day120_urine_increased" value="Increased" <?php echo ($day120_urine === 'Increased') ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day120_urine_increased">Increased</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_urine"
                                                id="day120_urine_reduced" value="Reduced" <?php echo ($day120_urine === 'Reduced') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_urine_reduced">Reduced</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">9.Any question related to diet or lifestyle
                                            changes?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_questions"
                                                id="day120_questions_yes" value="Yes" <?php echo ($day120_questions === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_questions_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_questions"
                                                id="day120_questions_no" value="No" <?php echo ($day120_questions === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_questions_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">10.Would you like more help with meal planning or salt
                                            restriction?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_help"
                                                id="day120_help_yes" value="Yes" <?php echo ($day120_help === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_help_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_help"
                                                id="day120_help_no" value="No" <?php echo ($day120_help === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_help_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">11.Was there any follow-up with the doctor
                                            recently?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_doctor"
                                                id="day120_doctor_yes" value="Yes" <?php echo ($day120_doctor === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_doctor_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day120_doctor"
                                                id="day120_doctor_no" value="No" <?php echo ($day120_doctor === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day120_doctor_no">No</label>
                                        </div>
                                        <span id="day120_doctor_reason"
                                            style="display: <?php echo ($day120_doctor === 'No') ? 'inline' : 'none'; ?>;;">
                                            → Reason: <input type="text" name="day120_doctor_reason"
                                                value="<?php echo htmlspecialchars($day120_doctor_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">12.How are you feeling now do you need more yoga
                                            sessions??</label>
                                        <div class="form-group">
                                            <label>Remark:</label>
                                            <textarea name="day120_yoga_remark" class="form-control"
                                                rows="2"><?php echo htmlspecialchars($day120_yoga_remark); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Call Remark</label>
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_120"
                                                    id="callremark_call_120" value="Call Connect" <?php echo ($day120_call_remark === 'Call Connect') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_call_120">Call
                                                    Connect</label>
                                            </div>
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_120"
                                                    id="callremark_no_120" value="No Response" <?php echo ($day120_call_remark === 'No Response') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_no_120">No
                                                    Response</label>
                                            </div>
                                        </div>
                                        <div id="callremark_subremarks_120"
                                            style="display: <?php echo ($day120_call_remark === 'No Response') ? 'block' : 'none'; ?>;">
                                            <div class="mt-2">
                                                <label class="form-label">Remarks:</label>
                                                <div id="callconnect_subremarks_120" style="display: none;">
                                                    <select class="form-select form-select-sm"
                                                        name="callconnect_subremark_120">
                                                        <option value="">Select remark</option>
                                                        <option value="Option to DND the Patient" <?php echo ($callconnect_subremark_120 === 'Option to DND the Patient') ? 'selected' : ''; ?>>
                                                            Option to DND the Patient</option>
                                                        <option value="Journey Completed" <?php echo ($callconnect_subremark_120 === 'Journey Completed') ? 'selected' : ''; ?>>
                                                            Journey Completed</option>
                                                        <option value="Call Rescheduled by the Patient" <?php echo ($callconnect_subremark_120 === 'Call Rescheduled by the Patient') ? 'selected' : ''; ?>>
                                                            Call Rescheduled by the Patient</option>
                                                        <option value="Wrong Number – DND the Patient" <?php echo ($callconnect_subremark_120 === 'Wrong Number – DND the Patient') ? 'selected' : ''; ?>>
                                                            Wrong Number – DND the Patient</option>
                                                        <option value="Language Barrier" <?php echo ($callconnect_subremark_120 === 'Language Barrier') ? 'selected' : ''; ?>>
                                                            Language Barrier</option>
                                                        <option value="Call Completed" <?php echo ($callconnect_subremark_120 === 'Call Completed') ? 'selected' : ''; ?>>
                                                            Call Completed</option>
                                                        <option value="Call Disconnected by the Patient" <?php echo ($callconnect_subremark_120 === 'Call Disconnected by the Patient') ? 'selected' : ''; ?>>
                                                            Call Disconnected by the Patient</option>
                                                        <option value="Dropout" <?php echo ($callconnect_subremark_120 === 'Dropout') ? 'selected' : ''; ?>>
                                                            Dropout</option>
                                                    </select>
                                                </div>
                                                <div id="noresponse_subremarks_120"
                                                    style="display: <?php echo ($day120_call_remark === 'No Response') ? 'block' : 'none'; ?>;;">
                                                    <select class="form-select form-select-sm"
                                                        name="noresponse_subremark_120">
                                                        <option value="">Select remark</option>
                                                        <option value="Ringing" <?php echo ($day120_sub_remark === 'Ringing') ? 'selected' : ''; ?>>
                                                            Ringing</option>
                                                        <option value="Call Busy" <?php echo ($day120_sub_remark === 'Call Busy') ? 'selected' : ''; ?>>
                                                            Call Busy</option>
                                                        <option value="Invalid Number" <?php echo ($day120_sub_remark === 'Invalid Number') ? 'selected' : ''; ?>>
                                                            Invalid Number</option>
                                                        <option value="Out of Service" <?php echo ($day120_sub_remark === 'Out of Service') ? 'selected' : ''; ?>>
                                                            Out of Service</option>
                                                        <option value="Switched Off" <?php echo ($day120_sub_remark === 'Switched Off') ? 'selected' : ''; ?>>
                                                            Switched Off</option>
                                                        <option value="Drop out" <?php echo ($day120_sub_remark === 'Drop out') ? 'selected' : ''; ?>>
                                                            Drop out</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit"
                                            class="btn btn-primary <?php echo $day120_data_exists ? 'btn-disabled' : ''; ?>"
                                            <?php echo $day120_data_exists ? 'disabled' : ''; ?>>
                                            <?php echo $day120_data_exists ? 'Already Submitted' : 'Submit Day 120 Follow-up'; ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="day150" role="tabpanel" aria-labelledby="day150-tab">
                            <div class="form-section">
                                <h2 class="section-title">🗓️ Day 150 Follow-up</h2>
                                <form id="day150form" method="POST" action="Digital-educator-follow-up-form-post">
                                    <input type="hidden" name="day" value="150">
                                    <input type="hidden" name="patient_id" value="<?php echo $patientId; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">1. Are you taking your medicines regularly as advised
                                            by your doctor?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_meds"
                                                id="day150_meds_yes" value="Yes" <?php echo ($day150_meds === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day150_meds_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_meds"
                                                id="day150_meds_no" value="No" <?php echo ($day150_meds === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day150_meds_no">No</label>
                                        </div>
                                        <span id="day150_meds_reason"
                                            style="display:  <?php echo ($day150_meds === 'No') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day150_meds_reason"
                                                value="<?php echo htmlspecialchars($day150_meds_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">2. Do you have enough stock of medicines?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_stock"
                                                id="day150_stock_yes" value="Yes" <?php echo ($day150_stock === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day150_stock_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_stock"
                                                id="day150_stock_no" value="No" <?php echo ($day150_stock === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day150_stock_no">No</label>
                                        </div>
                                        <span id="day150_meds_stock"
                                            style="display:  <?php echo ($day150_stock === 'No') ? 'inline' : 'none'; ?>;">
                                            → Please get a refill or consult your doctor.

                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">3. Has your doctor added or changed any medication
                                            recently?</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_changes"
                                                id="day150_changes_yes" value="Yes" <?php echo ($day150_changes === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day150_changes_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_changes"
                                                id="day150_changes_no" value="No" <?php echo ($day150_changes === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day150_changes_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">4. Recent BP Reading:</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_bp"
                                                id="day150_bp_yes" value="Yes" <?php echo ($day150_bp === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day150_bp_yes">Yes→ BP:</label>
                                        </div>
                                        <span id="day150_bp_value"
                                            style="display:  <?php echo ($day150_bp === 'Yes') ? 'inline' : 'none'; ?>;">
                                            <input type="text" name="day150_bp_value"
                                                value="<?php echo htmlspecialchars($day150_bp_value); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_bp"
                                                id="day150_bp_no" value="No" <?php echo ($day150_bp === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day150_bp_no">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">5. Current weight:</label>
                                        <input type="text" name="day150_weight"
                                            value="<?php echo htmlspecialchars($day150_weight); ?>"
                                            class="form-control form-control-sm d-inline form-text-input">
                                        kg
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">6. Have you checked your blood sugar level (RBS)
                                            recently</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_rbs"
                                                id="day150_rbs_yes" value="Yes" <?php echo ($day150_rbs === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day150_rbs_yes">Yes</label>
                                        </div>
                                        <span id="day150_rbs_value" style="display: inline;">
                                            → <input type="text" name="day150_rbs_value"
                                                value="<?php echo htmlspecialchars($day150_rbs_value); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                            mg/dL
                                        </span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_rbs"
                                                id="day150_rbs_no" value="No" <?php echo ($day150_rbs === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day150_rbs_no">No</label>
                                        </div>
                                        <span id="day150_rbs_reason" style="display: none;">
                                            → Reason: <input type="text" name="day150_rbs_reason"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">7. Can you tell me about your water/fluid intake and
                                            urine output over the past few days?</label>
                                        <br>
                                        <label class="form-label"> Fluid Intake:</label>
                                        <br>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_fluid"
                                                id="day150_fluid_adequate" value="Adequate" <?php echo ($day150_fluid === 'Adequate') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day150_fluid_adequate">Adequate</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_fluid"
                                                id="day150_fluid_increased" value="Increased" <?php echo ($day150_fluid === 'Increased') ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day150_fluid_increased">Increased</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_fluid"
                                                id="day150_fluid_decreased" value="Decreased" <?php echo ($day150_fluid === 'Decreased') ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day150_fluid_decreased">Decreased</label>
                                        </div>
                                        <br>
                                        <label class="form-label"> Urine Output:</label><br>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_urine"
                                                id="day150_urine_normal" value="Normal" <?php echo ($day150_urine === 'Normal') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day150_urine_normal">Normal</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_urine"
                                                id="day150_urine_increased" value="Increased" <?php echo ($day150_urine === 'Increased') ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="day150_urine_increased">Increased</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_urine"
                                                id="day150_urine_reduced" value="Reduced" <?php echo ($day150_fluid === 'Reduced') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day150_urine_reduced">Reduced</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">8. How is your breathing (NYHA
                                            Classification)?</label>
                                        <div class="checkbox-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day150_breathless"
                                                    id="day150_breathless_none" value="No breathlessness" <?php echo ($day150_breathless === 'No breathlessness') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day150_breathless_none">No
                                                    breathlessness</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day150_breathless"
                                                    id="day150_breathless_stairs" value="While climbing stairs" <?php echo ($day150_breathless === 'No breathlessness') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day150_breathless_stairs">While
                                                    climbing stairs</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day150_breathless"
                                                    id="day150_breathless_sitting" value="While sitting" <?php echo ($day150_breathless === 'While sitting') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day150_breathless_sitting">While
                                                    sitting</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day150_breathless"
                                                    id="day150_breathless_clothes" value="While changing clothes" <?php echo ($day150_breathless === 'While changing clothes') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day150_breathless_clothes">While
                                                    changing clothes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day150_breathless"
                                                    id="day150_breathless_lie" value="Cannot lie down flat" <?php echo ($day150_breathless === 'Cannot lie down flat') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="day150_breathless_lie">Cannot lie
                                                    down flat</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">9. Have you attended any yoga sessions yet</label>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_yoga"
                                                id="day150_yoga_yes" value="Yes" <?php echo ($day150_yoga === 'Yes') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day150_yoga_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="radio" name="day150_yoga"
                                                id="day150_yoga_no" value="No" <?php echo ($day150_yoga === 'No') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="day150_yoga_no">No</label>
                                        </div>
                                        <span id="day150_yoga_reason"
                                            style="display: <?php echo ($day150_yoga === 'No') ? 'inline' : 'none'; ?>;">
                                            → Reason: <input type="text" name="day150_yoga_reason"
                                                value="<?php echo htmlspecialchars($day150_yoga_reason); ?>"
                                                class="form-control form-control-sm d-inline form-text-input">
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Call Remark</label>
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_150"
                                                    id="callremark_call_150" value="Call Connect" <?php echo ($day150_call_remark === 'Call Connect') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_call_150">Call
                                                    Connect</label>
                                            </div>
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_150"
                                                    id="callremark_no_150" value="No Response" <?php echo ($day150_call_remark === 'No Response') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_no_150">No
                                                    Response</label>
                                            </div>

                                            <div id="callremark_subremarks_150"
                                                style="display: <?php echo ($day150_call_remark === 'Call Connect') ? 'block' : 'none'; ?>;">
                                                <div class="mt-2">
                                                    <label class="form-label">Remarks:</label>
                                                    <div id="callconnect_subremarks_150" style="display: none;">
                                                        <select class="form-select form-select-sm"
                                                            name="callconnect_subremark_150">
                                                            <option value="">Select remark</option>
                                                            <option value="Option to DND the Patient" <?php echo ($callconnect_subremark_150 === 'Option to DND the Patient') ? 'selected' : ''; ?>>
                                                                Option to DND the Patient</option>
                                                            <option value="Journey Completed" <?php echo ($callconnect_subremark_150 === 'Journey Completed') ? 'selected' : ''; ?>>
                                                                Journey Completed</option>
                                                            <option value="Call Rescheduled by the Patient" <?php echo ($callconnect_subremark_150 === 'Call Rescheduled by the Patient') ? 'selected' : ''; ?>>
                                                                Call Rescheduled by the Patient</option>
                                                            <option value="Wrong Number – DND the Patient" <?php echo ($callconnect_subremark_150 === 'Wrong Number – DND the Patient') ? 'selected' : ''; ?>>
                                                                Wrong Number – DND the Patient</option>
                                                            <option value="Language Barrier" <?php echo ($callconnect_subremark_150 === 'Language Barrier') ? 'selected' : ''; ?>>
                                                                Language Barrier</option>
                                                            <option value="Call Completed" <?php echo ($callconnect_subremark_150 === 'Call Completed') ? 'selected' : ''; ?>>
                                                                Call Completed</option>
                                                            <option value="Call Disconnected by the Patient" <?php echo ($callconnect_subremark_150 === 'Call Disconnected by the Patient') ? 'selected' : ''; ?>>
                                                                Call Disconnected by the Patient</option>
                                                            <option value="Dropout" <?php echo ($callconnect_subremark_150 === 'Dropout') ? 'selected' : ''; ?>>
                                                                Dropout</option>
                                                        </select>
                                                    </div>
                                                    <div id="noresponse_subremarks_150"
                                                        style="display: <?php echo ($day150_call_remark === 'No Response') ? 'block' : 'none'; ?>;">
                                                        <select class="form-select form-select-sm"
                                                            name="noresponse_subremark_150">
                                                            <option value="">Select remark</option>
                                                            <option value="Ringing" <?php echo ($day150_sub_remark === 'Ringing') ? 'selected' : ''; ?>>
                                                                Ringing</option>
                                                            <option value="Call Busy" <?php echo ($day150_sub_remark === 'Call Busy') ? 'selected' : ''; ?>>
                                                                Call Busy</option>
                                                            <option value="Invalid Number" <?php echo ($day150_sub_remark === 'Invalid Number') ? 'selected' : ''; ?>>
                                                                Invalid Number</option>
                                                            <option value="Out of Service" <?php echo ($day150_sub_remark === 'Out of Service') ? 'selected' : ''; ?>>
                                                                Out of Service</option>
                                                            <option value="Switched Off" <?php echo ($day150_sub_remark === 'Switched Off') ? 'selected' : ''; ?>>
                                                                Switched Off</option>
                                                            <option value="Drop out" <?php echo ($day150_sub_remark === 'Drop out') ? 'selected' : ''; ?>>
                                                                Drop out</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit"
                                            class="btn btn-primary <?php echo $day150_data_exists ? 'btn-disabled' : ''; ?>"
                                            <?php echo $day150_data_exists ? 'disabled' : ''; ?>>
                                            <?php echo $day150_data_exists ? 'Already Submitted' : 'Submit Day 150 Follow-up'; ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="day180" role="tabpanel" aria-labelledby="day180-tab">
                            <div class="form-section">
                                <h2 class="section-title">🗓️ Day 180 Follow-up</h2>
                                <form id="day150form" method="POST" action="Digital-educator-follow-up-form-post">
                                    <input type="hidden" name="day" value="180">
                                    <input type="hidden" name="patient_id" value="<?php echo $patientId; ?>">

                                    <!-- Q1 -->
                                    <div class="mb-3">
                                        <label class="form-label">1. How are you feeling now compared to 6 months
                                            ago?</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="feeling_now"
                                                id="feeling_much_better" value="Much better" <?php echo $feeling_now == 'Much better' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="feeling_much_better">Much better – I
                                                feel healthier and more energetic</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="feeling_now"
                                                id="feeling_slightly_better" value="Slightly better" <?php echo $feeling_now == 'Slightly better' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="feeling_slightly_better">Slightly
                                                better – Some improvements, but still facing a few challenges</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="feeling_now"
                                                id="feeling_same" value="About the same" <?php echo $feeling_now == 'About the same' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="feeling_same">About the same – No major
                                                changes noticed</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="feeling_now"
                                                id="feeling_not_better" value="Not feeling better" <?php echo $feeling_now == 'Not feeling better' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="feeling_not_better">Not feeling better
                                                – I’m still struggling with my health</label>
                                        </div>
                                    </div>

                                    <!-- Q2 -->
                                    <div class="mb-3">
                                        <label class="form-label">2. Have the yoga sessions been helpful in managing
                                            your health condition (HF/HTN/Diabetes)?</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="yoga_helpful"
                                                id="yoga_helpful_yes" value="Yes" <?php echo $yoga_helpful == 'Yes' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="yoga_helpful_yes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="yoga_helpful"
                                                id="yoga_helpful_no" value="No" <?php echo $yoga_helpful == 'No' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="yoga_helpful_no">No</label>
                                        </div>
                                        <div class="mt-2" id="yoga_feedback_container"
                                            style="<?php echo $yoga_helpful == 'No' ? 'display:block' : 'display:none' ?>">
                                            <label>→ If No, please share your feedback:</label>
                                            <input type="text" name="yoga_feedback" class="form-control form-control-sm"
                                                value="<?php echo htmlspecialchars($yoga_feedback) ?>">
                                        </div>
                                    </div>

                                    <!-- Q3 -->
                                    <div class="mb-3">
                                        <label class="form-label">3. Were the yoga and diet instructors supportive and
                                            knowledgeable?</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="instructor_support"
                                                id="instructor_yes" value="Yes" <?php echo $instructor_support == 'Yes' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="instructor_yes">Yes – They explained
                                                things clearly and were easy to approach</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="instructor_support"
                                                id="instructor_somewhat" value="Somewhat" <?php echo $instructor_support == 'Somewhat' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="instructor_somewhat">Somewhat – They
                                                helped, but I had some unanswered questions</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="instructor_support"
                                                id="instructor_no" value="No" <?php echo $instructor_support == 'No' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="instructor_no">No – I didn’t find the
                                                sessions helpful</label>
                                        </div>
                                        <div class="mt-2">
                                            <label>→ Feedback:</label>
                                            <input type="text" name="instructor_feedback"
                                                class="form-control form-control-sm"
                                                value="<?php echo htmlspecialchars($instructor_feedback) ?>">
                                        </div>
                                    </div>

                                    <!-- Q4 -->
                                    <div class="mb-3">
                                        <label class="form-label">4. Have the diet plans contributed to improvements in
                                            your health?</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="diet_impact"
                                                id="diet_yes" value="Yes" <?php echo $diet_impact == 'Yes' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="diet_yes">Yes – I’ve seen clear health
                                                benefits</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="diet_impact"
                                                id="diet_somewhat" value="Somewhat" <?php echo $diet_impact == 'Somewhat' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="diet_somewhat">Somewhat – Minor
                                                changes, but not significant</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="diet_impact" id="diet_no"
                                                value="No" <?php echo $diet_impact == 'No' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="diet_no">No – Didn’t see any
                                                impact</label>
                                        </div>
                                        <div class="mt-2">
                                            <label>→ Feedback:</label>
                                            <input type="text" name="diet_feedback" class="form-control form-control-sm"
                                                value="<?php echo htmlspecialchars($diet_feedback) ?>">
                                        </div>
                                    </div>

                                    <!-- Q5 -->
                                    <div class="mb-3">
                                        <label class="form-label">5. Was the dietician/nutritionist accessible for
                                            follow-ups or questions?</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dietician_access"
                                                id="dietician_yes" value="Yes" <?php echo $dietician_access == 'Yes' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="dietician_yes">Yes – I was able to
                                                connect whenever I needed support</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dietician_access"
                                                id="dietician_sometimes" value="Sometimes" <?php echo $dietician_access == 'Sometimes' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="dietician_sometimes">Sometimes – Faced
                                                delays in getting responses</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dietician_access"
                                                id="dietician_no" value="No" <?php echo $dietician_access == 'No' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="dietician_no">No – It was difficult to
                                                reach them</label>
                                        </div>
                                        <div class="mt-2">
                                            <label>→ Feedback:</label>
                                            <input type="text" name="dietician_feedback"
                                                class="form-control form-control-sm"
                                                value="<?php echo htmlspecialchars($dietician_feedback) ?>">
                                        </div>
                                    </div>

                                    <!-- Q6 -->
                                    <div class="mb-3">
                                        <label class="form-label">6. How would you describe your overall experience
                                            during the 6-month program?</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="overall_experience"
                                                id="experience_excellent" value="Excellent" <?php echo $overall_experience == 'Excellent' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="experience_excellent">Excellent – Very
                                                supportive and effective</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="overall_experience"
                                                id="experience_satisfactory" value="Satisfactory" <?php echo $overall_experience == 'Satisfactory' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="experience_satisfactory">Satisfactory –
                                                Helpful, but with more improvement</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="overall_experience"
                                                id="experience_needs" value="Needs Improvement" <?php echo $overall_experience == 'Needs Improvement' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="experience_needs">Needs Improvement – I
                                                expected better results and support</label>
                                        </div>
                                        <div class="mt-2">
                                            <label>Remarks:</label>
                                            <textarea name="experience_remarks" class="form-control"
                                                rows="2"><?php echo htmlspecialchars($experience_remarks) ?></textarea>
                                        </div>
                                    </div>

                                    <!-- Q7 -->
                                    <div class="mb-3">
                                        <label class="form-label">7. Do you have any final feedback or suggestions for
                                            us?</label>
                                        <textarea name="final_feedback" class="form-control"
                                            rows="2"><?php echo htmlspecialchars($final_feedback) ?></textarea>
                                    </div>

                                    <!-- Call Remark -->
                                    <div class="mb-3">
                                        <label class="form-label">Call Remark</label>
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_180"
                                                    id="callremark_call_180" value="Call Connect" <?php echo ($day150_call_remark === 'Call Connect') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_call_180">Call
                                                    Connect</label>
                                            </div>
                                            <div class="form-check form-check-inline checkbox-item">
                                                <input class="form-check-input" type="radio" name="callremark_180"
                                                    id="callremark_no_180" value="No Response" <?php echo ($day150_call_remark === 'No Response') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="callremark_no_180">No
                                                    Response</label>
                                            </div>

                                            <div id="callremark_subremarks_180"
                                                style="<?php echo $day180_call_remark ? 'display:block' : 'display:none' ?>">
                                                <div class="mt-2">
                                                    <label class="form-label">Remarks:</label>
                                                    <div id="callconnect_subremarks_180"
                                                        style="<?php echo $day180_call_remark == 'Call Connect' ? 'display:block' : 'display:none' ?>">
                                                        <select class="form-select form-select-sm"
                                                            name="callconnect_subremark_180">
                                                            <option value="">Select remark</option>
                                                            <option value="Option to DND the Patient" <?php echo $callconnect_subremark_180 == 'Option to DND the Patient' ? 'selected' : '' ?>>Option to DND the Patient
                                                            </option>
                                                            <option value="Journey Completed" <?php echo $callconnect_subremark_180 == 'Journey Completed' ? 'selected' : '' ?>>Journey Completed</option>
                                                            <option value="Call Rescheduled by the Patient" <?php echo $callconnect_subremark_180 == 'Call Rescheduled by the Patient' ? 'selected' : '' ?>>Call Rescheduled by the
                                                                Patient</option>
                                                            <option value="Wrong Number – DND the Patient" <?php echo $callconnect_subremark_180 == 'Wrong Number – DND the Patient' ? 'selected' : '' ?>>Wrong Number – DND the
                                                                Patient</option>
                                                            <option value="Language Barrier" <?php echo $callconnect_subremark_180 == 'Language Barrier' ? 'selected' : '' ?>>Language Barrier</option>
                                                            <option value="Call Completed" <?php echo $callconnect_subremark_180 == 'Call Completed' ? 'selected' : '' ?>>Call Completed</option>
                                                            <option value="Call Disconnected by the Patient" <?php echo $callconnect_subremark_180 == 'Call Disconnected by the Patient' ? 'selected' : '' ?>>Call Disconnected by the
                                                                Patient</option>
                                                            <option value="Dropout" <?php echo $callconnect_subremark_180 == 'Dropout' ? 'selected' : '' ?>>Dropout</option>
                                                        </select>
                                                    </div>
                                                    <div id="noresponse_subremarks_180"
                                                        style="<?php echo $day180_call_remark == 'No Response' ? 'display:block' : 'display:none' ?>">
                                                        <select class="form-select form-select-sm"
                                                            name="noresponse_subremark_180">
                                                            <option value="">Select remark</option>
                                                            <option value="Ringing" <?php echo $noresponse_subremark_180 == 'Ringing' ? 'selected' : '' ?>>Ringing</option>
                                                            <option value="Call Busy" <?php echo $noresponse_subremark_180 == 'Call Busy' ? 'selected' : '' ?>>Call Busy</option>
                                                            <option value="Invalid Number" <?php echo $noresponse_subremark_180 == 'Invalid Number' ? 'selected' : '' ?>>Invalid Number</option>
                                                            <option value="Out of Service" <?php echo $noresponse_subremark_180 == 'Out of Service' ? 'selected' : '' ?>>Out of Service</option>
                                                            <option value="Switched Off" <?php echo $noresponse_subremark_180 == 'Switched Off' ? 'selected' : '' ?>>Switched Off</option>
                                                            <option value="Drop out" <?php echo $noresponse_subremark_180 == 'Drop out' ? 'selected' : '' ?>>Drop out</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="text-center mt-4">
                                        <button type="submit"
                                            class="btn btn-primary <?php echo $day180_data_exists ? 'btn-disabled' : ''; ?>"
                                            <?php echo $day180_data_exists ? 'disabled' : ''; ?>>
                                            <?php echo $day180_data_exists ? 'Already Submitted' : 'Submit Day 180 Follow-up'; ?>
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php'); ?>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Function to set up listeners for a specific day
                function setupCallRemarkListeners(day) {
                    const callConnectRadio = document.getElementById(`callremark_call_${day}`);
                    const noResponseRadio = document.getElementById(`callremark_no_${day}`);
                    const subRemarksContainer = document.getElementById(`callremark_subremarks_${day}`);
                    const callConnectDropdown = document.getElementById(`callconnect_subremarks_${day}`);
                    const noResponseDropdown = document.getElementById(`noresponse_subremarks_${day}`);

                    if (callConnectRadio) {
                        callConnectRadio.addEventListener('change', function () {
                            if (this.checked) {
                                subRemarksContainer.style.display = 'block';
                                callConnectDropdown.style.display = 'block';
                                noResponseDropdown.style.display = 'none';
                                // Reset the value of the other dropdown when hiding
                                noResponseDropdown.querySelector('select').value = '';
                            }
                        });
                    }

                    if (noResponseRadio) {
                        noResponseRadio.addEventListener('change', function () {
                            if (this.checked) {
                                subRemarksContainer.style.display = 'block';
                                callConnectDropdown.style.display = 'none';
                                noResponseDropdown.style.display = 'block';
                                // Reset the value of the other dropdown when hiding
                                callConnectDropdown.querySelector('select').value = '';
                            } else {

                            }
                        });
                    }

                    // Initial state check in case of pre-selected values (e.g., from editing)
                    if (callConnectRadio && callConnectRadio.checked) {
                        subRemarksContainer.style.display = 'block';
                        callConnectDropdown.style.display = 'block';
                        noResponseDropdown.style.display = 'none';
                    } else if (noResponseRadio && noResponseRadio.checked) {
                        subRemarksContainer.style.display = 'block';
                        callConnectDropdown.style.display = 'none';
                        noResponseDropdown.style.display = 'block';
                    } else {
                        subRemarksContainer.style.display = 'none';
                        callConnectDropdown.style.display = 'none';
                        noResponseDropdown.style.display = 'none';
                    }
                }

                // Call the setup function for each day that has call remark fields
                setupCallRemarkListeners(3);
                setupCallRemarkListeners(7);
                setupCallRemarkListeners(15);
                setupCallRemarkListeners(30);
                setupCallRemarkListeners(45);
                setupCallRemarkListeners(60);
                setupCallRemarkListeners(90);
                setupCallRemarkListeners(120);
                setupCallRemarkListeners(150);
                setupCallRemarkListeners(180);

                // --- Other existing JavaScript for Day 3 and Day 7 questions ---

                // Day 3 Medication Adherence
                const day3MedsYes = document.getElementById('day3_meds_yes');
                const day3MedsNo = document.getElementById('day3_meds_no');
                const day3MedsReason = document.getElementById('day3_meds_reason');

                if (day3MedsNo) {
                    day3MedsNo.addEventListener('change', function () {
                        if (this.checked) {
                            day3MedsReason.style.display = 'inline';
                        }
                    });
                }
                if (day3MedsYes) {
                    day3MedsYes.addEventListener('change', function () {
                        if (this.checked) {
                            day3MedsReason.style.display = 'none';
                            day3MedsReason.querySelector('input').value = ''; // Clear reason when 'Yes' is selected
                        }
                    });
                }
                // Initial check for day3_meds
                if (day3MedsNo && day3MedsNo.checked) {
                    day3MedsReason.style.display = 'inline';
                } else if (day3MedsYes && day3MedsYes.checked) {
                    day3MedsReason.style.display = 'none';
                }

                // Day 3 Sugar Monitoring
                const day3SugarYes = document.getElementById('day3_sugar_yes');
                const day3SugarNo = document.getElementById('day3_sugar_no');
                const day3SugarReason = document.getElementById('day3_sugar_reason');

                if (day3SugarNo) {
                    day3SugarNo.addEventListener('change', function () {
                        if (this.checked) {
                            day3SugarReason.style.display = 'inline';
                        }
                    });
                }
                if (day3SugarYes) {
                    day3SugarYes.addEventListener('change', function () {
                        if (this.checked) {
                            day3SugarReason.style.display = 'none';
                            day3SugarReason.querySelector('input').value = '';
                        }
                    });
                }
                // Initial check for day3_sugar
                if (day3SugarNo && day3SugarNo.checked) {
                    day3SugarReason.style.display = 'inline';
                } else if (day3SugarYes && day3SugarYes.checked) {
                    day3SugarReason.style.display = 'none';
                }

                // Day 3 BP Monitoring
                const day3BpYes = document.getElementById('day3_bp_yes');
                const day3BpNo = document.getElementById('day3_bp_no');
                const day3BpReason = document.getElementById('day3_bp_reason');

                if (day3BpNo) {
                    day3BpNo.addEventListener('change', function () {
                        if (this.checked) {
                            day3BpReason.style.display = 'inline';
                        }
                    });
                }
                if (day3BpYes) {
                    day3BpYes.addEventListener('change', function () {
                        if (this.checked) {
                            day3BpReason.style.display = 'none';
                            day3BpReason.querySelector('input').value = '';
                        }
                    });
                }
                // Initial check for day3_bp
                if (day3BpNo && day3BpNo.checked) {
                    day3BpReason.style.display = 'inline';
                } else if (day3BpYes && day3BpYes.checked) {
                    day3BpReason.style.display = 'none';
                }

                // Day 3 Fluid Monitoring
                const day3FluidYes = document.getElementById('day3_fluid_yes');
                const day3FluidNo = document.getElementById('day3_fluid_no');
                const day3FluidReason = document.getElementById('day3_fluid_reason');

                if (day3FluidNo) {
                    day3FluidNo.addEventListener('change', function () {
                        if (this.checked) {
                            day3FluidReason.style.display = 'inline';
                        }
                    });
                }
                if (day3FluidYes) {
                    day3FluidYes.addEventListener('change', function () {
                        if (this.checked) {
                            day3FluidReason.style.display = 'none';
                            day3FluidReason.querySelector('input').value = '';
                        }
                    });
                }
                // Initial check for day3_fluid
                if (day3FluidNo && day3FluidNo.checked) {
                    day3FluidReason.style.display = 'inline';
                } else if (day3FluidYes && day3FluidYes.checked) {
                    day3FluidReason.style.display = 'none';
                }


                // Day 7 Doctor Visit
                const day7DoctorYes = document.getElementById('day7_doctor_yes');
                const day7DoctorNo = document.getElementById('day7_doctor_no');
                const day7DoctorReason = document.getElementById('day7_doctor_reason');

                if (day7DoctorNo) {
                    day7DoctorNo.addEventListener('change', function () {
                        if (this.checked) {
                            day7DoctorReason.style.display = 'inline';
                        }
                    });
                }
                if (day7DoctorYes) {
                    day7DoctorYes.addEventListener('change', function () {
                        if (this.checked) {
                            day7DoctorReason.style.display = 'none';
                            day7DoctorReason.querySelector('input').value = '';
                        }
                    });
                }
                // Initial check for day7_doctor
                if (day7DoctorNo && day7DoctorNo.checked) {
                    day7DoctorReason.style.display = 'inline';
                } else if (day7DoctorYes && day7DoctorYes.checked) {
                    day7DoctorReason.style.display = 'none';
                }

                // Day 7 Medication Adherence
                const day7MedsYes = document.getElementById('day7_meds_yes');
                const day7MedsNo = document.getElementById('day7_meds_no');
                const day7MedsReason = document.getElementById('day7_meds_reason');

                if (day7MedsNo) {
                    day7MedsNo.addEventListener('change', function () {
                        if (this.checked) {
                            day7MedsReason.style.display = 'inline';
                        }
                    });
                }
                if (day7MedsYes) {
                    day7MedsYes.addEventListener('change', function () {
                        if (this.checked) {
                            day7MedsReason.style.display = 'none';
                            day7MedsReason.querySelector('input').value = '';
                        }
                    });
                }
                // Initial check for day7_meds
                if (day7MedsNo && day7MedsNo.checked) {
                    day7MedsReason.style.display = 'inline';
                } else if (day7MedsYes && day7MedsYes.checked) {
                    day7MedsReason.style.display = 'none';
                }


                // Day 7 BP Reading
                const day7BpValYes = document.getElementById('day7_bp_yes');
                const day7BpValNo = document.getElementById('day7_bp_no');
                const day7BpValue = document.getElementById('day7_bp_value');
                const day7BpRemarks = document.getElementById('day7_bp_remarks');

                if (day7BpValYes) {
                    day7BpValYes.addEventListener('change', function () {
                        if (this.checked) {
                            day7BpValue.style.display = 'inline';
                            day7BpRemarks.style.display = 'none';
                            day7BpRemarks.querySelector('input').value = '';
                        }
                    });
                }
                if (day7BpValNo) {
                    day7BpValNo.addEventListener('change', function () {
                        if (this.checked) {
                            day7BpValue.style.display = 'none';
                            day7BpValue.querySelector('input').value = '';
                            day7BpRemarks.style.display = 'inline';
                        }
                    });
                }
                // Initial check for day7_bp
                if (day7BpValYes && day7BpValYes.checked) {
                    day7BpValue.style.display = 'inline';
                    day7BpRemarks.style.display = 'none';
                } else if (day7BpValNo && day7BpValNo.checked) {
                    day7BpValue.style.display = 'none';
                    day7BpRemarks.style.display = 'inline';
                }


                // Day 7 Yoga Schedule
                const day7YogaScheduleYes = document.getElementById('day7_yoga_schedule_yes');
                const day7YogaScheduleNo = document.getElementById('day7_yoga_schedule_no');
                const day7YogaScheduleReason = document.getElementById('day7_yoga_schedule_reason');

                if (day7YogaScheduleNo) {
                    day7YogaScheduleNo.addEventListener('change', function () {
                        if (this.checked) {
                            day7YogaScheduleReason.style.display = 'inline';
                        }
                    });
                }
                if (day7YogaScheduleYes) {
                    day7YogaScheduleYes.addEventListener('change', function () {
                        if (this.checked) {
                            day7YogaScheduleReason.style.display = 'none';
                            day7YogaScheduleReason.querySelector('input').value = '';
                        }
                    });
                }
                // Initial check for day7_yoga_schedule
                if (day7YogaScheduleNo && day7YogaScheduleNo.checked) {
                    day7YogaScheduleReason.style.display = 'inline';
                } else if (day7YogaScheduleYes && day7YogaScheduleYes.checked) {
                    day7YogaScheduleReason.style.display = 'none';
                }

                // Day 7 Yoga Tried & Difficulties
                const day7YogaTriedYes = document.getElementById('day7_yoga_tried_yes');
                const day7YogaTriedNo = document.getElementById('day7_yoga_tried_no');
                const day7YogaTriedDifficult = document.getElementById('day7_yoga_tried_difficult');
                const day7YogaDifficultYes = document.getElementById('day7_yoga_difficult_yes');
                const day7YogaDifficultReason = document.getElementById('day7_yoga_difficult_reason');


                if (day7YogaTriedYes) {
                    day7YogaTriedYes.addEventListener('change', function () {
                        if (this.checked) {
                            day7YogaTriedDifficult.style.display = 'inline';
                        }
                    });
                }
                if (day7YogaTriedNo) {
                    day7YogaTriedNo.addEventListener('change', function () {
                        if (this.checked) {
                            day7YogaTriedDifficult.style.display = 'none';
                            day7YogaDifficultYes.checked = false; // Uncheck difficulties
                            day7YogaDifficultReason.style.display = 'none';
                            day7YogaDifficultReason.querySelector('input').value = '';
                        }
                    });
                }
                if (day7YogaDifficultYes) {
                    day7YogaDifficultYes.addEventListener('change', function () {
                        if (this.checked) {
                            day7YogaDifficultReason.style.display = 'inline';
                        } else {
                            day7YogaDifficultReason.style.display = 'none';
                            day7YogaDifficultReason.querySelector('input').value = '';
                        }
                    });
                }

                // Initial check for day7_yoga_tried
                if (day7YogaTriedYes && day7YogaTriedYes.checked) {
                    day7YogaTriedDifficult.style.display = 'inline';
                    if (day7YogaDifficultYes && day7YogaDifficultYes.checked) {
                        day7YogaDifficultReason.style.display = 'inline';
                    }
                } else if (day7YogaTriedNo && day7YogaTriedNo.checked) {
                    day7YogaTriedDifficult.style.display = 'none';
                }
                const yesRadio = document.getElementById("day7_yoga_required_yes");
                const noRadio = document.getElementById("day7_yoga_required_no");
                const plannedDateSpan = document.getElementById("day7_yoga_planned_date");
                const reasonSpan = document.getElementById("day7_yoga_required_reason");

                function toggleYogaFields() {
                    if (yesRadio.checked) {
                        plannedDateSpan.style.display = "inline";
                        reasonSpan.style.display = "none";
                    } else if (noRadio.checked) {
                        plannedDateSpan.style.display = "none";
                        reasonSpan.style.display = "inline";
                    } else {
                        plannedDateSpan.style.display = "none";
                        reasonSpan.style.display = "none";
                    }
                }

                // Initialize on page load
                toggleYogaFields();

                // Attach event listeners
                yesRadio.addEventListener("change", toggleYogaFields);
                noRadio.addEventListener("change", toggleYogaFields);
                // 1. Medicines taken - show reason if No
                const medsYes = document.getElementById("day15_meds_yes");
                const medsNo = document.getElementById("day15_meds_no");
                const medsReason = document.getElementById("day15_meds_reason");

                medsYes.addEventListener("change", () => medsReason.style.display = "none");
                medsNo.addEventListener("change", () => medsReason.style.display = "inline");

                const stockYes = document.getElementById("day15_stock_yes");
                const stockNo = document.getElementById("day15_stock_no");
                const stockMeds = document.getElementById("day15_meds_stock");

                stockYes.addEventListener("change", () => {
                    if (stockYes.checked) {
                        stockMeds.style.display = "none";
                    }
                });

                stockNo.addEventListener("change", () => {
                    if (stockNo.checked) {
                        stockMeds.style.display = "inline";
                    }
                });


                // 2. BP Reading - show BP input only if Yes is selected
                const bpYes = document.getElementById("day15_bp_yes");
                const bpNo = document.getElementById("day15_bp_no");
                const bpValue = document.getElementById("day15_bp_value");

                bpYes.addEventListener("change", () => bpValue.style.display = "inline");
                bpNo.addEventListener("change", () => bpValue.style.display = "none");

                // 3. RBS - show value if Yes, reason if No
                const rbsYes = document.getElementById("day15_rbs_yes");
                const rbsNo = document.getElementById("day15_rbs_no");
                const rbsValue = document.getElementById("day15_rbs_value");
                const rbsReason = document.getElementById("day15_rbs_reason");

                rbsYes.addEventListener("change", () => {
                    rbsValue.style.display = "inline";
                    rbsReason.style.display = "none";
                });

                rbsNo.addEventListener("change", () => {
                    rbsValue.style.display = "none";
                    rbsReason.style.display = "inline";
                });

                // 4. Yoga attended - show reason if No
                const yogaYes = document.getElementById("day15_yoga_yes");
                const yogaNo = document.getElementById("day15_yoga_no");
                const yogaReason = document.getElementById("day15_yoga_reason");

                yogaYes.addEventListener("change", () => yogaReason.style.display = "none");
                yogaNo.addEventListener("change", () => yogaReason.style.display = "inline");

                // 5. Call Remark - handle sub-options visibility
                const callConnect = document.getElementById("callremark_call_15");
                const noResponse = document.getElementById("callremark_no_15");
                const callRemarkContainer = document.getElementById("callremark_subremarks_15");
                const callConnectSub = document.getElementById("callconnect_subremarks_15");
                const noResponseSub = document.getElementById("noresponse_subremarks_15");

                callConnect.addEventListener("change", () => {
                    callRemarkContainer.style.display = "block";
                    callConnectSub.style.display = "block";
                    noResponseSub.style.display = "none";
                });

                noResponse.addEventListener("change", () => {
                    callRemarkContainer.style.display = "block";
                    callConnectSub.style.display = "none";
                    noResponseSub.style.display = "block";
                });
                // 1. Medicines taken - show reason if No
                const medsYes1 = document.getElementById("day30_meds_yes");
                const medsNo1 = document.getElementById("day30_meds_no");
                const medsReason1 = document.getElementById("day30_meds_reason");

                medsYes1.addEventListener("change", () => medsReason1.style.display = "none");
                medsNo1.addEventListener("change", () => medsReason1.style.display = "inline");

                const stockYes1 = document.getElementById("day30_stock_yes");
                const stockNo1 = document.getElementById("day30_stock_no");
                const stockMeds1 = document.getElementById("day30_meds_stock");

                stockYes1.addEventListener("change", () => {
                    if (stockYes1.checked) {
                        stockMeds1.style.display = "none";
                    }
                });

                stockNo1.addEventListener("change", () => {
                    if (stockNo1.checked) {
                        stockMeds1.style.display = "inline";
                    }
                });


                // 2. BP Reading - show BP input only if Yes is selected
                const bpYes1 = document.getElementById("day30_bp_yes");
                const bpNo1 = document.getElementById("day30_bp_no");
                const bpValue1 = document.getElementById("day30_bp_value");

                bpYes1.addEventListener("change", () => bpValue1.style.display = "inline");
                bpNo1.addEventListener("change", () => bpValue1.style.display = "none");

                // 3. RBS - show value if Yes, reason if No
                const rbsYes1 = document.getElementById("day30_rbs_yes");
                const rbsNo1 = document.getElementById("day30_rbs_no");
                const rbsValue1 = document.getElementById("day30_rbs_value");
                const rbsReason1 = document.getElementById("day30_rbs_reason");

                rbsYes1.addEventListener("change", () => {
                    rbsValue1.style.display = "inline";
                    rbsReason1.style.display = "none";
                });

                rbsNo1.addEventListener("change", () => {
                    rbsValue1.style.display = "none";
                    rbsReason1.style.display = "inline";
                });

                // 4. Yoga attended - show reason if No
                const yogaYes1 = document.getElementById("day30_yoga_yes");
                const yogaNo1 = document.getElementById("day30_yoga_no");
                const yogaReason1 = document.getElementById("day30_yoga_reason");

                yogaYes1.addEventListener("change", () => yogaReason1.style.display = "none");
                yogaNo1.addEventListener("change", () => yogaReason.style.display = "inline");

                // 5. Call Remark - handle sub-options visibility
                const callConnect1 = document.getElementById("callremark_call_30");
                const noResponse1 = document.getElementById("callremark_no_30");
                const callRemarkContainer1 = document.getElementById("callremark_subremarks_30");
                const callConnectSub1 = document.getElementById("callconnect_subremarks_30");
                const noResponseSub1 = document.getElementById("noresponse_subremarks_30");

                callConnect1.addEventListener("change", () => {
                    callRemarkContainer1.style.display = "block";
                    callConnectSub1.style.display = "block";
                    noResponseSub1.style.display = "none";
                });

                noResponse1.addEventListener("change", () => {
                    callRemarkContainer1.style.display = "block";
                    callConnectSub1.style.display = "none";
                    noResponseSub1.style.display = "block";
                });
                // day45

                // Day 45 Doctor Visit
                const day45DoctorYes = document.getElementById('day45_doctor_yes');
                const day45DoctorNo = document.getElementById('day45_doctor_no');
                const day45DoctorReason = document.getElementById('day45_doctor_reason');

                if (day45DoctorNo) {
                    day45DoctorNo.addEventListener('change', function () {
                        if (this.checked) {
                            day45DoctorReason.style.display = 'inline';
                        }
                    });
                }
                if (day45DoctorYes) {
                    day45DoctorYes.addEventListener('change', function () {
                        if (this.checked) {
                            day45DoctorReason.style.display = 'none';
                            day45DoctorReason.querySelector('input').value = '';
                        }
                    });
                }
                // Initial check for day45_doctor
                if (day45DoctorNo && day45DoctorNo.checked) {
                    day45DoctorReason.style.display = 'inline';
                } else if (day45DoctorYes && day45DoctorYes.checked) {
                    day45DoctorReason.style.display = 'none';
                }

                // Day 45 Medication Adherence
                const day45MedsYes = document.getElementById('day45_meds_yes');
                const day45MedsNo = document.getElementById('day45_meds_no');
                const day45MedsReason = document.getElementById('day45_meds_reason');

                if (day45MedsNo) {
                    day45MedsNo.addEventListener('change', function () {
                        if (this.checked) {
                            day45MedsReason.style.display = 'inline';
                        }
                    });
                }
                if (day45MedsYes) {
                    day45MedsYes.addEventListener('change', function () {
                        if (this.checked) {
                            day45MedsReason.style.display = 'none';
                            day45MedsReason.querySelector('input').value = '';
                        }
                    });
                }
                // Initial check for day45_meds
                if (day45MedsNo && day45MedsNo.checked) {
                    day45MedsReason.style.display = 'inline';
                } else if (day45MedsYes && day45MedsYes.checked) {
                    day45MedsReason.style.display = 'none';
                }


                // Day 45 BP Reading
                const day45BpValYes = document.getElementById('day45_bp_yes');
                const day45BpValNo = document.getElementById('day45_bp_no');
                const day45BpValue = document.getElementById('day45_bp_value');
                const day45BpRemarks = document.getElementById('day45_bp_remarks');

                if (day45BpValYes) {
                    day45BpValYes.addEventListener('change', function () {
                        if (this.checked) {
                            day45BpValue.style.display = 'inline';
                            day45BpRemarks.style.display = 'none';
                            day45BpRemarks.querySelector('input').value = '';
                        }
                    });
                }
                if (day45BpValNo) {
                    day45BpValNo.addEventListener('change', function () {
                        if (this.checked) {
                            day45BpValue.style.display = 'none';
                            day45BpValue.querySelector('input').value = '';
                            day45BpRemarks.style.display = 'inline';
                        }
                    });
                }
                // Initial check for day45_bp
                if (day45BpValYes && day45BpValYes.checked) {
                    day45BpValue.style.display = 'inline';
                    day45BpRemarks.style.display = 'none';
                } else if (day45BpValNo && day45BpValNo.checked) {
                    day45BpValue.style.display = 'none';
                    day45BpRemarks.style.display = 'inline';
                }


                // Day 45 Yoga Schedule
                const day45YogaScheduleYes = document.getElementById('day45_yoga_schedule_yes');
                const day45YogaScheduleNo = document.getElementById('day45_yoga_schedule_no');
                const day45YogaScheduleReason = document.getElementById('day45_yoga_schedule_reason');

                if (day45YogaScheduleNo) {
                    day45YogaScheduleNo.addEventListener('change', function () {
                        if (this.checked) {
                            day45YogaScheduleReason.style.display = 'inline';
                        }
                    });
                }
                if (day45YogaScheduleYes) {
                    day45YogaScheduleYes.addEventListener('change', function () {
                        if (this.checked) {
                            day45YogaScheduleReason.style.display = 'none';
                            day45YogaScheduleReason.querySelector('input').value = '';
                        }
                    });
                }
                // Initial check for day45_yoga_schedule
                if (day45YogaScheduleNo && day45YogaScheduleNo.checked) {
                    day45YogaScheduleReason.style.display = 'inline';
                } else if (day45YogaScheduleYes && day45YogaScheduleYes.checked) {
                    day45YogaScheduleReason.style.display = 'none';
                }

                // Day 45 Yoga Tried & Difficulties
                const day45YogaTriedYes = document.getElementById('day45_yoga_tried_yes');
                const day45YogaTriedNo = document.getElementById('day45_yoga_tried_no');
                const day45YogaTriedDifficult = document.getElementById('day45_yoga_tried_difficult');
                const day45YogaDifficultYes = document.getElementById('day45_yoga_difficult_yes');
                const day45YogaDifficultReason = document.getElementById('day45_yoga_difficult_reason');


                if (day45YogaTriedYes) {
                    day45YogaTriedYes.addEventListener('change', function () {
                        if (this.checked) {
                            day45YogaTriedDifficult.style.display = 'inline';
                        }
                    });
                }
                if (day45YogaTriedNo) {
                    day45YogaTriedNo.addEventListener('change', function () {
                        if (this.checked) {
                            day45YogaTriedDifficult.style.display = 'none';
                            day45YogaDifficultYes.checked = false; // Uncheck difficulties
                            day45YogaDifficultReason.style.display = 'none';
                            day45YogaDifficultReason.querySelector('input').value = '';
                        }
                    });
                }
                if (day45YogaDifficultYes) {
                    day45YogaDifficultYes.addEventListener('change', function () {
                        if (this.checked) {
                            day45YogaDifficultReason.style.display = 'inline';
                        } else {
                            day45YogaDifficultReason.style.display = 'none';
                            day45YogaDifficultReason.querySelector('input').value = '';
                        }
                    });
                }

                // Initial check for day45_yoga_tried
                if (day45YogaTriedYes && day45YogaTriedYes.checked) {
                    day45YogaTriedDifficult.style.display = 'inline';
                    if (day45YogaDifficultYes && day45YogaDifficultYes.checked) {
                        day45YogaDifficultReason.style.display = 'inline';
                    }
                } else if (day45YogaTriedNo && day45YogaTriedNo.checked) {
                    day45YogaTriedDifficult.style.display = 'none';
                }
                const yesRadio45 = document.getElementById("day45_yoga_required_yes");
                const noRadio45 = document.getElementById("day45_yoga_required_no");
                const plannedDateSpan45 = document.getElementById("day45_yoga_planned_date");
                const reasonSpan45 = document.getElementById("day45_yoga_required_reason");

                function toggleYogaFields45() {
                    if (yesRadio45.checked) {
                        plannedDateSpan45.style.display = "inline";
                        reasonSpan45.style.display = "none";
                    } else if (noRadio45.checked) {
                        plannedDateSpan45.style.display = "none";
                        reasonSpan45.style.display = "inline";
                    } else {
                        plannedDateSpan45.style.display = "none";
                        reasonSpan45.style.display = "none";
                    }
                }

                // Initialize on page load
                toggleYogaFields45();

                // Attach event listeners
                yesRadio45.addEventListener("change", toggleYogaFields45);
                noRadio45.addEventListener("change", toggleYogaFields45);

                const day60_meds_yes = document.getElementById('day60_meds_yes');
                const day60_meds_no = document.getElementById('day60_meds_no');
                const day60_meds_reason = document.getElementById('day60_meds_reason');

                function toggleYogaFields60() {
                    if (day60_meds_no.checked) {
                        day60_meds_reason.style.display = "inline";
                    } else {
                        day60_meds_reason.style.display = "none";
                    }
                }

                // Initialize on page load
                toggleYogaFields60();

                // Attach event listeners
                day60_meds_yes.addEventListener("change", toggleYogaFields60);
                day60_meds_no.addEventListener("change", toggleYogaFields60);

                const day60_bp_yes = document.getElementById('day60_bp_yes');
                const day60_bp_no = document.getElementById('day60_bp_no');
                const day60_bp_value = document.getElementById('day60_bp_value');

                function toggleBPField60() {
                    if (day60_bp_yes.checked) {
                        day60_bp_value.style.display = "inline";
                    } else {
                        day60_bp_value.style.display = "none";
                    }
                }

                // Initialize on page load
                window.addEventListener('DOMContentLoaded', toggleBPField60);

                // Attach event listeners
                day60_bp_yes.addEventListener("change", toggleBPField60);
                day60_bp_no.addEventListener("change", toggleBPField60);
            });

            const day60_rbs_yes = document.getElementById('day60_rbs_yes');
            const day60_rbs_no = document.getElementById('day60_rbs_no');
            const day60_rbs_value = document.getElementById('day60_rbs_value');

            function toggleRBSField60() {
                if (day60_rbs_yes.checked) {
                    day60_rbs_value.style.display = "inline";
                } else {
                    day60_rbs_value.style.display = "none";
                }
            }

            // Initialize on page load
            window.addEventListener('DOMContentLoaded', toggleRBSField60);

            // Attach event listeners
            day60_rbs_yes.addEventListener("change", toggleRBSField60);
            day60_rbs_no.addEventListener("change", toggleRBSField60);

            const day60_hba1c_yes = document.getElementById('day60_hba1c_yes');
            const day60_hba1c_no = document.getElementById('day60_hba1c_no');
            const day60_hba1c_value = document.getElementById('day60_hba1c_value');
            const day60_hba1c_last = document.getElementById('day60_hba1c_last');

            function toggleHbA1cFields60() {
                if (day60_hba1c_yes.checked) {
                    day60_hba1c_value.style.display = "inline";
                    day60_hba1c_last.style.display = "none";
                } else if (day60_hba1c_no.checked) {
                    day60_hba1c_value.style.display = "none";
                    day60_hba1c_last.style.display = "inline";
                } else {
                    day60_hba1c_value.style.display = "none";
                    day60_hba1c_last.style.display = "none";
                }
            }

            // Initialize on page load
            window.addEventListener('DOMContentLoaded', toggleHbA1cFields60);

            // Attach event listeners
            day60_hba1c_yes.addEventListener("change", toggleHbA1cFields60);
            day60_hba1c_no.addEventListener("change", toggleHbA1cFields60);

            const day60_challenges_yes = document.getElementById('day60_challenges_yes');
            const day60_challenges_no = document.getElementById('day60_challenges_no');
            const day60_challenges_reason = document.getElementById('day60_challenges_reason');

            function toggleDietChallengeField60() {
                if (day60_challenges_yes.checked) {
                    day60_challenges_reason.style.display = "inline";
                } else {
                    day60_challenges_reason.style.display = "none";
                }
            }

            // Initialize on page load
            window.addEventListener('DOMContentLoaded', toggleDietChallengeField60);

            // Attach event listeners
            day60_challenges_yes.addEventListener("change", toggleDietChallengeField60);
            day60_challenges_no.addEventListener("change", toggleDietChallengeField60);

            const day60_monitor_yes = document.getElementById('day60_monitor_yes');
            const day60_monitor_no = document.getElementById('day60_monitor_no');
            const day60_monitor_reason = document.getElementById('day60_monitor_reason');

            function toggleFluidMonitorField60() {
                if (day60_monitor_no.checked) {
                    day60_monitor_reason.style.display = "inline";
                } else {
                    day60_monitor_reason.style.display = "none";
                }
            }

            // Initialize on page load
            window.addEventListener('DOMContentLoaded', toggleFluidMonitorField60);

            // Attach event listeners
            day60_monitor_yes.addEventListener("change", toggleFluidMonitorField60);
            day60_monitor_no.addEventListener("change", toggleFluidMonitorField60);

            const day60_doctor_yes = document.getElementById('day60_doctor_yes');
            const day60_doctor_no = document.getElementById('day60_doctor_no');
            const day60_doctor_reason = document.getElementById('day60_doctor_reason');

            function toggleDoctorFollowupField60() {
                if (day60_doctor_no.checked) {
                    day60_doctor_reason.style.display = "inline";
                } else {
                    day60_doctor_reason.style.display = "none";
                }
            }

            // Initialize on page load
            window.addEventListener('DOMContentLoaded', toggleDoctorFollowupField60);

            // Attach event listeners
            day60_doctor_yes.addEventListener("change", toggleDoctorFollowupField60);
            day60_doctor_no.addEventListener("change", toggleDoctorFollowupField60);

            const day90DoctorYes = document.getElementById('day90_doctor_yes');
            const day90DoctorNo = document.getElementById('day90_doctor_no');
            const day90DoctorReason = document.getElementById('day90_doctor_reason');

            if (day90DoctorNo) {
                day90DoctorNo.addEventListener('change', function () {
                    if (this.checked) {
                        day90DoctorReason.style.display = 'inline';
                    }
                });
            }
            if (day90DoctorYes) {
                day90DoctorYes.addEventListener('change', function () {
                    if (this.checked) {
                        day90DoctorReason.style.display = 'none';
                        day90DoctorReason.querySelector('input').value = '';
                    }
                });
            }
            // Initial check for day90_doctor
            if (day90DoctorNo && day90DoctorNo.checked) {
                day90DoctorReason.style.display = 'inline';
            } else if (day90DoctorYes && day90DoctorYes.checked) {
                day90DoctorReason.style.display = 'none';
            }

            // Day 90 Medication Adherence
            const day90MedsYes = document.getElementById('day90_meds_yes');
            const day90MedsNo = document.getElementById('day90_meds_no');
            const day90MedsReason = document.getElementById('day90_meds_reason');

            if (day90MedsNo) {
                day90MedsNo.addEventListener('change', function () {
                    if (this.checked) {
                        day90MedsReason.style.display = 'inline';
                    }
                });
            }
            if (day90MedsYes) {
                day90MedsYes.addEventListener('change', function () {
                    if (this.checked) {
                        day90MedsReason.style.display = 'none';
                        day90MedsReason.querySelector('input').value = '';
                    }
                });
            }
            // Initial check for day90_meds
            if (day90MedsNo && day90MedsNo.checked) {
                day90MedsReason.style.display = 'inline';
            } else if (day90MedsYes && day90MedsYes.checked) {
                day90MedsReason.style.display = 'none';
            }


            // Day 90 BP Reading
            const day90BpValYes = document.getElementById('day90_bp_yes');
            const day90BpValNo = document.getElementById('day90_bp_no');
            const day90BpValue = document.getElementById('day90_bp_value');
            const day90BpRemarks = document.getElementById('day90_bp_remarks');

            if (day90BpValYes) {
                day90BpValYes.addEventListener('change', function () {
                    if (this.checked) {
                        day90BpValue.style.display = 'inline';
                        day90BpRemarks.style.display = 'none';
                        day90BpRemarks.querySelector('input').value = '';
                    }
                });
            }
            if (day90BpValNo) {
                day90BpValNo.addEventListener('change', function () {
                    if (this.checked) {
                        day90BpValue.style.display = 'none';
                        day90BpValue.querySelector('input').value = '';
                        day90BpRemarks.style.display = 'inline';
                    }
                });
            }
            // Initial check for day90_bp
            if (day90BpValYes && day90BpValYes.checked) {
                day90BpValue.style.display = 'inline';
                day90BpRemarks.style.display = 'none';
            } else if (day90BpValNo && day90BpValNo.checked) {
                day90BpValue.style.display = 'none';
                day90BpRemarks.style.display = 'inline';
            }


            // Day 90 Yoga Schedule
            const day90YogaScheduleYes = document.getElementById('day90_yoga_schedule_yes');
            const day90YogaScheduleNo = document.getElementById('day90_yoga_schedule_no');
            const day90YogaScheduleReason = document.getElementById('day90_yoga_schedule_reason');

            if (day90YogaScheduleNo) {
                day90YogaScheduleNo.addEventListener('change', function () {
                    if (this.checked) {
                        day90YogaScheduleReason.style.display = 'inline';
                    }
                });
            }
            if (day90YogaScheduleYes) {
                day90YogaScheduleYes.addEventListener('change', function () {
                    if (this.checked) {
                        day90YogaScheduleReason.style.display = 'none';
                        day90YogaScheduleReason.querySelector('input').value = '';
                    }
                });
            }
            // Initial check for day90_yoga_schedule
            if (day90YogaScheduleNo && day90YogaScheduleNo.checked) {
                day90YogaScheduleReason.style.display = 'inline';
            } else if (day90YogaScheduleYes && day90YogaScheduleYes.checked) {
                day90YogaScheduleReason.style.display = 'none';
            }

            // Day 90 Yoga Tried & Difficulties
            const day90YogaTriedYes = document.getElementById('day90_yoga_tried_yes');
            const day90YogaTriedNo = document.getElementById('day90_yoga_tried_no');
            const day90YogaTriedDifficult = document.getElementById('day90_yoga_tried_difficult');
            const day90YogaDifficultYes = document.getElementById('day90_yoga_difficult_yes');
            const day90YogaDifficultReason = document.getElementById('day90_yoga_difficult_reason');


            if (day90YogaTriedYes) {
                day90YogaTriedYes.addEventListener('change', function () {
                    if (this.checked) {
                        day90YogaTriedDifficult.style.display = 'inline';
                    }
                });
            }
            if (day90YogaTriedNo) {
                day90YogaTriedNo.addEventListener('change', function () {
                    if (this.checked) {
                        day90YogaTriedDifficult.style.display = 'none';
                        day90YogaDifficultYes.checked = false; // Uncheck difficulties
                        day90YogaDifficultReason.style.display = 'none';
                        day90YogaDifficultReason.querySelector('input').value = '';
                    }
                });
            }
            if (day90YogaDifficultYes) {
                day90YogaDifficultYes.addEventListener('change', function () {
                    if (this.checked) {
                        day90YogaDifficultReason.style.display = 'inline';
                    } else {
                        day90YogaDifficultReason.style.display = 'none';
                        day90YogaDifficultReason.querySelector('input').value = '';
                    }
                });
            }

            // Initial check for day90_yoga_tried
            if (day90YogaTriedYes && day90YogaTriedYes.checked) {
                day90YogaTriedDifficult.style.display = 'inline';
                if (day90YogaDifficultYes && day90YogaDifficultYes.checked) {
                    day90YogaDifficultReason.style.display = 'inline';
                }
            } else if (day90YogaTriedNo && day90YogaTriedNo.checked) {
                day90YogaTriedDifficult.style.display = 'none';
            }
            const yesRadio90 = document.getElementById("day90_yoga_required_yes");
            const noRadio90 = document.getElementById("day90_yoga_required_no");
            const plannedDateSpan90 = document.getElementById("day90_yoga_planned_date");
            const reasonSpan90 = document.getElementById("day90_yoga_required_reason");

            function toggleYogaFields90() {
                if (yesRadio90.checked) {
                    plannedDateSpan90.style.display = "inline";
                    reasonSpan90.style.display = "none";
                } else if (noRadio90.checked) {
                    plannedDateSpan90.style.display = "none";
                    reasonSpan90.style.display = "inline";
                } else {
                    plannedDateSpan90.style.display = "none";
                    reasonSpan90.style.display = "none";
                }
            }

            // Initialize on page load
            toggleYogaFields90();

            // Attach event listeners
            yesRadio90.addEventListener("change", toggleYogaFields90);
            noRadio90.addEventListener("change", toggleYogaFields90);

            const day120_meds_yes = document.getElementById('day120_meds_yes');
            const day120_meds_no = document.getElementById('day120_meds_no');
            const day120_meds_reason = document.getElementById('day120_meds_reason');

            function toggleYogaFields120() {
                if (day120_meds_no.checked) {
                    day120_meds_reason.style.display = "inline";
                } else {
                    day120_meds_reason.style.display = "none";
                }
            }

            // Initialize on page load
            toggleYogaFields120();

            // Attach event listeners
            day120_meds_yes.addEventListener("change", toggleYogaFields120);
            day120_meds_no.addEventListener("change", toggleYogaFields120);

            const day120_bp_yes = document.getElementById('day120_bp_yes');
            const day120_bp_no = document.getElementById('day120_bp_no');
            const day120_bp_value = document.getElementById('day120_bp_value');

            function toggleBPField120() {
                if (day120_bp_yes.checked) {
                    day120_bp_value.style.display = "inline";
                } else {
                    day120_bp_value.style.display = "none";
                }
            }

            // Initialize on page load
            window.addEventListener('DOMContentLoaded', toggleBPField120);

            // Attach event listeners
            day120_bp_yes.addEventListener("change", toggleBPField120);
            day120_bp_no.addEventListener("change", toggleBPField120);

            const day120_rbs_yes = document.getElementById('day120_rbs_yes');
            const day120_rbs_no = document.getElementById('day120_rbs_no');
            const day120_rbs_value = document.getElementById('day120_rbs_value');

            function toggleRBSField120() {
                if (day120_rbs_yes.checked) {
                    day120_rbs_value.style.display = "inline";
                } else {
                    day120_rbs_value.style.display = "none";
                }
            }

            // Initialize on page load
            window.addEventListener('DOMContentLoaded', toggleRBSField120);

            // Attach event listeners
            day120_rbs_yes.addEventListener("change", toggleRBSField120);
            day120_rbs_no.addEventListener("change", toggleRBSField120);

            const day120_hba1c_yes = document.getElementById('day120_hba1c_yes');
            const day120_hba1c_no = document.getElementById('day120_hba1c_no');
            const day120_hba1c_value = document.getElementById('day120_hba1c_value');
            const day120_hba1c_last = document.getElementById('day120_hba1c_last');

            function toggleHbA1cFields120() {
                if (day120_hba1c_yes.checked) {
                    day120_hba1c_value.style.display = "inline";
                    day120_hba1c_last.style.display = "none";
                } else if (day120_hba1c_no.checked) {
                    day120_hba1c_value.style.display = "none";
                    day120_hba1c_last.style.display = "inline";
                } else {
                    day120_hba1c_value.style.display = "none";
                    day120_hba1c_last.style.display = "none";
                }
            }

            // Initialize on page load
            window.addEventListener('DOMContentLoaded', toggleHbA1cFields120);

            // Attach event listeners
            day120_hba1c_yes.addEventListener("change", toggleHbA1cFields120);
            day120_hba1c_no.addEventListener("change", toggleHbA1cFields120);

            const day120_challenges_yes = document.getElementById('day120_challenges_yes');
            const day120_challenges_no = document.getElementById('day120_challenges_no');
            const day120_challenges_reason = document.getElementById('day120_challenges_reason');

            function toggleDietChallengeField120() {
                if (day120_challenges_yes.checked) {
                    day120_challenges_reason.style.display = "inline";
                } else {
                    day120_challenges_reason.style.display = "none";
                }
            }

            // Initialize on page load
            window.addEventListener('DOMContentLoaded', toggleDietChallengeField120);

            // Attach event listeners
            day120_challenges_yes.addEventListener("change", toggleDietChallengeField120);
            day120_challenges_no.addEventListener("change", toggleDietChallengeField120);

            const day120_monitor_yes = document.getElementById('day120_monitor_yes');
            const day120_monitor_no = document.getElementById('day120_monitor_no');
            const day120_monitor_reason = document.getElementById('day120_monitor_reason');

            function toggleFluidMonitorField120() {
                if (day120_monitor_no.checked) {
                    day120_monitor_reason.style.display = "inline";
                } else {
                    day120_monitor_reason.style.display = "none";
                }
            }

            // Initialize on page load
            window.addEventListener('DOMContentLoaded', toggleFluidMonitorField120);

            // Attach event listeners
            day120_monitor_yes.addEventListener("change", toggleFluidMonitorField120);
            day120_monitor_no.addEventListener("change", toggleFluidMonitorField120);

            const day120_doctor_yes = document.getElementById('day120_doctor_yes');
            const day120_doctor_no = document.getElementById('day120_doctor_no');
            const day120_doctor_reason = document.getElementById('day120_doctor_reason');

            function toggleDoctorFollowupField120() {
                if (day120_doctor_no.checked) {
                    day120_doctor_reason.style.display = "inline";
                } else {
                    day120_doctor_reason.style.display = "none";
                }
            }

            // Initialize on page load
            window.addEventListener('DOMContentLoaded', toggleDoctorFollowupField120);

            // Attach event listeners
            day120_doctor_yes.addEventListener("change", toggleDoctorFollowupField120);
            day120_doctor_no.addEventListener("change", toggleDoctorFollowupField120);

            const medsYes2 = document.getElementById("day150_meds_yes");
            const medsNo2 = document.getElementById("day150_meds_no");
            const medsReason2 = document.getElementById("day150_meds_reason");

            medsYes2.addEventListener("change", () => medsReason2.style.display = "none");
            medsNo2.addEventListener("change", () => medsReason2.style.display = "inline");

            const stockYes2 = document.getElementById("day150_stock_yes");
            const stockNo2 = document.getElementById("day150_stock_no");
            const stockMeds2 = document.getElementById("day150_meds_stock");

            stockYes2.addEventListener("change", () => {
                if (stockYes2.checked) {
                    stockMeds2.style.display = "none";
                }
            });

            stockNo2.addEventListener("change", () => {
                if (stockNo2.checked) {
                    stockMeds2.style.display = "inline";
                }
            });


            // 2. BP Reading - show BP input only if Yes is selected
            const bpYes2 = document.getElementById("day150_bp_yes");
            const bpNo2 = document.getElementById("day150_bp_no");
            const bpValue2 = document.getElementById("day150_bp_value");

            bpYes2.addEventListener("change", () => bpValue2.style.display = "inline");
            bpNo2.addEventListener("change", () => bpValue2.style.display = "none");

            // 3. RBS - show value if Yes, reason if No
            const rbsYes2 = document.getElementById("day150_rbs_yes");
            const rbsNo2 = document.getElementById("day150_rbs_no");
            const rbsValue2 = document.getElementById("day150_rbs_value");
            const rbsReason2 = document.getElementById("day150_rbs_reason");

            rbsYes2.addEventListener("change", () => {
                rbsValue2.style.display = "inline";
                rbsReason2.style.display = "none";
            });

            rbsNo2.addEventListener("change", () => {
                rbsValue2.style.display = "none";
                rbsReason2.style.display = "inline";
            });

            // 4. Yoga attended - show reason if No
            const yogaYes2 = document.getElementById("day150_yoga_yes");
            const yogaNo2 = document.getElementById("day150_yoga_no");
            const yogaReason2 = document.getElementById("day150_yoga_reason");

            yogaYes2.addEventListener("change", () => yogaReason2.style.display = "none");
            yogaNo2.addEventListener("change", () => yogaReason.style.display = "inline");

            // 5. Call Remark - handle sub-options visibility
            const callConnect2 = document.getElementById("callremark_call_150");
            const noResponse2 = document.getElementById("callremark_no_150");
            const callRemarkContainer2 = document.getElementById("callremark_subremarks_150");
            const callConnectSub2 = document.getElementById("callconnect_subremarks_150");
            const noResponseSub2 = document.getElementById("noresponse_subremarks_150");

            callConnect2.addEventListener("change", () => {
                callRemarkContainer2.style.display = "block";
                callConnectSub2.style.display = "block";
                noResponseSub2.style.display = "none";
            });

            noResponse2.addEventListener("change", () => {
                callRemarkContainer2.style.display = "block";
                callConnectSub2.style.display = "none";
                noResponseSub2.style.display = "block";
            });

            const callConnect180 = document.getElementById("callremark_call_180");
            const noResponse180 = document.getElementById("callremark_no_180");
            const callRemarkContainer180 = document.getElementById("callremark_subremarks_180");
            const callConnectSub180 = document.getElementById("callconnect_subremarks_180");
            const noResponseSub180 = document.getElementById("noresponse_subremarks_180");

            callConnect180.addEventListener("change", () => {
                callRemarkContainer180.style.display = "block";
                callConnectSub180.style.display = "block";
                noResponseSub180.style.display = "none";
            });

            noResponse180.addEventListener("change", () => {
                callRemarkContainer180.style.display = "block";
                callConnectSub180.style.display = "none";
                noResponseSub180.style.display = "block";
            });
            document.addEventListener("DOMContentLoaded", function () {
                const yogaYes = document.getElementById("yoga_helpful_yes");
                const yogaNo = document.getElementById("yoga_helpful_no");
                const feedbackContainer = document.getElementById("yoga_feedback_container");

                function toggleFeedbackField() {
                    if (yogaNo.checked) {
                        feedbackContainer.style.display = "block";
                    } else {
                        feedbackContainer.style.display = "none";
                    }
                }

                // Add event listeners
                yogaYes.addEventListener("change", toggleFeedbackField);
                yogaNo.addEventListener("change", toggleFeedbackField);

                // Optional: trigger on page load if one is preselected
                toggleFeedbackField();
            });
        </script>