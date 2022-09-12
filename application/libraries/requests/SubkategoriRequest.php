<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SubkategoriRequest {
    private $_table = "dir_subkategori";

    function allRequest(){
        $rules = [
			[
				'field' => 'id_kategori',
				'label' => 'Nama Kategori',
				'rules' => 'required'
			],
			[
				'field' => 'subkategori',
				'label' => 'Subkategori',
				'rules' => 'required'
			],
		];

        return $rules;
    }
    

}

