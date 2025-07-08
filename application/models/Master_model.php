<?php
/************************************************************************************
* This is the Master Model for project, it contain all function related to Add,update,delete,fetch.*
*************************************************************************************/
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Master_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    #########################################################
    #            Functions For Master Model #
    #########################################################    
    function getRow($table, $data)
    {
		
        return $this->db->get_where($table, $data)->first_row();
    }
    function listAll($table,$order_by="id",$order_type="DESC",$group_by='')
    {
		if($group_by){
			$this->db->group_by($group_by); 
		}
		$this->db->order_by($order_by,$order_type);
		$rest = $this->db->get($table);
		return $rest->result_array();
    }
    function listAllWhere($table,$where,$order_by="id",$order_type="DESC",$group_by='')
    {
		if($group_by){
			$this->db->group_by($group_by); 
		}
        $this->db->order_by($order_by,$order_type);
        $rest = $this->db->get_where($table, $where);
        return $rest->result_array();
    }

    function save($table, $data)
    {
        if (isset($data['id']) && $data['id'] > 0) {
            $this->db->update($table, $data, array(
                'id' => $data['id']
            ));
            return $data['id'];
        } else {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
    }
	
	    function save_user($table, $data)
    {
        if (isset($data['uid']) && $data['uid'] > 0) {
            $this->db->update($table, $data, array(
                'uid' => $data['uid']
            ));
            return $data['uid'];
        } else {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
    }
	
	function save1($table, $data)
    {
        if (isset($data['company_id']) && $data['company_id'] > 0) {
            $this->db->update($table, $data, array(
                'company_id' => $data['company_id']
            ));
            return $data['company_id'];
        } else {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
    }
	
	function query($sql){
		$this->db->query($sql);
		return  $id = $this->db->affected_rows();
	}
	
    function delete($id, $table)
    {
        $this->db->delete($table, array(
            'id' => $id
        ));
    }
	
	function customQueryRow($sql,$delete=''){
		$query = $this->db->query($sql);
		if(!$delete){
			$row = $query->row();
			return $row;
		}
	}
	function customQueryArray($sql){
		$query = $this->db->query($sql);
        $array = $query->result_array();
		return $array;
	}
	
	function countRow($sql)
	{
		$query = $this->db->query($sql);
        return $query->num_rows();
	}
	
}