<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KategoriRequest {
    private $_table = "dir_kategori";

    function allRequest(){
        $rules = [
			[
				'field' => 'nama_kategori',
				'label' => 'Nama Kategori',
				'rules' => 'required'
			],
		];

        return $rules;
    }
    

}

