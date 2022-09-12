<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>Ganti Password</h4>
                </div>
                <div class="card-body">
                <?php  $this->load->view('content/alert') ?>
                <form method="post" action="<?= base_url('ganti_password') ?>" autocomplete="off">
                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" class="form-control" id="password_lama" name="password_lama">
                    </div>
                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" class="form-control" id="password_baru" name="password_baru">
                    </div>
                    <div class="form-group">
                        <label for="konfirmasi_password_baru">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="konfirmasi_password_baru" name="konfirmasi_password_baru">
                    </div>
                    <button type="reset" class="btn btn-secondary" >Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <div class="card-footer bg-whitesmoke">
                    <?= Globals::layout('footer') ?>
                </div>
            </div>
        </div>
    </section>
</div>