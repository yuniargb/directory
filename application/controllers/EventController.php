<?php

defined('BASEPATH') OR exit('No direct script header allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



Class EventController extends CI_Controller {



	private $title = 'Event';

	private $current_url = '/event';

	private $id_current_url;

	private $_table = "dir_event";

	private $_key = "id_event";

	private $request;

	private $lib;

	



    public function __construct() {

        parent::__construct();

		// model

		$this->load->model('AccessMenuModel');

		$this->load->model('GlobalModel');

		// library

		$this->load->library('requests/EventRequest');

		// declare

		$this->request = new EventRequest();

		$this->lib = new Customlibrary();



		$find_menu['link_menu'] = $this->current_url;

        $get_id_menu =  $this->GlobalModel->find_data('dir_menu',$find_menu)->row();

		$this->id_current_url = $get_id_menu->id_menu;

		

    }



	// main page

	public function index() {

		$this->lib->check_auth($this->id_current_url,'read');

		

		$access =  $this->AccessMenuModel->find_data_access($this->id_current_url);



		$EventData = $this->GlobalModel->get_data('dir_event')->result();

		$ProvinsiData = $this->GlobalModel->get_data('dir_provinsi')->result();

		$KabKotaData = $this->GlobalModel->get_data('dir_kabkota')->result();

		$KategoriData = $this->GlobalModel->get_data('dir_kategori')->result();


		$data = array(

			'title' => $this->title,

			'data' => $EventData,

			'access' => $access,

			'provinsi' => $ProvinsiData,

			'kabkota' => $KabKotaData,

			'kategori' => $KategoriData,

			
		);

        $this->lib->views('content/event/event_main', $data);

	}



	// store data

	public function store()

	{

		$this->lib->check_auth($this->id_current_url,'create');

		$rules = $this->request->postRequest();

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

		$rules = $this->request->putRequest();

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

