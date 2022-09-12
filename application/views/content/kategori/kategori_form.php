<!-- Modal -->

<div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="tambah-modalLabel"

    aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <form method="post" action="" id="data_form" enctype="multipart/form-data">

                <div class="modal-header  bg-primary py-5 text-white">

                    <h5 class="modal-title" id="form-modal-title">Modal title</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">
                    <?php  $this->load->view('content/alert') ?>
                    <div class="form-group">

                        <label for="nama_kategori">Kategori</label>

                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori">

                    </div>

                    <div class="form-group">

                        <label for="foto_kategori">Foto Icon</label>

                        <input type="file" class="form-control" id="foto_kategori" name="foto_kategori">

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