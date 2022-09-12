<?php



class JuaraModel extends CI_Model

{

	private $_table = "dir_juara";

	private $_as_table = " as dj";

    private $column_order = array('dj.id_juara', 'juara_nama','juara_foto','event_name');
    private $column_search = array('juara_nama'); 
    private $order = array('juara_nama' => 'asc'); // default order 

    public function get_data(){

		$this->db->join('dir_event de', 'de.id_event=dj.id_event','left');

		$this->db->join('dir_cabang dc', 'dc.id_cabang=dj.id_cabang','left');

		$this->db->join('dir_golongan dg', 'dg.id_golongan=dj.id_golongan','left');

		$this->db->join('dir_provinsi dp', 'dp.prov_id=dj.juara_provinsi','left');

        return $sql = $this->db->get($this->_table . $this->_as_table);

	}	



	public function find_data($data){

		$this->db->join('dir_event de', 'de.id_event=dj.id_event','left');

		$this->db->join('dir_cabang dc', 'dc.id_cabang=dj.id_cabang','left');

		$this->db->join('dir_golongan dg', 'dg.id_golongan=dj.id_golongan','left');

		$this->db->join('dir_provinsi dp', 'dp.prov_id=dj.juara_provinsi','left');

		$this->db->where([

			'dj.id_event' => $data['id_event'],

			'dj.id_cabang' => $data['id_cabang'],

			'dj.id_golongan' => $data['id_golongan'],

			'dj.juara_ke' => $data['juara_ke'],

		]);
        return $sql = $this->db->get($this->_table . $this->_as_table);

	}	

	private function get_data_ajax(){

		$this->load->helper('ajaxd');

		$this->db->join('dir_event de', 'de.id_event=dj.id_event','left');
		$this->db->join('dir_cabang dc', 'dc.id_cabang=dj.id_cabang','left');
		$this->db->join('dir_golongan dg', 'dg.id_golongan=dj.id_golongan','left');
		$this->db->join('dir_provinsi dp', 'dp.prov_id=dj.juara_provinsi','left');
		$this->db->join('dir_video dv', 'dv.id_juara=dj.id_juara','left');
		$this->db->select('dj.*,de.event_tahun,de.event_name,de.event_provinsi,dc.cabang_nama,dg.golongan_nama,dp.prov_nama,dv.deskripsi,dv.link,dv.thumbnail');
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