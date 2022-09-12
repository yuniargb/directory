<div class="container py-5">
    <h3 class=""> Pencarian: <b><?= $nama ?></b></h3>
    <hr>
    <?php if(!$juara && !$video && !$file) {?>
        <h3 class="text-center"> Data tidak ditemukan</h3>
    <?php } ?>
    <?php if($subkategori){?>
        <select name="subkategori" id="f_subkategori" class="form-control col-md-3 mb-3">
            <option value="all">Semua</option>
            <?php foreach($subkategori as $k) { ?>
            <option value="<?= $k->subkategori ?>"><?= $k->subkategori ?></option>
            <?php } ?>
        </select>
    <?php } ?>
    <div class="row" id="table-1">
        <?php if($juara){?>
        <?php foreach($juara as $j) {?>
        <?php 
        if($j->juara_foto){
            $foto = base_url('/assets/'. $j->juara_foto);
        }else{
            $foto = base_url('/assets/img/background/user_not_found.png');
        }
        ?>
        <div class="col-6 col-md-3 pag-data" data-subkategori="<?= $j->subkategori ?>">
            <div class="card card-result">
                <img class="card-img-top" src="<?= $foto ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $j->juara_nama ?></h5>
                    <span class="badge badge-pill badge-secondary"><?= $j->nama_kategori ?></span>
                    <span class="badge badge-pill badge-light"><?= $j->subkategori ?></span>
                </div>
                <div class="card-footer text-center">
                <a href="<?= base_url('detail_juara/'.base64_encode($this->encryption->encrypt($j->id_juara)))?>" target="_blank" class="btn btn-primary ">Lihat Detail</a>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php }?>

        <?php if($video){?>
        <?php foreach($video as $v) {?>
        <?php 
        if($v->thumbnail){
            $foto = base_url('/assets/'. $v->thumbnail);
        }else{
            $foto = base_url('/assets/img/background/video_not_found.jpg');
        }

        $jumlah_karakter    =strlen($v->deskripsi);

        if($jumlah_karakter > 50 ){
            $deskripsi = substr($v->deskripsi,0,50) . '<span id="read_'.$v->id_video.'">...</span><a href="#" class="readmore" data-show="0" data-target="#read_'.$v->id_video.'" data-next="'.substr($v->deskripsi,50).'">read more</a>' ;
        }else{
            $deskripsi = $v->deskripsi;
        }
        ?>
        <div class="col-6 col-md-3 pag-data"  data-subkategori="<?= $v->subkategori ?>">
            <div class="card card-result">
                <img class="card-img-top" src="<?= $foto ?>" alt="Image Not found">
                <div class="card-body">
                    <h5 class="card-title"><?= $v->judul ?></h5>
                    <p class="card-text text-justify"><?= $deskripsi ?></p>
                </div>
                <div class="card-footer text-center">
                <a href="<?= $v->link ?>" class="btn btn-primary " target="_blank">Lihat Video</a>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php }?>

        <?php if($file){?>
        <?php foreach($file as $v) {?>
        <div class="col-6 col-md-3 pag-data">
            <div class="card card-result">
                <img class="card-img-top" src="<?= base_url('/assets/img/icon/file-3.png') ?>" alt="File">
                <div class="card-body">
                    <h5 class="card-title"><?= $v->judul_file ?></h5>
                    <p class="card-text text-justify"><?= $v->event_name ?></p>
                </div>
                <div class="card-footer text-center">
                <a href="<?= base_url('assets/'.$v->nama_file) ?>" class="btn btn-primary " target="_blank">Download File</a>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php }?>
        
    </div>

    <nav class="m-auto" id="pagination_directory">
        <ul class="pagination justify-content-center pagination-sm">
        </ul>
    </nav>
</div>

