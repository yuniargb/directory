<div class="table-responsive">

    <?php if($access->exported_access ){ ?>

    <select id="exportLink" class="form-control col-md-3 float-right" autocomplete="off">

        <option selected>Choose Export</option>

        <option id="excel">Export as XLS</option>

        <option id="copy">Copy to clipboard</option>                                                

        <option id="pdf">Export as PDF</option>

    </select>

    <?php } ?>

    <table class="table table-striped" id="<?= $access->exported_access ? 'table-1' : 'table-2'?>">

        <thead>

            <tr>

                <th>Level</th>

                <?php if($access->updated_access || $access->deleted_access ){ ?>

                <th class="text-center hide-export">Action</th>

                <?php } ?>

            </tr>

        </thead>

        <tbody>

            <?php foreach($data as $d){ ?>

            <tr>

                <td><?=  $d['level']->nama_level ?></td>

                <?php if($access->updated_access || $access->deleted_access || $access->other_access ){ ?>

                <td class="text-center">

                    <div class="btn-group" role="group" aria-label="Basic example">

                        <?php if($access->other_access ){ ?>

                        <button class="btn btn-warning btn-sm btn-detail-access" data-toggle="modal" data-target="#detail-modal"

                            data-title="Detail <?= $d['level']->nama_level ?>" 

                            data-field="<?= htmlspecialchars(json_encode($d['menu']), ENT_QUOTES, 'UTF-8')  ?>">

                            <i class="fas fa-eye"></i> Detail

                        </button>

                        <?php } ?>

                        <?php if($access->updated_access ){ ?>

                        <button class="btn btn-info btn-sm btn-edit-access" data-toggle="modal" data-target="#form-modal"

                            data-title="Edit <?= $title ?>" data-level="<?=  $d['level']->level_id ?>" data-action="<?= base_url('access_menu/update/'. base64_encode($this->encryption->encrypt($d['level']->level_id)))  ?>"

                            data-field="<?= htmlspecialchars(json_encode($d['menu']), ENT_QUOTES, 'UTF-8')  ?>">

                            <i class="fas fa-edit"></i> Edit

                        </button>

                        <?php } ?>

                        <?php if($access->deleted_access ){ ?>

                        <button class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#delete-modal"

                        data-title="Hapus <?= $title ?>" data-action="<?= base_url('access_menu/delete/'.base64_encode($this->encryption->encrypt($d['level']->level_id))) ?>">

                            <i class="fas fa-trash"></i> Hapus

                        </button>

                        <?php } ?>

                </td>

                <?php } ?>

            </tr>

            <?php } ?>

        </tbody>

    </table>

</div>