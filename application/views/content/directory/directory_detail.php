
<?php 
if($juara->juara_foto){
    $foto = base_url('/assets/'. $juara->juara_foto);
}else{
    $foto = base_url('/assets/img/background/user_not_found.png');
}
?>
<body class="layout-2 bg-white ">
            <nav class="navbar bg-primary navbar-expand-lg main-navbar w-100 px-5 py-1">
                <a class="navbar-brand" href="<?= base_url('/')?>">
                    <img class="logo float-left mr-3" width="50" height="50" src="<?php echo base_url('assets/'.Globals::layout('logo_1')); ?>" alt=""> 
                    <h6 class="display-6">Directory</h6>
                    <h6 class="display-5"><?= Globals::layout('title') ?></h6>
                </a>
            </nav>
            <div class="main-content w-100 px-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <img class="img-fluid" src="<?= $foto ?>" alt="Card image cap">
                        </div>
                        <div class="col-md-9">
                            <dl class="row">
                                <dt class="col-sm-3">Nama</dt>
                                <dd class="col-sm-9"><?= $juara->juara_nama ?? '-'?></dd>

                                <dt class="col-sm-3">Provinsi</dt>
                                <dd class="col-sm-9"><?= $juara->prov_nama ?? '-'?></dd>

                                <dt class="col-sm-3">Nomor Telepon</dt>
                                <dd class="col-sm-9"><?= $juara->juara_telp ?? '-'?></dd>

                                <dt class="col-sm-3">Nilai</dt>
                                <dd class="col-sm-9"><?= $juara->juara_nilai ?? '-'?></dd>

                                <dt class="col-sm-3">Juara</dt>
                                <dd class="col-sm-9"><?= $juara->juara_ke ?? '-'?></dd>

                                <dt class="col-sm-3">Event</dt>
                                <dd class="col-sm-9"><?= $juara->event_name ?? '-'?></dd>

                                <dt class="col-sm-3">Lokasi Event</dt>
                                <dd class="col-sm-9"><?= $juara->event_kota ?? '-' ?><?= $juara->event_provinsi ? ', ' . $juara->event_provinsi : '' ?></dd>

                                <dt class="col-sm-3">Cabang</dt>
                                <dd class="col-sm-9"><?= $juara->cabang_nama ?? '-'?></dd>

                                <dt class="col-sm-3">Golongan</dt>
                                <dd class="col-sm-9"><?= $juara->golongan_nama ?? '-'?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="container-fluid bg-primary py-5 text-white text-center mt-3 bg-image">
                    <img class="img-fluid rounded-circle  shadow mb-5" width="300" src="<?= base_url('/assets/'.$juara->foto_kategori) ?>" alt="Kategori">
                    <h3><?= $juara->nama_kategori . ' ' .$juara->subkategori ?></h3>
                </div>
                <?php if($video){ ?>
                <div class="container mt-3">
                    <h2 class="text-center my-5">Video</h2>
                    <?php if(!$video) {?>
                        <h3 class="text-center text-secondary"> Video tidak ditemukan</h3>
                    <?php } ?>
                    <ul>
                        <?php if($video){
                        foreach($video as $v) {
                            if($v->thumbnail){
                                $foto = base_url('/assets/'. $v->thumbnail);
                            }else{
                                $foto = base_url('/assets/img/background/user_not_found.png');
                            }
                        ?>
                        <li>
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-fluid mb-3" src="<?= $foto ?>" alt="Card image cap">
                                    <a href="<?= $v->link ?>" class="btn btn-primary text-center w-100" target="_blank">Lihat Video</a>
                                </div>
                                <div class="col-md-9">
                                    <dl class="row">
                                        <dt class="col-sm-3">Judul</dt>
                                        <dd class="col-sm-9"><?= $v->judul ?></dd>
                                        <dt class="col-sm-3">Deskripsi</dt>
                                        <dd class="col-sm-9"><?= $v->deskripsi ?></dd>
                                        <dt class="col-sm-3">Kategori</dt>
                                        <dd class="col-sm-9"><?= $v->nama_kategori ?></dd>
                                        <dt class="col-sm-3">Cabang</dt>
                                        <dd class="col-sm-9"><?= $v->cabang_nama ?></dd>
                                        <dt class="col-sm-3">Golongan</dt>
                                        <dd class="col-sm-9"><?= $v->golongan_nama ?></dd>
                                    </dl>
                                </div>
                            </div>
                            <hr>
                        </li>
                        <?php 
                            } 
                        }
                        ?>
                    </ul>
                </div>
                <?php } ?>
                <?php if( $juara->judul_file){ ?>
                <div class="container-fluid bg-primary py-5 text-white text-center">
                <img class="img-fluid rounded-circle shadow mb-5" width="300" src="<?= base_url('/assets/img/icon/pdf-circle.png') ?>" alt="Icon PDF">
                    <h3>Download File <?= $juara->judul_file ?></h3>
                    <a href="<?= base_url('assets/'.$juara->nama_file) ?>" target="_blank" class="btn btn-lg font-weight-bold text-uppercase btn-warning"><i class="fas fa-file-download"></i> Download</a>
                </div>
                <?php } ?>
            </div>

       