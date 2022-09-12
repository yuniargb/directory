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

                    <div class="form-group">

                        <label for="id_juara">Juara</label>
                        <select name="id_juara" id="id_juara" class="form-control select2">
                            <option value=""></option>
                            <?php foreach($juara as $jr) { ?>
                            <option value="<?= $jr->id_juara ?>"> <?= $jr->juara_nama ?> <?= $jr->event_name?> Juara <?= $jr->juara_ke?></option>
                            <?php } ?>
                        </select>     
                    </div>

                    <div class="form-group">
                        <label for="judul">Judul Video</label>
                        <input type="text" class="form-control" id="judul" name="judul">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" cols="10" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="link">Link Video</label>
                        <input type="text" class="form-control" id="link" name="link">
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail</label>
                        <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                    </div>

                   


                    <div class="row">
                        <div class="col-6">

                            <div class="form-group">

                                <label for="id_kategori">Kategori</label>

                                <select name="id_kategori" id="id_kategori" class="form-control">

                                    <option value=""></option>

                                    <?php foreach($kategori as $kt) { ?>

                                    <option value="<?= $kt->id_kategori ?>"> <?= $kt->nama_kategori ?></option>

                                    <?php } ?>

                                </select>     

                            </div>

                            </div>

                            <div class="col-6">

                            <div class="form-group">

                                <label for="id_subkategori">Subkategori</label>

                                <select name="id_subkategori" id="id_subkategori" class="form-control">

                                    <option value=""></option>

                                    <?php foreach($subkategori as $skt) { ?>

                                    <option value="<?= $skt->id_subkategori ?>" data-kategori="<?= $skt->id_kategori ?>"> <?= $skt->subkategori ?></option>

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

                                    <option value="<?= $gl->id_golongan ?>" data-cabang="<?= $gl->id_cabang ?>"> <?= $gl->golongan_nama ?></option>

                                    <?php } ?>

                                </select>     

                            </div>

                        </div>

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