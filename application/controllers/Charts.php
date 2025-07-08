<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Charts extends CI_Controller
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
private function jsonResponse($data) {
        if (ob_get_contents()) ob_clean();
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    // Monthly Counseling Data
    public function monthly_counseling() {
        $user_id=$this->session->userdata('educator_id');
        $query = $this->db->query("
            SELECT 
                MONTHNAME(date) as month, 
                COUNT(*) as count 
            FROM patient_inquiry_new 
            WHERE date >= DATE_SUB(NOW(), INTERVAL 4 MONTH) AND educator_id=$user_id
            GROUP BY MONTH(date)
            ORDER BY MONTH(date)
        ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
    public function pmmonthly_counseling() {
        // $user_id=$this->session->userdata('educator_id');
        $query = $this->db->query("
            SELECT 
                MONTHNAME(date) as month, 
                COUNT(*) as count 
            FROM patient_inquiry_new 
            WHERE date >= DATE_SUB(NOW(), INTERVAL 4 MONTH)
            GROUP BY MONTH(date)
            ORDER BY MONTH(date)
        ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
    public function rmmonthly_counseling() {
        $user_id=$this->session->userdata('rm_id');
        // echo $user_id;die;
        $query = $this->db->query("
            SELECT 
                MONTHNAME(date) as month, 
                COUNT(*) as count 
            FROM patient_inquiry_new pin
            LEFT JOIN educator e ON e.id=pin.educator_id
            LEFT JOIN rm_name rm ON rm.id=e.rm_id
            WHERE date >= DATE_SUB(NOW(), INTERVAL 4 MONTH) AND rm.id=$user_id
            GROUP BY MONTH(date)
            ORDER BY MONTH(date)
        ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }

    // Top Educators Data
    public function pmtop_educators() {
        $limit = $this->input->get('limit') ?: 5;
        $query = $this->db->query("
            SELECT 
                e.first_name as educator_name,
                COUNT(c.id) as session_count
            FROM educator e
            LEFT JOIN patient_inquiry_new c ON c.educator_id = e.id
            GROUP BY e.id
            ORDER BY session_count DESC LIMIT $limit
            ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
    public function pmnoteducator() {
        $limit = $this->input->get('limit') ?: 5;
        $query = $this->db->query("
            SELECT 
                e.first_name as educator_name
            FROM educator e
            LEFT JOIN patient_inquiry_new c ON c.educator_id = e.id
            WHERE c.medicine is NULL
            GROUP BY e.id
            ORDER BY e.first_name DESC LIMIT $limit
            ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
    public function rmtop_educators() {
         $user_id=$this->session->userdata('rm_id');
        $limit = $this->input->get('limit') ?: 5;
        $query = $this->db->query("
            SELECT 
                e.first_name as educator_name,
                COUNT(c.id) as session_count
            FROM educator e
            LEFT JOIN patient_inquiry_new c ON c.educator_id = e.id
             LEFT JOIN rm_name rm ON rm.id=e.rm_id
             WHERE rm.id=$user_id
            GROUP BY e.id
            ORDER BY session_count DESC LIMIT $limit
            ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }

    // Gender Distribution Data
    public function gender_distribution() {
         $user_id=$this->session->userdata('educator_id');
        $query = $this->db->query("
            SELECT 
                gender,
                COUNT(*) as count
            FROM patient_inquiry_new
            WHERE educator_id=$user_id
            GROUP BY gender
        ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
    public function rmgender_distribution() {
         $user_id=$this->session->userdata('rm_id');
        $query = $this->db->query("
                    SELECT 
                'Brand' AS type,
                GROUP_CONCAT(DISTINCT medicine SEPARATOR ', ') AS names,
                COUNT(*) AS count
            FROM patient_inquiry_new pin
            LEFT JOIN educator e ON e.id = pin.educator_id
            LEFT JOIN rm_name rm ON rm.id = e.rm_id
            WHERE rm.id = $user_id AND medicine IS NOT NULL

            UNION ALL

            SELECT 
                'Non-brand' AS type,
                GROUP_CONCAT(DISTINCT compititor SEPARATOR ', ') AS names,
                COUNT(*) AS count
            FROM patient_inquiry_new pin
            LEFT JOIN educator e ON e.id = pin.educator_id
            LEFT JOIN rm_name rm ON rm.id = e.rm_id
            WHERE rm.id = $user_id AND compititor IS NOT NULL
        ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
    public function pmgender_distribution() {
        //  $user_id=$this->session->userdata('educator_id');
        $query = $this->db->query("
           SELECT 
                'Brand' AS type,
                GROUP_CONCAT(DISTINCT medicine SEPARATOR ', ') AS names,
                COUNT(*) AS count
            FROM patient_inquiry_new pin
            LEFT JOIN educator e ON e.id = pin.educator_id
            LEFT JOIN rm_name rm ON rm.id = e.rm_id
            WHERE  medicine IS NOT NULL

            UNION ALL

            SELECT 
                'Non-brand' AS type,
                GROUP_CONCAT(DISTINCT compititor SEPARATOR ', ') AS names,
                COUNT(*) AS count
            FROM patient_inquiry_new pin
            LEFT JOIN educator e ON e.id = pin.educator_id
            LEFT JOIN rm_name rm ON rm.id = e.rm_id
            WHERE  compititor IS NOT NULL
        ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }

    // Camp Distribution Data
    public function camp_distribution() {
         $user_id=$this->session->userdata('educator_id');
        $query = $this->db->query("
            SELECT 
                date,
                COUNT(*) as count
            FROM camp WHERE edcator_id=$user_id
            GROUP BY date
            ORDER BY count DESC LIMIT 7
        ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
    public function rmcamp_distribution() {
         $user_id=$this->session->userdata('rm_id');
        $query = $this->db->query("
            SELECT 
                date,
                COUNT(*) as count
            FROM camp pin 
            LEFT JOIN educator e ON e.id=pin.edcator_id
            LEFT JOIN rm_name rm ON rm.id=e.rm_id
            WHERE rm.id=$user_id
            GROUP BY date
            ORDER BY date DESC LIMIT 7
        ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
    public function pmcamp_distribution() {
        //  $user_id=$this->session->userdata('educator_id');
        $query = $this->db->query("
            SELECT 
                date,
                COUNT(*) as count
            FROM camp 
            GROUP BY date
            ORDER BY date DESC LIMIT 7
        ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }

    // Blood Pressure Data
    public function blood_pressure() {
        $user_id=$this->session->userdata('educator_id');
        $days = $this->input->get('days') ?: 5;
        
        $query = $this->db->query("
            SELECT 
                date,
                AVG(CAST(SUBSTRING_INDEX(blood_pressure, '/', 1) AS UNSIGNED)) as systolic,
            AVG(CAST(SUBSTRING_INDEX(blood_pressure, '/', -1) AS UNSIGNED)) as diastolic
            FROM patient_inquiry_new
            WHERE date >= DATE_SUB(NOW(), INTERVAL ? DAY) AND educator_id=$user_id
            GROUP BY DATE(date)
            ORDER BY date
        ", [$days]);
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
    public function rmblood_pressure() {
        $user_id=$this->session->userdata('rm_id');
        $days = $this->input->get('days') ?: 5;
        
        $query = $this->db->query("
           SELECT 
                h.name,
                COUNT(*) AS count
            FROM patient_inquiry_new pin
            LEFT JOIN doctors_new h on pin.hcp_name=h.id
            LEFT JOIN educator e ON e.id=pin.educator_id
            LEFT JOIN rm_name rm ON rm.id=e.rm_id
            WHERE rm.id=$user_id AND medicine is null
            GROUP BY h.name
            ORDER BY h.name
        ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
    public function pmblood_pressure() {
        // $user_id=$this->session->userdata('educator_id');
        $days = $this->input->get('days') ?: 5;
        
        $query = $this->db->query("
            SELECT 
                date,
                AVG(CAST(SUBSTRING_INDEX(blood_pressure, '/', 1) AS UNSIGNED)) as systolic,
            AVG(CAST(SUBSTRING_INDEX(blood_pressure, '/', -1) AS UNSIGNED)) as diastolic
            FROM patient_inquiry_new
            WHERE date >= DATE_SUB(NOW(), INTERVAL ? DAY) 
            GROUP BY DATE(date)
            ORDER BY date DESC LIMIT 10
        ", [$days]);
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }

    // Obesity Metrics Data
    public function obesity_metrics() {
         $user_id=$this->session->userdata('educator_id');
        $days = $this->input->get('days') ?: 5;
        
        $query = $this->db->query("
            SELECT 
                date,
                AVG(bmi) as bmi,
                AVG(waist_to_height_ratio) as whr
            FROM patient_inquiry_new
            WHERE date >= DATE_SUB(NOW(), INTERVAL ? DAY) AND educator_id=$user_id
            GROUP BY DATE(date)
            ORDER BY date
        ", [$days]);
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
    public function rmobesity_metrics() {
         $user_id=$this->session->userdata('rm_id');
        $days = $this->input->get('days') ?: 5;
        
        $query = $this->db->query("
            SELECT 
                h.name,
                COUNT(*) AS count
            FROM patient_inquiry_new pin
            LEFT JOIN doctors_new h on pin.hcp_name=h.id
            LEFT JOIN educator e ON e.id=pin.educator_id
            LEFT JOIN rm_name rm ON rm.id=e.rm_id
            WHERE rm.id=$user_id AND medicine is not null
            GROUP BY h.name
            ORDER BY h.name
        ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
    public function pmobesity_metrics() {
        //  $user_id=$this->session->userdata('educator_id');
        $days = $this->input->get('days') ?: 5;
        
        $query = $this->db->query("
             SELECT 
                h.name,
                COUNT(*) AS count
            FROM patient_inquiry_new pin
            LEFT JOIN doctors_new h on pin.hcp_name=h.id
            LEFT JOIN educator e ON e.id=pin.educator_id
            LEFT JOIN rm_name rm ON rm.id=e.rm_id
            WHERE medicine is not null
            GROUP BY h.name
            ORDER BY h.name Limit 10");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
    public function doctor_metrics() {
         $user_id=$this->session->userdata('educator_id');
        $days = $this->input->get('days') ?: 5;
        
        $query = $this->db->query("
             SELECT 
                h.name,
                COUNT(*) AS count
            FROM patient_inquiry_new pin
            LEFT JOIN educator e ON e.id=pin.educator_id
            LEFT JOIN doctors_new h on pin.hcp_name=h.id AND e.id=h.educator_id
            WHERE medicine is not null AND pin.educator_id=$user_id
            GROUP BY h.name
            ORDER BY h.name Limit 10");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
     public function doctornot_metrics() {
        $user_id=$this->session->userdata('educator_id');
        $days = $this->input->get('days') ?: 5;
        
        $query = $this->db->query("
           SELECT 
                h.name,
                COUNT(*) AS count
            FROM patient_inquiry_new pin
            LEFT JOIN doctors_new h on pin.hcp_name=h.id
            LEFT JOIN educator e ON e.id=pin.educator_id
            LEFT JOIN rm_name rm ON rm.id=e.rm_id
            WHERE pin.educator_id=$user_id AND medicine is null
            GROUP BY h.name
            ORDER BY h.name
        ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
     public function pmdocnot() {
        // $user_id=$this->session->userdata('educator_id');
        $days = $this->input->get('days') ?: 5;
        
        $query = $this->db->query("
           SELECT 
                h.name,
                COUNT(*) AS count
            FROM patient_inquiry_new pin
            LEFT JOIN doctors_new h on pin.hcp_name=h.id
            LEFT JOIN educator e ON e.id=pin.educator_id
            WHERE  medicine is null
            GROUP BY h.name
            ORDER BY h.name LIMIT 5
        ");
        
        $data = $query->result_array();
        $this->jsonResponse(['success' => true, 'data' => $data]);
    }
}