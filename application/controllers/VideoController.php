<?php

defined('BASEPATH') OR exit('No direct script header allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



Class VideoController extends CI_Controller {



	private $title = 'Video';

	private $current_url = '/video';

	private $id_current_url;

	private $_table = "dir_video";

	private $_key = "id_video";

	private $request;

	private $lib;

	



    public function __construct() {

        parent::__construct();

		// model

		$this->load->model('AccessMenuModel');

		$this->load->model('GlobalModel');

		$this->load->model('VideoModel');

		$this->load->model('JuaraModel');

		// library

		$this->load->library('requests/VideoRequest');

		// declare

		$this->request = new VideoRequest();

		$this->lib = new Customlibrary();



		$find_menu['link_menu'] = $this->current_url;

        $get_id_menu =  $this->GlobalModel->find_data('dir_menu',$find_menu)->row();

		$this->id_current_url = $get_id_menu->id_menu;

		

    }



	// main page

	public function index() {

		$this->lib->check_auth($this->id_current_url,'read');

		

		$access =  $this->AccessMenuModel->find_data_access($this->id_current_url);



		$VideoData = $this->VideoModel->get_data('dir_video')->result();

		$CabangData = $this->GlobalModel->get_data('dir_cabang')->result();

		$GolonganData = $this->GlobalModel->get_data('dir_golongan')->result();

		$KategoriData = $this->GlobalModel->get_data('dir_kategori')->result();
		$SubkategoriData = $this->GlobalModel->get_data('dir_subkategori')->result();

		$JuaraData = $this->JuaraModel->get_data()->result();



		$data = array(

			'title' => $this->title,

			'data' => $VideoData,

			'access' => $access,

			'cabang' => $CabangData,

			'golongan' => $GolonganData,

			'kategori' => $KategoriData,

			'subkategori' => $SubkategoriData,

			'juara' => $JuaraData,

		);

        $this->lib->views('content/video/video_main', $data);

	}

	// ajax
	public function ajax() {
		$this->lib->check_auth($this->id_current_url,'read');
		$access =  $this->AccessMenuModel->find_data_access($this->id_current_url);
		$this->load->helper('ajaxd');
	
		$list = $this->VideoModel->get_datatables();
        $data = array();
        foreach ($list as $field) {
			$jumlah_karakter    = strlen($field->deskripsi);

			if($jumlah_karakter > 50 ){
				$deskripsi = substr($field->deskripsi,0,50) . '<span id="read_'.$field->id_video.'">...</span><a href="#" class="readmore" data-show="0" data-target="#read_'.$field->id_video.'" data-next="'.substr($field->deskripsi,50).'">read more</a>' ;
			}else{
				$deskripsi = $field->deskripsi;
			}
            $row = array();
            $row[] = $field->id_video;
            $row[] = $field->juara_nama;
            $row[] = $field->judul;
            $row[] = $deskripsi;
            $row[] = '<a href="'. $field->link .'" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-link"></i> Link</a>';
            $row[] = $field->cabang_nama;
            $row[] = $field->golongan_nama;
            $row[] = $field->nama_kategori;
			$row[] = Ajaxd::fotoBtn($field->thumbnail);
			$row[] = Ajaxd::btnAccess($access,$this->title,$field,$field->id_video,$this->current_url,false);

            $data[] = $row;
        }
		$output = Ajaxd::outputAjax($data,$this->VideoModel->count_all(),$this->VideoModel->count_filtered());
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



		$data = $this->lib->post_form();;



		if (!empty($_FILES['thumbnail']['name'])){

			$this->lib->validation_image_potrait('thumbnail',$this->current_url);

			$importImage = $this->lib->import_image('thumbnail','img/thumbnail_1');

			

			if(!$importImage){

				return redirect($this->current_url);

			}else{

				$data['thumbnail'] = $importImage;

			}

		}else{

			$this->session->set_flashdata('error', "Thumbnail wajib diisi");

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



		if (!empty($_FILES['thumbnail']['name'])){

			$this->lib->validation_image_potrait('thumbnail',$this->current_url);

			$importImage = $this->lib->import_image('thumbnail','img/thumbnail_1');

			

			if(!$importImage){

				return redirect($this->current_url);

			}else{

				$data['thumbnail'] = $importImage;

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

		unlink('./assets/'.$getData->thumbnail);

		$response= $this->GlobalModel->delete_data($this->_table,[$this->_key => $id]);

		$this->lib->response($response,$this->current_url,'delete',$substr);

	}

}

