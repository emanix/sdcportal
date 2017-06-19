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

    function get_student_by_id($id){
        $query = $this->db->query('select * from studenttb where studid = "'.$id.'"');
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

    function get_case_by_caseid($id){
        /*$query = $this->db->query('select * from casetb where stud_id = "'.$id.'"');*/
        $this->db->select('*');
        $this->db->from('casetb');
        $this->db->join('studenttb', 'studenttb.studid = casetb.stud_id');
        $this->db->where('caseid', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function addStudentRecord($data){
        $this->db->insert('studenttb', $data);
    }

    function addStudentCaseRecord($data){
        $this->db->insert('casetb', $data);
    }

    function updateStudentRecord($id, $image){
        $query = array('picture' => $image);
        $this->db->where('studid', $id);
        $this->db->update('studenttb', $query);
    }
}