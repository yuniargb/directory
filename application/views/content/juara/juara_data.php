<div class="table-responsive">

    <?php if($access->exported_access ){ ?>

    <select id="exportLink" class="form-control col-md-3 float-right" autocomplete="off">

        <option selected>Choose Export</option>

        <option id="excel">Export as XLS</option>

        <option id="copy">Copy to clipboard</option>                                                

        <option id="pdf">Export as PDF</option>

    </select>

    <?php } ?>

    <table class="table table-striped" id="<?= $access->exported_access ? 'table-1-ss' : 'table-2-ss'?>" >

        <thead>

            <tr>

                <th>ID</th>

                <th>Nama</th>

                <th class="hide-export">Foto</th>

                <th>Event</th>

                <?php if($access->updated_access || $access->deleted_access ){ ?>

                <th class="text-center hide-export">Action</th>

                <?php } ?>

            </tr>

        </thead>

        <tbody></tbody>

    </table>

</div>

<script>
    var get_data = "<?= base_url('juara/data_list');?>"
</script>