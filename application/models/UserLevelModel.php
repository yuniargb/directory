<?php

class UserLevelModel extends CI_Model
{
	private $_table = "dir_user_level";
	private $_as_table = " as ds";
	private $_key = "level_id";
    
    public function get_data(){
		$this->db->join('dir_menu dm', 'dm.id_menu=ds.redirect_menu');
		$this->db->where('ds.level_id !=', 1);
        return $sql = $this->db->get($this->_table . $this->_as_table);
	}	
}