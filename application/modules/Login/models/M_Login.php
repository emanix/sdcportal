<?php

class M_Login extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_user(){
        $this->db->select('loginid');
        $this->db->from('login');
        $query = $this->db->get();

        return $query->result();
    }

    function get_userid($email){
        $this->db->select('login_id');
        $this->db->from('login');
        $this->db->where('username', $email);
        $query = $this->db->get();

        return $query->result();
    }

    function confirm_users_password($userid, $password){
        $query = $this->db->query('select * from login where login_id =  "'.$userid.'"  and password =  "'.$password.'" ');
        /*$this->db->select('password');
        $this->db->from('login');
        $this->db->where('password', $password);
        $query = $this->db->get();*/

        return $query->result();
    }

    function confirm_users_details($username, $user_password){
        $query = $this->db->query('select * from login where username =  "'.$username.'"  and password =  "'.$user_password.'" ');

        return $query->result();
    }

    function update_password(){

        /*$query = $this->db->query('update login set password = "'.sha1($this->input->post('new_pass', TRUE)).'" where ID = "'.$this->session->userdata('user_id').'"');

        return $this->db->set();*/
        $this->db->set('password', sha1($this->input->post('new_pass', TRUE)));
        $this->db->where('login_id', $this->session->userdata('user_id'));
        
        return $this->db->update('login');
        
    }
}