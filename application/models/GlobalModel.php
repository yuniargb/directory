<?php



class GlobalModel extends CI_Model

{

    public function store_data($table,$data){

        return $this->db->insert($table,$data);

	}

    public function store_data_id($table,$data){
		$this->db->insert($table,$data);
        return $this->db->insert_id();
	}

    public function store_batch_data($table,$data){

        return $this->db->insert_batch($table,$data);

	}

    public function update_data($table,$where,$data) {

		$this->db->where($where);

		return $this->db->update($table, $data);

	}

    public function delete_data($table,$where) {

		$this->db->where($where);

		return $this->db->delete($table);

	}

    public function get_data($table,$order_by = null,$sort = 'asc'){
		if($order_by){

			$this->db->order_by($order_by,$sort);

		}
        return $sql = $this->db->get($table);

	}

    public function find_data($table,$where,$order_by = null){

		$this->db->where($where);

		if($order_by){

			$this->db->order_by($order_by);

		}

        return $sql = $this->db->get($table);

	}

}