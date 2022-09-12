<?php



class VideoModel extends CI_Model

{

	private $_table = "dir_video";

	private $_as_table = " as dv";

	private $column_order = array('dv.id_video', 'juara_nama','judul','deskripsi','link','cabang_nama','golongan_nama','nama_kategori','thumbnail');
    private $column_search = array('judul'); 
    private $order = array('judul' => 'asc'); // default order 
    

    public function get_data(){

		$this->db->select('dv.*,dc.cabang_nama,dg.golongan_nama,dk.nama_kategori,dj.juara_nama');

		$this->db->join('dir_cabang dc', 'dc.id_cabang=dv.id_cabang','left');

		$this->db->join('dir_golongan dg', 'dg.id_golongan=dv.id_golongan','left');

		$this->db->join('dir_kategori dk', 'dk.id_kategori=dv.id_kategori','left');

		$this->db->join('dir_juara dj', 'dj.id_juara=dv.id_juara','left');

        return $sql = $this->db->get($this->_table . $this->_as_table);

	}	

	private function get_data_ajax(){

		$this->load->helper('ajaxd');

		$this->db->select('dv.*,dc.cabang_nama,dg.golongan_nama,dk.nama_kategori,dj.juara_nama');

		$this->db->join('dir_cabang dc', 'dc.id_cabang=dv.id_cabang','left');

		$this->db->join('dir_golongan dg', 'dg.id_golongan=dv.id_golongan','left');

		$this->db->join('dir_kategori dk', 'dk.id_kategori=dv.id_kategori','left');

		$this->db->join('dir_juara dj', 'dj.id_juara=dv.id_juara','left');

		$this->db->from($this->_table . $this->_as_table);
		
		Ajaxd::filterData($this->column_search,$this->order,$this->column_order);
	}	

	function get_datatables()
    {
        $this->get_data_ajax();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->get_data_ajax();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }

}