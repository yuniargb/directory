<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class JuaraRequest {

    private $_table = "dir_juara";



    function allRequest(){

        $rules = [

			[

				'field' => 'id_event',

				'label' => 'Event',

				'rules' => 'required'

			],

			[

				'field' => 'id_cabang',

				'label' => 'Cabang',

				'rules' => 'required'

			],

			[

				'field' => 'id_golongan',

				'label' => 'Golongan',

				'rules' => 'required'

			],

			[

				'field' => 'juara_ke',

				'label' => 'Juara',

				'rules' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[6]'

			],


			[

				'field' => 'id_kategori',

				'label' => 'Kategori',

				'rules' => 'required|numeric'

			],

			[

				'field' => 'juara_nama',

				'label' => 'Nama Juara',

				'rules' => 'required'

			],


			[

				'field' => 'juara_provinsi',

				'label' => 'Provinsi Juara',

				'rules' => 'required'

			],

			[

				'field' => 'link',

				'label' => 'Link video',

				'rules' => 'required'

			],

		];



		



        return $rules;

    }

    



}



