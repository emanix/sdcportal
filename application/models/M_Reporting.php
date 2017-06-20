<?php

class M_Reporting extends CI_Model{

	function __construct(){
		parent:: __construct();
		
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
}