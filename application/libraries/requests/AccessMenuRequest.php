<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AccessMenuRequest {
    private $_table = "dir_access_menu";

    function postRequest(){
        $rules = [
			[
				'field' => 'level_id',
				'label' => 'Level',
				'rules' => 'required|is_unique['.$this->_table.'.level_id]'
			]
		];

        return $rules;
    }
    function putRequest(){
        $rules = [
			[
				'field' => 'level_id',
				'label' => 'Level',
				'rules' => 'required'
			]
		];

        return $rules;
    }
    

}