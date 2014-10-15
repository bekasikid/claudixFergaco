<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
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
	
	function index($id=null){
                if($this->user_data['user_info']->role != 1){
                    $output = null;
                    $output->userinfo = $this->user_data;
                    if($id != null){
                        $query = $this->db->get_where('user',array('parentId'=>  $id));
                    } else {
                        $query = $this->db->get_where('user',array('parentId'=>  $this->user_data['user_info']->id));
                    }

                    $output->list_user = $query->result_array();
                    $this->load->view('home',$output);
                } else {
                    redirect('data/progress/first/'.$this->user_data['user_info']->id.'/'.$this->user_data['user_info']->notes);
                }
	}	

}