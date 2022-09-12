<div class="table-responsive">

    <?php if($access->exported_access ){ ?>

    <select id="exportLink" class="form-control col-md-3 float-right" autocomplete="off">

        <option selected>Choose Export</option>

        <option id="excel">Export as XLS</option>

        <option id="copy">Copy to clipboard</option>                                                

        <option id="pdf">Export as PDF</option>

    </select>

    <?php } ?>

    <table class="table table-striped" id="<?= $access->exported_access ? 'table-1-ss' : 'table-2-ss'?>">

        <thead>

            <tr>

                <th>ID</th>

                <th>Judul File</th>

                <th>Event</th>

                <th>File</th>

                <?php if($access->updated_access || $access->deleted_access ){ ?>

                <th class="text-center hide-export">Action</th>

                <?php } ?>

            </tr>

        </thead>

        <tbody>

            <?php foreach($data as $d){ ?>

            <tr>

                <td><?=  $d->id_file ?></td>

                <td><?=  $d->judul_file ?></td>

                <td><?=  $d->event_name ?></td>

                <td><a href="<?= base_url('assets/'.$d->nama_file) ?>" target="_blank" class="btn btn-sm btn-secondary"><i class="fas fa-file-pdf"></i> Download</a></td>

                <?php if($access->updated_access || $access->deleted_access ){ ?>

                <td class="text-center">

                    <div class="btn-group" role="group" aria-label="Basic example">

                        <?php if($access->updated_access ){ ?>

                        <button class="btn btn-info btn-sm btn-edit" data-toggle="modal" data-target="#form-modal"

                            data-title="Edit <?= $title ?>" data-action="<?= base_url('file/update/'.base64_encode($this->encryption->encrypt($d->id_file))) ?>"

                            data-field="<?= htmlspecialchars(json_encode($d), ENT_QUOTES, 'UTF-8')  ?>">

                            <i class="fas fa-edit"></i> Edit

                        </button>

                        <?php } ?>

                        <?php if($access->deleted_access ){ ?>

                        <button class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#delete-modal"

                        data-title="Hapus <?= $title ?>" data-action="<?= base_url('file/delete/'.base64_encode($this->encryption->encrypt($d->id_file))) ?>">

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

<script>
    var get_data = "<?= base_url('file/data_list');?>"
</script>