<?php



class DirectoryModel extends CI_Model

{
    public function get_juara($name = null,$event = null,$id = null,$kategori = null){

		$this->db->join('dir_event de', 'de.id_event=dj.id_event','left');
        $this->db->join('dir_cabang dc', 'dc.id_cabang=dj.id_cabang','left');
		$this->db->join('dir_golongan dg', 'dg.id_golongan=dj.id_golongan','left');
		$this->db->join('dir_provinsi dp', 'dp.prov_id=dj.juara_provinsi','left');
		$this->db->join('dir_kategori dk', 'dk.id_kategori=dj.id_kategori','left');
		$this->db->join('dir_subkategori dsk', 'dsk.id_subkategori=dj.id_subkategori','left');
        $this->db->join('dir_file df', 'df.id_event=de.id_event','left');

        if($name != null){
            $newName = explode(" ", $name);
            $newSearch = [];
            $i = 0;
            while($i < count($newName)){
                if($newName[$i] != null){
                    if($i == 0){
                        $this->db->like('juara_nama', $newName[$i], 'both'); 
                    }else{
                        $this->db->or_like('juara_nama', $newName[$i], 'both'); 
                    }
                } 
               
                $i++;
            }
           
        }
        if($event != null){
            $this->db->where('de.id_event', $event); 
        }
        if($id != null){
            $this->db->where('dj.id_juara', $id); 
        }
        if($kategori != null){
            $this->db->where('dj.id_kategori', $kategori); 
        }
        $this->db->select('dj.juara_nama,dj.id_juara,de.event_name,de.event_tahun,de.event_provinsi,de.event_kota,dj.juara_ke,
        dj.juara_foto,dc.cabang_nama,dg.golongan_nama,dj.juara_nilai,dj.juara_telp,dp.prov_nama,
        dk.nama_kategori,dk.foto_kategori,dsk.subkategori,df.judul_file,df.nama_file'); 
        return $sql = $this->db->get('dir_juara as dj');

	}	
    public function get_video($name = null,$id = null, $kategori = null,$event = null){
        if($name != null){
            $newName = explode(" ", $name);
            $newSearch = [];
            $i = 0;
           
            while($i < count($newName)){
                if($newName[$i] != null){
                    if($i == 0){
                        $this->db->like('dv.judul', $newName[$i], 'both'); 
                    }else{
                        $this->db->or_like('dv.judul', $newName[$i], 'both'); 
                    }
                }
                $i++;
            }
        }
        if($id != null){
            $this->db->where('dv.id_juara', $id); 
        }
        if($kategori != null){
            $this->db->where('dv.id_kategori', $kategori); 
        }

        if($event != null){
            $this->db->where('dj.id_event', $event);
        }
        $this->db->join('dir_cabang dc', 'dc.id_cabang=dv.id_cabang','left');
		$this->db->join('dir_golongan dg', 'dg.id_golongan=dv.id_golongan','left');
		$this->db->join('dir_kategori dk', 'dk.id_kategori=dv.id_kategori','left');
        $this->db->join('dir_subkategori dsk', 'dsk.id_subkategori=dv.id_subkategori','left');
        $this->db->join('dir_juara dj', 'dj.id_juara=dv.id_juara');
        $this->db->select('dv.judul,dv.deskripsi,dv.thumbnail,dv.link,dv.id_video,dc.cabang_nama,dg.golongan_nama,dk.nama_kategori,dsk.subkategori'); 
        return $sql = $this->db->get('dir_video as dv');
	}	

    public function get_file($name = null,$event = null){
        if($name != null){
            $newName = explode(" ", $name);
            $newSearch = [];
            $i = 0;
            while($i < count($newName)){
                if($newName[$i] != null){
                    if($i == 0){
                        $this->db->like('df.judul_file', $newName[$i], 'both'); 
                    }else{
                        $this->db->or_like('df.judul_file', $newName[$i], 'both'); 
                    }
                }
                $i++;
            }
        }
        if($event != null){
            $this->db->where('de.id_event', $event); 
        }
        $this->db->join('dir_event de', 'de.id_event=df.id_event','left');
        $this->db->select('df.judul_file,df.nama_file,de.event_name'); 
        return $sql = $this->db->get('dir_file as df');
	}	

}