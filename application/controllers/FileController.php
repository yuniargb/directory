<?php

defined('BASEPATH') OR exit('No direct script header allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



Class FileController extends CI_Controller {



	private $title = 'File';

	private $current_url = '/file';

	private $id_current_url;

	private $_table = "dir_file";

	private $_key = "id_file";

	private $request;

	private $lib;

	



    public function __construct() {

        parent::__construct();

		// model

		$this->load->model('AccessMenuModel');

		$this->load->model('GlobalModel');

		$this->load->model('FileModel');

		// library

		$this->load->library('requests/FileRequest');

		// declare

		$this->request = new FileRequest();

		$this->lib = new Customlibrary();



		$find_menu['link_menu'] = $this->current_url;

        $get_id_menu =  $this->GlobalModel->find_data('dir_menu',$find_menu)->row();

		$this->id_current_url = $get_id_menu->id_menu;

		

    }



	// main page

	public function index() {

		$this->lib->check_auth($this->id_current_url,'read');

		

		$access =  $this->AccessMenuModel->find_data_access($this->id_current_url);

		$FileData = $this->FileModel->get_data('dir_file')->result();

		$EventData = $this->GlobalModel->get_data('dir_event')->result();

		$data = array(

			'title' => $this->title,

			'data' => $FileData,

			'access' => $access,

			'event' => $EventData,

		);

        $this->lib->views('content/file/file_main', $data);

	}

	// ajax
	
	public function ajax() {

		$this->lib->check_auth($this->id_current_url,'read');
		$access =  $this->AccessMenuModel->find_data_access($this->id_current_url);
		$this->load->helper('ajaxd');
	
		$list = $this->FileModel->get_datatables();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->id_file;
            $row[] = $field->judul_file;
            $row[] = $field->event_name;
			$row[] = '<a href="'. base_url('assets/'.$field->nama_file) .'" target="_blank" class="btn btn-sm btn-secondary"><i class="fas fa-file-pdf"></i> Download</a>';
			$row[] = Ajaxd::btnAccess($access,$this->title,$field,$field->id_file,$this->current_url,false);

            $data[] = $row;
        }
		$output = Ajaxd::outputAjax($data,$this->FileModel->count_all(),$this->FileModel->count_filtered());
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

		if (!empty($_FILES['file_pdf']['name'])){

			$importImage = $this->lib->import_pdf('file_pdf','pdf');

			if(!$importImage){

				return redirect($this->current_url);

			}else{

				$data['nama_file'] = $importImage;

			}

		}else{

			$this->session->set_flashdata('error', "File PDF wajib diisi");

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

		if (!empty($_FILES['file_pdf']['name'])){

			$importFile = $this->lib->import_pdf('file_pdf','pdf');

			if(!$importFile){

				return redirect($this->current_url);

			}else{

				$data['nama_file'] = $importFile;

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

		$response = $this->GlobalModel->delete_data($this->_table,[$this->_key => $id]);

		$this->lib->response($response,$this->current_url,'delete',$substr);

	}

}

