<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserLevelRequest {
    private $_table = "dir_user_level";

    function allRequest(){
        $rules = [
			[
				'field' => 'nama_level',
				'label' => 'Nama Level',
				'rules' => 'required'
			],
			[
				'field' => 'redirect_menu',
				'label' => 'Redirect Menu',
				'rules' => 'required'
			],
		];

        return $rules;
    }
    

}

