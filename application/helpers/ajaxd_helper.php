<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



// Application specific global variables

class Ajaxd

{
    public static function btnAccess($access,$title,$field,$key,$url,$other = false){
        $CI = get_instance();
        $btn = '-';
        if($access->updated_access || $access->deleted_access || $access->other_access ){ 
            $btn = '
             <div class="btn-group" role="group" aria-label="Basic example">
            ';

            if($access->other_access && $other){ 
                $btn .= '
                <button class="btn btn-warning btn-sm btn-detail" data-toggle="modal" data-target="#detail-modal"
                    data-title="Detail '. $title .'" 
                    data-field="'. htmlspecialchars(json_encode($field), ENT_QUOTES, 'UTF-8')  .'">
                    <i class="fas fa-eye"></i> Detail
                </button>';
            }

            if($access->updated_access ){ 
                $btn .= '
                <button class="btn btn-info btn-sm btn-edit" data-toggle="modal" data-target="#form-modal"
                    data-title="Edit '. $title .'" 
                    data-field="'. htmlspecialchars(json_encode($field), ENT_QUOTES, 'UTF-8')  .'"
                    data-action="'. base_url($url. '/update/'.base64_encode($CI->encryption->encrypt($key))) .'">
                    <i class="fas fa-edit"></i> Edit
                </button>';
            }

            if($access->deleted_access ){ 
                $btn .= '
                <button class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#delete-modal"
                    data-title="Hapus '. $title .'" 
                    data-field="'. htmlspecialchars(json_encode($field), ENT_QUOTES, 'UTF-8')  .'"
                    data-action="'. base_url($url. '/delete/'.base64_encode($CI->encryption->encrypt($key))) .'">
                    <i class="fas fa-trash"></i> Hapus
                </button>';
            }

            $btn .= '
             </div>
            ';
            return $btn;
        }
    }
    public static function fotoBtn($foto){
        if($foto) { 
            $btn = '<button class="btn btn-secondary btn-sm btn-image" data-toggle="modal" data-target="#image-modal"
                    data-image="'. base_url('assets/'.$foto) .'">
                    <i class="fas fa-eye"></i> Tampil
            </button>';
        }else{ 
            $btn =  '-'; 
        } 
        return $btn;
    }
    public static function outputAjax($data,$record,$filter){
        return array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $record,
            "recordsFiltered" => $filter,
            "data" => $data,
        );
    }

    public static function filterData($column_search,$order = null,$column_order){
        $CI = get_instance();
        $i = 0;
		
        foreach ($column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if($i===0) // looping awal
                {
                    $CI->db->group_start(); 
                    $CI->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $CI->db->or_like($item, $_POST['search']['value']);
                }
                if(count($column_search) - 1 == $i) 
                    $CI->db->group_end(); 
            }
           
            
            $i++;
        }
        if(count($_POST['columns']) > 0){
            foreach($_POST['columns'] as $i => $col){
                if($col['search']['value']){
                    $CI->db->like($column_order[$i], $col['search']['value']);
                }
            }
        }
        if(isset($_POST['order'])) 
        {
            $CI->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if($order)
        {
            $CI->db->order_by(key($order), $order[key($order)]);
        }
    }
}

