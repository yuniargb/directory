<!-- Modal -->

<div class="modal fade " id="form-modal" tabindex="-1" role="dialog" aria-labelledby="tambah-modalLabel"

    aria-hidden="true">

    <div class="modal-dialog modal-fullscreen " role="document">

        <div class="modal-content ">

            <form method="post" action="" id="data_form" autocomplete="off">

                <div class="modal-header  bg-primary py-5 text-white">

                    <h5 class="modal-title" id="form-modal-title">Modal title</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">
                    <?php  $this->load->view('content/alert') ?>
                    
                    <div class="form-group" id="level_id_hide">

                        <label for="level_id">Level</label>

                        <select name="level_id" id="level_id" class="form-control">

                            <option value=""></option>

                            <?php foreach($level as $lv) { ?>

                            <option value="<?= $lv->level_id ?>"> <?= $lv->nama_level ?></option>

                            <?php } ?>

                        </select>     

                    </div>

                    <table class="table table-striped">

                        <thead>

                            <tr>

                                <th rowspan="2">Menu</th>

                                <th class="text-dark text-center">Read</th>

                                <th class="text-dark text-center">Create</th>

                                <th class="text-dark text-center">Update</th>

                                <th class="text-dark text-center">Delete</th>

                                <th class="text-dark text-center">Export</th>

                                <th class="text-dark text-center">Other</th>

                                <th ></th>

                            </tr>

                            <tr>

                                <th class="text-dark text-center bg-light">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="read_all" class="custom-switch-input"  id="read_all_2" data-access="all" value="1" data-type="read">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description"></span>
                                    </label>
                                </th>

                                <th class="text-dark text-center bg-light">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="create_all" class="custom-switch-input"  id="create_all_2" data-access="all" value="1" data-type="create">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description"></span>
                                    </label>
                                </th>

                                <th class="text-dark text-center bg-light">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="update_all" class="custom-switch-input"  id="update_all_2" data-access="all" value="1" data-type="update">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description"></span>
                                    </label>
                                </th>

                                <th class="text-dark text-center bg-light">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="delete_all" class="custom-switch-input"  id="delete_all_2" data-access="all" value="1" data-type="delete">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description"></span>
                                    </label>
                                </th>

                                <th class="text-dark text-center bg-light">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="export_all" class="custom-switch-input"  id="export_all_2" data-access="all" value="1" data-type="export">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description"></span>
                                    </label>
                                </th>

                                <th class="text-dark text-center bg-light">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="other_all" class="custom-switch-input"  id="other_all_2" data-access="all" value="1" data-type="other">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description"></span>
                                    </label>

                                </th>

                                <th class="bg-light text-dark text-center">Check All</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach($menu as $i => $m) { ?>

                                <tr>

                                    <th>

                                        <?= $m->nama_menu ?>

                                        <input type="hidden" name="menu[<?= $m->id_menu ?>]" value="<?= $m->id_menu ?>">

                                    </th>

                                    <td class="text-dark text-center">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="read[<?= $m->id_menu ?>]" class="custom-switch-input"  id="read_access_<?= $i ?>_2" data-access="read" value="1" data-menu="<?= $m->id_menu ?>">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description"></span>
                                        </label>
                                    </td>

                                    <td class="text-dark text-center">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="create[<?= $m->id_menu ?>]" class="custom-switch-input"  id="create_access_<?= $i ?>_2" data-access="create" value="1" data-menu="<?= $m->id_menu ?>">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description"></span>
                                        </label>
                                    </td>

                                    <td class="text-dark text-center">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="update[<?= $m->id_menu ?>]" class="custom-switch-input"  id="update_access_<?= $i ?>_2" data-access="update" value="1" data-menu="<?= $m->id_menu ?>">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description"></span>
                                        </label>
                                    </td>

                                    <td class="text-dark text-center">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="delete[<?= $m->id_menu ?>]" class="custom-switch-input"  id="delete_access_<?= $i ?>_2" data-access="delete" value="1" data-menu="<?= $m->id_menu ?>">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description"></span>
                                        </label>
                                    </td>

                                    <td class="text-dark text-center">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="export[<?= $m->id_menu ?>]" class="custom-switch-input"  id="export_access_<?= $i ?>_2" data-access="export" value="1" data-menu="<?= $m->id_menu ?>">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description"></span>
                                        </label>
                                    </td>

                                    <td class="text-dark text-center">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="other[<?= $m->id_menu ?>]" class="custom-switch-input"  id="other_access_<?= $i ?>_2" data-access="other" value="1" data-menu="<?= $m->id_menu ?>">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description"></span>
                                        </label>
                                    </td>

                                    <th class="text-dark text-center bg-light">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="all_row[<?= $i ?>]" class="custom-switch-input"  id="all_row_<?= $i ?>_2" data-access="all_row" value="1" data-access="all_row" data-menu="<?= $m->id_menu ?>">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description"></span>
                                        </label>
                                    </th>

                                    

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Simpan</button>

                </div>

            </form>

        </div>

    </div>

</div>