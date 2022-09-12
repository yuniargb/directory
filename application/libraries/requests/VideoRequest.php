<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class VideoRequest {

    private $_table = "dir_video";



    function allRequest(){

        $rules = [

			[

				'field' => 'id_cabang',

				'label' => 'Cabang',

				'rules' => 'required'

			],

			[

				'field' => 'id_juara',

				'label' => 'Juara',

				'rules' => 'required'

			],

			[

				'field' => 'id_golongan',

				'label' => 'Golongan',

				'rules' => 'required'

			],

			[

				'field' => 'id_kategori',

				'label' => 'Kategori',

				'rules' => 'required'

			],

			[

				'field' => 'id_subkategori',

				'label' => 'Subkategori',

				'rules' => 'required'

			],

			[

				'field' => 'judul',

				'label' => 'Judul Video',

				'rules' => 'required'

			],

			[

				'field' => 'deskripsi',

				'label' => 'Deskripsi',

				'rules' => 'required'

			],

			[

				'field' => 'link',

				'label' => 'Link',

				'rules' => 'required'

			],

		];



		



        return $rules;

    }

    



}



