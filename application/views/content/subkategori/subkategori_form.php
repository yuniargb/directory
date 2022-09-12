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

                        <label for="subkategori">Subkategori</label>

                        <input type="text" class="form-control" id="subkategori" name="subkategori">

                    </div>

                    <div class="form-group">

                        <label for="id_kategori">Kategori</label>

                        <select name="id_kategori" id="id_kategori" class="form-control">

                            <option value=""></option>

                            <?php foreach($kategori as $k) { ?>

                            <option value="<?= $k->id_kategori ?>"> <?= $k->nama_kategori ?></option>

                            <?php } ?>

                        </select>     

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