<?php



class AuthModel extends CI_Model

{

	private $_table = "dir_user";

	const SESSION_KEY = 'user_id';



	public function rules()

	{

		return [

			[

				'field' => 'username',

				'label' => 'Username',

				'rules' => 'required'

			],

			[

				'field' => 'password',

				'label' => 'Password',

				'rules' => 'required|max_length[255]'

			]

		];

	}



	public function login($username, $password)

	{

		$password = md5($password);

		$this->db->where('user_username', $username)

				->where('user_password', $password)

				->where('user_flag', 1);

		$this->db->select('id_user,user_username,user_nama,level_id');

		$query = $this->db->get($this->_table);

		$user = $query->row();

		// cek apakah user sudah terdaftar?

		if (!$user) {

			return FALSE;

		}

		$this->db->join('dir_menu as dm', 'dm.id_menu=dul.redirect_menu');

		$this->db->where('dul.level_id', $user->level_id);

		$access = $this->db->get('dir_user_level as dul')->row();

		// cek apakah passwordnya benar?

		$data = array(

			'id' => $user->id_user,

			'username' => $user->user_username,

			'nama' => $user->user_nama,

			'level' => $user->level_id,

			'nama_level' => $access->nama_level,

			'redirect_menu' => $access->link_menu,

		);	

		$this->_update_last_login($user->id_user);

		// bikin session

		$this->session->set_userdata($data);

		$this->session->set_userdata([self::SESSION_KEY => $user->id_user]);

		$menu = $this->get_menu($user->level_id);

		$this->session->set_userdata(['menu' => $menu]);

		return $this->session->has_userdata(self::SESSION_KEY);

	}



	public function _update_last_login($id) {

		$this->db->where('id_user', $id);

		return $this->db->update($this->_table, ['last_login' => date('Y-m-d h:i:s')]);

		$this->session->set_userdata(['last_login' => date('Y-m-d h:i:s')]);

	}



	public function logout()

	{

		$this->session->unset_userdata(self::SESSION_KEY);

		$data = array(

			'id',

			'username',

			'nama',

			'level',

			'layout_title',

			'layout_footer',

			'layout_logo_utama',

			'layout_logo_cadangan',

			'menu',

			'last_login',

		);	

		// bikin session

		$this->session->unset_userdata($data);

		return !$this->session->has_userdata(self::SESSION_KEY);

	}





	function get_menu($level){

		$this->db->join('dir_menu as dm', 'dm.id_menu=dam.id_menu');

		$this->db->join('dir_header_menu as dhm', 'dm.id_header_menu=dhm.id_header_menu');

		$this->db->select('dhm.id_header_menu,dhm.nama_header,dhm.order_by');

		$this->db->group_by('dhm.id_header_menu,dhm.nama_header,dhm.order_by');

		$this->db->where('dam.level_id', $level);

		$this->db->where('dam.read_access', 1);

		$this->db->where('dm.flag_menu', 1);

		$get_header = $this->db->get('dir_access_menu as dam')->result();



		$menu = [];

		foreach($get_header as $gh){

			$data_list = [];

			$list = [];



			$this->db->join('dir_menu as dmx', 'dmx.parent_menu=dm.id_menu');

			$this->db->join('dir_access_menu as dam', 'dmx.id_menu=dam.id_menu');

			$this->db->where('dm.id_header_menu', $gh->id_header_menu);

			$this->db->where('dm.group_menu', 1);

			$this->db->where('dam.level_id', $level);

			$this->db->where('dm.flag_menu', 1);

			$this->db->where('dmx.flag_menu', 1);

			$this->db->where('dam.read_access', 1);

			$this->db->select('dm.icon_menu,dm.nama_menu,dm.order_by,dm.id_menu');

			$this->db->group_by('dm.icon_menu,dm.nama_menu,dm.order_by,dm.id_menu');

			$group_menu = $this->db->get('dir_menu as dm')->result();

			

		



			foreach($group_menu as $gm){



				$this->db->join('dir_menu as dm', 'dm.id_menu=dam.id_menu');

				$this->db->join('dir_header_menu as dhm', 'dm.id_header_menu=dhm.id_header_menu');

				$this->db->where('dm.id_header_menu', $gh->id_header_menu);

				$this->db->where('dm.parent_menu',$gm->id_menu);

				$this->db->where('dam.level_id', $level);

				$this->db->where('dm.flag_menu', 1);

				$this->db->where('dam.read_access', 1);

				$this->db->select('dm.nama_menu,dm.icon_menu,dm.link_nama_menu,dm.link_menu,dm.order_by');

				$child_menu = $this->db->get('dir_access_menu as dam')->result();



				$link = [];

				$link_name = [];



				foreach($child_menu as $cm){

					$link[] = array(

						'menu'  => $cm->nama_menu,

						'link_name'  => $cm->link_nama_menu,

						'link' => base_url($cm->link_menu),

						'sort' => $cm->order_by

					);

					$link_name[] = $cm->link_nama_menu;



				}



				usort($link, function($a, $b) {

					return $a['sort'] <=> $b['sort'];

				});

				

				$data_list[] = [

					'icon'  =>  $gm->icon_menu,

					'menu'  => $gm->nama_menu,

					'type' => 'dropdown',

					'link_name'  => $link_name,

					'link' => $link,

					'sort' => $gm->order_by

				];

			}



			

			// cek single menu

			$this->db->join('dir_menu as dm', 'dm.id_menu=dam.id_menu');

			$this->db->join('dir_header_menu as dhm', 'dm.id_header_menu=dhm.id_header_menu');

			$this->db->where('dm.id_header_menu', $gh->id_header_menu);

			$this->db->where('dm.group_menu', 0);

			$this->db->where('dm.parent_menu', NULL);

			$this->db->where('dam.level_id', $level);

			$this->db->where('dm.flag_menu', 1);

			$this->db->where('dam.read_access', 1);

			$this->db->select('dm.nama_menu,dm.icon_menu,dm.link_nama_menu,dm.link_menu,dm.order_by');

			$single_menu = $this->db->get('dir_access_menu as dam')->result();



			foreach($single_menu as $sm){

				$data_list[] = array(

					'icon'  => $sm->icon_menu,

					'menu'  => $sm->nama_menu,

					'link_name'  => $sm->link_nama_menu,

					'type' => 'menu',

					'link' => base_url($sm->link_menu),

					'sort' => $sm->order_by

				);

			}

			usort($data_list, function($a, $b) {

				return $a['sort'] <=> $b['sort'];

			});

			$menu[] = array(

				'header' => $gh->nama_header,

				'list' =>$data_list,

				'sort' =>$gh->order_by,

			) ;

			

		}



		usort($menu, function($a, $b) {

			return $a['sort'] <=> $b['sort'];

		});



		return $menu;

	}

	

	

}