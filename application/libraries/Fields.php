<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Fields {
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    function menuFields(){
        $arr = array(
            'table' => 'dir_menu',        
            'alias' => 'dm',        
            'primary_key' => 'id_menu',
            'column' => [
                [ 
                    'field' => 'nama_menu', 
                    'type' => 'varchar', 
                ]
            ]        
        );
    }
}