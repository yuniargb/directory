<!-- Modal -->

<div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="tambah-modalLabel"

    aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <form method="post" action="" id="data_form" autocomplete="false">

                <div class="modal-header  bg-primary py-5 text-white">

                    <h5 class="modal-title" id="form-modal-title">Modal title</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                <?php  $this->load->view('content/alert') ?>

                    <div class="form-group" id="idx_user">

                        <label for="user_username">Username</label>

                        <input type="text" class="form-control" id="user_username" name="user_username">

                    </div>

                    <div class="form-group">

                        <label for="user_nama">Nama</label>

                        <input type="text" class="form-control" id="user_nama" name="user_nama">

                    </div>

                    <div class="form-group">

                        <label for="uxpx">Password</label>

                        <input type="password" class="form-control" id="uxpx" name="uxpx">

                    </div>



                    <div class="form-group">

                        <label for="level_id">Level</label>

                        <select name="level_id" id="level_id" class="form-control">

                            <option value=""></option>

                            <?php foreach($level as $lv) { ?>

                            <option value="<?= $lv->level_id ?>"> <?= $lv->nama_level ?></option>

                            <?php } ?>

                        </select>     

                    </div>

                    

                    <div class="form-group">

                        <label for="user_flag">Status</label>

                        <div class="form-check">

                            <input class="form-check-input" type="radio" name="user_flag" id="user_flag1" value="0" >

                            <label class="form-check-label" for="user_flag1">

                                Tidak Aktif

                            </label>

                        </div>

                        <div class="form-check">

                            <input class="form-check-input" type="radio" name="user_flag" id="user_flag2" value="1" checked>

                            <label class="form-check-label" for="user_flag2">

                                Aktif

                            </label>

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