<?php

class Students extends MY_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->load->module(['Templates']);
        $this->load->model(['M_Student', 'M_Subjects', 'M_Grades', 'M_Programs', 'M_Admin']);
        
    }

    function add_students(){
    	$data['student_records'] = 'Students Management';
        $data['page_title'] = 'Manage Students Details';
        $data['optional_description'] = 'Add Students details';
        $data['add_students'] = 'Add Students';
        $data['sessions'] = $this->session_select();
        $data['programs'] = $this->program_select();
        //$data['student_tables'] = '';
        $data['content_view'] = 'Students/add_students_view';
        $this->templates->call_admin_template($data);
    }

    function view_students(){
      $data['student_records'] = 'Students Management';
        $data['page_title'] = 'Manage Students Details';
        $data['optional_description'] = 'Search details by matric number and program';
        $data['add_students'] = 'Add Students';
        //$data['sessions'] = $this->session_select();
        $data['programs'] = $this->program_select();
        $data['student_tables'] = '';
        $data['content_view'] = 'Students/view_students_view';
        $this->templates->call_admin_template($data);
    }

    function search_students_with_matric(){
    	$data['student_records'] = 'Students Management';
        $data['page_title'] = 'Manage Students Details';
        $data['optional_description'] = 'Add Students details, search details by matric number and program';
        $data['add_students'] = 'Add Students';
        $data['sessions'] = $this->session_select();
        $data['programs'] = $this->program_select();
        $data['student_tables'] = $this->search_students_matric();
        $data['content_view'] = 'Students/view_students_view';
        $this->templates->call_admin_template($data);
    }

    function search_students_with_program(){
    	$data['student_records'] = 'Students Management';
        $data['page_title'] = 'Manage Students Details';
        $data['optional_description'] = 'Add Students details, search details by matric number and program';
        $data['add_students'] = 'Add Students';
        $data['sessions'] = $this->session_select();
        $data['programs'] = $this->program_select();
        $data['student_tables'] = $this->search_students_program();
        $data['content_view'] = 'Students/view_students_view';
        $this->templates->call_admin_template($data);
    }

    function session_select(){

        $sessions = $this->M_Student->get_session_details();
        $options = "";
        if (count($sessions)){
            foreach ($sessions as $key => $value){
                $options .= "<option value = '{$value->sid}'>{$value->session_name}</option>";
            }
        }
        return $options;
    }

    function program_select(){

        $programs = $this->M_Student->get_program();
        $options = "";
        if (count($programs)){
            foreach ($programs as $key => $value){
                $options .= "<option value = '{$value->pid}'>{$value->program_name}</option>";
            }
        }
        return $options;
    }

    function add_student_record(){

    	$this->load->library('form_validation');

		$this->form_validation->set_rules('matric', 'Matric Number', 'required');
		$this->form_validation->set_rules('stdname', 'Students Name', 'required');
		$this->form_validation->set_rules('sid', 'Session Name', 'required');
		$this->form_validation->set_rules('pid', 'Program Name', 'required');
        // if validation fails
        if ($this->form_validation->run() == FALSE){
            $this->add_students();

        }
        else
        {
	    	if ($this->input->post()){

	    		$matric = $this->input->post('matric');
	    		$stdname = $this->input->post('stdname');
	    		$sid = $this->input->post('sid');
	    		$pid = $this->input->post('pid');

	    		$this->M_Student->add_students($matric, $stdname, $sid, $pid);
          //new items comes here
          $subjects = $this->M_Subjects->get_subject_pid($pid);
          $student = $this->M_Student->get_student_by_name($stdname);
          $stdid = ""; $session_id = "";
          foreach ($student as $key => $value) {
            $stdid = $value->stdid;
            $session_id = $value->session_id;
          }

          $session_name = $this->M_Admin->get_session_by_id($session_id);
          foreach ($session_name as $key => $session) {
            $sesname=$session->session_name;
            
            for($counter = 1; $counter <= 2; $counter++){
              $semester = $this->M_Admin->get_semester_by_name("$sesname.$counter");
              foreach ($semester as $key => $sem) {
                $semid = $sem->semid; 
                foreach ($subjects as $key => $subject) {
                  $this->M_Grades->insert_into_gradestb($stdid, $pid, $subject->sid, $semid);
                }
              } 
            }
          }
	    	}
	    }
	    $this->session->set_flashdata('success', 'Students Record added successfully');
	    $this->add_students();
    }

    function search_students_program(){

    	if ($this->input->post()){

    		$student = $this->M_Student->get_student_by_program($this->input->post('pid'));
    		$student_table = "";

    		if (count($student) > 0){
          $student_table .= "<div id='list_student'>";
    			$student_table .= "<section class='content'>";
    			$student_table .= "<div class='row'id='list_student'>";
    			$student_table .= "<div class='col-xs-12'>";
    			$student_table .= "<div class='box'>";
    			$student_table .= "<div class='box-header'>";
    			$student_table .= "<h3 class='box-title'>Students Details</h3>";
   				$student_table .= "</div>";
    			$student_table .= "<div class='box-body'>";
    			$student_table .= "<table id='example2' class='table table-bordered table-striped'>";
    			$student_table .= "<thead>";
    			$student_table .= "<tr>";
   				$student_table .= "<th>Serial No</th>";
   				$student_table .= "<th>Student Name</th>";
   				$student_table .= "<th>Program</th>";
   				//$student_table .= "<th>Edit</th>";
   				$student_table .= "</tr>";
   				$student_table .= "</thead>";
   				$student_table .= "<tfoot>";
   				$student_table .= "<tr>";
   				$student_table .= "<th>Serial No</th>";
   				$student_table .= "<th>Student Name</th>";
   				$student_table .= "<th>Program</th>";
   				//$student_table .= "<th>Edit</th>";
   				$student_table .= "</tr>";
   				$student_table .= "</tfoot>";
   				$student_table .= "<tbody>";
    			$counter = 1;
    			foreach ($student as $key => $value) {
    				
    				$program_name = $this->M_Student->get_program_name($value->program_id);
    				$std_id = $value->stdid;
    				$student_table .="<tr>";
					$student_table .="<td>{$counter}</td>";
					$student_table .="<td>{$value->student_name}</td>";
					foreach ($program_name as $key => $value){
						$student_table .="<td>{$value->program_name}</td>";
					}

					$student_table .="<td><a href='".base_url()."Students/edit_student/$std_id'> <i class='material-icons'>Edit</i></a></td>";
					$counter++;
    			}
    			$student_table .= "</tr>";
   				$student_table .= "</tbody>";
   				$student_table .= "</table>";
   				$student_table .= "</div>";
   				$student_table .= "</div>";
   				$student_table .= "</div>";
   				$student_table .= "</div>";
   				$student_table .= "</section>";
          $student_table .= "</div>";
    		}else{
          $student_table .= "<div id='list_student'>";
    			$student_table .= "<section class='content'>";
    			$student_table .= "<div class='row'>";
    			$student_table .= "<div class='col-xs-12'>";
    			$student_table .= "<div class='box'>";
    			$student_table .= "<div class='box-header'>";
    			$student_table .= "<h3 class='box-title'>Students Details</h3>";
   				$student_table .= "</div>";
    			$student_table .= "<div class='box-body'>";
    			$student_table .= "<table id='example2' class='table table-bordered table-striped'>";
    			$student_table .= "<thead>";
    			$student_table .= "<tr>";
   				$student_table .= "<th>Serial No</th>";
   				$student_table .= "<th>Student Name</th>";
   				$student_table .= "<th>Program</th>";
   				//$student_table .= "<th>Edit</th>";
   				$student_table .= "</tr>";
   				$student_table .= "</thead>";
   				$student_table .= "<tfoot>";
   				$student_table .= "<tr>";
   				$student_table .= "<th>Serial No</th>";
   				$student_table .= "<th>Student Name</th>";
   				$student_table .= "<th>Program</th>";
   				//$student_table .= "<th>Edit</th>";
   				$student_table .= "</tr>";
   				$student_table .= "</tfoot>";
   				$student_table .= "<tbody>";
   				$student_table .= "<tr>";
   				$student_table .= "<td colspan='4'><center><h4>Student records does not exist.</h4></center></td>";
   				$student_table .= "</tr>";
   				$student_table .= "</tbody>";
   				$student_table .= "</table>";
   				$student_table .= "</div>";
   				$student_table .= "</div>";
   				$student_table .= "</div>";
   				$student_table .= "</div>";
   				$student_table .= "</section>";
          $student_table .= "</div>";
    		}
    	}
    	
    	return $student_table;
    }

    function search_students_matric(){

    	if ($this->input->post()){

    		$student = $this->M_Student->get_student_by_matric($this->input->post('matric'));
    		$student_table = "";

    		if (count($student) > 0){
    			$student_table .= "<section class='content'>";
    			$student_table .= "<div class='row'>";
    			$student_table .= "<div class='col-xs-12'>";
    			$student_table .= "<div class='box'>";
    			$student_table .= "<div class='box-header'>";
    			$student_table .= "<h3 class='box-title'>Students Details</h3>";
   				$student_table .= "</div>";
    			$student_table .= "<div class='box-body'>";
    			$student_table .= "<table id='example2' class='table table-bordered table-striped'>";
    			$student_table .= "<thead>";
    			$student_table .= "<tr>";
   				$student_table .= "<th>Serial No</th>";
   				$student_table .= "<th>Student Name</th>";
   				$student_table .= "<th>Program</th>";
   				$student_table .= "<th>Edit</th>";
   				$student_table .= "</tr>";
   				$student_table .= "</thead>";
   				$student_table .= "<tfoot>";
   				$student_table .= "<tr>";
   				$student_table .= "<th>Serial No</th>";
   				$student_table .= "<th>Student Name</th>";
   				$student_table .= "<th>Program</th>";
   				$student_table .= "<th>Edit</th>";
   				$student_table .= "</tr>";
   				$student_table .= "</tfoot>";
   				$student_table .= "<tbody>";
    			$counter = 1;
    			foreach ($student as $key => $value) {
    				
    				$program_name = $this->M_Student->get_program_name($value->program_id);
    				$std_id = $value->stdid;
    				$student_table .="<tr>";
					$student_table .="<td>{$counter}</td>";
					$student_table .="<td>{$value->student_name}</td>";
					foreach ($program_name as $key => $value){
						$student_table .="<td>{$value->program_name}</td>";
					}

					$student_table .="<td><a href='".base_url()."Students/edit_student/$std_id'> <i class='material-icons'>Edit</i></a></td>";
					$counter++;
    			}
    			$student_table .= "</tr>";
   				$student_table .= "</tbody>";
   				$student_table .= "</table>";
   				$student_table .= "</div>";
   				$student_table .= "</div>";
   				$student_table .= "</div>";
   				$student_table .= "</div>";
   				$student_table .= "</section>";
    		}else{
    			$student_table .= "<section class='content'>";
    			$student_table .= "<div class='row'>";
    			$student_table .= "<div class='col-xs-12'>";
    			$student_table .= "<div class='box'>";
    			$student_table .= "<div class='box-header'>";
    			$student_table .= "<h3 class='box-title'>Students Details</h3>";
   				$student_table .= "</div>";
    			$student_table .= "<div class='box-body'>";
    			$student_table .= "<table id='example2' class='table table-bordered table-striped'>";
    			$student_table .= "<thead>";
    			$student_table .= "<tr>";
   				$student_table .= "<th>Serial No</th>";
   				$student_table .= "<th>Student Name</th>";
   				$student_table .= "<th>Program</th>";
   				$student_table .= "<th>Edit</th>";
   				$student_table .= "</tr>";
   				$student_table .= "</thead>";
   				$student_table .= "<tfoot>";
   				$student_table .= "<tr>";
   				$student_table .= "<th>Serial No</th>";
   				$student_table .= "<th>Student Name</th>";
   				$student_table .= "<th>Program</th>";
   				$student_table .= "<th>Edit</th>";
   				$student_table .= "</tr>";
   				$student_table .= "</tfoot>";
   				$student_table .= "<tbody>";
   				$student_table .= "<tr>";
   				$student_table .= "<td colspan='4'><center><h4>Student record does not exist.</h4></center></td>";
   				$student_table .= "</tr>";
   				$student_table .= "</tbody>";
   				$student_table .= "</table>";
   				$student_table .= "</div>";
   				$student_table .= "</div>";
   				$student_table .= "</div>";
   				$student_table .= "</div>";
   				$student_table .= "</section>";
    		}
    	}
    	
    	return $student_table;
    }

    function edit_student($id){
    	$stdid = $this->M_Student->get_student_by_id($id);
		//creates the student name field and populates it with the student to be edited
		$update_field = "";
		if(count($stdid) > 0){
			foreach ($stdid as $key => $value) {
				$update_field .= "<div class='col-sm-9'>";
				$update_field .= "<input  type='text' class='form-control' id='inputEmail3' name='{$value->stdid}' value='{$value->student_name}'>";
				$update_field .= "</div>";
				$this->session->set_userdata(array('studentname' => $value->stdid, 'std_id' => $id));
			}	
		}

		//creates the matric number field and populates it with the matric number to be edited
		$update_matric_field = "";
		if(count($stdid) > 0){
			foreach ($stdid as $key => $value) {
				$update_matric_field .= "<div class='col-sm-9'>";
				$update_matric_field .= "<input  type='text' class='form-control' id='inputEmail3' name='{$value->matric_no}' value='{$value->matric_no}'>";
				$update_matric_field .= "</div>";
				$this->session->set_userdata(array('matricno' => $value->matric_no));
			}	
		}

		$data['student_records'] = 'Students Management';
		$data['update_student'] = 'Update Students record';
        $data['page_title'] = 'Manage Students';
        $data['optional_description'] = 'Update current students record.';
        //$data['desc_students'] = 'Add current session';
        $data['matric_field'] = $update_matric_field;
        $data['student_field'] = $update_field;
        $data['sessions'] = $this->session_select();
        $data['programs'] = $this->program_select();
        $data['content_view'] = 'Students/edit_student_view';
        $this->templates->call_admin_template($data);
    }

    function update_student(){
		if($this->input->post()){
			$this->M_Student->update_student_record();
			
        	$this->session->set_flashdata('success', 'Students record successfully updated');
        	redirect(base_url() . 'Students/add_students');
		}
	}

  function batch_upload(){

    if(isset($_POST["upload"])){
      if (!empty($_FILES['stdfile']['name'])){
        $stddetail = $_FILES['stdfile']['tmp_name'];
        if($_FILES['stdfile']['size'] > 0){

          if (($opfile = fopen($stddetail, "r")) !== FALSE){
            while (($data = fgetcsv($opfile, ",")) !== FALSE){
               
              $pname = $this->M_Programs->get_program_by_name($data[3]);
              $sessionname = $this->M_Admin->get_session_by_name($data[2]);

              $pid = ""; $sid = "";
              foreach ($pname as $key => $value) {
                $pid = $value->pid;
              }

              foreach ($sessionname as $key => $value) {
                $sid = $value->sid;
              }
              
              $this->M_Student->add_students($data[0], $data[1], $sid, $pid);
             
              /*$subjects = $this->M_Subjects->get_subject_pid($pid);
              $student = $this->M_Student->get_student_by_name($data[1]);
              $stdid = "";
              foreach ($student as $key => $value) {
                $stdid = $value->stdid;
              }

              foreach ($subjects as $key => $value) {
                $this->M_Grades->insert_into_gradestb($stdid, $pid, $value->sid);
              }*/
              $subjects = $this->M_Subjects->get_subject_pid($pid);
              $student = $this->M_Student->get_student_by_name($data[1]);
              $stdid = ""; $session_id = "";
              foreach ($student as $key => $value) {
                $stdid = $value->stdid;
                $session_id = $value->session_id;
              }

              $session_name = $this->M_Admin->get_session_by_id($session_id);
              foreach ($session_name as $key => $session) {
                $sesname=$session->session_name;
                
                for($counter = 1; $counter <= 2; $counter++){
                  $semester = $this->M_Admin->get_semester_by_name("$sesname.$counter");
                  foreach ($semester as $key => $sem) {
                    $semid = $sem->semid; 
                    foreach ($subjects as $key => $subject) {
                      $this->M_Grades->insert_into_gradestb($stdid, $pid, $subject->sid, $semid);
                    }
                  } 
                }
              }
            }
            fclose($opfile);
            $this->session->set_flashdata('message', 'Students details uploaded successfully');
            $this->add_students();
          }else{
            $this->session->set_flashdata('message', 'Failed to upload, check your file format');
            $this->add_students();
          }
        }
      }
    }
  }
}
