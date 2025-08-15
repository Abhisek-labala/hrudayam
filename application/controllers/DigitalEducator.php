<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DigitalEducator extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $status = 1;
        if ($status == 0) {
            echo "Invalid Access";
            die();
        }
    }

    public function dashboard()
    {
        $this->load->view('digitaleducator/dashboard');
    }

    public function digitalPatientList()
    {
        $this->load->view('digitaleducator/patient-list');
    }
    public function logout()
    {
        $this->session->unset_userdata('digital_educator_id');
        redirect(base_url() . '/Digital-Educator-login');
    }
    public function changePassword()
    {
        $this->load->view('digitaleducator/change-password');
    }

    public function changePasswordPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $oldPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];

            if (!$oldPassword) {
                $this->session->set_flashdata('error', 'Old Password Empty');
                redirect(base_url() . '/Digital-educator-change-password');
            }

            if (!$newPassword) {
                $this->session->set_flashdata('error', 'New Password Empty');
                redirect(base_url() . '/Digital-educator-change-password');
            }

            $educatorId = $this->session->userdata('digital_educator_id');
            // echo $educatorId;die;

            $query = "SELECT * FROM `digital_educator` WHERE `password`='" . $oldPassword . "' and `id`='" . $educatorId . "';";
            $educatorData = $this->master_model->customQueryArray($query);

            if ($educatorData) {

                $educatorPasswordData = array();
                $educatorPasswordData['id'] = $educatorId;
                $educatorPasswordData['password'] = $newPassword;
                $row = $this->master_model->save('digital_educator', $educatorPasswordData);
                unset($educatorPasswordData);

                $this->session->set_flashdata('message', 'Password update Successfully');
                redirect(base_url() . '/Digital-educator-change-password');

            } else {
                $this->session->set_flashdata('error', 'Password Not Matched');
                redirect(base_url() . '/Digital-educator-change-password');
            }


        }
    }

    public function followupform()
    {
        $this->load->view('digitaleducator/patientfollowupform');
    }

    public function followupformpost()
    {
        $day = $this->input->post('day', TRUE);
        $patient_id = $this->input->post('patient_id', TRUE);
        $daydata = [
            'day' => $day,
            'patient_id' => $patient_id
        ];
        $inserted = $this->db->insert('feedback_submitted', $daydata);
        if ($day === '3') {
            $day3_meds = $this->input->post('day3_meds', TRUE);
            $day3_meds_reason = $this->input->post('day3_meds_reason', TRUE);
            $day3_sugar = $this->input->post('day3_sugar', TRUE);
            $day3_sugar_reason = $this->input->post('day3_sugar_reason', TRUE);
            $day3_bp = $this->input->post('day3_bp', TRUE);
            $day3_bp_reason = $this->input->post('day3_bp_reason', TRUE);
            $day3_fluid = $this->input->post('day3_fluid', TRUE);
            $day3_fluid_reason = $this->input->post('day3_fluid_reason', TRUE);
            $day3_support = $this->input->post('day3_support') ? implode(',', $this->input->post('day3_support')) : '';
            $callremark_3 = $this->input->post('callremark_3', TRUE);
            $callconnect_subremark_3 = $this->input->post('callconnect_subremark_3', TRUE);
            $noresponse_subremark_3 = $this->input->post('noresponse_subremark_3', TRUE);
            $ae_report = $this->input->post('ae_report', TRUE);

            $data = [
                'patient_id' => $patient_id,
                'day3_meds' => $day3_meds,
                'day3_meds_reason' => $day3_meds_reason,
                'day3_sugar' => $day3_sugar,
                'day3_sugar_reason' => $day3_sugar_reason,
                'day3_bp' => $day3_bp,
                'day3_bp_reason' => $day3_bp_reason,
                'day3_fluid' => $day3_fluid,
                'day3_fluid_reason' => $day3_fluid_reason,
                'day3_support' => $day3_support,
                'callremark_3' => $callremark_3,
                'callconnect_subremark_3' => $callconnect_subremark_3,
                'noresponse_subremark_3' => $noresponse_subremark_3,
                'ae_report' => $ae_report,
            ];

            $inserted = $this->db->insert('day3_followup', $data);

            if ($inserted) {
                $this->session->set_flashdata('success', 'Follow-up saved successfully!');
                redirect('digital-Patient-List'); // Replace with your actual form page route
            } else {
                $this->session->set_flashdata('error', 'Failed to save follow-up.');
                redirect('digital-Patient-List');
            }
        }
        if ($day === '7') {
            $patient_id = $this->input->post('patient_id', TRUE);

            $day7_meds = $this->input->post('day7_meds', TRUE);
            $day7_meds_reason = $this->input->post('day7_meds_reason', TRUE);

            $day7_doctor = $this->input->post('day7_doctor', TRUE);
            $day7_doctor_reason = $this->input->post('day7_doctor_reason', TRUE);

            $day7_bp = $this->input->post('day7_bp', TRUE);
            $day7_bp_value = $this->input->post('day7_bp_value', TRUE);
            $day7_bp_remarks = $this->input->post('day7_bp_remarks', TRUE);

            $day7_weight = $this->input->post('day7_weight', TRUE);

            $day7_breathless = $this->input->post('day7_breathless', TRUE);

            $day7_yoga_schedule = $this->input->post('day7_yoga_schedule', TRUE);
            $day7_yoga_schedule_reason = $this->input->post('day7_yoga_schedule_reason', TRUE);

            $day7_yoga_tried = $this->input->post('day7_yoga_tried', TRUE);
            $day7_yoga_difficult = $this->input->post('day7_yoga_difficult', TRUE);
            $day7_yoga_difficult_reason = $this->input->post('day7_yoga_difficult_reason', TRUE);

            $day7_yoga_required = $this->input->post('day7_yoga_required', TRUE);
            $day7_yoga_planned_date = $this->input->post('day7_yoga_planned_date', TRUE);
            $day7_yoga_required_reason = $this->input->post('day7_yoga_required_reason', TRUE);

            $callremark_7 = $this->input->post('callremark_7', TRUE);
            $callconnect_subremark_7 = $this->input->post('callconnect_subremark_7', TRUE);
            $noresponse_subremark_7 = $this->input->post('noresponse_subremark_7', TRUE);

            $data = [
                'patient_id' => $patient_id,
                'day7_meds' => $day7_meds,
                'day7_meds_reason' => $day7_meds_reason,
                'day7_doctor' => $day7_doctor,
                'day7_doctor_reason' => $day7_doctor_reason,
                'day7_bp' => $day7_bp,
                'day7_bp_value' => $day7_bp_value,
                'day7_bp_remarks' => $day7_bp_remarks,
                'day7_weight' => $day7_weight,
                'day7_breathless' => $day7_breathless,
                'day7_yoga_schedule' => $day7_yoga_schedule,
                'day7_yoga_schedule_reason' => $day7_yoga_schedule_reason,
                'day7_yoga_tried' => $day7_yoga_tried,
                'day7_yoga_difficult' => $day7_yoga_difficult,
                'day7_yoga_difficult_reason' => $day7_yoga_difficult_reason,
                'day7_yoga_required' => $day7_yoga_required,
                'day7_yoga_planned_date' => $day7_yoga_planned_date,
                'day7_yoga_required_reason' => $day7_yoga_required_reason,
                'callremark_7' => $callremark_7,
                'callconnect_subremark_7' => $callconnect_subremark_7,
                'noresponse_subremark_7' => $noresponse_subremark_7
            ];

            $inserted = $this->db->insert('day7_followup', $data);

            if ($inserted) {
                $this->session->set_flashdata('success', 'Day 7 Follow-up saved successfully!');
                redirect('digital-Patient-List');
            } else {
                $this->session->set_flashdata('error', 'Failed to save Day 7 follow-up.');
                redirect('digital-Patient-List');
            }
        }
        if ($day === '15') {
            $patient_id = $this->input->post('patient_id', TRUE);

            $day15_meds = $this->input->post('day15_meds', TRUE);
            $day15_meds_reason = $this->input->post('day15_meds_reason', TRUE);

            $day15_stock = $this->input->post('day15_stock', TRUE);
            $day15_changes = $this->input->post('day15_changes', TRUE);

            $day15_bp = $this->input->post('day15_bp', TRUE);
            $day15_bp_value = $this->input->post('day15_bp_value', TRUE);

            $day15_weight = $this->input->post('day15_weight', TRUE);

            $day15_rbs = $this->input->post('day15_rbs', TRUE);
            $day15_rbs_value = $this->input->post('day15_rbs_value', TRUE);
            $day15_rbs_reason = $this->input->post('day15_rbs_reason', TRUE);

            $day15_fluid = $this->input->post('day15_fluid', TRUE);
            $day15_urine = $this->input->post('day15_urine', TRUE);

            // Handle multi-select (radio inputs named like array)
            $day15_breathless = $this->input->post('day15_breathless', TRUE);

            $day15_yoga = $this->input->post('day15_yoga', TRUE);
            $day15_yoga_reason = $this->input->post('day15_yoga_reason', TRUE);

            $callremark_15 = $this->input->post('callremark_15', TRUE);
            $callconnect_subremark_15 = $this->input->post('callconnect_subremark_15', TRUE);
            $noresponse_subremark_15 = $this->input->post('noresponse_subremark_15', TRUE);
            $data = [
                'patient_id' => $patient_id,
                'day15_meds' => $day15_meds,
                'day15_meds_reason' => $day15_meds_reason,
                'day15_stock' => $day15_stock,
                'day15_changes' => $day15_changes,
                'day15_bp' => $day15_bp,
                'day15_bp_value' => $day15_bp_value,
                'day15_weight' => $day15_weight,
                'day15_rbs' => $day15_rbs,
                'day15_rbs_value' => $day15_rbs_value,
                'day15_rbs_reason' => $day15_rbs_reason,
                'day15_fluid' => $day15_fluid,
                'day15_urine' => $day15_urine,
                'day15_breathless' => $day15_breathless,
                'day15_yoga' => $day15_yoga,
                'day15_yoga_reason' => $day15_yoga_reason,
                'callremark_15' => $callremark_15,
                'callconnect_subremark_15' => $callconnect_subremark_15,
                'noresponse_subremark_15' => $noresponse_subremark_15
            ];
            $inserted = $this->db->insert('day15_followup', $data);

            if ($inserted) {
                $this->session->set_flashdata('success', 'Day 15 Follow-up saved successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to save Day 15 follow-up.');
            }

            redirect('digital-Patient-List');
        }
        if ($day === '30') {
            $patient_id = $this->input->post('patient_id', TRUE);

            $day30_meds = $this->input->post('day30_meds', TRUE);
            $day30_meds_reason = $this->input->post('day30_meds_reason', TRUE);

            $day30_stock = $this->input->post('day30_stock', TRUE);
            $day30_changes = $this->input->post('day30_changes', TRUE);

            $day30_bp = $this->input->post('day30_bp', TRUE);
            $day30_bp_value = $this->input->post('day30_bp_value', TRUE);

            $day30_weight = $this->input->post('day30_weight', TRUE);

            $day30_rbs = $this->input->post('day30_rbs', TRUE);
            $day30_rbs_value = $this->input->post('day30_rbs_value', TRUE);
            $day30_rbs_reason = $this->input->post('day30_rbs_reason', TRUE);

            $day30_fluid = $this->input->post('day30_fluid', TRUE);
            $day30_urine = $this->input->post('day30_urine', TRUE);

            // Handle multi-select (radio inputs named like array)
            $day30_breathless = $this->input->post('day30_breathless', TRUE);

            $day30_yoga = $this->input->post('day30_yoga', TRUE);
            $day30_yoga_reason = $this->input->post('day30_yoga_reason', TRUE);

            $callremark_30 = $this->input->post('callremark_30', TRUE);
            $callconnect_subremark_30 = $this->input->post('callconnect_subremark_30', TRUE);
            $noresponse_subremark_30 = $this->input->post('noresponse_subremark_30', TRUE);
            $data = [
                'patient_id' => $patient_id,
                'day30_meds' => $day30_meds,
                'day30_meds_reason' => $day30_meds_reason,
                'day30_stock' => $day30_stock,
                'day30_changes' => $day30_changes,
                'day30_bp' => $day30_bp,
                'day30_bp_value' => $day30_bp_value,
                'day30_weight' => $day30_weight,
                'day30_rbs' => $day30_rbs,
                'day30_rbs_value' => $day30_rbs_value,
                'day30_rbs_reason' => $day30_rbs_reason,
                'day30_fluid' => $day30_fluid,
                'day30_urine' => $day30_urine,
                'day30_breathless' => $day30_breathless,
                'day30_yoga' => $day30_yoga,
                'day30_yoga_reason' => $day30_yoga_reason,
                'callremark_30' => $callremark_30,
                'callconnect_subremark_30' => $callconnect_subremark_30,
                'noresponse_subremark_30' => $noresponse_subremark_30
            ];
            $inserted = $this->db->insert('day30_followup', $data);

            if ($inserted) {
                $this->session->set_flashdata('success', 'Day 30 Follow-up saved successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to save Day 30 follow-up.');
            }

            redirect('digital-Patient-List');
        }
        if ($day === '45') {
            $patient_id = $this->input->post('patient_id', TRUE);

            $day45_meds = $this->input->post('day45_meds', TRUE);
            $day45_meds_reason = $this->input->post('day45_meds_reason', TRUE);

            $day45_doctor = $this->input->post('day45_doctor', TRUE);
            $day45_doctor_reason = $this->input->post('day45_doctor_reason', TRUE);

            $day45_bp = $this->input->post('day45_bp', TRUE);
            $day45_bp_value = $this->input->post('day45_bp_value', TRUE);
            $day45_bp_remarks = $this->input->post('day45_bp_remarks', TRUE);

            $day45_weight = $this->input->post('day45_weight', TRUE);

            $day45_breathless = $this->input->post('day45_breathless', TRUE);

            $day45_yoga_schedule = $this->input->post('day45_yoga_schedule', TRUE);
            $day45_yoga_schedule_reason = $this->input->post('day45_yoga_schedule_reason', TRUE);

            $day45_yoga_tried = $this->input->post('day45_yoga_tried', TRUE);
            $day45_yoga_difficult = $this->input->post('day45_yoga_difficult', TRUE);
            $day45_yoga_difficult_reason = $this->input->post('day45_yoga_difficult_reason', TRUE);

            $day45_yoga_required = $this->input->post('day45_yoga_required', TRUE);
            $day45_yoga_planned_date = $this->input->post('day45_yoga_planned_date', TRUE);
            $day45_yoga_required_reason = $this->input->post('day45_yoga_required_reason', TRUE);

            $callremark_45 = $this->input->post('callremark_45', TRUE);
            $callconnect_subremark_45 = $this->input->post('callconnect_subremark_45', TRUE);
            $noresponse_subremark_45 = $this->input->post('noresponse_subremark_45', TRUE);

            $data = [
                'patient_id' => $patient_id,
                'day45_meds' => $day45_meds,
                'day45_meds_reason' => $day45_meds_reason,
                'day45_doctor' => $day45_doctor,
                'day45_doctor_reason' => $day45_doctor_reason,
                'day45_bp' => $day45_bp,
                'day45_bp_value' => $day45_bp_value,
                'day45_bp_remarks' => $day45_bp_remarks,
                'day45_weight' => $day45_weight,
                'day45_breathless' => $day45_breathless,
                'day45_yoga_schedule' => $day45_yoga_schedule,
                'day45_yoga_schedule_reason' => $day45_yoga_schedule_reason,
                'day45_yoga_tried' => $day45_yoga_tried,
                'day45_yoga_difficult' => $day45_yoga_difficult,
                'day45_yoga_difficult_reason' => $day45_yoga_difficult_reason,
                'day45_yoga_required' => $day45_yoga_required,
                'day45_yoga_planned_date' => $day45_yoga_planned_date,
                'day45_yoga_required_reason' => $day45_yoga_required_reason,
                'callremark_45' => $callremark_45,
                'callconnect_subremark_45' => $callconnect_subremark_45,
                'noresponse_subremark_45' => $noresponse_subremark_45
            ];

            $inserted = $this->db->insert('day45_followup', $data);

            if ($inserted) {
                $this->session->set_flashdata('success', 'Day 45 Follow-up saved successfully!');
                redirect('digital-Patient-List');
            } else {
                $this->session->set_flashdata('error', 'Failed to save Day 45 follow-up.');
                redirect('digital-Patient-List');
            }
        }
        if ($day === '60') {
            // echo '<pre>'; print_r($_POST); echo '</pre>'; die;
                $patient_id = $this->input->post('patient_id', TRUE);

                $day60_meds = $this->input->post('day60_meds', TRUE);
                $day60_meds_reason = $this->input->post('day60_meds_reason', TRUE);

                $day60_bp = $this->input->post('day60_bp', TRUE);
                $day60_bp_value = $this->input->post('day60_bp_value', TRUE);

                $day60_rbs = $this->input->post('day60_rbs', TRUE);
                $day60_rbs_value = $this->input->post('day60_rbs_value', TRUE);

                $day60_weight = $this->input->post('day60_weight', TRUE);

                $day60_hba1c = $this->input->post('day60_hba1c', TRUE);
                $day60_hba1c_value = $this->input->post('day60_hba1c_value', TRUE);
                $day60_hba1c_last = $this->input->post('day60_hba1c_last', TRUE);

                $day60_challenges = $this->input->post('day60_challenges', TRUE);
                $day60_challenges_reason = $this->input->post('day60_challenges_reason', TRUE);

                $day60_monitor = $this->input->post('day60_monitor', TRUE);
                $day60_monitor_reason = $this->input->post('day60_monitor_reason', TRUE);

                $day60_water = $this->input->post('day60_water', TRUE);
                $day60_urine = $this->input->post('day60_urine', TRUE);

                $day60_questions = $this->input->post('day60_questions', TRUE);
                $day60_help = $this->input->post('day60_help', TRUE);

                $day60_doctor = $this->input->post('day60_doctor', TRUE);
                $day60_doctor_reason = $this->input->post('day60_doctor_reason', TRUE);

                $day60_yoga_remark = $this->input->post('day60_yoga_remark', TRUE);

                $callremark_60 = $this->input->post('callremark_60', TRUE);
                $callconnect_subremark_60 = $this->input->post('callconnect_subremark_60', TRUE);
                $noresponse_subremark_60 = $this->input->post('noresponse_subremark_60', TRUE);
                $data = [
                    'patient_id' => $patient_id,
                    'day60_meds' => $day60_meds,
                    'day60_meds_reason' => $day60_meds_reason,
                    'day60_bp' => $day60_bp,
                    'day60_bp_value' => $day60_bp_value,
                    'day60_rbs' => $day60_rbs,
                    'day60_rbs_value' => $day60_rbs_value,
                    'day60_weight' => $day60_weight,
                    'day60_hba1c' => $day60_hba1c,
                    'day60_hba1c_value' => $day60_hba1c_value,
                    'day60_hba1c_last' => $day60_hba1c_last,
                    'day60_challenges' => $day60_challenges,
                    'day60_challenges_reason' => $day60_challenges_reason,
                    'day60_monitor' => $day60_monitor,
                    'day60_monitor_reason' => $day60_monitor_reason,
                    'day60_water' => $day60_water,
                    'day60_urine' => $day60_urine,
                    'day60_questions' => $day60_questions,
                    'day60_help' => $day60_help,
                    'day60_doctor' => $day60_doctor,
                    'day60_doctor_reason' => $day60_doctor_reason,
                    'day60_yoga_remark' => $day60_yoga_remark,
                    'callremark_60' => $callremark_60,
                    'callconnect_subremark_60' => $callconnect_subremark_60,
                    'noresponse_subremark_60' => $noresponse_subremark_60
                ];
                $inserted = $this->db->insert('day60_follow_up', $data);
                // echo 'hii';die;

                if ($inserted) {
                    $this->session->set_flashdata('success', 'Day 60 Follow-up saved successfully!');
                } else {
                    $this->session->set_flashdata('error', 'Failed to save Day 60 follow-up.');
                }

                redirect('digital-Patient-List');
        }
         if ($day === '90') {
            $patient_id = $this->input->post('patient_id', TRUE);

            $day90_meds = $this->input->post('day90_meds', TRUE);
            $day90_meds_reason = $this->input->post('day90_meds_reason', TRUE);

            $day90_doctor = $this->input->post('day90_doctor', TRUE);
            $day90_doctor_reason = $this->input->post('day90_doctor_reason', TRUE);

            $day90_bp = $this->input->post('day90_bp', TRUE);
            $day90_bp_value = $this->input->post('day90_bp_value', TRUE);
            $day90_bp_remarks = $this->input->post('day90_bp_remarks', TRUE);

            $day90_weight = $this->input->post('day90_weight', TRUE);

            $day90_breathless = $this->input->post('day90_breathless', TRUE);

            $day90_yoga_schedule = $this->input->post('day90_yoga_schedule', TRUE);
            $day90_yoga_schedule_reason = $this->input->post('day90_yoga_schedule_reason', TRUE);

            $day90_yoga_tried = $this->input->post('day90_yoga_tried', TRUE);
            $day90_yoga_difficult = $this->input->post('day90_yoga_difficult', TRUE);
            $day90_yoga_difficult_reason = $this->input->post('day90_yoga_difficult_reason', TRUE);

            $day90_yoga_required = $this->input->post('day90_yoga_required', TRUE);
            $day90_yoga_planned_date = $this->input->post('day90_yoga_planned_date', TRUE);
            $day90_yoga_required_reason = $this->input->post('day90_yoga_required_reason', TRUE);

            $callremark_90 = $this->input->post('callremark_90', TRUE);
            $callconnect_subremark_90 = $this->input->post('callconnect_subremark_90', TRUE);
            $noresponse_subremark_90 = $this->input->post('noresponse_subremark_90', TRUE);

            $data = [
                'patient_id' => $patient_id,
                'day90_meds' => $day90_meds,
                'day90_meds_reason' => $day90_meds_reason,
                'day90_doctor' => $day90_doctor,
                'day90_doctor_reason' => $day90_doctor_reason,
                'day90_bp' => $day90_bp,
                'day90_bp_value' => $day90_bp_value,
                'day90_bp_remarks' => $day90_bp_remarks,
                'day90_weight' => $day90_weight,
                'day90_breathless' => $day90_breathless,
                'day90_yoga_schedule' => $day90_yoga_schedule,
                'day90_yoga_schedule_reason' => $day90_yoga_schedule_reason,
                'day90_yoga_tried' => $day90_yoga_tried,
                'day90_yoga_difficult' => $day90_yoga_difficult,
                'day90_yoga_difficult_reason' => $day90_yoga_difficult_reason,
                'day90_yoga_required' => $day90_yoga_required,
                'day90_yoga_planned_date' => $day90_yoga_planned_date,
                'day90_yoga_required_reason' => $day90_yoga_required_reason,
                'callremark_90' => $callremark_90,
                'callconnect_subremark_90' => $callconnect_subremark_90,
                'noresponse_subremark_90' => $noresponse_subremark_90
            ];

            $inserted = $this->db->insert('day90_followup', $data);

            if ($inserted) {
                $this->session->set_flashdata('success', 'Day 90 Follow-up saved successfully!');
                redirect('digital-Patient-List');
            } else {
                $this->session->set_flashdata('error', 'Failed to save Day 90 follow-up.');
                redirect('digital-Patient-List');
            }
        }
         if ($day === '120') {
            // echo '<pre>'; print_r($_POST); echo '</pre>'; die;
                $patient_id = $this->input->post('patient_id', TRUE);

                $day120_meds = $this->input->post('day120_meds', TRUE);
                $day120_meds_reason = $this->input->post('day120_meds_reason', TRUE);

                $day120_bp = $this->input->post('day120_bp', TRUE);
                $day120_bp_value = $this->input->post('day120_bp_value', TRUE);

                $day120_rbs = $this->input->post('day120_rbs', TRUE);
                $day120_rbs_value = $this->input->post('day120_rbs_value', TRUE);

                $day120_weight = $this->input->post('day120_weight', TRUE);

                $day120_hba1c = $this->input->post('day120_hba1c', TRUE);
                $day120_hba1c_value = $this->input->post('day120_hba1c_value', TRUE);
                $day120_hba1c_last = $this->input->post('day120_hba1c_last', TRUE);

                $day120_challenges = $this->input->post('day120_challenges', TRUE);
                $day120_challenges_reason = $this->input->post('day120_challenges_reason', TRUE);

                $day120_monitor = $this->input->post('day120_monitor', TRUE);
                $day120_monitor_reason = $this->input->post('day120_monitor_reason', TRUE);

                $day120_water = $this->input->post('day120_water', TRUE);
                $day120_urine = $this->input->post('day120_urine', TRUE);

                $day120_questions = $this->input->post('day120_questions', TRUE);
                $day120_help = $this->input->post('day120_help', TRUE);

                $day120_doctor = $this->input->post('day120_doctor', TRUE);
                $day120_doctor_reason = $this->input->post('day120_doctor_reason', TRUE);

                $day120_yoga_remark = $this->input->post('day120_yoga_remark', TRUE);

                $callremark_120 = $this->input->post('callremark_120', TRUE);
                $callconnect_subremark_120 = $this->input->post('callconnect_subremark_120', TRUE);
                $noresponse_subremark_120 = $this->input->post('noresponse_subremark_120', TRUE);
                $data = [
                    'patient_id' => $patient_id,
                    'day120_meds' => $day120_meds,
                    'day120_meds_reason' => $day120_meds_reason,
                    'day120_bp' => $day120_bp,
                    'day120_bp_value' => $day120_bp_value,
                    'day120_rbs' => $day120_rbs,
                    'day120_rbs_value' => $day120_rbs_value,
                    'day120_weight' => $day120_weight,
                    'day120_hba1c' => $day120_hba1c,
                    'day120_hba1c_value' => $day120_hba1c_value,
                    'day120_hba1c_last' => $day120_hba1c_last,
                    'day120_challenges' => $day120_challenges,
                    'day120_challenges_reason' => $day120_challenges_reason,
                    'day120_monitor' => $day120_monitor,
                    'day120_monitor_reason' => $day120_monitor_reason,
                    'day120_water' => $day120_water,
                    'day120_urine' => $day120_urine,
                    'day120_questions' => $day120_questions,
                    'day120_help' => $day120_help,
                    'day120_doctor' => $day120_doctor,
                    'day120_doctor_reason' => $day120_doctor_reason,
                    'day120_yoga_remark' => $day120_yoga_remark,
                    'callremark_120' => $callremark_120,
                    'callconnect_subremark_120' => $callconnect_subremark_120,
                    'noresponse_subremark_120' => $noresponse_subremark_120
                ];
                $inserted = $this->db->insert('day120_follow_up', $data);
                // echo 'hii';die;

                if ($inserted) {
                    $this->session->set_flashdata('success', 'Day 120 Follow-up saved successfully!');
                } else {
                    $this->session->set_flashdata('error', 'Failed to save Day 120 follow-up.');
                }

                redirect('digital-Patient-List');
        }
        if ($day === '150') {
            $patient_id = $this->input->post('patient_id', TRUE);

            $day150_meds = $this->input->post('day150_meds', TRUE);
            $day150_meds_reason = $this->input->post('day150_meds_reason', TRUE);

            $day150_stock = $this->input->post('day150_stock', TRUE);
            $day150_changes = $this->input->post('day150_changes', TRUE);

            $day150_bp = $this->input->post('day150_bp', TRUE);
            $day150_bp_value = $this->input->post('day150_bp_value', TRUE);

            $day150_weight = $this->input->post('day150_weight', TRUE);

            $day150_rbs = $this->input->post('day150_rbs', TRUE);
            $day150_rbs_value = $this->input->post('day150_rbs_value', TRUE);
            $day150_rbs_reason = $this->input->post('day150_rbs_reason', TRUE);

            $day150_fluid = $this->input->post('day150_fluid', TRUE);
            $day150_urine = $this->input->post('day150_urine', TRUE);

            // Handle multi-select (radio inputs named like array)
            $day150_breathless = $this->input->post('day150_breathless', TRUE);

            $day150_yoga = $this->input->post('day150_yoga', TRUE);
            $day150_yoga_reason = $this->input->post('day150_yoga_reason', TRUE);

            $callremark_150 = $this->input->post('callremark_150', TRUE);
            $callconnect_subremark_150 = $this->input->post('callconnect_subremark_150', TRUE);
            $noresponse_subremark_150 = $this->input->post('noresponse_subremark_150', TRUE);
            $data = [
                'patient_id' => $patient_id,
                'day150_meds' => $day150_meds,
                'day150_meds_reason' => $day150_meds_reason,
                'day150_stock' => $day150_stock,
                'day150_changes' => $day150_changes,
                'day150_bp' => $day150_bp,
                'day150_bp_value' => $day150_bp_value,
                'day150_weight' => $day150_weight,
                'day150_rbs' => $day150_rbs,
                'day150_rbs_value' => $day150_rbs_value,
                'day150_rbs_reason' => $day150_rbs_reason,
                'day150_fluid' => $day150_fluid,
                'day150_urine' => $day150_urine,
                'day150_breathless' => $day150_breathless,
                'day150_yoga' => $day150_yoga,
                'day150_yoga_reason' => $day150_yoga_reason,
                'callremark_150' => $callremark_150,
                'callconnect_subremark_150' => $callconnect_subremark_150,
                'noresponse_subremark_150' => $noresponse_subremark_150
            ];
            $inserted = $this->db->insert('day150_followup', $data);

            if ($inserted) {
                $this->session->set_flashdata('success', 'Day 150 Follow-up saved successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to save Day 150 follow-up.');
            }

            redirect('digital-Patient-List');
        }
        if ($day === '180') {
    $patient_id = $this->input->post('patient_id', TRUE);

    $feeling_now = $this->input->post('feeling_now', TRUE);
    $yoga_helpful = $this->input->post('yoga_helpful', TRUE);
    $yoga_feedback = $this->input->post('yoga_feedback', TRUE);

    $instructor_support = $this->input->post('instructor_support', TRUE);
    $instructor_feedback = $this->input->post('instructor_feedback', TRUE);

    $diet_impact = $this->input->post('diet_impact', TRUE);
    $diet_feedback = $this->input->post('diet_feedback', TRUE);

    $dietician_access = $this->input->post('dietician_access', TRUE);
    $dietician_feedback = $this->input->post('dietician_feedback', TRUE);

    $overall_experience = $this->input->post('overall_experience', TRUE);
    $experience_remarks = $this->input->post('experience_remarks', TRUE);

    $final_feedback = $this->input->post('final_feedback', TRUE);

    $callremark_180 = $this->input->post('callremark_180', TRUE);
    $callconnect_subremark_180 = $this->input->post('callconnect_subremark_180', TRUE);
    $noresponse_subremark_180 = $this->input->post('noresponse_subremark_180', TRUE);

    $data = [
        'patient_id' => $patient_id,
        'feeling_now' => $feeling_now,
        'yoga_helpful' => $yoga_helpful,
        'yoga_feedback' => $yoga_feedback,
        'instructor_support' => $instructor_support,
        'instructor_feedback' => $instructor_feedback,
        'diet_impact' => $diet_impact,
        'diet_feedback' => $diet_feedback,
        'dietician_access' => $dietician_access,
        'dietician_feedback' => $dietician_feedback,
        'overall_experience' => $overall_experience,
        'experience_remarks' => $experience_remarks,
        'final_feedback' => $final_feedback,
        'callremark_180' => $callremark_180,
        'callconnect_subremark_180' => $callconnect_subremark_180,
        'noresponse_subremark_180' => $noresponse_subremark_180
    ];

    $inserted = $this->db->insert('day180_followup', $data);

    if ($inserted) {
        $this->session->set_flashdata('success', 'Day 180 Follow-up saved successfully!');
    } else {
        $this->session->set_flashdata('error', 'Failed to save Day 180 follow-up.');
    }

    redirect('digital-Patient-List');
}

    }

    public function createPatientInquiry()
	{				
		$this->load->view('digitaleducator/create-patient-inquiry-new');	
	}

    	public function createPatientInquiryPost()
{
    if(!$this->session->userdata('digital_educator_id')){
        redirect('Digital-Educator-login');
    }
	// pr($_POST);die;
    $educatorId = $this->session->userdata('digital_educator_id');

    // Allowed image extensions
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $ciplaPrescribed = $_POST['ciplaBrandPrescribed'] ?? 'No';
    $patientEnrolled = $_POST['patientEnrolled'] ?? 'No';
    $prescription_available = $_POST['prescription_available'] ?? 'No';

    $prescriptionFilename = '';
    $consentFilename = '';

    // Handle uploads based on conditions
    if ($ciplaPrescribed === 'Yes' && $patientEnrolled === 'Yes' && $prescription_available === 'Yes') {
        // Prescription required
        if (empty($_FILES['fileToUpload']['name'])) {
            $this->session->set_flashdata('error', "Please upload Prescription.");
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }

        // Consent required
        if (empty($_FILES['consentForm']['name'])) {
            $this->session->set_flashdata('error', "Please upload Consent Form.");
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }

       $prescriptionFilenames = [];
			foreach ($_FILES['fileToUpload']['name'] as $key => $name) {
				$tmpName = $_FILES['fileToUpload']['tmp_name'][$key];
				$extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

				if (!in_array($extension, $allowedExtensions)) {
					$this->session->set_flashdata('error', "Invalid prescription file format: $name");
					redirect(base_url() . '/DigitalEducator-Patient-Inquiry');
					return;
				}

				$filename = time() . '_' . uniqid() . '_' . basename($name);
				$destination = $uploadDir . $filename;

				if (!move_uploaded_file($tmpName, $destination)) {
					$this->session->set_flashdata('error', "Failed to upload prescription file: $name");
					redirect(base_url() . '/DigitalEducator-Patient-Inquiry');
					return;
				}

				$prescriptionFilenames[] = $filename;
			}

			$prescriptionFilename = implode(',', $prescriptionFilenames);

        // Validate and upload consent form
        $consentExtension = strtolower(pathinfo($_FILES['consentForm']['name'], PATHINFO_EXTENSION));
        if (!in_array($consentExtension, $allowedExtensions)) {
            $this->session->set_flashdata('error', 'Invalid consent form file format.');
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }
        $consentFilename = 'Consent_'.time().'_'.uniqid().'_'.basename($_FILES['consentForm']['name']);
        $consentPath = $uploadDir . $consentFilename;
        if (!move_uploaded_file($_FILES['consentForm']['tmp_name'], $consentPath)) {
            die("Error: Failed to upload Consent Form.");
        }
		   // Medicine
    if (!empty($_POST['medicine'])) {
        $medicineString = implode(',', $_POST['medicine']);
    }
    }
	else if ($ciplaPrescribed === 'Yes' && $patientEnrolled === 'Yes' && $prescription_available === 'No') {
		   // Medicine
    if (!empty($_POST['medicine'])) {
        $medicineString = implode(',', $_POST['medicine']);
    }
    }
    else if ($ciplaPrescribed === 'Yes' && $patientEnrolled === 'No' && $prescription_available === 'No') {
        // Consent form should not be uploaded
        if (!empty($_FILES['consentForm']['name'])) {
            $this->session->set_flashdata('error', 'Consent form not required. Please remove it.');
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }
		   // Medicine
    if (!empty($_POST['medicine'])) {
        $medicineString = implode(',', $_POST['medicine']);
    }
}
    else if ($ciplaPrescribed === 'Yes' && $patientEnrolled === 'No' && $prescription_available === 'Yes') {
        // Prescription required
        if (empty($_FILES['fileToUpload']['name'])) {
            $this->session->set_flashdata('error', "Please upload Prescription.");
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }

        $prescriptionFilenames = [];
			foreach ($_FILES['fileToUpload']['name'] as $key => $name) {
				$tmpName = $_FILES['fileToUpload']['tmp_name'][$key];
				$extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

				if (!in_array($extension, $allowedExtensions)) {
					$this->session->set_flashdata('error', "Invalid prescription file format: $name");
					redirect(base_url() . '/DigitalEducator-Patient-Inquiry');
					return;
				}

				$filename = time() . '_' . uniqid() . '_' . basename($name);
				$destination = $uploadDir . $filename;

				if (!move_uploaded_file($tmpName, $destination)) {
					$this->session->set_flashdata('error', "Failed to upload prescription file: $name");
					redirect(base_url() . '/DigitalEducator-Patient-Inquiry');
					return;
				}

				$prescriptionFilenames[] = $filename;
			}

			$prescriptionFilename = implode(',', $prescriptionFilenames);

        // Consent form should not be uploaded
        if (!empty($_FILES['consentForm']['name'])) {
            $this->session->set_flashdata('error', 'Consent form not required. Please remove it.');
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }
		   // Medicine
    if (!empty($_POST['medicine'])) {
        $medicineString = implode(',', $_POST['medicine']);
    }
    }
    else if ($ciplaPrescribed === 'No' && $patientEnrolled === 'No') {
        
    }
	$prescribedselect=$_POST['prescribedselect']??'No';
	if($prescribedselect != 'No' && $prescribedselect==='Purchase Bill Available')
	{
		 if (empty($_FILES['purchasebill']['name'])) {
            $this->session->set_flashdata('error', "Please upload purchasebill.");
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }
		 $purchasebillExt = strtolower(pathinfo($_FILES['purchasebill']['name'], PATHINFO_EXTENSION));
        if (!in_array($purchasebillExt, $allowedExtensions)) {
            $this->session->set_flashdata('error', 'Invalid purchasebill format.');
            redirect(base_url().'/DigitalEducator-Patient-Inquiry');
            die();
        }
        $purchasebillname = 'purchasebill_'.time().'_'.uniqid().'_'.basename($_FILES['purchasebill']['name']);
        $purchasebillpath = $uploadDir . $purchasebillname;
        if (!move_uploaded_file($_FILES['purchasebill']['tmp_name'], $purchasebillpath)) {
            die("Error: Failed to upload purchasebill.");
        }
	}
	// echo 'hii';die;
    // Prepare data array
    $patientFormData = array();
	$patientFormData['cipla_brand_prescribed_no_option']=$prescribedselect ??'';
	$patientFormData['prescription_available']=$prescription_available ??'';
	$patientFormData['purchase_bill']=$purchasebillname?? '';
    $patientFormData['prescription_file'] = $prescriptionFilename;
    $patientFormData['consent_form_file'] = $consentFilename;
    $patientFormData['digital_educator_id'] = $educatorId;
    $patientFormData['camp_id'] = $_POST['campId'] ?? '';
    $patientFormData['hcp_name'] = $_POST['hcp_name'] ?? '';
    $patientFormData['msl_code'] = $_POST['msl_code'] ?? '';
    // $patientFormData['medicine_header'] = $_POST['medicine_header'] ?? '';
    $patientFormData['city'] = $_POST['city'] ?? '';
    $patientFormData['state'] = $_POST['state'] ?? '';
    $patientFormData['speciality'] = $_POST['speciality'] ?? '';
    $patientFormData['patient_name'] = $_POST['patient_name'] ?? '';
    $patientFormData['patient_enrolled'] = $patientEnrolled;
    $patientFormData['patient_kit_enrolled'] = $_POST['patient_kit_enrolled'] ?? '';
    $patientFormData['age'] = $_POST['age'] ?? '';
    $patientFormData['mobile_number'] = $_POST['mobile_number'] ?? '';
    $patientFormData['gender'] = $_POST['gender'] ?? '';
    $patientFormData['date_of_discharge'] = $_POST['date_of_discharge'] ?? '';
    $patientFormData['cipla_brand_prescribed'] = $ciplaPrescribed;

    $patientFormData['blood_pressure'] = $_POST['blood_pressure'] ?? '';
    $patientFormData['urea'] = $_POST['urea'] ?? '';
    $patientFormData['lv_ef'] = $_POST['lv_ef'] ?? '';
    $patientFormData['heart_rate'] = $_POST['heart_rate'] ?? '';
    $patientFormData['nt_pro_bnp'] = $_POST['nt_pro_bnp'] ?? '';
    $patientFormData['egfr'] = $_POST['egfr'] ?? '';
    $patientFormData['potassium'] = $_POST['potassium'] ?? '';
    $patientFormData['sodium'] = $_POST['sodium'] ?? '';
    $patientFormData['uric_acid'] = $_POST['uric_acid'] ?? '';
    $patientFormData['creatinine'] = $_POST['creatinine'] ?? '';
    $patientFormData['crp'] = $_POST['crp'] ?? '';
    $patientFormData['uacr'] = $_POST['uacr'] ?? '';
    $patientFormData['iron'] = $_POST['iron'] ?? '';

    $patientFormData['hb'] = $_POST['hb'] ?? '';
    $patientFormData['ldl'] = $_POST['ldl'] ?? '';
    $patientFormData['hdl'] = $_POST['hdl'] ?? '';
    $patientFormData['triglycerid'] = $_POST['triglycerid'] ?? '';
    $patientFormData['total_cholesterol'] = $_POST['total_cholesterol'] ?? '';
    $patientFormData['hba1c'] = $_POST['hba1c'] ?? '';
    $patientFormData['sgot'] = $_POST['sgot'] ?? '';
    $patientFormData['sgpt'] = $_POST['sgpt'] ?? '';
    $patientFormData['vit_d'] = $_POST['vit_d'] ?? '';
    $patientFormData['t3'] = $_POST['t3'] ?? '';
    $patientFormData['t4'] = $_POST['t4'] ?? '';
    $patientFormData['anti_diabetic_therapy'] = $_POST['anti_diabetic_therapy'] ?? '';

    $patientFormData['arni'] = $_POST['arni'] ?? '';
    $patientFormData['b_blockers'] = $_POST['b_blockers'] ?? '';
    $patientFormData['mra'] = $_POST['mra'] ?? '';

    $patientFormData['arni_remark'] = $_POST['arni_remark'] ?? '';
    $patientFormData['b_blockers_remark'] = $_POST['b_blockers_remark'] ?? '';
    $patientFormData['mra_remark'] = $_POST['mra_remark'] ?? '';

    $patientFormData['remark'] = $_POST['remark'] ?? '';

    $patientFormData['weight'] = $_POST['weight'] ?? '';
    $patientFormData['height'] = $_POST['height'] ?? '';
    $patientFormData['waist_circumference_remark'] = $_POST['waist_circumference_remark'] ?? '';
    $patientFormData['bmi'] = $_POST['bmi'] ?? '';
    $patientFormData['waist_to_height_ratio'] = $_POST['waist_to_height_ratio'] ?? '';

    // Radio buttons
    $patientFormData['vaccination'] = $_POST['vaccination'] ?? '';
    $patientFormData['influenza'] = $_POST['influenza'] ?? '';
    $patientFormData['pneumococcal'] = $_POST['pneumococcal'] ?? '';
    $patientFormData['cardiac_rehab'] = $_POST['cardiac_rehab'] ?? '';
    $patientFormData['nsaids_use'] = $_POST['nsaids_use'] ?? '';
    $patientFormData['patient_kit_given'] = $_POST['patient_kit_given'] ?? '';
    $patientFormData['exercise_30mins'] = $_POST['exercise_30mins'] ?? '';
    $patientFormData['breakfast_days'] = $_POST['breakfast_days'] ?? '';
    $patientFormData['food_habits'] = $_POST['food_habits'] ?? '';
    $patientFormData['sedentary_hours'] = $_POST['sedentary_hours'] ?? '';

    $patientFormData['type_2_dm'] = $_POST['type_2_dm'] ?? '';
    $patientFormData['hypertension'] = $_POST['hypertension'] ?? '';
    $patientFormData['dyslipidemia'] = $_POST['dyslipidemia'] ?? '';
    $patientFormData['pco'] = $_POST['pco'] ?? '';
    $patientFormData['knee_pain'] = $_POST['knee_pain'] ?? '';
    $patientFormData['asthma'] = $_POST['asthma'] ?? '';

    $patientFormData['adl_bathing'] = $_POST['adl_bathing'] ?? '';
    $patientFormData['adl_dressing'] = $_POST['adl_dressing'] ?? '';
    $patientFormData['adl_walking'] = $_POST['adl_walking'] ?? '';
    $patientFormData['adl_toileting'] = $_POST['adl_toileting'] ?? '';
	$patientFormData['medicine'] = $medicineString ?? '';
 

    // Competitor
    if (!empty($_POST['Compititor'])) {
        $CompititorString = implode(',', $_POST['Compititor']);
        $patientFormData['Compititor'] = $CompititorString;
    }

    $patientFormData['date'] = date('Y-m-d');

    // Save data to DB
    $inquiry_id = $this->master_model->save('patient_inquiry_new', $patientFormData);

    if ($inquiry_id) {
        $this->session->set_flashdata('message', 'Patient information submitted successfully');
    } else {
        $this->session->set_flashdata('error', 'Try again! Patient information not created');
    }

    redirect(base_url() . '/DigitalEducator-Patient-Inquiry');
}

public function getHCLDetails(){
		$mslCode = "";
		$status = "fail";
		$doctorId =  $_POST['doctor_id'];
	 	$status = "success";

		$stock_view_query = "SELECT * FROM `doctors_new` WHERE `id` = '".$doctorId."'";				
		$DoctorDetails 	= $this->master_model->customQueryRow($stock_view_query); 

		$mslCode = $DoctorDetails->msl_code;
		$city =$DoctorDetails->city;
		$speciality =$DoctorDetails->speciality;
		$state =$DoctorDetails->state;

		$statename = "select * from `state_list` where state='".$state."'";
		$statedetails =$this->master_model->customQueryRow($statename);
		
		$state_id=$statedetails->id;
	   
		echo   json_encode(array('status'=>$status,'msl_code'=>$mslCode,'city'=>$city,'speciality'=>$speciality,'state'=>$state ,'state_id'=>$state_id));
	   die();
   }
	
}