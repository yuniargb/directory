<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



Class AccessMenuController extends CI_Controller {



	private $title = 'Access Menu';

	private $current_url = '/access_menu';

	private $id_current_url;

	private $_table = "dir_access_menu";

	private $_key = "id_access";

	private $request;

	private $lib;

	



    public function __construct() {

        parent::__construct();

		// model

		$this->load->model('AccessMenuModel');

		$this->load->model('GlobalModel');

		// library

		$this->load->library('requests/AccessMenuRequest');

		// declare

		$this->request = new AccessMenuRequest();

		$this->lib = new Customlibrary();



		$find_menu['link_menu'] = $this->current_url;

        $get_id_menu =  $this->GlobalModel->find_data('dir_menu',$find_menu)->row();

		$this->id_current_url = $get_id_menu->id_menu;

		

    }



	// main page

	public function index() {

		$this->lib->check_auth($this->id_current_url,'read');

		

		$access =  $this->AccessMenuModel->find_data_access($this->id_current_url);

// 

		$AccessMenuData = $this->AccessMenuModel->get_detail_data();

		

		$MenuData = $this->GlobalModel->find_data('dir_menu',['group_menu' => 0],'order_by')->result();

		$LevelData = $this->GlobalModel->get_data('dir_user_level')->result();

		$data = array(

			'title' => $this->title,

			'data' => $AccessMenuData,

			'access' => $access,

			'menu' => $MenuData,

			'level' => $LevelData,

		);

        $this->lib->views('content/access_menu/access_menu_main', $data);

	}



	// store data

	public function store()

	{

		$this->lib->check_auth($this->id_current_url,'create');

		$rules = $this->request->postRequest();

		$this->lib->validation($rules,$this->current_url);



		$data = $this->lib->post_form();



		foreach($data['menu'] as $k => $m){

			$final['level_id'] = $data['level_id'];

			$final['id_menu'] = $m;

			$final['created_access'] = $data['create'][$m] ?? 0;

			$final['updated_access'] = $data['update'][$m] ?? 0;

			$final['deleted_access'] = $data['delete'][$m] ?? 0;

			$final['read_access'] = $data['read'][$m] ?? 0;

			$final['exported_access'] = $data['export'][$m] ?? 0;

			$final['other_access'] = $data['other'][$m] ?? 0;

			$final['created_date'] = $data['created_date'];

			$final['created_user'] = $data['created_user'];



			$data_new[] = $final;

		}



		$response= $this->GlobalModel->store_batch_data($this->_table,$data_new);



		$this->lib->response($response,$this->current_url,'store',$this->title);

	}



	// update data

	public function update($id)

	{
		$id = $this->encryption->decrypt(base64_decode($id));
		$this->lib->check_auth($this->id_current_url,'update');

		// $rules = $this->request->putRequest();

		// $this->lib->validation($rules,$this->current_url);



		$data = $this->lib->put_form();

		

		foreach($data['menu'] as $k => $m){
			$final = array();
			$where = array();

			$where['level_id'] = $id;

			$where['id_menu'] = $m;

			$final['created_access'] = $data['create'][$m] ?? 0;

			$final['updated_access'] = $data['update'][$m] ?? 0;

			$final['deleted_access'] = $data['delete'][$m] ?? 0;

			$final['read_access'] = $data['read'][$m] ?? 0;

			$final['exported_access'] = $data['export'][$m] ?? 0;

			$final['other_access'] = $data['other'][$m] ?? 0;

			$final['updated_date'] = $data['updated_date'];

			$final['updated_user'] = $data['updated_user'];

			$cekData = $this->GlobalModel->find_data($this->_table,$where)->row();

			if($cekData){
				$response= $this->GlobalModel->update_data($this->_table,$where ,$final);
			}else{
				$final['level_id'] = $id;
				$final['id_menu'] = $m;

				$response= $this->GlobalModel->store_data($this->_table,$final);
			}

			

		}

		$this->lib->response($response,$this->current_url,'update',$this->title);

	}



	// delete data

	public function delete($id)

	{	
		$id = $this->encryption->decrypt(base64_decode($id));

		$this->lib->check_auth($this->id_current_url,'delete');

		

		$substr = $this->title . ' (multiple by level)';



		$response= $this->GlobalModel->delete_data($this->_table,['level_id' => $id]);

		$this->lib->response($response,$this->current_url,'delete',$substr);

	}

}

