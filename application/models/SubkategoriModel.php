<?php

class SubkategoriModel extends CI_Model
{
	private $_table = "dir_subkategori";
	private $_as_table = " as ds";
	private $_key = "id_subkategori";
    
    public function get_data(){
		$this->db->join('dir_kategori dk', 'dk.id_kategori=ds.id_kategori');
        return $sql = $this->db->get($this->_table . $this->_as_table);
	}	
}