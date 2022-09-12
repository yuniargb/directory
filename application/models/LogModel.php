<?php

class LogModel extends CI_Model
{
	private $_table = "dir_log";

    function store_data($data)
	{
        return $this->db->insert($this->_table,$data);
	}
}