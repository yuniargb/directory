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

                <th>ID</th>

                <th>Menu</th>

                <th>Icon</th>

                <th>Menu Tag</th>

                <th>Link</th>

                <th>Group</th>

                <th>Parent</th>

                <th>Header</th>

                <th>Urutan</th>

                <th>Status</th>

                <?php if($access->updated_access || $access->deleted_access ){ ?>

                <th class="text-center hide-export">Action</th>

                <?php } ?>

            </tr>

        </thead>

        <tbody>

            <?php foreach($data as $d){ ?>

            <tr>

                <td><?=  $d->id_menu ?></td>

                <td><?=  $d->nama_menu ?></td>

                <td><?=  ($d->icon_menu ?? '-') ?></td>

                <td><?=  ($d->link_nama_menu ?? '-') ?></td>

                <td><?=  $d->link_menu ?? '#' ?></td>

                <td><?=  $d->group_menu ? '<span class="badge badge-pill  badge-success">Aktif</span>' : '<span class="badge badge-pill  badge-danger">Tidak Aktif</span>' ?></td>

                <td><?=  $d->parent_nama ?? '-' ?></td>

                <td><?=  $d->nama_header ?></td>

                <td><?=  $d->order_by ?></td>

                <td><?=  $d->flag_menu ? '<span class="badge badge-pill  badge-success">Aktif</span>' : '<span class="badge badge-pill  badge-danger">Tidak Aktif</span>' ?></td>

                <?php if($access->updated_access || $access->deleted_access ){ ?>

                <td class="text-center">

                    <div class="btn-group" role="group" aria-label="Basic example">

                        <?php if($access->updated_access ){ ?>

                        <button class="btn btn-info btn-sm btn-edit" data-toggle="modal" data-target="#form-modal"

                            data-title="Edit <?= $title ?>" data-action="<?= base_url('menu/update/'.base64_encode($this->encryption->encrypt($d->id_menu))) ?>"

                            data-field="<?= htmlspecialchars(json_encode($d), ENT_QUOTES, 'UTF-8')  ?>">

                            <i class="fas fa-edit"></i> Edit

                        </button>

                        <?php } ?>

                        <?php if($access->deleted_access && $this->session->userdata('level') == 1){ ?>

                        <button class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#delete-modal"

                        data-title="Hapus <?= $title ?>" data-action="<?= base_url('menu/delete/'.base64_encode($this->encryption->encrypt($d->id_menu))) ?>">

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