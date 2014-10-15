<?php

class mitra_model extends MY_Model{
    
    public function save_menu($data,$id=null){
        if(isset($data['id_menu'])){
            unset($data['id_menu']);
        }
        
        if($id != null){
            $this->db->where('id_menu',$id);
            $this->db->update('user_menu',$data);
        } else {
            $this->db->insert('user_menu',$data);
        }
    }
    
    public function delete_menu($id){
        $this->db->where('id_menu',$id);
        $this->db->delete('user_menu');
    }
    
    public function save_role($data,$id=null){
        if(isset($data['id_role'])){
            unset($data['id_role']);
        }
        
        if($id != null){
            $this->db->where('id_role',$id);
            $this->db->update('user_roles',$data);
        } else {
            $this->db->insert('user_roles',$data);
        }
    }
    
    public function delete_role($id){
        $this->db->where('role',$id);
        $query = $this->db->get('user');
        if($query->num_rows() == 0){
            $this->db->where('id_role',$id);
            $this->db->delete('user_roles');
        }
    }
    
    public function save_access($data){
        if(isset($data['id'])){
            unset($data['id']);
        }
        
        $this->db->where('id_role',$data['id_role']);
        $this->db->delete('user_menu_role');
        
        foreach ($data['id_menu'] as $value) {
            $data_insert = array(
                'id_role'=>$data['id_role'],
                'id_menu'=>$value
            );
            $this->db->insert('user_menu_role',$data_insert);
        }
    }
    
    function get_user_access($id=null){
        if($id != null){
            $this->db->where('id',$id);
            return $this->db->get('user')->row();
        } else {
            return $this->db->get('user')->result();
        }
    }
    
    function get_user_menu($id_parent=0,$id=null){
        $this->db->where('id_parent',$id_parent);
        if($id != null){
            $this->db->where('id_menu',$id);
            return $this->db->get('user_menu')->row();
        } else {
            return $this->db->get('user_menu')->result();
        }
    }
    
    function get_user_menu_by_id($id=null){
        if($id != null){
            $this->db->where('id_menu',$id);
            return $this->db->get('user_menu')->row();
        } else {
            return $this->db->get('user_menu')->result();
        }
    }
    
    function get_user_role($id=null){
        if($id != null){
            $this->db->where('id_role',$id);
            return $this->db->get('user_roles')->row();
        } else {
            return $this->db->get('user_roles')->result();
        }
    }
    
    function get_menu_role($id=null){
        $this->db->order_by('user_menu.seq','ASC');
        $this->db->order_by('user_menu.id_parent','ASC');
        $this->db->where('user_menu_role.id_role',$id);
        $this->db->join('user_menu','user_menu.id_menu = user_menu_role.id_menu');
        return $this->db->get('user_menu_role')->result();
    }
    
    function list_fields($table){
        return $this->db->list_fields($table);
    }
}
