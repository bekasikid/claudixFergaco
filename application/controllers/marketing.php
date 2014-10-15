<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketing extends CI_Controller {
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
	
	function _home_output($output = null,$view='crud'){
                $output->userinfo = $this->user_data;
		$this->load->view($view,$output);	
	}
	
	function index($output = null){
                $output->userinfo = $this->user_data;
		$this->load->view('home',$output);
	}	
        
        function chechFilterProgress($crud, $x="first"){
            $idUser = null;
            if($x != "first" || !empty($_POST['user'])){
                $user = $this->session->userdata('user');
                $user_data = $this->input->post('user');
                if(!empty($user_data)) {
                    $this->session->set_userdata('user',$user_data);
                    $user = $this->session->userdata('user');
                }
                $idUser    = $user;
            } else {
                $this->session->unset_userdata('user');
                $this->session->set_userdata('user',null);
                $user = $this->session->userdata('user');
                $idUser = $user;
            }
            
            if(!empty($idUser)){
                $crud->where('id_user',$idUser);  
            }
        }
	
	function progress($state='first'){
            $crud = new grocery_CRUD(); 
            $this->chechFilterProgress($crud, $state);
            
            $sel_user = $this->input->post('user');
            $data = array();
            if($this->user_data['user_info']->role != 1){
                $query = $this->db->get('user');
                $data = $query->result_array();
            } else {
                $data[] = array('id'=>$this->user_data['user_info']->id,'name'=>$this->user_data['user_info']->name);
            }
            
            $crud->set_table('marketing');
            $crud->columns('date_start','id_client','issue','plan','id_user','dateline','note','status');	 
            $crud->display_as('id_client','client')->display_as('id_user','PIC')->display_as('date_start','Start');
            $crud->set_width('note', '400');
            $crud->set_subject('Marketing Progress');
            $crud->set_relation('id_client','client','client');
            $crud->required_fields('id_user');
            if($this->user_data['user_info']->role == 1){
                $crud->set_relation('id_user','user','name',array('id'=>$this->user_data['user_info']->id));
                $crud->where('id_user',$this->user_data['user_info']->id);
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
                $crud->add_action('View Report', base_url().'assets/img/view.png', 'marketing/report','ui-icon-image');
            } else {
                $crud->set_relation('id_user','user','name',array('role'=>1));
                $crud->add_action('View Report', base_url().'assets/img/view.png', 'marketing/report_view','ui-icon-image');
            }
            
            if($this->user_data['user_info']->role != 1){
                $crud->where('id_boss',$this->user_data['user_info']->id);
                $crud->field_type('id_boss','hidden',$this->user_data['user_info']->id);
            }
            $crud->callback_column('date_start',array($this,'_urgentIcon'));
            $crud->callback_column('status',array($this,'_statusIcon'));
            $crud->set_width('status','100');
            $crud->order_by('date_start','desc');
            $crud->edit_fields(
                'id_client', 
                'date_start', 
                'issue', 
                'plan', 
                'goal', 
                'class', 
                'dateline', 
                'update', 
                'status', 
                'note', 
                'id_user'
            );
            
            $output = $crud->render(); 
            $output->users = $data;
            $output->sel_user = $sel_user;
            $this->_home_output($output,'crud_marketing');
	}	
	
	function report($id_task){
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
	
	function report_user($id_user){
            $query = $this->db->get_where('user',array('id'=>$id_user));
            $data_user = $query->row;
            
            $crud = new grocery_CRUD(); 
            $crud->set_table('report');
            $crud->where('task_id', $id_user);
            $crud->columns('task_id','descr','dt');	 
            $crud->set_subject('Management Report : '. $data_user->name);
            $crud->display_as('descr','Description')->display_as('dt','Date')->display_as('task_id','Task');
            $crud->set_relation('task_id','marketing','issue'); 
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
        
        function _userLink($value){
            return $value."asdasd";
        }
        
        function _urgentIcon($value,$row){
            $diff = now() - strtotime($row->dateline);
            $days = floor($diff / 86400);
            
            if($days > 0){
                $img =  img('assets/img/urgent1.png');
            } else {
                $img =  img('assets/img/ok.png');
            }
            $date = $img.' '.date('d/m/Y - H:i',  strtotime($value));
            return $date;
        }
        
        function _statusIcon($value){            
            if($value == 'Open'){
                $img =  img('assets/img/open.png');
            } else {
                $img =  img('assets/img/closed.png');
            }
            return $img;
        }
}