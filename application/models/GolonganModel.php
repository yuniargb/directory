<?php



class GolonganModel extends CI_Model

{

	private $_table = "dir_golongan";

	private $_as_table = " as dg";

	private $_key = "id_golongan";

    

    public function get_data(){

		$this->db->join('dir_cabang dc', 'dc.id_cabang=dg.id_cabang');

        return $sql = $this->db->get($this->_table . $this->_as_table);

	}	
    public function get_data_subkategori(){

		$this->db->select('subkategori');
		$this->db->group_by('subkategori');
        return $sql = $this->db->get('dir_subkategori');

	}	

}