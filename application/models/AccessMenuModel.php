<?php

class AccessMenuModel extends CI_Model
{
	private $_table = "dir_access_menu";
	private $_as_table = " as dam";
	private $_key = "id_access";
    
    public function get_data(){
		$this->db->join('dir_menu dm', 'dm.id_menu=dam.id_menu');
		$this->db->join('dir_user_level dul', 'dul.level_id=dam.level_id');
        return $sql = $this->db->get($this->_table . $this->_as_table);
	}	
  
    public function find_data_access($menu){
        $this->db->where('level_id', $this->session->userdata('level'));
        $this->db->where('id_menu', $menu);
        return $this->db->get($this->_table)->row();
    }

    public function get_detail_data(){
        $this->db->join('dir_menu dm', 'dm.id_menu=dam.id_menu');
		$this->db->join('dir_user_level dul', 'dul.level_id=dam.level_id');
		$this->db->select('dul.level_id,dul.nama_level');
		$this->db->group_by('dul.level_id,dul.nama_level');
		$this->db->where('dul.level_id !=', 1);
        $group_level = $this->db->get($this->_table . $this->_as_table)->result();


        foreach($group_level as $gl){
            $x['level'] = $gl;

            $this->db->join('dir_menu dm', 'dm.id_menu=dam.id_menu');
            $this->db->join('dir_user_level dul', 'dul.level_id=dam.level_id');
            $this->db->select('dam.level_id,dam.id_menu,dam.exported_access as export, created_access as create, updated_access as update, deleted_access as delete, read_access as read, other_access as other');
            $this->db->where('dul.level_id', $gl->level_id);
            $menu = $this->db->get($this->_table . $this->_as_table)->result();

            $x['menu'] = $menu;
            $data[] =$x;
        }
        return $data;
    }
}