<?php

defined('BASEPATH') OR exit('No direct script header allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



Class KategoriController extends CI_Controller {



	private $title = 'Kategori';

	private $current_url = '/kategori';

	private $id_current_url;

	private $_table = "dir_kategori";

	private $_key = "id_kategori";

	private $request;

	private $lib;

	



    public function __construct() {

        parent::__construct();

		// model

		$this->load->model('AccessMenuModel');

		$this->load->model('GlobalModel');

		// library

		$this->load->library('requests/KategoriRequest');

		// declare

		$this->request = new KategoriRequest();

		$this->lib = new Customlibrary();



		$find_menu['link_menu'] = $this->current_url;

        $get_id_menu =  $this->GlobalModel->find_data('dir_menu',$find_menu)->row();

		$this->id_current_url = $get_id_menu->id_menu;

		

    }



	// main page

	public function index() {

		$this->lib->check_auth($this->id_current_url,'read');

		

		$access =  $this->AccessMenuModel->find_data_access($this->id_current_url);



		$KategoriData = $this->GlobalModel->get_data('dir_kategori')->result();

		



		$data = array(

			'title' => $this->title,

			'data' => $KategoriData,

			'access' => $access,

		);

        $this->lib->views('content/kategori/kategori_main', $data);

	}



	// store data

	public function store()

	{

		$this->lib->check_auth($this->id_current_url,'create');

		$rules = $this->request->allRequest();

		$this->lib->validation($rules,$this->current_url);



		$data = $this->lib->post_form();



		if (!empty($_FILES['foto_kategori']['name'])){

			$importImage = $this->lib->import_image('foto_kategori','img/foto_kategori');

			if(!$importImage){

				return redirect($this->current_url);

			}else{

				$data['foto_kategori'] = $importImage;

			}

		}else{

			$this->session->set_flashdata('error', "Foto Icon wajib diisi");

			redirect($this->current_url);

		}



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

		if (!empty($_FILES['foto_kategori']['name'])){

			$importImage = $this->lib->import_image('foto_kategori','img/foto_kategori');

			if(!$importImage){

				return redirect($this->current_url);

			}else{

				$data['foto_kategori'] = $importImage;

			}

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

		unlink('./assets/'.$getData->foto_kategori);



		$response= $this->GlobalModel->delete_data($this->_table,[$this->_key => $id]);

		$this->lib->response($response,$this->current_url,'delete',$substr);

	}

}

