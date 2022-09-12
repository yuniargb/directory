<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



Class MenuController extends CI_Controller {



	private $title = 'Menu';

	private $current_url = '/menu';

	private $id_current_url;

	private $_table = "dir_menu";

	private $_key = "id_menu";

	private $request;

	private $lib;

	



    public function __construct() {

        parent::__construct();

		// model

		$this->load->model('MenuModel');

		$this->load->model('GlobalModel');

		$this->load->model('AccessMenuModel');

		// library

		$this->load->library('requests/MenuRequest');

		// declare

		$this->request = new MenuRequest();

		$this->lib = new Customlibrary();



		$find_menu['link_menu'] = $this->current_url;

        $get_id_menu =  $this->GlobalModel->find_data('dir_menu',$find_menu)->row();

		$this->id_current_url = $get_id_menu->id_menu;

		

    }



	// main page

	public function index() {

		$this->lib->check_auth($this->id_current_url,'read');

		

		$access =  $this->AccessMenuModel->find_data_access($this->id_current_url);



		$MenuData = $this->MenuModel->get_data()->result();

		$MenuParentData = $this->MenuModel->get_data_parent()->result();

		$HeaderMenuData = $this->GlobalModel->get_data('dir_header_menu')->result();

		$data = array(

			'title' => $this->title,

			'data' => $MenuData,

			'access' => $access,

			'headerMenu' => $HeaderMenuData,

			'menuParent' => $MenuParentData,

		);

        $this->lib->views('content/menu/menu_main', $data);

	}



	// store data

	public function store()

	{

		$this->lib->check_auth($this->id_current_url,'create');

		$rules = $this->request->postRequest();

		$this->lib->validation($rules,$this->current_url);



		$data = $this->lib->post_form();



		if($data['group_menu'] == 1){

			$data['link_nama_menu'] = null;

			$data['link_menu'] = null;

			$data['parent_menu'] = null;

		}else{

			$rules = $this->request->groupRequest();

			$this->lib->validation($rules,$this->current_url);

		}



		if($data['parent_menu'] != ""){

			$data['icon_menu'] = null;

		}else{

			$data['parent_menu'] = null;

		}

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



		if($data['group_menu'] == 1){

			$data['link_nama_menu'] = null;

			$data['link_menu'] = null;

			$data['parent_menu'] = null;

		}else{

			$rules = $this->request->groupRequest();

			$this->lib->validation($rules,$this->current_url);

		}



		if($data['parent_menu'] != ""){

			$data['icon_menu'] = null;

		}else{

			$data['parent_menu'] = null;

		}

		

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

