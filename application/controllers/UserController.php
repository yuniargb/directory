<?php

defined('BASEPATH') OR exit('No direct script header allowed');



Class UserController extends CI_Controller {



	private $title = 'User';

	private $current_url = '/user';

	private $id_current_url;

	private $_table = "dir_user";

	private $_key = "id_user";

	private $request;

	private $lib;

	



    public function __construct() {

        parent::__construct();

		// model

		$this->load->model('AccessMenuModel');

		$this->load->model('GlobalModel');

		$this->load->model('UserModel');

		$this->load->model('UserLevelModel');

		// library

		$this->load->library('requests/UserRequest');

		// declare

		$this->request = new UserRequest();

		$this->lib = new Customlibrary();



		$find_menu['link_menu'] = $this->current_url;

        $get_id_menu =  $this->GlobalModel->find_data('dir_menu',$find_menu)->row();

		$this->id_current_url = $get_id_menu->id_menu;

		

    }



	// main page

	public function index() {

		$this->lib->check_auth($this->id_current_url,'read');

		

		$access =  $this->AccessMenuModel->find_data_access($this->id_current_url);



		$UserData = $this->UserModel->get_data('dir_user')->result();

		$LevelData = $this->UserLevelModel->get_data()->result();

		$data = array(

			'title' => $this->title,

			'data' => $UserData,

			'access' => $access,

			'level' => $LevelData,

		);

        $this->lib->views('content/user/user_main', $data);

	}



	// store data

	public function store()

	{

		$this->lib->check_auth($this->id_current_url,'create');

		$rules = $this->request->postRequest();

		$this->lib->validation($rules,$this->current_url);



		$data = $this->lib->post_form();



		$data['user_password'] = md5($data['uxpx']);

		unset($data['uxpx']);



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

		if($data['uxpx'] != ""){

			$data['user_password'] = md5($data['uxpx']);

		}else{

			

		}

		unset($data['uxpx']);

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

