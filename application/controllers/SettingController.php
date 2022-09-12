<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



Class SettingController extends CI_Controller {



	private $title = 'Setting';

	private $current_url = '/setting';

	private $id_current_url;

	private $_table = "dir_setting";

	private $_key = "id_setting";

	private $request;

	private $lib;

    public function __construct() {

        parent::__construct();

		$this->load->model('SettingModel');

        $this->load->model('GlobalModel');

        $this->load->model('AccessMenuModel');



        // declare

		// $this->request = new SubkategoriRequest();

		$this->lib = new Customlibrary();



        $find_menu['link_menu'] = $this->current_url;

        $get_id_menu =  $this->GlobalModel->find_data('dir_menu',$find_menu)->row();

		$this->id_current_url = $get_id_menu->id_menu;

    }



	public function ganti_password() {

        if(!$this->session->userdata('id')){

			redirect('');

		}

		$data = array(

			'title' => 'Ganti Password',

		);

        $this->lib->views('content/setting/ganti_password', $data);

	}



	public function proses_ganti_password(){

        if(!$this->session->userdata('id')){

			redirect('');

		}

        $rules = $this->SettingModel->gantiPasswordRules();

		$this->lib->validation($rules,'password');



        $data['user_password'] = md5($this->input->post('password_baru'));

        $password_lama = $this->input->post('password_lama');



        $check_user = $this->SettingModel->check_user($password_lama);



        if($check_user){

            $update = $this->SettingModel->ganti_password($data);

            if($update){

                $this->lib->log_task('ganti password');

                $this->session->set_flashdata('success','Password Berhasil Diubah!');

            }else{

                $this->session->set_flashdata('error','Password Gagal Diubah!');

            }

        }else{

            $this->session->set_flashdata('error','Password Lama Salah!');

        }

        redirect('password');

    }



    public function ganti_layout() {

        $this->lib->check_auth($this->id_current_url,'read');

        $layout = $this->SettingModel->get_layout();

        $access =  $this->AccessMenuModel->find_data_access($this->id_current_url);



		$data = array(

			'title' => 'Ganti Layout',

			'data' => $layout,

			'access' => $access,

		);

        $this->lib->views('content/setting/ganti_layout', $data);

	}



    public function proses_ganti_layout(){

        $this->lib->check_auth($this->id_current_url,'update');

        $rules = $this->SettingModel->gantiLayoutRules();

		$this->lib->validation($rules,'password');



        $data['setting_title'] = $this->input->post('title');

        $data['setting_footer'] = $this->input->post('footer');



        if (!empty($_FILES['logo_1']['name'])){

			$importImage = $this->lib->import_image('logo_1','img/setting');

            if(!$importImage){

				return redirect($this->current_url);

			}else{

				$data['setting_logo_utama'] = $importImage;

			}
		}



        if (!empty($_FILES['logo_2']['name'])){

			$importImage = $this->lib->import_image('logo_2','img/setting');

            if(!$importImage){

				return redirect($this->current_url);

			}else{

				$data['setting_logo_cadangan'] = $importImage;

			}

		}



        $update = $this->SettingModel->ganti_layout($data);

        if($update){

            $this->lib->log_task('ganti layout');

            $this->session->set_flashdata('success','Layout Berhasil Diubah, silahkan logout terlebih dahulu jika ingin melihat perubahan!');

        }else{

            $this->session->set_flashdata('error','Layout Gagal Diubah!');

        }

        redirect($this->current_url);

    }

}

