<!-- Modal -->

<div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="tambah-modalLabel"

    aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">

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

                        <label for="nama_menu">Nama Menu</label>

                        <input type="text" class="form-control" id="nama_menu" name="nama_menu">

                    </div>

                    <div class="form-group">

                        <label for="icon_menu">Icon</label>

                        <input type="text" class="form-control" id="icon_menu" name="icon_menu">

                    </div>

                    <div class="row">

                        <div class="col-6">

                            <div class="form-group">

                                <label for="group_menu">Group</label>

                                <div class="form-check">

                                    <input class="form-check-input" type="radio" name="group_menu" id="group_menu1" value="0" >

                                    <label class="form-check-label" for="group_menu1">

                                        Tidak 

                                    </label>

                                </div>

                                <div class="form-check">

                                    <input class="form-check-input" type="radio" name="group_menu" id="group_menu2" value="1" checked>

                                    <label class="form-check-label" for="group_menu2">

                                        Ya

                                    </label>

                                </div>

                            </div>

                        </div>

                        

                        <div class="col-6">

                            <div class="form-group">

                                <label for="parent_menu">Parent</label>

                                <select name="parent_menu" id="parent_menu" class="form-control">

                                    <option value=""></option>

                                    <?php foreach($menuParent as $mp) { ?>

                                    <option value="<?= $mp->id_menu ?>"> <?= $mp->nama_menu ?></option>

                                    <?php } ?>

                                </select>     

                            </div>

                        </div>

                        <div class="col-6">

                            <div class="form-group">

                                <label for="link_nama_menu">Menu Tag</label>

                                <input type="text" class="form-control" id="link_nama_menu" name="link_nama_menu">

                            </div>

                        </div>

                        <div class="col-6">

                            <div class="form-group">

                                <label for="link_menu">Link Menu</label>

                                <input type="text" class="form-control" id="link_menu" name="link_menu">

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="id_header_menu">Header</label>

                        <select name="id_header_menu" id="id_header_menu" class="form-control">

                            <option value=""></option>

                            <?php foreach($headerMenu as $hm) { ?>

                            <option value="<?= $hm->id_header_menu ?>"> <?= $hm->nama_header ?></option>

                            <?php } ?>

                        </select>      

                    </div>

                    <div class="row">

                        <div class="col-6">

                            <div class="form-group">

                                <label for="order_by">Urutan</label>

                                <input type="text" class="form-control" id="order_by" name="order_by">

                            </div>

                        </div>

                        <div class="col-6">

                            <div class="form-group">

                                <label for="flag_menu">Status</label>

                                <div class="form-check">

                                    <input class="form-check-input" type="radio" name="flag_menu" id="flag_menu1" value="0" >

                                    <label class="form-check-label" for="flag_menu1">

                                        Tidak Aktif

                                    </label>

                                </div>

                                <div class="form-check">

                                    <input class="form-check-input" type="radio" name="flag_menu" id="flag_menu2" value="1" checked>

                                    <label class="form-check-label" for="flag_menu2">

                                        Aktif

                                    </label>

                                </div>

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