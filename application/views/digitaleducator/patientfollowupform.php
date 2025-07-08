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
    </style>
</head>
<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Sidebar -->
        <?php include('side_bar.php'); ?>
        <!-- /Sidebar -->

        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- Page Header -->
                <?php include('breadcum.php'); ?>
                <!-- /Page Header -->

                <?php include('alerts.php'); ?>

                <div class="form-container">
                    <h1 class="form-title">✅ Patient Follow-up Form</h1>

                    <form id="followUpForm" method="POST" action="process_followup.php">

                        <!-- Day 3 -->
                        <div class="form-section">
                            <h2 class="section-title">📞 Day 3 Follow-up</h2>

                            <div class="mb-3">
                                <label class="form-label">1. Are you taking your prescribed medicines regularly and on time?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day3_meds_yes" value="Yes">
                                    <label class="form-check-label" for="day3_meds_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day3_meds_no" value="No">
                                    <label class="form-check-label" for="day3_meds_no">No</label>
                                </div>
                                <span id="day3_meds_reason" style="display: none;">
                                    → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">2. Are you monitoring the following as advised?</label>
                                <div class="checkbox-group">
                                    <div class="mb-2">
                                        <span>Daily sugar levels:</span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="checkbox" id="day3_sugar_yes" value="Yes">
                                            <label class="form-check-label" for="day3_sugar_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="checkbox" id="day3_sugar_no" value="No">
                                            <label class="form-check-label" for="day3_sugar_no">No</label>
                                        </div>
                                        <span id="day3_sugar_reason" style="display: none;">
                                            → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                        </span>
                                    </div>
                                    
                                    <div class="mb-2">
                                        <span>Blood pressure:</span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="checkbox" id="day3_bp_yes" value="Yes">
                                            <label class="form-check-label" for="day3_bp_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="checkbox" id="day3_bp_no" value="No">
                                            <label class="form-check-label" for="day3_bp_no">No</label>
                                        </div>
                                        <span id="day3_bp_reason" style="display: none;">
                                            → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                        </span>
                                    </div>
                                    
                                    <div class="mb-2">
                                        <span>Fluid and salt intake:</span>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="checkbox" id="day3_fluid_yes" value="Yes">
                                            <label class="form-check-label" for="day3_fluid_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline checkbox-item">
                                            <input class="form-check-input" type="checkbox" id="day3_fluid_no" value="No">
                                            <label class="form-check-label" for="day3_fluid_no">No</label>
                                        </div>
                                        <span id="day3_fluid_reason" style="display: none;">
                                            → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">3. 3.	Would you like us to arrange a yoga, physiotherapy, or dietitian call for support?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day3_support_yoga" value="Yoga">
                                    <label class="form-check-label" for="day3_support_yoga">Yoga</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day3_support_physio" value="Physiotherapy">
                                    <label class="form-check-label" for="day3_support_physio">Physiotherapy</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day3_support_diet" value="Dietitian">
                                    <label class="form-check-label" for="day3_support_diet">Dietitian</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day3_support_none" value="No">
                                    <label class="form-check-label" for="day3_support_none">No</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">4. 4.	In case you need any support, please feel free to call us on our toll-free number: <span class="support-number">18002670975</span></label>
                            </div>
                        </div>

                        <!-- Yoga Follow-up -->
                        <div class="form-section">
                            <h2 class="section-title">🧘 Yoga Follow-up – Day 7 / 45 / 90</h2>

                            <div class="mb-3">
                                <label class="form-label">1.Are you taking your prescribed medicines regularly?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="yoga_meds_yes" value="Yes">
                                    <label class="form-check-label" for="yoga_meds_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="yoga_meds_no" value="No">
                                    <label class="form-check-label" for="yoga_meds_no">No</label>
                                </div>
                                <span id="yoga_meds_reason" style="display: none;">
                                    → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">2.Have you visited your doctor recently for a follow-up?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="yoga_doctor_yes" value="Yes">
                                    <label class="form-check-label" for="yoga_doctor_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="yoga_doctor_no" value="No">
                                    <label class="form-check-label" for="yoga_doctor_no">No</label>
                                </div>
                                <span id="yoga_doctor_reason" style="display: none;">
                                    → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">3.What was your latest blood pressure reading:</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="yoga_bp_yes" value="Yes">
                                    <label class="form-check-label" for="yoga_bp_yes">Yes</label>
                                </div>
                                <span id="yoga_bp_value" style="display: inline-block;">
                                    → BP: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="yoga_bp_no" value="No">
                                    <label class="form-check-label" for="yoga_bp_no">No</label>
                                </div>
                                <span id="yoga_bp_remarks" style="display: none;">
                                    → Remarks: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">4. Do you know your current weight :</label>
                                <input type="text" class="form-control form-control-sm d-inline-block form-text-input"> kg
                            </div>

                            <div class="mb-3">
                                <label class="form-label">5. Do you feel breathless?</label>
                                <div class="checkbox-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="breathless_none" value="No breathlessness">
                                        <label class="form-check-label" for="breathless_none">No breathlessness</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="breathless_stairs" value="While climbing stairs">
                                        <label class="form-check-label" for="breathless_stairs">While climbing stairs</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="breathless_sitting" value="While sitting">
                                        <label class="form-check-label" for="breathless_sitting">While sitting</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="breathless_clothes" value="While changing clothes">
                                        <label class="form-check-label" for="breathless_clothes">While changing clothes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="breathless_lie" value="Cannot lie down flat">
                                        <label class="form-check-label" for="breathless_lie">Cannot lie down flat</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">6. Would you like to schedule a yoga session as part of your care plan?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="yoga_schedule_yes" value="Yes">
                                    <label class="form-check-label" for="yoga_schedule_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="yoga_schedule_no" value="No">
                                    <label class="form-check-label" for="yoga_schedule_no">No</label>
                                </div>
                                <span id="yoga_schedule_reason" style="display: none;">
                                    → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">7.	Have you tried any yoga or breathing exercises earlier?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="yoga_tried_yes" value="Yes">
                                    <label class="form-check-label" for="yoga_tried_yes">Yes</label>
                                </div>
                                <span id="yoga_tried_difficult" style="display: none;">
                                    <div class="form-check form-check-inline checkbox-item">
                                        <input class="form-check-input" type="checkbox" id="yoga_difficult_yes" value="Yes">
                                        <label class="form-check-label" for="yoga_difficult_yes">Difficulties?</label>
                                    </div>
                                    <span id="yoga_difficult_reason" style="display: none;">
                                        → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                    </span>
                                </span>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="yoga_tried_no" value="No">
                                    <label class="form-check-label" for="yoga_tried_no">No</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">8. Yoga Session Required?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="yoga_required_yes" value="Yes">
                                    <label class="form-check-label" for="yoga_required_yes">Yes</label>
                                </div>
                                <span id="yoga_planned_date" style="display: none;">
                                    → Planned date: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="yoga_required_no" value="No">
                                    <label class="form-check-label" for="yoga_required_no">No</label>
                                </div>
                                <span id="yoga_required_reason" style="display: none;">
                                    → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>
                        </div>

                        <!-- Day 15/30/150 -->
                        <div class="form-section">
                            <h2 class="section-title">📅 Day 15 / 30 / 150 Follow-up</h2>

                            <div class="mb-3">
                                <label class="form-label">1. Are you taking your medicines regularly as advised by your doctor?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_meds_yes" value="Yes">
                                    <label class="form-check-label" for="day15_meds_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_meds_no" value="No">
                                    <label class="form-check-label" for="day15_meds_no">No</label>
                                </div>
                                <span id="day15_meds_reason" style="display: none;">
                                    → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">2. Do you have enough stock of medicines?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_stock_yes" value="Yes">
                                    <label class="form-check-label" for="day15_stock_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_stock_no" value="No">
                                    <label class="form-check-label" for="day15_stock_no">No</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">3. Has your doctor added or changed any medication recently?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_changes_yes" value="Yes">
                                    <label class="form-check-label" for="day15_changes_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_changes_no" value="No">
                                    <label class="form-check-label" for="day15_changes_no">No</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">4. Recent BP Reading:</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_bp_yes" value="Yes">
                                    <label class="form-check-label" for="day15_bp_yes">Yes→ BP:</label>
                                </div>
                                <span id="day15_bp_value" style="display: inline-block;">
                                     <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_bp_no" value="No">
                                    <label class="form-check-label" for="day15_bp_no">No</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">5. Current weight:</label>
                                <input type="text" class="form-control form-control-sm d-inline-block form-text-input"> kg
                            </div>

                            <div class="mb-3">
                                <label class="form-label">6. Have you checked your blood sugar level (RBS) recently</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_rbs_yes" value="Yes">
                                    <label class="form-check-label" for="day15_rbs_yes">Yes</label>
                                </div>
                                <span id="day15_rbs_value" style="display: inline-block;">
                                    → <input type="text" class="form-control form-control-sm d-inline-block form-text-input"> mg/dL
                                </span>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_rbs_no" value="No">
                                    <label class="form-check-label" for="day15_rbs_no">No</label>
                                </div>
                                <span id="day15_rbs_reason" style="display: none;">
                                    → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">7. Can you tell me about your water/fluid intake and urine output over the past few days?</label>
                                <br>
                                <label class="form-label"> Fluid Intake:</label>
                                <br>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_fluid_adequate" value="Adequate">
                                    <label class="form-check-label" for="day15_fluid_adequate">Adequate</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_fluid_increased" value="Increased">
                                    <label class="form-check-label" for="day15_fluid_increased">Increased</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_fluid_decreased" value="Decreased">
                                    <label class="form-check-label" for="day15_fluid_decreased">Decreased</label>
                                </div>
                                <br>
                                <label class="form-label"> Urine Output:</label><br>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_urine_normal" value="Normal">
                                    <label class="form-check-label" for="day15_urine_normal">Normal</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_urine_increased" value="Increased">
                                    <label class="form-check-label" for="day15_urine_increased">Increased</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_urine_reduced" value="Reduced">
                                    <label class="form-check-label" for="day15_urine_reduced">Reduced</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">8. How is your breathing (NYHA Classification)?</label>
                                <div class="checkbox-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="day15_breathless_none" value="No breathlessness">
                                        <label class="form-check-label" for="day15_breathless_none">No breathlessness</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="day15_breathless_stairs" value="While climbing stairs">
                                        <label class="form-check-label" for="day15_breathless_stairs">While climbing stairs</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="day15_breathless_sitting" value="While sitting">
                                        <label class="form-check-label" for="day15_breathless_sitting">While sitting</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="day15_breathless_clothes" value="While changing clothes">
                                        <label class="form-check-label" for="day15_breathless_clothes">While changing clothes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="day15_breathless_lie" value="Cannot lie down flat">
                                        <label class="form-check-label" for="day15_breathless_lie">Cannot lie down flat</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">9. Have you attended any yoga sessions yet</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_yoga_yes" value="Yes">
                                    <label class="form-check-label" for="day15_yoga_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day15_yoga_no" value="No">
                                    <label class="form-check-label" for="day15_yoga_no">No</label>
                                </div>
                                <span id="day15_yoga_reason" style="display: none;">
                                    → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>
                        </div>

                        <!-- Day 60/120 Diet Call -->
                        <div class="form-section">
                            <h2 class="section-title">🥗 Day 60 / 120 – Diet Call</h2>

                            <div class="mb-3">
                                <label class="form-label">1. Medicines taken regularly?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_meds_yes" value="Yes">
                                    <label class="form-check-label" for="day60_meds_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_meds_no" value="No">
                                    <label class="form-check-label" for="day60_meds_no">No</label>
                                </div>
                                <span id="day60_meds_reason" style="display: none;">
                                    → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">2. BP Reading:</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_bp_yes" value="Yes">
                                    <label class="form-check-label" for="day60_bp_yes">Yes</label>
                                </div>
                                <span id="day60_bp_value" style="display: inline-block;">
                                    → <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_bp_no" value="No">
                                    <label class="form-check-label" for="day60_bp_no">No</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">3. RBS Reading:</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_rbs_yes" value="Yes">
                                    <label class="form-check-label" for="day60_rbs_yes">Yes</label>
                                </div>
                                <span id="day60_rbs_value" style="display: inline-block;">
                                    → <input type="text" class="form-control form-control-sm d-inline-block form-text-input"> mg/dL
                                </span>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_rbs_no" value="No">
                                    <label class="form-check-label" for="day60_rbs_no">No</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">4. Weight:</label>
                                <input type="text" class="form-control form-control-sm d-inline-block form-text-input"> kg
                            </div>

                            <div class="mb-3">
                                <label class="form-label">5. Last HbA1c value:</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_hba1c_yes" value="Yes">
                                    <label class="form-check-label" for="day60_hba1c_yes">Yes</label>
                                </div>
                                <span id="day60_hba1c_value" style="display: inline-block;">
                                    → <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_hba1c_no" value="No">
                                    <label class="form-check-label" for="day60_hba1c_no">No</label>
                                </div>
                                <span id="day60_hba1c_last" style="display: none;">
                                    → Last checked: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">6. Facing challenges with diet?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_challenges_yes" value="Yes">
                                    <label class="form-check-label" for="day60_challenges_yes">Yes</label>
                                </div>
                                <span id="day60_challenges_reason" style="display: none;">
                                    → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_challenges_no" value="No">
                                    <label class="form-check-label" for="day60_challenges_no">No</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">7. Monitoring daily fluid intake?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_monitor_yes" value="Yes">
                                    <label class="form-check-label" for="day60_monitor_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_monitor_no" value="No">
                                    <label class="form-check-label" for="day60_monitor_no">No</label>
                                </div>
                                <span id="day60_monitor_reason" style="display: none;">
                                    → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">8. Water Intake:</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_water_adequate" value="Adequate">
                                    <label class="form-check-label" for="day60_water_adequate">Adequate</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_water_increased" value="Increased">
                                    <label class="form-check-label" for="day60_water_increased">Increased</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_water_decreased" value="Decreased">
                                    <label class="form-check-label" for="day60_water_decreased">Decreased</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Urine Output:</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_urine_normal" value="Normal">
                                    <label class="form-check-label" for="day60_urine_normal">Normal</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_urine_increased" value="Increased">
                                    <label class="form-check-label" for="day60_urine_increased">Increased</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_urine_reduced" value="Reduced">
                                    <label class="form-check-label" for="day60_urine_reduced">Reduced</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">9. Questions on diet/lifestyle?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_questions_yes" value="Yes">
                                    <label class="form-check-label" for="day60_questions_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_questions_no" value="No">
                                    <label class="form-check-label" for="day60_questions_no">No</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">10. Need help with meal planning or salt restriction?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_help_yes" value="Yes">
                                    <label class="form-check-label" for="day60_help_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_help_no" value="No">
                                    <label class="form-check-label" for="day60_help_no">No</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">11. Recent doctor follow-up?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_doctor_yes" value="Yes">
                                    <label class="form-check-label" for="day60_doctor_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day60_doctor_no" value="No">
                                    <label class="form-check-label" for="day60_doctor_no">No</label>
                                </div>
                                <span id="day60_doctor_reason" style="display: none;">
                                    → Reason: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">12. Do you need more yoga sessions?</label>
                                <div class="form-group">
                                    <label>Remark:</label>
                                    <textarea class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Day 180 Final Call -->
                        <div class="form-section">
                            <h2 class="section-title">🎯 Day 180 Final – Diet Call</h2>

                            <div class="mb-3">
                                <label class="form-label">1. Feeling now compared to 6 months ago?</label>
                                <div class="checkbox-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="day180_feeling_better" value="Much better">
                                        <label class="form-check-label" for="day180_feeling_better">Much better</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="day180_feeling_slightly" value="Slightly better">
                                        <label class="form-check-label" for="day180_feeling_slightly">Slightly better</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="day180_feeling_same" value="About the same">
                                        <label class="form-check-label" for="day180_feeling_same">About the same</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="day180_feeling_worse" value="Not feeling better">
                                        <label class="form-check-label" for="day180_feeling_worse">Not feeling better</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">2. Were yoga sessions helpful?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day180_yoga_yes" value="Yes">
                                    <label class="form-check-label" for="day180_yoga_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day180_yoga_no" value="No">
                                    <label class="form-check-label" for="day180_yoga_no">No</label>
                                </div>
                                <span id="day180_yoga_feedback" style="display: none;">
                                    → Feedback: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">3. Were instructors supportive?</label>
                                <div class="checkbox-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="day180_instructors_yes" value="Yes – Clear and supportive">
                                        <label class="form-check-label" for="day180_instructors_yes">Yes – Clear and supportive</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="day180_instructors_somewhat" value="Somewhat – Some gaps">
                                        <label class="form-check-label" for="day180_instructors_somewhat">Somewhat – Some gaps</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="day180_instructors_no" value="No">
                                        <label class="form-check-label" for="day180_instructors_no">No</label>
                                    </div>
                                    <span id="day180_instructors_feedback" style="display: none;">
                                        → Feedback: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">4. Did the diet help your health?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day180_diet_yes" value="Yes">
                                    <label class="form-check-label" for="day180_diet_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day180_diet_somewhat" value="Somewhat">
                                    <label class="form-check-label" for="day180_diet_somewhat">Somewhat</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day180_diet_no" value="No">
                                    <label class="form-check-label" for="day180_diet_no">No</label>
                                </div>
                                <span id="day180_diet_feedback" style="display: none;">
                                    → Feedback: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">5. Was the dietician accessible?</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day180_dietician_yes" value="Yes">
                                    <label class="form-check-label" for="day180_dietician_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day180_dietician_sometimes" value="Sometimes">
                                    <label class="form-check-label" for="day180_dietician_sometimes">Sometimes</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day180_dietician_no" value="No">
                                    <label class="form-check-label" for="day180_dietician_no">No</label>
                                </div>
                                <span id="day180_dietician_feedback" style="display: none;">
                                    → Feedback: <input type="text" class="form-control form-control-sm d-inline-block form-text-input">
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">6. Overall experience with 6-month program:</label>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day180_experience_excellent" value="Excellent">
                                    <label class="form-check-label" for="day180_experience_excellent">Excellent</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day180_experience_satisfactory" value="Satisfactory">
                                    <label class="form-check-label" for="day180_experience_satisfactory">Satisfactory</label>
                                </div>
                                <div class="form-check form-check-inline checkbox-item">
                                    <input class="form-check-input" type="checkbox" id="day180_experience_improve" value="Needs Improvement">
                                    <label class="form-check-label" for="day180_experience_improve">Needs Improvement</label>
                                </div>
                                <div class="form-group mt-2">
                                    <label>Remarks:</label>
                                    <textarea class="form-control" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">7. Final feedback/suggestions:</label>
                                <div class="form-group">
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Submit Follow-up Form</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Show/hide reason fields based on checkbox selections
        $(document).ready(function() {
            // Day 3 Medicines
            $('#day3_meds_no').change(function() {
                if(this.checked) {
                    $('#day3_meds_reason').show();
                } else {
                    $('#day3_meds_reason').hide();
                }
            });
            
            // Day 3 Sugar Monitoring
            $('#day3_sugar_no').change(function() {
                if(this.checked) {
                    $('#day3_sugar_reason').show();
                } else {
                    $('#day3_sugar_reason').hide();
                }
            });
            
            // Day 3 BP Monitoring
            $('#day3_bp_no').change(function() {
                if(this.checked) {
                    $('#day3_bp_reason').show();
                } else {
                    $('#day3_bp_reason').hide();
                }
            });
            
            // Day 3 Fluid Monitoring
            $('#day3_fluid_no').change(function() {
                if(this.checked) {
                    $('#day3_fluid_reason').show();
                } else {
                    $('#day3_fluid_reason').hide();
                }
            });
            
            // Yoga Medicines
            $('#yoga_meds_no').change(function() {
                if(this.checked) {
                    $('#yoga_meds_reason').show();
                } else {
                    $('#yoga_meds_reason').hide();
                }
            });
            
            // Yoga Doctor Visit
            $('#yoga_doctor_no').change(function() {
                if(this.checked) {
                    $('#yoga_doctor_reason').show();
                } else {
                    $('#yoga_doctor_reason').hide();
                }
            });
            
            // Yoga BP Reading
            $('#yoga_bp_yes').change(function() {
                if(this.checked) {
                    $('#yoga_bp_value').show();
                } else {
                    $('#yoga_bp_value').hide();
                }
            });
            
            $('#yoga_bp_no').change(function() {
                if(this.checked) {
                    $('#yoga_bp_remarks').show();
                } else {
                    $('#yoga_bp_remarks').hide();
                }
            });
            
            // Yoga Schedule
            $('#yoga_schedule_no').change(function() {
                if(this.checked) {
                    $('#yoga_schedule_reason').show();
                } else {
                    $('#yoga_schedule_reason').hide();
                }
            });
            
            // Yoga Tried
            $('#yoga_tried_yes').change(function() {
                if(this.checked) {
                    $('#yoga_tried_difficult').show();
                } else {
                    $('#yoga_tried_difficult').hide();
                }
            });
            
            $('#yoga_difficult_yes').change(function() {
                if(this.checked) {
                    $('#yoga_difficult_reason').show();
                } else {
                    $('#yoga_difficult_reason').hide();
                }
            });
            
            // Yoga Required
            $('#yoga_required_yes').change(function() {
                if(this.checked) {
                    $('#yoga_planned_date').show();
                } else {
                    $('#yoga_planned_date').hide();
                }
            });
            
            $('#yoga_required_no').change(function() {
                if(this.checked) {
                    $('#yoga_required_reason').show();
                } else {
                    $('#yoga_required_reason').hide();
                }
            });
            
            // Add similar handlers for other sections as needed
        });
    </script>

    <?php include('footer.php'); ?>