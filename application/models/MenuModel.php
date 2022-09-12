<?php

class MenuModel extends CI_Model
{
	private $_table = "dir_menu";
	private $_as_table = " as dm";
	private $_key = "id_menu";
    
    public function get_data(){
		$select_join = '(select nama_menu from dir_menu dmm where dmm.id_menu = dm.parent_menu) as parent_nama';

		$this->db->select('dm.*,dhm.nama_header, '. $select_join);
		$this->db->join('dir_header_menu dhm', 'dhm.id_header_menu=dm.id_header_menu');
        return $sql = $this->db->get($this->_table . $this->_as_table);
	}	
    public function get_data_parent(){
		$this->db->where('dm.group_menu', 1);
        return $sql = $this->db->get($this->_table . $this->_as_table);
	}	
}