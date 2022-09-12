<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class FileRequest {

    private $_table = "dir_file";



    function allRequest(){

        $rules = [

			[

				'field' => 'id_event',

				'label' => 'Event',

				'rules' => 'required'

			],

			[

				'field' => 'judul_file',

				'label' => 'Judul File',

				'rules' => 'required'

			],

		];



        return $rules;

    }

    



}



