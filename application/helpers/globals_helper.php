<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



// Application specific global variables

class Globals

{

    

    

    public static function messageValidation(){

        $message = array(

			'required' => '%s wajib diisi',

			'is_unique' => '%s sudah pernah diinput',

			'numeric' => '%s hanya diperbolehkan angka',

			'matches' => 'password baru dan konfirmasi password baru tidak sesuai',

			'_min_selection' => '%s minimal %s pilihan',

			'_max_selection' => '%s maksimal %s pilihan',

			'greater_than_equal_to' => 'minimal %s lebih besar atau sama dengan %s',

			'less_than_equal_to' => 'maksimal %s lebih kecil atau sama dengan %s',

		);



        return $message;

    }



    



    public static function layout($param){

        $CI = get_instance();

        $cek =$CI->session->userdata('layout_title');



        if(!$cek){

            $CI->load->model('SettingModel');

            $layout = $CI->SettingModel->get_layout();

           

            $data = array(

                'layout_title' => $layout->setting_title,

                'layout_footer' => $layout->setting_footer,

                'layout_logo_utama' =>  $layout->setting_logo_utama,

                'layout_logo_cadangan' => $layout->setting_logo_cadangan,

            );	

            // bikin session

            $CI->session->set_userdata($data);

        }

        

        $data['title']  =  $CI->session->userdata('layout_title');

        $data['footer'] = $CI->session->userdata('layout_footer');

        $data['logo_1'] = $CI->session->userdata('layout_logo_utama');

        $data['logo_2'] = $CI->session->userdata('layout_logo_cadangan');

        

        return $data[$param];

    }



    public static function sidebarMenu()

    {

        $CI = get_instance();
        $menu = $CI->session->userdata('menu');

        return $menu;

    }

}

