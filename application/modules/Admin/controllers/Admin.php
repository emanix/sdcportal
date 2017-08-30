<?php

class Admin extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model("M_Students");
		$this->load->module('Templates');
	}

	function index($data = NULL){
        $data['page_title'] = 'Choose semester to add case';
        $data['semester_table'] = $this->get_semester();
        $data['content_view'] = 'Students/semester_view';
        $this->templates->call_admin_template($data);
	}

	function create_student_table(){
		if (isset($_GET['matricno'])){
			$matric = $_GET['matricno'];
			$student = $this->M_Students->get_student_by_matric($_GET['matricno']);
			if(count($student) > 0){
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
				//echo "<th>Semester</th>";
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
						//$student_table .="<td>{$value->semester}</td>";
						$student_table .="<td>{$value->level}</td>";
						$student_table .="<td>{$value->hall}</td>";
						$this->session->set_userdata(array('studname' => $value->name), 'studid', $value->studid);
						$student_table .="<td><input type='hidden' id ='std' value='{$value->studid}'/><a href='#'> <i onclick='show_case()'>View Case</i></a></td>";
						$student_table .="<td><a href='".base_url()."Admin/addCase/{$value->studid}'> <i>Add Case</i></a></td>";
						$student_table .="<td><a href='".base_url()."Admin/add_passport/{$value->studid}'> <i>Update Passport</i></a></td>";
						$incrementer++;
					}
					echo $student_table;
				}
				echo "</tbody>";
				echo "</table>";
			}else{
				$this->load->module("Umis");
				//get students details from umis
				$student_record = $this->umis->load_api("getStudentInfo", $this->session->userdata('semester_name'), $matric);
				foreach ($student_record->transfer->record as $records){
					$getRecord = array(
						'matric_no' => $records->studentid,
						'name' => $records->studentname,
						'program' => $records->majorname,
						'school' => $records->schoolname,
						'department' => $records->departmentname,
						//'semester' => $records->quarterid,
						'level' => $records->studylevel,
						'hall' => $records->residencename
					);
					//add students details to sdc database
					$this->M_Students->addStudentRecord($getRecord);
				}
				//fetch the just added record from database
				$studentRec = $this->M_Students->get_student_by_matric($_GET['matricno']);

				if(count($studentRec) > 0){
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
					if (count($studentRec)>0){
						$incrementer = 1;
						foreach ($studentRec as $key => $value) {
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
							$this->session->set_userdata(array('studname' => $value->name));
							$student_table .="<td><input type='hidden' id ='std' value='{$value->studid}'/><a href='#'> <i onclick='show_case()'>View Case</i></a></td>";
							$student_table .="<td><a href='".base_url()."Admin/addCase/{$value->studid}'> <i>Add Case</i></a></td>";
							$student_table .="<td><a href='".base_url()."Admin/add_passport/{$value->studid}'> <i>Update Passport</i></a></td>";
							$incrementer++;
						}
						echo $student_table;
					}
					echo "</tbody>";
					echo "</table>";
				}
			}
		}
	}

	function create_student_case_table(){
		if (isset($_GET['stud_id'])){
			$student = $this->M_Students->get_case_by_studentid($_GET['stud_id']);
			if(count($student) > 0){
				echo "<div class='header'>";
				echo "<h2>Case Detail of {$this->session->userdata('studname')}</h2>";
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
				echo "<th>Semester</th>";
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
						$student_table .="<td>{$value->semester_name}</td>";
						$student_table .="<td>{$value->date}</td>";
						$this->session->set_userdata('studid', $value->studid);
						$student_table .="<td><a href='".base_url()."Admin/edit_case/{$value->caseid}'> <i>Edit Case</i></a></td>";
						$student_table .="<td><a href='".base_url()."Reporting/case_report/{$value->caseid}' target='_blank'> <i>Print Case</i></a></td>";
						$incrementer++;
					}
					echo $student_table;
				}
				echo "</tbody>";
				echo "</table>";
			}else{
				echo "<div class='header'>";
				echo "<h2>Case Detail</h2>";
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
				$student_table .="<tr>";
				$student_table .="<td colspan='7'><center><h4>No Case to display</h4></center></td>";
				$student_table .="</tr>";
				echo $student_table;
				echo "</tbody>";
				echo "</table>";
			}
		}
	}

	function get_semester(){
		/*$this->session->set_userdata('studid', $id);

		$student = $this->M_Students->get_student_by_id($id);

		foreach ($student as $key => $value) {
			//$data['passport'] = base_url().ltrim($value->picture, '.');
			//$data['name'] = $value->name;
			$name = $value->name;
		}*/

		$semester = $this->M_Students->getSemesters();
		$table = "";
		if (count($semester)>0){
			$incrementer = 1;
			foreach ($semester as $key => $value){
				$table .= "<tr>";
				$table .= "<td>{$incrementer}</td>";
				$table .= "<td>{$value->semester_name}</td>";
				$table .= "<td><a href='".base_url()."Admin/getMatric/{$value->semester_id}'> <i>Find Matric</i></a></td>";
				$incrementer++;
			}
		}else{
			$this->load->module("Umis");
				//get semester details from umis
			$semester_record = $this->umis->load_apis("getSemesters"); 
			//print_r($semester_record); die;
			foreach ($semester_record->transfer->record as $records){
				$getRecord = array('semester_name' => $records->quarterid);
				//Update semester table
				$this->M_Students->addSemester($getRecord);
			}
			$semesters = $this->M_Students->getSemesters();
			$table = "";
			if (count($semesters)>0){
				$incrementer = 1;
				foreach ($semesters as $key => $value){
					$table .= "<tr>";
					$table .= "<td>{$incrementer}</td>";
					$table .= "<td>{$value->semester_name}</td>";
					$table .= "<td><a href='".base_url()."Admin/getMatric/{$value->semester_id}'> <i>Find Matric</i></a></td>";
					$incrementer++;
				}
			}
		}
		return $table;
	}

	function getSemester(){

		$semester = $this->M_Students->getSemesters();
		$table = "";
		if (count($semester)>0){
			$incrementer = 1;
			foreach ($semester as $key => $value){
				$table .= "<tr>";
				$table .= "<td>{$incrementer}</td>";
				$table .= "<td>{$value->semester_name}</td>";
				$table .= "<td><a href='".base_url()."Admin/getMatric/{$value->semester_id}'> <i>Find Matric</i></a></td>";
				$incrementer++;
			}
		}else{
			$this->load->module("Umis");
				//get semester details from umis
			$semester_record = $this->umis->load_apis("getSemesters"); 
			//print_r($semester_record); die;
			foreach ($semester_record->transfer->record as $records){
				$getRecord = array('semester_name' => $records->quarterid);
				//Update semester table
				$this->M_Students->addSemester($getRecord);
			}
			$semesters = $this->M_Students->getSemesters();
			$table = "";
			if (count($semesters)>0){
				$incrementer = 1;
				foreach ($semesters as $key => $value){
					$table .= "<tr>";
					$table .= "<td>{$incrementer}</td>";
					$table .= "<td>{$value->semester_name}</td>";
					$table .= "<td><a href='".base_url()."Admin/getMatric/{$value->semester_id}'> <i>Find Matric</i></a></td>";
					$incrementer++;
				}
			}
		}
	
        $data['page_title'] = 'Choose semester to add case';
        $data['semester_table'] = $table;
        $data['content_view'] = 'Students/semester_view';
        $this->templates->call_admin_template($data);
	}

	function getMatric($id){
		$this->session->set_userdata('semester_id', $id);
		$semester = $this->M_Students->getSemester($id);
		foreach ($semester as $key => $value) {
			$sem = $value->semester_name;
			$this->session->set_userdata('semester_name', $sem);
		}
		$data['page_title'] = 'Enter Students Matric Number to search in '.$sem.'';
        $data['content_view'] = 'Admin/dashboard_view';
        $this->templates->call_admin_template($data);
	}

	function viewCase(){
		/*$this->session->set_userdata('semester_id', $id);
		$semester = $this->M_Students->getSemester($id);
		foreach ($semester as $key => $value) {
			$sem = $value->semester_name;
			$this->session->set_userdata('semester_name', $sem);
		}*/
		$data['page_title'] = 'Enter Students Matric Number';
        $data['content_view'] = 'Admin/view_case_view';
        $this->templates->call_admin_template($data);
	}

	function addCase($id){
		//$this->session->set_userdata('semester_id', $id);
		$semester = $this->M_Students->getSemester($this->session->userdata('semester_id'));
		$data['semid'] = $this->session->userdata('semester_id');
		$data['studid'] = $id;
		foreach ($semester as $key => $value) {
			$sem = $value->semester_name;
		}
		$student = $this->M_Students->get_student_by_id($id);

		foreach ($student as $key => $value) {
			$data['passport'] = base_url().ltrim($value->picture, '.');
			//$data['name'] = $value->name;
			$name = $value->name;
		}
		$data['page_title'] = 'Add Case for '.$name.' in ('.$sem.')';
        $data['content_view'] = 'Students/add_students_case_view';
        $this->templates->call_admin_template($data);
	}

	function add_case_todb(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('sdc_no', 'SDC Number', 'required');
		$this->form_validation->set_rules('infraction', 'Infraction', 'required');
		$this->form_validation->set_rules('infra_detail', 'Infraction details', 'required');
		$this->form_validation->set_rules('panel_rec', 'Panel recommendation', 'required');
		$this->form_validation->set_rules('panel_rec_det', 'Panel recommendation details', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
        // if validation fails
        if ($this->form_validation->run() == FALSE){
            $this->add_case($this->session->userdata('studid'));

        }
        else
        {
			if($this->input->post()){
				$caseDetails = array('stud_id' => $this->input->post('studid'),
					'sdc_no' => $this->input->post('sdc_no'),
					'infraction' => $this->input->post('infraction'),
					'infraction_detail' => $this->input->post('infra_detail'),
					'panel_recom' => $this->input->post('panel_rec'),
					'panel_recom_det' => $this->input->post('panel_rec_det'),
					'semid' => $this->input->post('sem_id'),
					'date' => $this->input->post('date')
				);
				//print_r($this->input->post('studid')); die;
				$this->M_Students->addStudentCaseRecord($caseDetails);
				$this->session->set_flashdata('success', 'Student case added successfully');
			}
	    }
	    $data['page_title'] = 'View Students Case details';
	    $data['content_view'] = 'Admin/dashboard_view';
	    $this->templates->call_admin_template($data);
	}

	function edit_case($id){
		$case = $this->M_Students->get_case_by_caseid($id);
		foreach ($case as $key => $value) {
			$data['passport'] = base_url().ltrim($value->picture, '.');
			$data['sdc_no'] = $value->sdc_no;
			$data['infraction'] = $value->infraction;
			$data['infra_detail'] = $value->infraction_detail;
			$data['panel_rec'] = $value->panel_recom;
			$data['panel_rec_det'] = $value->panel_recom_det;
			$data['date'] = $value->date;
			$name = $value->name;
		}
		//Loads the edit session page
        $data['page_title'] = 'Edit Students Case of '.$name;
        $data['caseid'] = $id;
        $data['content_view'] = 'Students/edit_student_case_view';
        $this->templates->call_admin_template($data);
	}

	function add_passport($id){
		$student = $this->M_Students->get_student_by_id($id);

		foreach ($student as $key => $value) {
			$data['passport'] = base_url().ltrim($value->picture, '.');
			$data['name'] = $value->name;
			$name = $value->name;
		}

		$data['studid'] = $id;
		$data['page_title'] = 'Add Passport for '.$name;
        $data['content_view'] = 'Students/add_passport_view';
        $this->templates->call_admin_template($data);
	}

	function upload_passport(){

		$this->load->library(['upload']);
		if($this->input->post()){
			$files = $_FILES;
				$id = $this->input->post('studid');
                if (!file_exists("./assets/passports/")) {
                    mkdir("./assets/passports/", 0777, true);
                }
                $config = $this->passport_upload_option($id);
                $this->upload->initialize($config);
                if($this->upload->do_upload('passport')){
                    $file_path = $config['upload_path'].$id.$this->upload->data('file_ext');
                    
                    $this->M_Students->updateStudentRecord($id, $file_path);
                }
                $this->session->set_flashdata('success', 'Student passport uploaded successfully');
		}
		$data['page_title'] = 'View Students Case details';
	    $data['content_view'] = 'Admin/dashboard_view';
	    $this->templates->call_admin_template($data);

	}

	private function passport_upload_option($id){
        //upload image options
	    $config = array();
	    $config['upload_path'] = "./assets/passports/";
	    $config['file_name'] = $id;
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size'] = '0';
	    $config['overwrite'] = TRUE;

        return $config;
    }

	function update_case(){
		if($this->input->post()){
			//Updates the case
			$cases = array('sdc_no' => $this->input->post('sdc_no'),
				'infraction' => $this->input->post('infraction'),
				'infraction_detail' => $this->input->post('infra_detail'),
				'panel_recom' => $this->input->post('panel_rec'),
				'panel_recom_det' => $this->input->post('panel_rec_det'),
				'date' => $this->input->post('date')
			);
			$this->M_Students->updateCase($this->input->post('caseid'), $cases);
        	$this->session->set_flashdata('success', 'Case successfully updated');
		}

		$data['page_title'] = 'View Students Case details';
	    $data['content_view'] = 'Admin/dashboard_view';
	    $this->templates->call_admin_template($data);
	}

	function create_student_tables(){
		if (isset($_GET['matricno'])){
			$matric = $_GET['matricno'];
			$student = $this->M_Students->get_student_by_matric($_GET['matricno']);
			if(count($student) > 0){
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
				//echo "<th>Semester</th>";
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
						//$student_table .="<td>{$value->semester}</td>";
						$student_table .="<td>{$value->level}</td>";
						$student_table .="<td>{$value->hall}</td>";
						$this->session->set_userdata(array('studname' => $value->name), 'studid', $value->studid);
						$student_table .="<td><input type='hidden' id ='std' value='{$value->studid}'/><a href='#'> <i onclick='show_case()'>View Case</i></a></td>";
						//$student_table .="<td><a href='".base_url()."Admin/addCase/{$value->studid}'> <i>Add Case</i></a></td>";
						$student_table .="<td><a href='".base_url()."Admin/add_passport/{$value->studid}'> <i>Update Passport</i></a></td>";
						$incrementer++;
					}
					echo $student_table;
				}
				echo "</tbody>";
				echo "</table>";
			}
		}
	}
}