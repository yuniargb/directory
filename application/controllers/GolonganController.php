<?php

defined('BASEPATH') OR exit('No direct script header allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



Class GolonganController extends CI_Controller {



	private $title = 'Golongan';

	private $current_url = '/golongan';

	private $id_current_url;

	private $_table = "dir_golongan";

	private $_key = "id_golongan";

	private $request;

	private $lib;

	



    public function __construct() {

        parent::__construct();

		// model

		$this->load->model('AccessMenuModel');

		$this->load->model('GlobalModel');

		$this->load->model('GolonganModel');

		// library

		$this->load->library('requests/GolonganRequest');

		// declare

		$this->request = new GolonganRequest();

		$this->lib = new Customlibrary();



		$find_menu['link_menu'] = $this->current_url;

        $get_id_menu =  $this->GlobalModel->find_data('dir_menu',$find_menu)->row();

		$this->id_current_url = $get_id_menu->id_menu;

		

    }



	// main page

	public function index() {

		$this->lib->check_auth($this->id_current_url,'read');

		

		$access =  $this->AccessMenuModel->find_data_access($this->id_current_url);



		$GolonganData = $this->GolonganModel->get_data('dir_golongan')->result();

		$CabangData = $this->GlobalModel->get_data('dir_cabang')->result();
		$KategoriData = $this->GolonganModel->get_data_subkategori()->result();
		



		$data = array(

			'title' => $this->title,

			'data' => $GolonganData,

			'access' => $access,

			'cabang' => $CabangData,

			'kategori' => $KategoriData,

		);

        $this->lib->views('content/golongan/golongan_main', $data);

	}



	// store data

	public function store()

	{

		$this->lib->check_auth($this->id_current_url,'create');

		$rules = $this->request->allRequest();

		$this->lib->validation($rules,$this->current_url);



		$data = $this->lib->post_form();



		$response= $this->GlobalModel->store_data($this->_table,$data);



		$this->lib->response($response,$this->current_url,'store',$this->title);

	}



	// update data

	public function update($id)

	{
		$id = $this->encryption->decrypt(base64_decode($id));

		$this->lib->check_auth($this->id_current_url,'update');

		$rules = $this->request->allRequest();

		$this->lib->validation($rules,$this->current_url);



		$data = $this->lib->put_form();

		

		$response= $this->GlobalModel->update_data($this->_table,[$this->_key => $id],$data);



		$this->lib->response($response,$this->current_url,'update',$this->title);

	}



	// delete data

	public function delete($id)

	{	
		$id = $this->encryption->decrypt(base64_decode($id));
		
		$this->lib->check_auth($this->id_current_url,'delete');

		$getData = $this->GlobalModel->find_data($this->_table,[$this->_key => $id])->row();

		$imp = http_build_query($getData);

		$substr = $this->title . ' ('.$imp.')';



		$response= $this->GlobalModel->delete_data($this->_table,[$this->_key => $id]);

		$this->lib->response($response,$this->current_url,'delete',$substr);

	}

}

