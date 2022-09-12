<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class EventRequest {

    private $_table = "dir_event";



    function postRequest(){

        $rules = [

			[

				'field' => 'event_tahun',

				'label' => 'Tahun Event',

				'rules' => 'required|is_unique['.$this->_table.'.event_tahun]|numeric'

			],

			[

				'field' => 'event_name',

				'label' => 'Nama Event',

				'rules' => 'required'

			],

			[

				'field' => 'event_kota',

				'label' => 'Kota',

				'rules' => 'required'

			],

			[

				'field' => 'event_provinsi',

				'label' => 'Provinsi',

				'rules' => 'required'

			],
			
			[

				'field' => 'event_kategori',

				'label' => 'Kategori',

				'rules' => 'required'

			],

		];



        return $rules;

    }

    function putRequest(){

        $rules = [

			[

				'field' => 'event_tahun',

				'label' => 'Tahun Event',

				'rules' => 'required|numeric'

			],

			[

				'field' => 'event_name',

				'label' => 'Nama Event',

				'rules' => 'required'

			],

			[

				'field' => 'event_kota',

				'label' => 'Kota',

				'rules' => 'required'

			],

			[

				'field' => 'event_provinsi',

				'label' => 'Provinsi',

				'rules' => 'required'

			],

			[

				'field' => 'event_kategori',

				'label' => 'Kategori',

				'rules' => 'required'

			],

		];



        return $rules;

    }

    



}



