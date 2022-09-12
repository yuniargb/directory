<!-- Modal -->

<div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="tambah-modalLabel"

    aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <form method="post" action="" id="data_form">

                <div class="modal-header bg-primary py-5 text-white">

                    <h5 class="modal-title" id="form-modal-title">Modal title</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <?php  $this->load->view('content/alert') ?>

                    <div class="form-group">

                        <label for="event_tahun">Tahun Event</label>

                        <input type="text" class="form-control" id="event_tahun" name="event_tahun">

                    </div>

                    <div class="form-group">

                        <label for="event_name">Nama Event</label>

                        <input type="text" class="form-control" id="event_name" name="event_name">

                    </div>

                    <div class="row">

                        <div class="col-6">

                            <div class="form-group">

                                <label for="event_provinsi">Provinsi</label>

                                <select name="event_provinsi" id="event_provinsi" class="form-control">

                                    <option value=""></option>

                                    <?php foreach($provinsi as $p) { ?>

                                    <option value="<?= $p->prov_nama ?>" data-id="<?= $p->prov_id ?>"> <?= $p->prov_nama ?></option>

                                    <?php } ?>

                                </select>     

                            </div>

                        </div>

                        <div class="col-6">

                            <div class="form-group">

                                <label for="event_kota">Kota</label>

                                <select name="event_kota" id="event_kota" class="form-control">

                                    <option value=""></option>

                                    <?php foreach($kabkota as $k) { ?>

                                    <option data-provinsi="<?= $k->prov_id ?>" value="<?= $k->kabkota_nama ?>" > <?= $k->kabkota_nama ?></option>

                                    <?php } ?>

                                </select>     

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="event_kategori">Kategori</label>

                        <select name="event_kategori" id="event_kategori" class="form-control">

                            <option value=""></option>

                            <?php foreach($kategori as $kt) { ?>

                            <option value="<?= $kt->nama_kategori ?>"> <?= $kt->nama_kategori ?></option>

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