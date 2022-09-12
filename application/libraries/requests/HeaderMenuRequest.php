<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class HeaderMenuRequest {
    private $_table = "dir_header_menu";

    function postRequest(){
        $rules = [
			[
				'field' => 'nama_header',
				'label' => 'Nama Header',
				'rules' => 'required'
			],
			[
				'field' => 'order_by',
				'label' => 'Urutan',
				'rules' => 'required|is_unique['.$this->_table.'.order_by]|numeric'
			],
		];

        return $rules;
    }
    function putRequest(){
        $rules = [
			[
				'field' => 'nama_header',
				'label' => 'Nama Header',
				'rules' => 'required'
			],
			[
				'field' => 'order_by',
				'label' => 'Urutan',
				'rules' => 'required|numeric'
			],
		];

        return $rules;
    }
    

}