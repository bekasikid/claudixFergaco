<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Management_report extends CI_Controller {
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
	
	function report()
	{
            $crud = new grocery_CRUD(); 	 
            $crud->set_subject('Management Report');
            $crud->set_table('report');
            $crud->columns('task_id','descr','dt');
            $crud->display_as('descr','Description')->display_as('dt','Date')->display_as('task_id','Task');
            $crud->set_relation('task_id','marketing','issue'); 
            $output = $crud->render(); 
            $this->_home_output($output);
	}	
	
	function add_report($id_task)
	{
            $crud = new grocery_CRUD(); 
            $crud->set_table('report');
            $crud->where('task_id', $id_task);
            $crud->columns('task_id','descr','dt');	 
            $crud->set_subject('Management Report');
            $crud->display_as('descr','Description')->display_as('dt','Date')->display_as('task_id','Task');
            $crud->field_type('task_id', 'hidden',$id_task);
            $crud->set_relation('task_id','marketing','issue'); 
            $output = $crud->render(); 
            $this->_home_output($output);
	}
	
	function view_report($id_task)
	{
            $crud = new grocery_CRUD(); 
            $crud->set_theme('datatables');
            $crud->set_table('report');
            $crud->where('task_id', $id_task);
            $crud->columns('task_id','descr','dt');	 
            $crud->set_subject('Management Report');
            $crud->display_as('descr','Description')->display_as('dt','Date')->display_as('task_id','Task');
            $crud->field_type('task_id', 'hidden',$id_task);
            $crud->set_relation('task_id','task','title'); 
            $crud->unset_add();
            $crud->unset_edit();
            $crud->unset_delete();
            $output = $crud->render(); 
            $this->_home_output($output);
	}
}