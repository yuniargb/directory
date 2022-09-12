<?php



class FileModel extends CI_Model

{

	private $_table = "dir_file";

	private $_as_table = " as df";

	private $_key = "id_file";

	private $column_order = array('df.id_file', 'judul_file','event_name','nama_file');
    private $column_search = array('judul_file'); 
    private $order = array('judul_file' => 'asc'); // default order 
    

    public function get_data(){

		$this->db->join('dir_event de', 'de.id_event=df.id_event');
        return $sql = $this->db->get($this->_table . $this->_as_table);

	}	

	private function get_data_ajax(){

		$this->load->helper('ajaxd');

		$this->db->join('dir_event de', 'de.id_event=df.id_event');

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