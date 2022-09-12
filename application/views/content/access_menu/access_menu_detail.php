<!-- Modal -->
<div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="detail-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary py-5 text-white">
                <h5 class="modal-title" id="detail-modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                                <th>Menu</th>
                                <th>Read</th>
                                <th>Create</th>
                                <th>Update</th>
                                <th>Delete</th>
                                <th>Export</th>
                                <th>Other</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach($menu as $i => $m) { ?>
                            <tr>
                                <th><?= $m->nama_menu ?></th>
                                <td class="text-center detail_access" id="detail_read_<?= $m->id_menu ?>"></td>
                                <td class="text-center detail_access" id="detail_create_<?= $m->id_menu ?>"></td>
                                <td class="text-center detail_access" id="detail_update_<?= $m->id_menu ?>"></td>
                                <td class="text-center detail_access" id="detail_delete_<?= $m->id_menu ?>"></td>
                                <td class="text-center detail_access" id="detail_export_<?= $m->id_menu ?>"></td>
                                <td class="text-center detail_access" id="detail_other_<?= $m->id_menu ?>"></td>
                            </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>