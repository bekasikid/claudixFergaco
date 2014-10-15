<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Management_task extends CI_Controller {
    private $user_data;

	function __construct(){
            parent::__construct();
            $this->load->library('grocery_CRUD');	
            $this->load->library('image_CRUD');	
            $this->user_data = $this->session->userdata('user_data');

            if($this->user_data['login'] != "hore"){
                redirect('login');
            }
	}
	
	function _home_output($output = null){
                $output->userinfo = $this->user_data;
		$this->load->view('crud',$output);	
	}
	
	function index($output = null){
                $output->userinfo = $this->user_data;
		$this->load->view('home',$output);
	}	
	
	function task()
	{
            $crud = new grocery_CRUD(); 
            $crud->set_theme('datatables');
            $crud->set_table('task');
            $crud->columns('dt','descr','due','level','status','user_id','bos_id');	 
            $crud->set_subject('Management Task');
//            $crud->field_type('user_id', 'hidden',$this->user_data['user_info']->id_user);
//            $crud->field_type('bos_id', 'hidden','');
            $crud->set_relation('user_id','user','name');
            $crud->set_relation('bos_id','user','name'); 
            $crud->field_type('level','dropdown',array(1=> "Normal","Urgent"));
            $crud->field_type('status','dropdown',array(1=> 'active','non active'));
            $crud->display_as('descr','Description')->display_as('dt','Date')->display_as('user_id','User')->display_as('bos_id','Bos');
            
            $crud->add_action('Add Report', '', 'management_report/add_report','ui-icon-plus');
            $crud->add_action('View Report', '', 'management_report/view_report','ui-icon-image');
    
            $output = $crud->render(); 
            $this->_home_output($output);
	}
}