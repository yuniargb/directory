<?php

defined('BASEPATH') OR exit('No direct script access allowed');



Class AuthController extends CI_Controller {



    public function __construct() {

        parent::__construct();

		$this->load->model('AuthModel');

    }



	public function index() {

		$data = array(

			'title' => "Login"

		);

		// $this->customlibrary->views('auth/login', $data);

		$this->load->view('auth/login_2',$data);

	}



    public function login()

	{

		$rules = $this->AuthModel->rules();

		$this->form_validation->set_rules($rules);





		if($this->form_validation->run() == FALSE){

			return $this->index();

		}



		$username = $this->input->post('username');

		$password = $this->input->post('password');



		

		if($x = $this->AuthModel->login($username, $password)){

			$this->customlibrary->log_task('login '. $this->session->userdata('nama_level'));

			// echo $this->session->userdata('id');
			// echo '</br> '.  $this->session->userdata('level');

			return redirect($this->session->userdata('redirect_menu'));

		} else {

			$this->session->set_flashdata('error', 'Login Gagal, pastikan username dan passwrod benar!');

		}

		return redirect('/login');

	

		// return $this->index();

	}





    public function logout()

	{

		$this->load->model('AuthModel');

		$this->customlibrary->log_task('logout');

		$this->AuthModel->logout();

		redirect('/login');

	}

}

