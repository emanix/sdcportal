<?php

class Admin extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model("M_Students");
		$this->load->module('Templates');
	}

	function index($data = NULL){
        $data['page_title'] = 'View Students Case details';
        $data['content_view'] = 'Admin/dashboard_view';
        $this->templates->call_admin_template($data);
	}

	function manage_session(){
		$student = $this->M_Students->get_student_by_matric($this->input->post('matric'));
		print_r('am here'); print_r($student); die;
		$data['student_records'] = 'Students Management';
		$data['add_session'] = 'Add Session';
        $data['view_session'] = 'View Session';
        $data['page_title'] = 'Manage Session';
        $data['optional_description'] = 'Create new session record.';
        $data['desc_students'] = 'Add current session';
        $data['session_table'] = $this->create_session_table();
        $data['content_view'] = 'Admin/session_view';
        $this->templates->call_admin_template($data);
	}

	function create_student_table(){
		if (isset($_GET['matricno'])){
			$student = $this->M_Students->get_student_by_matric($_GET['matricno']);
			echo "<div class='body table-responsive'>";
			echo "<table class='table table-bordered'>";
			echo "<thead>";
			echo "<tr>";
			echo "<th>Serial No</th>";
			echo "<th>Matric No</th>";
			echo "<th>Student Name</th>";
			echo "<th>Program</th>";
			echo "<th>School</th>";
			echo "<th>Department</th>";
			echo "<th>Semester</th>";
			echo "<th>Level</th>";
			echo "<th>Hall</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			$student_table = "";
			if (count($student)>0){
				$incrementer = 1;
				foreach ($student as $key => $value) {
					$student_table .="<tr>";
					$student_table .="<td>{$incrementer}</td>";
					$student_table .="<td>{$value->matric_no}</td>";
					$student_table .="<td>{$value->name}</td>";
					$student_table .="<td>{$value->program}</td>";
					$student_table .="<td>{$value->school}</td>";
					$student_table .="<td>{$value->department}</td>";
					$student_table .="<td>{$value->semester}</td>";
					$student_table .="<td>{$value->level}</td>";
					$student_table .="<td>{$value->hall}</td>";
					$this->session->set_userdata(array('name' => $value->name));
					$student_table .="<td><input type='hidden' id ='std' value='{$value->studid}'/><a href='#'> <i onclick='show_case()'>View Case</i></a></td>";
					$student_table .="<td><a href='".base_url()."Admin/add_case/{$value->studid}'> <i>Add Case</i></a></td>";
					$incrementer++;
				}
				echo $student_table;
			}
			echo "</tbody>";
			echo "</table>";
		}
	}

	function create_student_case_table(){
		if (isset($_GET['stud_id'])){
			$student = $this->M_Students->get_case_by_studentid($_GET['stud_id']);
			echo "<div class='header'>";
			echo "<h2>Case Detail of {$this->session->userdata('name')}</h2>";
			echo "</div>";
			echo "<div class='body table-responsive'>";
			echo "<table class='table table-bordered'>";
			echo "<thead>";
			echo "<tr>";
			echo "<th>Serial No</th>";
			echo "<th>SDC Number</th>";
			echo "<th>Matric No</th>";
			echo "<th>Student Name</th>";
			echo "<th>Infraction</th>";
			echo "<th>Panel recommendation</th>";
			echo "<th>Date</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			$student_table = "";
			if (count($student)>0){
				$incrementer = 1;
				foreach ($student as $key => $value) {
					$student_table .="<tr>";
					$student_table .="<td>{$incrementer}</td>";
					$student_table .="<td>{$value->sdc_no}</td>";
					$student_table .="<td>{$value->matric_no}</td>";
					$student_table .="<td>{$value->name}</td>";
					$student_table .="<td>{$value->infraction}</td>";
					$student_table .="<td>{$value->panel_recom}</td>";
					$student_table .="<td>{$value->date}</td>";
					$this->session->set_userdata('studid', $value->studid);
					$student_table .="<td><a href='".base_url()."Admin/edit_case/{$value->caseid}'> <i>Edit Case</i></a></td>";
					$student_table .="<td><a href='".base_url()."Admin/edit_session/{$value->caseid}'> <i>Print Case</i></a></td>";
					$incrementer++;
				}
				echo $student_table;
			}
			echo "</tbody>";
			echo "</table>";
		}
	}

	function add_case($id){
		/*$this->load->model('M_Admin');
		$sid = $this->M_Admin->get_session_by_id($id);
		//creates the session name field and populates it with the session to be edited
		$update_field = "";
		if(count($sid) > 0){
			foreach ($sid as $key => $value) {
				$update_field .= "<div class='col-sm-10'>";
				$update_field .= "<input  type='text' class='form-control' id='inputEmail3' name='{$value->session_name}' value='{$value->session_name}'>";
				$update_field .= "</div>";
				$this->session->set_userdata(array('sessionname' => $value->session_name));
			}	
		}*/
		//Loads the edit session page
        $data['page_title'] = 'Add Students Case';
        //$data['desc_students'] = 'Add current session';
        //$data['session_field'] = $update_field;
        $data['content_view'] = 'Students/add_students_case_view';
        $this->templates->call_admin_template($data);
	}

	function edit_case($id){
		/*$this->load->model('M_Admin');
		$sid = $this->M_Admin->get_session_by_id($id);
		//creates the session name field and populates it with the session to be edited
		$update_field = "";
		if(count($sid) > 0){
			foreach ($sid as $key => $value) {
				$update_field .= "<div class='col-sm-10'>";
				$update_field .= "<input  type='text' class='form-control' id='inputEmail3' name='{$value->session_name}' value='{$value->session_name}'>";
				$update_field .= "</div>";
				$this->session->set_userdata(array('sessionname' => $value->session_name));
			}	
		}*/
		//Loads the edit session page
        $data['page_title'] = 'Edit Students Case';
        //$data['desc_students'] = 'Add current session';
        //$data['session_field'] = $update_field;
        $data['content_view'] = 'Students/edit_student_case_view';
        $this->templates->call_admin_template($data);
	}

	function update_session(){
		if($this->input->post()){
			$this->load->model('M_Admin');
			$this->M_Admin->session_update();
			//Updates the semesters of the updated session
			for ($counter = 1; $counter<=2; $counter++){
				$olddata = $this->session->userdata('sessionname').'.'.$counter;
        		$data = $this->input->post($this->session->userdata('sessionname')).'.'.$counter;
        		$this->M_Admin->semester_update($data, $olddata);

        	}
        	$this->session->set_flashdata('success', 'Session successfully updated');
        	redirect(base_url() . 'Admin/manage_session');
		}
	}

}