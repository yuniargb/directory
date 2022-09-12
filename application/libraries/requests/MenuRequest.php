<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class MenuRequest {

    private $_table = "dir_menu";



    function postRequest(){

        $rules = [

			[

				'field' => 'nama_menu',

				'label' => 'Nama Menu',

				'rules' => 'required'

			],

			[

				'field' => 'id_header_menu',
				'label' => 'Header Menu',
				'rules' => 'required'

			],

			[

				'field' => 'group_menu',
				'label' => 'Group',
				'rules' => 'required'

			],

			[

				'field' => 'flag_menu',
				'label' => 'Status',
				'rules' => 'required'

			],

			[

				'field' => 'order_by',
				'label' => 'Urutan',
				'rules' => 'required|is_unique['.$this->_table.'.order_by]|numeric'

			]

		];



        return $rules;

    }

    function putRequest(){

        $rules = [

			[

				'field' => 'nama_menu',

				'label' => 'Nama Menu',

				'rules' => 'required'

			],

			[

				'field' => 'id_header_menu',

				'label' => 'Header Menu',

				'rules' => 'required'

			],

            [

				'field' => 'group_menu',

				'label' => 'Group',

				'rules' => 'required'

			],

			[

				'field' => 'flag_menu',

				'label' => 'Status',

				'rules' => 'required'

			],

			[

				'field' => 'order_by',

				'label' => 'Urutan',

				'rules' => 'required|numeric'

			]

		];



        return $rules;

    }



    function groupRequest(){

        $rules = [

			[

				'field' => 'link_nama_menu',

				'label' => 'Tag Menu',

				'rules' => 'required'

			],

			[

				'field' => 'link_menu',

				'label' => 'Link Menu',

				'rules' => 'required'

			],

		];



        return $rules;

    }

}