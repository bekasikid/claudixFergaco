<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author Billy
 */
class Login extends CI_Controller{
	
	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('login_model');
		
// 		$this->output->enable_profiler(TRUE);
	}
	
	
    function index($flek=null){
        if($flek == '1'){
            $data = array('info'=>"Invalid login. Please try again.!");
        } else if($flek == '2'){
            $data = array('info'=>"This user has been log on!");
        } else {
            $data = array('info'=>null);
        }
        
        $this->load->view("login", $data);
    }
    //update by Ari Prasasti
    function check(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $data = $this->authenticate($username,$password);

        if($data != FALSE && $data['login'] != 'double'){
//              $this->get_task($data);
            $this->session->set_userdata('user_data',$data);
//            redirect('marketing/progress');
            redirect('home');
        } else if($data['login'] == 'double'){
            redirect('login/index/2');
        }else{
            redirect('login/index/1');
        }
    }
    
    function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
    
    function sess_expire(){
    }
    
    function logout_timeout(){
        $this->sess_expire();
        checkSession($user_data);
        redirect('home');
    }
    
    public function authenticate($user,$pass) {
    	return $this->login_model->validate($user, $pass );
    }
    
}
