<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class GolonganRequest {

    function allRequest(){

        $rules = [

			[

				'field' => 'id_cabang',

				'label' => 'Cabang',

				'rules' => 'required'

			],

			[

				'field' => 'golongan_nama',

				'label' => 'Nama Golongan',

				'rules' => 'required'

			],

			[

				'field' => 'golongan_umur',

				'label' => 'Golongan Umur',

				'rules' => 'required|numeric'

			],

			[

				'field' => 'golongan_urutan',

				'label' => 'Golongan Urutan',

				'rules' => 'required|numeric'

			],

			[

				'field' => 'golongan_kategori',

				'label' => 'Golongan Kategori',

				'rules' => 'required'

			],

		];



        return $rules;

    }

    



}



