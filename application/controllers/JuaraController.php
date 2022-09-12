<?php

defined('BASEPATH') OR exit('No direct script header allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



Class JuaraController extends CI_Controller {



	private $title = 'Juara';

	private $current_url = '/juara';

	private $id_current_url;

	private $_table = "dir_juara";

	private $_key = "id_juara";

	private $request;

	private $lib;

	



    public function __construct() {

        parent::__construct();

		// model

		$this->load->model('AccessMenuModel');

		$this->load->model('GlobalModel');

		$this->load->model('JuaraModel');

		$this->load->model('SubkategoriModel');

		// library

		$this->load->library('requests/JuaraRequest');

		// declare

		$this->request = new JuaraRequest();

		$this->lib = new Customlibrary();



		$find_menu['link_menu'] = $this->current_url;

        $get_id_menu =  $this->GlobalModel->find_data('dir_menu',$find_menu)->row();

		$this->id_current_url = $get_id_menu->id_menu;

		

    }



	// main page

	public function index() {

		$this->lib->check_auth($this->id_current_url,'read');

		

		$access =  $this->AccessMenuModel->find_data_access($this->id_current_url);



		// $JuaraData = $this->JuaraModel->get_data()->result();

		$EventData = $this->GlobalModel->get_data('dir_event')->result();

		$CabangData = $this->GlobalModel->get_data('dir_cabang')->result();

		$GolonganData = $this->GlobalModel->get_data('dir_golongan')->result();

		$ProvinsiData = $this->GlobalModel->get_data('dir_provinsi')->result();

		$KategoriData = $this->SubkategoriModel->get_data()->result();

		$SubkategoriData = $this->GlobalModel->get_data('dir_subkategori')->result();


		$data = array(

			'title' => $this->title,

			// 'data' => $JuaraData,

			'access' => $access,

			'event' => $EventData,

			'cabang' => $CabangData,

			'golongan' => $GolonganData,

			'provinsi' => $ProvinsiData,

			'kategori' => $KategoriData,

			'subkategori' => $SubkategoriData,

		);

        $this->lib->views('content/juara/juara_main', $data);

	}

	// ajax
	
	public function ajax() {

		$this->lib->check_auth($this->id_current_url,'read');
		$access =  $this->AccessMenuModel->find_data_access($this->id_current_url);
		$this->load->helper('ajaxd');
	
		$list = $this->JuaraModel->get_datatables();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->id_juara;
            $row[] = $field->juara_nama;
			$row[] = Ajaxd::fotoBtn($field->juara_foto);
            $row[] = $field->event_name .' ('.$field->event_tahun.')';
			$row[] = Ajaxd::btnAccess($access,$this->title,$field,$field->id_juara,$this->current_url,true);

            $data[] = $row;
        }
		$output = Ajaxd::outputAjax($data,$this->JuaraModel->count_all(),$this->JuaraModel->count_filtered());
        //output dalam format JSON
		header('Content-Type: application/json');
        echo json_encode( $output );

	}


	// store data

	public function store()
	{

		$this->lib->check_auth($this->id_current_url,'create');

		$rules = $this->request->allRequest();

		$this->lib->validation($rules,$this->current_url);



		$data = $this->lib->post_form();

		$cek = $this->JuaraModel->find_data($data)->row();



		if($cek){

			$msg = "Event " .$cek->event_name. ", Cabang " . $cek->cabang_nama . ", Golongan " . $cek->golongan_nama .", Juara ". $cek->juara_ke ." Sudah pernah didaftarkan";

			$this->session->set_flashdata('error', $msg);

			return redirect($this->current_url);

		}



		if (!empty($_FILES['juara_foto']['name'])){

			$importImage = $this->lib->import_image('juara_foto','img/foto_juara');

			if(!$importImage){

				return redirect($this->current_url);

			}else{

				$data['juara_foto'] = $importImage;

			}

		}

		if (!empty($_FILES['thumbnail']['name'])){

			// $this->lib->validation_image_potrait('thumbnail',$this->current_url);

			$import_thumbnail = $this->lib->import_image('thumbnail','img/thumbnail_1');


			if(!$import_thumbnail){

				return redirect($this->current_url);

			}else{

				$data['thumbnail'] = $import_thumbnail;
			}
		}

		$juara = $data;

		unset($juara['deskripsi']);
		unset($juara['thumbnail']);
		unset($juara['link']);

		$response_juara = $this->GlobalModel->store_data_id($this->_table,$juara);

		if($response_juara){
			$video = $data;
			$video['id_juara'] = $response_juara;
			$video['judul'] = $data['juara_nama'];
			unset($video['id_event']);
			unset($video['juara_nama']);
			unset($video['juara_nilai']);
			unset($video['juara_provinsi']);
			unset($video['juara_foto']);
			unset($video['juara_telp']);
			unset($video['juara_ke']);

			$response = $this->GlobalModel->store_data('dir_video',$video);
			$this->lib->response($response,$this->current_url,'store',$this->title);
		}else{
			$this->lib->response($response_juara,$this->current_url,'store',$this->title);
		}



		

	}



	// update data

	public function update($id)
	{
		$id = $this->encryption->decrypt(base64_decode($id));

		$this->lib->check_auth($this->id_current_url,'update');

		$rules = $this->request->allRequest();

		$this->lib->validation($rules,$this->current_url);



		$data = $this->lib->put_form();



		$cek = $this->JuaraModel->find_data($data)->row();



		if($cek){

			if($cek->id_juara != $id){

				$msg = "Event " .$cek->event_name. ", Cabang " . $cek->cabang_nama . ", Golongan " . $cek->golongan_nama .", Juara ". $cek->juara_ke ." Sudah pernah didaftarkan";

				$this->session->set_flashdata('error', $msg);

				return redirect($this->current_url);

			}
		}


		if (!empty($_FILES['juara_foto']['name'])){

			$importImage = $this->lib->import_image('juara_foto','img/foto_juara');

			if(!$importImage){

				return redirect($this->current_url);

			}else{

				$data['juara_foto'] = $importImage;

			}

		}

		if (!empty($_FILES['thumbnail']['name'])){

			$importImage = $this->lib->import_image('thumbnail','img/thumbnail_1');

			if(!$importImage){

				return redirect($this->current_url);

			}else{

				$data['thumbnail'] = $importImage;

			}

		}

		$juara = $data;

		unset($juara['deskripsi']);
		unset($juara['thumbnail']);
		unset($juara['link']);

		$response_juara = $this->GlobalModel->update_data($this->_table,[$this->_key => $id],$juara);

		if($response_juara){
			$video = $data;
			$video['judul'] = $data['juara_nama'];
			unset($video['id_event']);
			unset($video['juara_nama']);
			unset($video['juara_nilai']);
			unset($video['juara_provinsi']);
			unset($video['juara_foto']);
			unset($video['juara_telp']);
			unset($video['juara_ke']);

			$cek_video = $this->GlobalModel->find_data('dir_video',[$this->_key => $id])->row();

			if($cek_video){
				$response = $this->GlobalModel->update_data('dir_video',[$this->_key => $id],$video);
			}else{
				$video['id_juara'] = $id;
				$response = $this->GlobalModel->store_data('dir_video',$video);
			}

			$this->lib->response($response,$this->current_url,'update',$this->title);
		}else{
			$this->lib->response($response_juara,$this->current_url,'update',$this->title);
		}
	}



	// delete data

	public function delete($id)

	{	
		$id = $this->encryption->decrypt(base64_decode($id));

		$this->lib->check_auth($this->id_current_url,'delete');

		$getData = $this->GlobalModel->find_data($this->_table,[$this->_key => $id])->row();

		$imp = http_build_query($getData);

		$substr = $this->title . ' ('.$imp.')';

		unlink('./assets/'.$getData->juara_foto);



		$response= $this->GlobalModel->delete_data($this->_table,[$this->_key => $id]);

		$this->lib->response($response,$this->current_url,'delete',$substr);

	}

}

