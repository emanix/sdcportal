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
        $this->db->join('semestertb', 'semestertb.semester_id = casetb.semid');
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

    function getSemesters(){
        /*$query = $this->db->query('select * from semestertb order by semester_name DECS');*/
        $this->db->select('*');
        $this->db->from('semestertb');
        $this->db->order_by('semester_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function getSemester($data){
        $query = $this->db->query('select * from semestertb where semester_id = "'.$data.'"');
        return $query->result();
    }

    function addSemester($data){
        $this->db->insert('semestertb', $data);
    }

    /*function addSemester($data){
        $this->db->update('semestertb', $data);
    }*/

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

    function updateCase($id, $case){
        $this->db->where('caseid', $id);
        $this->db->update('casetb', $case);
    }
}