<?php

class Templates extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        
    }

    function load_login_template(){
    	//Calls the login page
    	
    	$this->load->view('login_view.php');
    }

    function call_admin_template($data = NULL){
        //call login template

        $this->load->view('admin_view', $data);
    }
 }