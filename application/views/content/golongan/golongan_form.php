<!-- Modal -->

<div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="tambah-modalLabel"

    aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <form method="post" action="" id="data_form">

                <div class="modal-header  bg-primary py-5 text-white">

                    <h5 class="modal-title" id="form-modal-title">Modal title</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <?php  $this->load->view('content/alert') ?>
                    
                    <div class="form-group">

                        <label for="golongan_nama">Nama Golongan</label>

                        <input type="text" class="form-control" id="golongan_nama" name="golongan_nama">

                    </div>

                    <div class="form-group">

                        <label for="id_cabang">Cabang</label>

                        <select name="id_cabang" id="id_cabang" class="form-control">

                            <option value=""></option>

                            <?php foreach($cabang as $c) { ?>

                            <option value="<?= $c->id_cabang ?>"> <?= $c->cabang_nama ?></option>

                            <?php } ?>

                        </select>     

                    </div>

                    <div class="form-group">

                        <label for="golongan_umur">Golongan Umur</label>

                        <input type="text" class="form-control" id="golongan_umur" name="golongan_umur">

                    </div>

                    <div class="form-group">

                        <label for="golongan_kategori">Golongan Kategori</label>

                        <select name="golongan_kategori" id="golongan_kategori" class="form-control">

                            <option value=""></option>

                            <?php foreach($kategori as $c) { ?>

                            <option value="<?= $c->subkategori ?>"> <?= $c->subkategori ?></option>

                            <?php } ?>

                        </select>     

                    </div>

                    <div class="form-group">

                        <label for="golongan_urutan">Golongan Urutan</label>

                        <input type="text" class="form-control" id="golongan_urutan" name="golongan_urutan">

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Simpan</button>

                </div>

            </form>

        </div>

    </div>

</div>