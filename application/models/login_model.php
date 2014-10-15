<?php

class Login_model extends MY_Model {
	
	public function __construct() {
		parent::__construct();
		
        $this->load->model('user/mitra_model');
	}
	
	public function validate($username, $password) { 
		$this->db->where('email', $username);  
		$this->db->where('pass', $password); 
		$q = $this->db->get('user');
		if ($q->num_rows == 1) {	// if query had 1 row to return
                    $data_user = $q->row();
                    $data_menu = $this->get_access($data_user->role);
                    $access = $this->mitra_model->get_menu_role($data_user->role);
                    $dt_access = array('home'=>'home');
                    foreach ($access as $key=>$value) {
                        if($value->param != ""){
                            $dt_access[$key] = $value->param;
                        }
                    }
                    $data = array('login'=>'hore','user_info'=>$data_user,'menu'=>$data_menu,'access'=>$dt_access);
                    return $data;
                                      
		}
		
		return false;
	}
        
        function get_access($role=0){
            $access = $this->mitra_model->get_menu_role($role);
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

            if(isset($data[0]) && count($data[0]) > 0){
                $data_level_2 = array();
                foreach ($data[0] as $key => $value) {
                    if(isset($value['level_1'])){
                        foreach ($value['level_1'] as $key_det => $level_1_det) {
                            // level 2
                            if(isset ($data_unknown[$key_det])){
                                $data[0][$key]['level_1'][$key_det]['level_2'][$key_det] = (array) $data_unknown[$key_det];
                                $data_level_2[$key_det] = (array) $data_unknown[$key_det];
                            }
                        }
                    }
                }

                $data_level_3 = array();
                foreach ($data[0] as $key => $value) {
                    if(isset($value['level_1'])){
                        foreach ($value['level_1'] as $key_det => $level_1_det) {
                            if(isset($data_level_2[$key_det])){
                                foreach ($data_level_2[$key_det] as $key_2 => $level_2) {
                                    if(isset ($data_unknown[$key_2])){
                                        $data[0][$key]['level_1'][$key_det]['level_2'][$key_det]['level_3'][$key_2] = (array) $data_unknown[$key_2];
                                        $data_level_3[$key_2] = (array) $data_unknown[$key_2];
                                    }
                                }
                            }
                        }
                    }
                }
            }
            return $data;
        }
	
}