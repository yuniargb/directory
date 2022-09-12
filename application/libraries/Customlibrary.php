<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class CustomLibrary {

    protected $CI;



    public function __construct()

    {

        $this->CI =& get_instance();

    }



    function check_auth($id_link,$action){

       

        if(!$this->CI->session->userdata('id')){

			redirect('403_override');

		}else{



            $this->CI->load->model('GlobalModel');

            $where['id_menu'] = $id_link;

            $where['level_id'] = $this->CI->session->userdata('level');



            if($action == 'read') $where['read_access'] = 1;

            if($action == 'create') $where['created_access'] = 1;

            if($action == 'update') $where['updated_access'] = 1;

            if($action == 'delete') $where['deleted_access'] = 1;

            if($action == 'other') $where['other_access'] = 1;



            $cek = $this->CI->GlobalModel->find_data('dir_access_menu',$where)->row();



            if(!$cek){

                redirect('403_override');

            }

            if($action == 'create' || $action == 'update'){
                $this->CI->session->set_flashdata('action', $action);
                $this->CI->session->set_flashdata('before_url', base_url(uri_string()));
            } 

		}

    }

    function views($views,$data) {

        $this->CI->load->view('dist/_partials/header',$data);

        $this->CI->load->view($views,$data);

        $this->CI->load->view('dist/_partials/js',$data);

    }
    function views_directory($views,$data) {

        $this->CI->load->view('directory/header',$data);

        $this->CI->load->view($views,$data);

        $this->CI->load->view('directory/footer',$data);

    }



    function post_form() {



        $post_data = $this->CI->input->post();

        foreach($post_data as $i => $pd){

            $data[$i] = $pd;

        }

        $data['created_user'] = $this->CI->session->userdata('id');

        $data['created_date'] = date('Y-m-d h:i:s');

        return $data;

    }

    function put_form() {



        $post_data = $this->CI->input->post();

        foreach($post_data as $i => $pd){

            $data[$i] = $pd;

        }

        $data['updated_user'] = $this->CI->session->userdata('id');

        $data['updated_date'] = date('Y-m-d h:i:s');

        return $data;

    }

    function validation($rules,$_redirect) {



        $message = Globals::messageValidation();

		$this->CI->form_validation->set_rules($rules);

		$this->CI->form_validation->set_message($message);

        $post_data = $this->CI->input->post();
        $form_error = [];
        foreach($post_data as $i => $pd){
            $form_error[$i] = $pd;
        }
		
        $this->CI->session->set_flashdata('field_error', $form_error);
		if($this->CI->form_validation->run() == FALSE){

			$this->CI->session->set_flashdata('error', validation_errors());

			redirect($_redirect);

		}

    }

    function response($response,$_redirect,$act,$title) {



        if($act == 'store'){

            $alert = 'Ditambahkan!';

            $log = 'Menambahkan Data '. $title;

        }else if($act == 'update'){

            $alert = 'Diubah!';

            $log = 'Mengubah Data '. $title;

        }else if($act == 'delete'){

            $alert = 'Dihapus!';

            $log = 'Menghapus Data '. $title;

        }else if($act == 'reset'){

            $alert = 'Reset!';

            $log = 'Reset Data '. $title;

        }else{

            $alert = 'Tidak diketahui!';

            $log = 'Akses tidak diketahui dari '. $title;

        }



        if($response==true){

			$this->CI->session->set_flashdata('success','Data Berhasil '. $alert);

            $this->log_task($log);

			redirect($_redirect);

		}else{

			$this->CI->session->set_flashdata('error','Data Gagal '. $alert);

			redirect($_redirect);

		}

    }

    function response_import($filter_data,$_redirect,$table) {

        if(count($filter_data['data']) > 0){

            $this->CI->db->insert_batch($table,$filter_data['data']);

            $this->log_task('import multiple data '.$table);

			$this->CI->session->set_flashdata('success',$filter_data['alert_success']);

            

		}

		$this->CI->session->set_flashdata('error',$filter_data['alert_failed']);



		redirect($_redirect);

    }



    function import_excel($fields){

        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');



		if(isset($_FILES['import']['name']) && in_array($_FILES['import']['type'], $file_mimes)) {

			$arr_file = explode('.', $_FILES['import']['name']);

			$extension = end($arr_file);

            

            if($extension == 'xlsx'){

                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();



                $spreadsheet = $reader->load($_FILES['import']['tmp_name']);

                $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                

                // array Count

                $arrayCount = count($sheetData);

                $SheetDataKey = array();

                foreach ($sheetData as $dataInSheet) {

                    foreach ($dataInSheet as $key => $value) {

                        if (in_array(trim($value), $fields)) {

                            $value = preg_replace('/\s+/', '', $value);

                            $SheetDataKey[trim($value)] = $key;

                        } 

                    }

                }

                

                for ($i = 2; $i <= $arrayCount; $i++) {

                    $data_temp = [];

                    foreach($SheetDataKey as $x => $sdk){

                        if($x == 'mushaf'){

                            $data_temp[$x] = 'img/mushaf/'.filter_var(trim($sheetData[$i][$SheetDataKey[$x]]), FILTER_SANITIZE_STRING);

                        }else if($x == 'file_pdf'){

                            $data_temp[$x] = 'pdf/paket/'.filter_var(trim($sheetData[$i][$SheetDataKey[$x]]), FILTER_SANITIZE_STRING);

                        }else{

                            $data_temp[$x] = filter_var(trim($sheetData[$i][$SheetDataKey[$x]]), FILTER_SANITIZE_STRING);

                        }

                    }



                    $data_temp['created_user'] = $this->CI->session->userdata('id');

                    $data_temp['created_date'] = date('Y-m-d h:i:s');

                    

                    $fetchData[] = $data_temp;

                }   

                return $fetchData;

            }

		}

        return false;

    }





    function filter_array($filter,$fields,$data,$table){

        

		$dataSuccess=[];

		$dataFailed=[];

        $alert_failed = null;

        $alert_success = null;



        

        foreach($fields as $f){

            if(!array_key_exists($f,$data[0])){

                $check_key[] = 0;

                $key_alert[] = 'Kolom '. $f .' tidak dapat ditemukan!';

            }else{

                $check_key[] = 1;

            }

        }   



        

        if(!in_array(0,$check_key)){

            foreach($data as $i => $d){

                $baris = $i + 1;

                $check = false;

                foreach($filter as $x => $f){

                    if(!empty($d[$f])){

                        if($d[$f] != ''){

                            $this->CI->db->or_where($f, $d[$f]);

                            $check = true;

                        }

                    }

                }

                if($check){

                    $check = $this->CI->db->get($table)->row();

                }

    

                if($check){

                    $dataFailed[] = 'Baris ke-'. $baris .' Duplikat data, Data gagal diinput!';

                }else{

                    $dataSuccess[] = $d;

                }

            }    

            if(count($dataFailed) > 0) {

                $messg = implode(" </br>",$dataFailed);

                $alert_failed =  count($dataFailed) . ' Data Gagal Ditambahkan </br>' .$messg;

            }

            if(count($dataSuccess) > 0) {

                $alert_success =  count($dataSuccess) . ' Data Berhasil Ditambahkan!';

            }

        }else{

            $messg = implode(" </br>",$key_alert);

            $alert_failed =  'Data Gagal Ditambahkan! </br>' .$messg;

        }

		



        return array(

            'data' => $dataSuccess,

            'alert_success' => $alert_success,

            'alert_failed' => $alert_failed,

        );



    }



    function export_dummy($col,$row,$filename){

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $chr = range('A', 'Z');



        // Buat header tabel 

        foreach($col as $i => $c){

            $sheet->setCellValue($chr[$i].'1', $c);

        }

        $numrow = 2; 

        foreach($row as $d){

            foreach($d as $i => $x){

                $sheet->setCellValue($chr[$i].$numrow, $x);

            }

            $numrow++;

        }



        // Set orientasi kertas jadi LANDSCAPE

        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        $filenames = 'dummy_'.$filename.'_'.date('hisdmY').'.xlsx';

        // Proses file excel

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        header('Content-Disposition: attachment; filename="'.$filenames.'"'); // Set nama file excel nya

        header('Cache-Control: max-age=0');



        $writer = new Xlsx($spreadsheet);

        $writer->save('php://output');

    }



    function log_task($task) {

        $this->CI->load->model('LogModel');

       

        $data = array(

            'Task' =>  $task,

            'UserID' =>  $this->CI->session->userdata('id'),

            'DateTime' =>  date('Y-m-d h:i:s'),

            'IP' => $this->getUserIP(),

        );

        $this->CI->LogModel->store_data($data);

    }





    function getUserIP() {

        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;

        

        return $ipaddress;

    }



    function validation_image_potrait($name,$to){

        list($width, $height) = getimagesize($_FILES[$name]["tmp_name"]);

			if ($width > $height) {

				$this->CI->session->set_flashdata('error', "Hanya menerima gambar potrait");

                redirect($to);

			} else {

				return true;

			}



        

    }



    function import_image($name,$path){

        $config['upload_path'] = './assets/'.$path;

        $config['allowed_types'] = 'jpeg|jpg|png';

        $config['max_size'] = 10000;

        $ext = pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);

        $new_name = time().".".$ext;

        $config['file_name'] = $new_name;

     

        $this->CI->load->library('upload', $config);

        // Alternately you can set
        $this->CI->upload->initialize($config);  

        if (!$this->CI->upload->do_upload($name)) {

            $this->CI->session->set_flashdata('error',$this->CI->upload->display_errors());

            return false;

        } else {

            return $path.'/'.$new_name;

        }

    }



    function import_image_multiple($name,$path){



        $config['upload_path'] = './assets/'.$path;

        $config['allowed_types'] = 'jpeg|jpg|png';

        $config['max_size'] = 10000;



        $this->CI->load->library('upload', $config);

        

        $total =  count($_FILES[$name]['name']);

        

        $sukses = array();

        $gagal = array();

        $files = $_FILES;



        for($i=0; $i<$total; $i++){ 

            $_FILES[$name]['name']= $files[$name]['name'][$i];

            $_FILES[$name]['type']= $files[$name]['type'][$i];

            $_FILES[$name]['tmp_name']= $files[$name]['tmp_name'][$i];

            $_FILES[$name]['error']= $files[$name]['error'][$i];

            $_FILES[$name]['size']= $files[$name]['size'][$i];  

            

            if (!$this->CI->upload->do_upload($name)) {

                $gagal[] = $this->CI->upload->data('orig_name') .' '.$this->CI->upload->display_errors();

                

            } else {

                $sukses[] = $this->CI->upload->data('orig_name') . ' berhasil diupload!';

            }

        }



        return array(

            'sukses' => implode(' </br>',$sukses),

            'gagal' => implode(' </br>', $gagal),

        );

    }



    function import_pdf($name,$path){

        $config['upload_path'] = './assets/'.$path;

        $config['allowed_types'] = 'pdf';

        $config['max_size'] = 10000;

        $ext = pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);

        $new_name = time().".".$ext;

        $config['file_name'] = $new_name;



         $this->CI->load->library('upload', $config);



        if (!$this->CI->upload->do_upload($name)) {

            $this->CI->session->set_flashdata('error',$this->CI->upload->display_errors());

            return false;

        } else {

            return $path.'/'.$new_name;

        }

    }



    function import_pdf_multiple($name,$path){



        $config['upload_path'] = './assets/'.$path;

        $config['allowed_types'] = 'pdf';

        $config['max_size'] = 20000;



        $this->CI->load->library('upload', $config);

        

        $total =  count($_FILES[$name]['name']);

        

        $sukses = array();

        $gagal = array();

        $files = $_FILES;



        for($i=0; $i<$total; $i++){ 

            $_FILES[$name]['name']= $files[$name]['name'][$i];

            $_FILES[$name]['type']= $files[$name]['type'][$i];

            $_FILES[$name]['tmp_name']= $files[$name]['tmp_name'][$i];

            $_FILES[$name]['error']= $files[$name]['error'][$i];

            $_FILES[$name]['size']= $files[$name]['size'][$i];  

            

            if (!$this->CI->upload->do_upload($name)) {

                $gagal[] = $this->CI->upload->data('orig_name') .' '.$this->CI->upload->display_errors();

                

            } else {

                $sukses[] = $this->CI->upload->data('orig_name') . ' berhasil diupload!';

            }

        }



        return array(

            'sukses' => implode(' </br>',$sukses),

            'gagal' => implode(' </br>', $gagal),

        );

    }

}