<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CabangRequest {
    private $_table = "dir_cabang";

    function allRequest(){
        $rules = [
			[
				'field' => 'cabang_nama',
				'label' => 'Nama Cabang',
				'rules' => 'required'
			],
		];

        return $rules;
    }
    

}

