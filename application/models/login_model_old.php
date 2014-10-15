<?php

class Login_model extends MY_Model {
	
	public function __construct() {
		parent::__construct();
		
        $this->load->model('user/mitra_model');
	}
	
	public function validate($username, $password) { 
		$this->db->where('USERNAME', $username);  
		$this->db->where('PASSWORD', $password); 
//                 $this->db->where('USER_STATUS',1);
//                 $this->db->where('IS_LOGIN',0);	
		$q = $this->db->get('user_access');  
			
		if ($q->num_rows == 1) {	// if query had 1 row to return
                    $data_user = $q->row();
                   
                    if($data_user->USER_STATUS == '1' && $data_user->IS_LOGIN == '0') {
                    	$data_menu = $this->get_access($data_user->ID_MODUL_ROLE);
                    	$data_login = array(
                    	        'IS_LOGIN'=>0,
//                     			'IS_LOGIN'=>1,	// 5Nov, UPDATE DI MATIKAN DULU KRN MASIH BUG
                    			'LAST_LOGIN'=>date("Y-m-d H:i:s")
                    	);
                    	$this->db->where('ID_USER',$data_user->ID_USER);
                    	$this->db->update('user_access',$data_login);
                    	
                    	$operator = $this->mitra_model->get_master_operator($data_user->OPERATOR_CODE);
                    	$data_user->LAST_LOGIN = date("Y-m-d H:i:s");
                    	$data = array('login'=>'hore','user_info'=>$data_user,'menu'=>$data_menu,'opr'=>$operator);
                    	return $data;
                    }else{
                    	$data = array('login'=>'double');
                    	return $data;
                    }
                                      
		}
		
		return false;
	}
        
        function get_access($role=0){
            $access = $this->mitra_model->get_menu_role($role);
//            echo $this->db->last_query();
//            die();
            $data = array();
            $data_unknown = array();
            foreach ($access as $menu) {
                $menux = $this->mitra_model->get_user_menu_by_id($menu->id_menu);
                if($menux->id_parent == 0){
                    // level 0
                    $data[0][$menux->id_menu] = (array) $menux;
                } else {
                    // level 1
                    if(isset($data[0][$menux->id_parent])){
                        $data[0][$menux->id_parent]['level_1'][$menux->id_menu] = (array) $menux;
                    } else {
                        $data_unknown[$menux->id_parent][$menux->id_menu] = (array) $menux;
                    }
                }
            }

            foreach ($data[0] as $key => $value) {
                if(isset($value['level_1'])){
                    foreach ($value['level_1'] as $key_det => $level_1_det) {
                        // level 2
                        if(isset ($data_unknown[$key_det])){
                            $data[0][$key]['level_1'][$key_det]['level_2'][$key_det] = (array) $data_unknown[$key_det];
                        }
                    }
                }
            }
            return $data;
        }
	
}