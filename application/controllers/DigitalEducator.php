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
}