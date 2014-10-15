<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Management_admin extends CI_Controller {
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
        
        function change_password($flag=null){
                $output->userinfo = $this->user_data;
		$this->load->view('change_password',$output);
        }
        
        function change_password_save($id){
            $data_password = $this->input->post('password');
            if(trim($data_password)){
                $data = array(
                    'pass'=>$data_password
                );
                $this->db->where('id',$id);
                $this->db->update('user',$data);
                redirect('admin/management_admin/change_password/1');
            } else {
                redirect('admin/management_admin/change_password/2');
            }
        }
	
//	function index($output = null){
//                $output->userinfo = $this->user_data;
//		$this->load->view('home',$output);
//	}	
	
	function menu()
	{
			$crud = new grocery_CRUD(); 
			$crud->set_table('user_menu');
			$crud->columns('id_menu','id_parent','menu_name','param','seq');	 
			$crud->set_subject('Management Menu');
			$crud->set_relation('id_parent','user_menu','menu_name'); 
			$output = $crud->render(); 
			$this->_home_output($output);
	}	
	
	function user()
	{
			$crud = new grocery_CRUD(); 
			$crud->set_table('user');
			$crud->columns('name','email','notes','role');	 
			$crud->required_fields('name','email','pass','role');
                        $crud->display_as('pass','Password');
                        $crud->field_type('pass', 'password');
			$crud->set_subject('Management User');
			$crud->set_relation('role','user_roles','name'); 
                        
                        #check user status
                        if($this->user_data['user_info']->role == 5){
                            $crud->field_type('role', 'hidden',2);
                        }
                        
                        if($this->user_data['user_info']->role == 2){
                            $crud->field_type('role', 'hidden',1);
                        }
                        
                        $crud->where('parentId',$this->user_data['user_info']->id);
                        $crud->field_type('parentId', 'hidden',$this->user_data['user_info']->id);                        
                        
//                        $crud->add_action('Add Sub', 'assets/img/user.jpg', 'management_admin/user/');
                        
			$output = $crud->render(); 
			$this->_home_output($output);
	}	
	
	function user_role()
	{
			$crud = new grocery_CRUD(); 
			$crud->set_table('user_roles');
			$crud->columns('id_role','name');	 
			$crud->required_fields('name');   
			$crud->set_subject('Management User Role'); 
			$output = $crud->render(); 
			$this->_home_output($output);
	}
	
	function user_role_menu()
	{
			$crud = new grocery_CRUD(); 
			$crud->set_table('user_menu_role');
			$crud->columns('id','id_role','id_menu');	 
			$crud->required_fields('id_role');   
			$crud->required_fields('id_menu');   
			$crud->set_subject('Management User Menu Role'); 
			$crud->set_relation('id_role','user_roles','name'); 
			$crud->set_relation('id_menu','user_menu','menu_name'); 
			$output = $crud->render(); 
			$this->_home_output($output);
	}
}