<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class client extends CI_Controller {
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
	
	function index()
	{
            $crud = new grocery_CRUD(); 
//            $crud->set_theme('datatables');
            $crud->set_table('client');
            $crud->set_subject('Client');
            $crud->columns('client');
            $crud->add_action('View Report', base_url().'assets/img/view.png', 'client/progress','ui-icon-image');
            $output = $crud->render(); 
            $this->_home_output($output);
	}
	
	function progress($id_client)
	{
            $crud = new grocery_CRUD(); 
            $crud->set_table('marketing');
            $crud->where('id_client',$id_client);
            $crud->columns('date_start','id_client','issue','plan','goal','class','dateline','status');	 
            $crud->display_as('id_client','client');
            $crud->set_subject('Marketing Progress');
            $crud->set_relation('id_client','client','client');
            $crud->unset_add();
            $crud->unset_edit();
            $crud->unset_delete();
            $crud->add_action('View Report', base_url().'assets/img/view.png', 'marketing/report_view','ui-icon-image');
            $output = $crud->render(); 
            $this->_home_output($output);
	}
	
	function report_view($id_task){
            $crud = new grocery_CRUD(); 
            $crud->set_table('report');
            $crud->where('task_id', $id_task);
            $crud->columns('task_id','descr','dt');	 
            $crud->set_subject('Management Report');
            $crud->display_as('descr','Description')->display_as('dt','Date')->display_as('task_id','Task');
            $crud->field_type('task_id', 'hidden',$id_task);
            $crud->set_relation('task_id','marketing','issue'); 
            $crud->unset_add();
            $crud->unset_edit();
            $crud->unset_delete();
            $output = $crud->render(); 
            $this->_home_output($output);
	}
}