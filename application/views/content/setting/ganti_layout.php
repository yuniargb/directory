<?php if($access->updated_access &&  $access->read_access ){ ?>

<!-- Main Content -->

<div class="main-content">

    <section class="section">

        <div class="section-header">

            <h1><?= $title ?></h1>

        </div>



        <div class="section-body">



            <div class="card">

                <div class="card-header">

                    <h4>Ganti Layout</h4>

                </div>

                <div class="card-body">

                <?php  $this->load->view('content/alert') ?>

                <form method="post" action="<?= base_url('proses_setting') ?>" autocomplete="off" enctype="multipart/form-data">

                    <div class="form-group">

                        <label for="title">Title</label>

                        <input type="text" class="form-control" id="title" name="title" value="<?= $data->setting_title ?>">

                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="logo_1">Logo 1</label>
                                <!-- <input type="file" class="form-control" id="logo_1" name="logo_1"> -->
                                <div id="image-preview-1" class="image-preview" style="background-image:url(<?= base_url('assets/'.$data->setting_logo_utama) ?>); background-size:cover; background-position: center center;">
                                <label for="logo_1" id="image-label-1" class="image-label">Pilih File</label>
                                <input type="file" name="logo_1" id="logo_1" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="logo_2">Logo 2</label>
                            <!-- <input type="file" class="form-control" id="logo_2" name="logo_2"> -->
                            <div id="image-preview-2" class="image-preview" style="background-image:url(<?= base_url('assets/'.$data->setting_logo_cadangan) ?>); background-size:cover; background-position: center center;">
                            <label for="logo_2" id="image-label-2" class="image-label">Pilih File</label>
                            <input type="file" name="logo_2" id="logo_2" />
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="footer">Footer</label>

                        <input type="text" class="form-control" id="footer" name="footer" value="<?= $data->setting_footer ?>">

                    </div>

                    <button type="reset" class="btn btn-secondary" >Reset</button>

                    <button type="submit" class="btn btn-primary">Simpan</button>

                </div>

                <div class="card-footer bg-whitesmoke">

                 <?= Globals::layout('footer'); ?>

                </div>

            </div>

        </div>

    </section>

</div>

<?php } ?>