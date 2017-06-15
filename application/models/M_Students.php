<?php

class M_Students extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_student_by_matric($matric){
    	$query = $this->db->query('select * from studenttb where matric_no = "'.$matric.'"');
    	return $query->result();
    }

    function get_case_by_studentid($id){
    	/*$query = $this->db->query('select * from casetb where stud_id = "'.$id.'"');*/
    	$this->db->select('*');
    	$this->db->from('casetb');
    	$this->db->join('studenttb', 'studenttb.studid = casetb.stud_id');
    	$this->db->where('stud_id', $id);
    	$query = $this->db->get();
    	return $query->result();
    }
}