<?php

defined('BASEPATH') OR exit('No direct script header allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



Class DirectoryController extends CI_Controller {



	private $title = 'Directory';

	private $current_url = '/';

	private $lib;

	



    public function __construct() {

        parent::__construct();

		// model

		$this->load->model('DirectoryModel');

		$this->load->model('GlobalModel');


		// declare

		$this->lib = new Customlibrary();
    }



	// main page

	public function index() {
        $KategoriData = $this->GlobalModel->get_data('dir_kategori')->result();
        $eventData = $this->GlobalModel->get_data('dir_event','event_tahun','desc')->result();
        $data = array(
            'title' => 'Cari Data',
            'kategori' => $KategoriData,
            'event' => $eventData,
        );
        $this->lib->views_directory('content/directory/directory_main',$data);
	}

    public function detailJuara($id){

        $id =  $this->encryption->decrypt(base64_decode($id));
        $juara = $this->DirectoryModel->get_juara(null,null,$id)->row();
        $video = $this->DirectoryModel->get_video(null,$id)->result();
       
        
        $data = array(
            'juara' => $juara,
            'video' => $video,
            'title' => 'Detail Juara',
        );
        $this->lib->views_directory('content/directory/directory_detail',$data);
    }


    public function findData(){
        $nama = $this->input->post('p_judul');
        $kategori = $this->input->post('p_kategori');
        $type = $this->input->post('p_type');
        $event = $this->input->post('p_event');
        if($event == 'all') $event = null;
        $juara = null;
        $video = null;
        $file = null;
        $subkategori = null;
        if($nama || $event){
            switch($type){
                case "juara":
                    $juara = $this->DirectoryModel->get_juara($nama,$event,null,$kategori)->result();
                    break;
                case "video":
                    $video = $this->DirectoryModel->get_video($nama,null,$kategori,$event)->result();
                    break;
                case "file":
                    $file = $this->DirectoryModel->get_file($nama,$event)->result();
                    break;
                default:
                    $juara = $this->DirectoryModel->get_juara($nama,$event,null,$kategori)->result();
                    $video = $this->DirectoryModel->get_video($nama,null,$kategori,$event)->result();
                    $file = $this->DirectoryModel->get_file($nama,$event)->result();
                    break;
            }
        }

        if($kategori){
            $subkategori = $this->GlobalModel->find_data('dir_subkategori',['id_kategori' => $kategori])->result();
        }
        
        $data = array(
            'juara' => $juara,
            'video' => $video,
            'nama' => $nama,
            'file' => $file,
            'subkategori' => $subkategori,
        );
        return $this->load->view('content/directory/directory_result',$data);
    }

    public function findEvent(){
        $id_event = $this->input->post('id_event');
        $event = $this->GlobalModel->find_data('dir_event',['id_event' => $id_event])->row();
        $juara = null;
        $video = null;
        $file = null;
        if($id_event){
            $juara = $this->DirectoryModel->get_juara(null,$id_event)->result();
            // $video = $this->DirectoryModel->get_video(null,$id_event)->result();
        }
        
        $data = array(
            'juara' => $juara,
            'video' => $video,
            'file' => $file,
            'nama' => $event->event_name,
        );
        return $this->load->view('content/directory/directory_result',$data);
    }

   
}

