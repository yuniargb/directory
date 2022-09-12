<?php

class SettingModel extends CI_Model
{
	public function gantiPasswordRules()
	{
		$rules = [
			[
				'field' => 'password_lama',
				'label' => 'Password Lama',
				'rules' => 'required'
			],
			[
				'field' => 'password_baru',
				'label' => 'Password Baru',
				'rules' => 'required'
            ],
			[
				'field' => 'konfirmasi_password_baru',
				'label' => 'Konfirmasi Password Baru',
				'rules' => 'required|matches[password_baru]'
            ],
		];

		return $rules;
	}

	public function gantiLayoutRules()
	{
		$rules = [
			[
				'field' => 'title',
				'label' => 'Title',
				'rules' => 'required'
			],
			[
				'field' => 'footer',
				'label' => 'Footer',
				'rules' => 'required'
			]
		];

		return $rules;
	}

    public function ganti_password($data) {
		$this->db->where('id_user', $this->session->userdata('id'));
		return $this->db->update('dir_user', $data);
	}

    public function check_user($password){
        $this->db->where('id_user', $this->session->userdata('id'));
        $this->db->where('user_password', md5($password));
        return $this->db->get('dir_user')->row();
    }

    public function get_layout(){
        $this->db->where('id_setting', 1);
        return $this->db->get('dir_setting')->row();
    }

    public function ganti_layout($data) {
		$this->db->where('id_setting', 1);
		return $this->db->update('dir_setting', $data);
	}

    
}