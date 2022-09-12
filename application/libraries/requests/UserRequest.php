<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserRequest {
    private $_table = "dir_user";

    function postRequest(){
        $rules = [
			[
				'field' => 'user_username',
				'label' => 'Username',
				'rules' => 'required|is_unique['.$this->_table.'.user_username]'
			],
			[
				'field' => 'user_nama',
				'label' => 'Nama User',
				'rules' => 'required'
			],
			[
				'field' => 'level_id',
				'label' => 'Level',
				'rules' => 'required'
			],
			[
				'field' => 'uxpx',
				'label' => 'Password',
				'rules' => 'required'
			],
			[
				'field' => 'user_flag',
				'label' => 'Status',
				'rules' => 'required'
			]
		];

        return $rules;
    }
    function putRequest(){
        $rules = [
			[
				'field' => 'user_nama',
				'label' => 'Nama User',
				'rules' => 'required'
			],
			[
				'field' => 'level_id',
				'label' => 'Level',
				'rules' => 'required'
			],
			[
				'field' => 'user_flag',
				'label' => 'Status',
				'rules' => 'required'
			]
		];

        return $rules;
    }

	
    

}

