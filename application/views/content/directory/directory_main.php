

<body class="layout-2 bg-light">
    <nav class="navbar navbar-light w-100 bg-transparent m-0 mb-0 float-left px-5">
        <a class="navbar-brand" href="<?= base_url('/')?>">
            <img class="logo float-left mr-3" width="50" height="50" src="<?php echo base_url('assets/'.Globals::layout('logo_1')); ?>" alt=""> 
            <h6 class="display-6">Dikrektori</h6>
            <h6 class="display-5"><?= Globals::layout('title') ?></h6>
        </a>
    </nav>
    <div class="jumbotron bg-primary jumbotron-fluid ">
        <div class="card w-75 m-auto rounded shadow-lg">
            <div class="card-body py-5 px-0">
                <!-- <h5 class=" text-center">Cari Data</h5>
                <hr class="my-4"> -->
                <div class="container">
                    <form action="<?= base_url('find_data')?>" method="post" id="find-directory-form" autocomplete="off">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" id="csrf_token" value="<?= $this->security->get_csrf_hash();?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="f_judul" class="pl-4">Nama</label>
                                    <input class="form-control px-4 shadow" id="f_judul" type="text" placeholder="cari nama / judul ...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="f_type" class="pl-4">Type</label>
                                    <select name="fields" id="f_type" class="form-control px-4  shadow">
                                        <option value="all">Semua</option>
                                        <option value="juara">Juara</option>
                                        <option value="video">Video</option>
                                        <option value="file">File</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="f_event" class="pl-4">Event</label>
                                    <select name="fields" id="f_event" class="form-control px-4  shadow">
                                        <option value="all">Semua</option>
                                        <?php foreach($event as $e) { ?>
                                        <option value="<?= $e->id_event ?>"><?= $e->event_name ?> <?= $e->event_kota ?> <?= $e->event_tahun ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <label for="f_kategori" class="h-5">Kategori</label>
                           <div class="row ">
                                <?php foreach($kategori as $k) { ?>
                                <div class="col-md-3 col-6 radio-uncheck">
                                <label class="radio-img mx-2">
                                    <input type="radio" id="f_kategori" name="kategori" class="d-none radio-image" value="<?= $k->id_kategori ?>" />
                                    <div class="image image-radio p-0 ">
                                        <img class="img-fluid  rounded-circle shadow" width="80"  src="<?= base_url('/assets/'.$k->foto_kategori) ?>" alt="<?= $k->id_kategori ?>"> 
                                    </div>
                                    <p><?= $k->nama_kategori ?></p>
                                </label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <button class="btn btn-primary  w-100 shadow" id="submit_directory" type="submit"><i class="fas fa-search"></i> Cari</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="directory-result"></div>
    

       