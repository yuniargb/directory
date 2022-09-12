<?php

class UserModel extends CI_Model
{
	private $_table = "dir_user";
	private $_as_table = " as du";
	private $_key = "id_user";
    
    public function get_data(){
		$this->db->join('dir_user_level dul', 'dul.level_id=du.level_id');
		$this->db->where('dul.level_id !=', 1);
        return $sql = $this->db->get($this->_table . $this->_as_table);
	}	
}