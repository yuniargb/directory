<!-- Modal -->

<div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="tambah-modalLabel"

    aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">

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

                        <label for="juara_nama">Nama Juara</label>

                        <input type="text" class="form-control" id="juara_nama" name="juara_nama">

                    </div>

                    <div class="row">

                        <div class="col-6">

                            <div class="form-group">

                                <label for="juara_ke">Juara Ke</label>

                                <input type="text" class="form-control" id="juara_ke" name="juara_ke">

                            </div>

                        </div>

                        <div class="col-6">

                            <div class="form-group">

                                <label for="juara_nilai">Nilai Juara</label>

                                <input type="text" class="form-control" id="juara_nilai" name="juara_nilai">

                            </div>

                        </div>


                        <div class="col-6">

                            <div class="form-group">

                                <label for="juara_provinsi">Provinsi</label>

                                <select name="juara_provinsi" id="juara_provinsi" class="form-control">

                                    <option value=""></option>

                                    <?php foreach($provinsi as $prv) { ?>

                                    <option value="<?= $prv->prov_id ?>"> <?= $prv->prov_nama ?></option>

                                    <?php } ?>

                                </select>     

                            </div>

                        </div>

                        <div class="col-6">

                            <div class="form-group">

                                <label for="juara_telp">Nomor Telepon</label>

                                <input type="text" class="form-control" id="juara_telp" name="juara_telp">

                            </div>

                        </div>

                        <div class="col-12">

                            <div class="form-group">

                                <label for="id_event">Event</label>

                                <select name="id_event" id="id_event" class="form-control">

                                    <option value=""></option>

                                    <?php foreach($event as $ev) { ?>

                                    <option value="<?= $ev->id_event ?>"> <?= $ev->event_name ?> <?= $ev->event_tahun ?> <?= $ev->event_kota ?></option>

                                    <?php } ?>

                                </select>     

                            </div>

                        </div>


                        <div class="col-6">

                            <div class="form-group">

                                <label for="id_cabang">Cabang</label>

                                <select name="id_cabang" id="id_cabang" class="form-control">

                                    <option value=""></option>

                                    <?php foreach($cabang as $cb) { ?>

                                    <option value="<?= $cb->id_cabang ?>" > <?= $cb->cabang_nama ?></option>

                                    <?php } ?>

                                </select>     

                            </div>

                        </div>

                        <div class="col-6">

                            <div class="form-group">

                                <label for="id_golongan">Golongan</label>

                                <select name="id_golongan" id="id_golongan" class="form-control">

                                    <option value=""></option>

                                    <?php foreach($golongan as $gl) { ?>

                                    <option value="<?= $gl->id_golongan ?>" data-cabang="<?= $gl->id_cabang ?>" data-subkategori="<?= $gl->golongan_kategori ?>"> <?= $gl->golongan_nama ?></option>

                                    <?php } ?>

                                </select>     
                            </div>
                        </div>

                        <div class="col-6">

                            <div class="form-group">

                                <label for="id_kategori">Kategori</label>

                                <select name="id_kategori" id="id_kategori" class="form-control juara-kategori">

                                    <option value=""></option>

                                    <?php foreach($kategori as $kt) { ?>

                                    <option value="<?= $kt->id_kategori ?>" data-subkategori="<?= $kt->subkategori ?>"> <?= $kt->nama_kategori ?></option>

                                    <?php } ?>

                                </select>     

                            </div>

                        </div>

                        <div class="col-6">

                            <div class="form-group">

                                <label for="id_subkategori">Subkategori</label>

                                <select name="id_subkategori" id="id_subkategori" class="form-control" readonly>

                                    <option value=""></option>

                                    <?php foreach($subkategori as $skt) { ?>

                                    <option value="<?= $skt->id_subkategori ?>" data-kategori="<?= $skt->id_kategori ?>" data-subkategori="<?= $skt->subkategori ?>"> <?= $skt->subkategori ?></option>

                                    <?php } ?>

                                </select>     

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="juara_foto">Foto Juara</label>

                        <input type="file" class="form-control" id="juara_foto" name="juara_foto">

                    </div>

                    <div class="form-group">
                        <label for="link">Link Video</label>
                        <input type="text" class="form-control" id="link" name="link">
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail Video</label>
                        <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Video</label>
                        <textarea name="deskripsi" id="deskripsi" cols="10" rows="5" class="form-control"></textarea>
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