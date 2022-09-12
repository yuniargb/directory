<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><?= $title ?> Data</h4>
                    <div class="card-header-form">
                        <?php if($access->created_access && $this->session->userdata('level') == 1){ ?>
                            <button class="btn btn-primary btn-tambah" data-toggle="modal" data-target="#form-modal"
                                data-title="Tambah <?= $title ?>" data-action="<?= base_url('menu/tambah') ?>"><i class="fas fa-plus"></i> Tambah Data</button>
                        <?php } ?> 
                    </div>
                </div>
                <div class="card-body">
                    <?php  $this->load->view('content/alert') ?>
                    <?php if($access->read_access ){ ?>
                    <?php  $this->load->view('content/menu/menu_data') ?>
                    <?php } ?> 
                </div>
                <div class="card-footer bg-whitesmoke">
                    <?= Globals::layout('footer') ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php  $this->load->view('content/menu/menu_form') ?>
<?php  $this->load->view('content/delete_modal') ?>
<?php  $this->load->view('content/import_modal') ?>