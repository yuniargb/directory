
<?php if( $this->session->flashdata('error') && ($this->session->flashdata('action') == 'create' || $this->session->flashdata('action') == 'update')){ ?>
<script>
    function form_show(){
        $('#data_form input[type=text]').val('')
        $('#data_form input[type=checkbox]').prop('checked', false)
        $('#data_form input[type=radio]').prop('checked', false)
        $('#data_form select').val('')

        <?php if($this->session->flashdata('action') == 'create' ){ ?>
            $('.hide-edit').prop('readonly', false).addClass('form-control').removeClass('form-control-plaintext')
            if ($('#uxpx').data('proteksi') >= 2) {
                $('#uxpx_proteksi').show()
            }
            $('#level_id_hide').show();
            var title = 'Tambah <?= Globals::layout('title') ?>';
        <?php }else{ ?>
            console.log('asd')
            $('.hide-edit').prop('readonly', true).addClass('form-control-plaintext').removeClass('form-control')
            if ($('#uxpx').data('proteksi') >= 2) {
                $('#uxpx_proteksi').hide()
            }

            var title = 'Edit <?= Globals::layout('title') ?>';
        <?php } ?>
            
        var actions = '<?= $this->session->flashdata('before_url') ?>';
          
        $('#form-modal-title').html(title)
        $('#data_form').attr('action', actions)

        <?php 
        $x = $this->session->flashdata('field_error');
        foreach($x as $key => $err){   
        ?>
            var attr_type = $('#data_form input[name="<?= $key ?>"]').attr('type')
            var attr_name = '<?= $key ?>'
            var val = `<?= $err ?>`
            if (attr_type == 'radio') {
                $('#data_form input[name="' + attr_name + '"][value="' + val + '"]').prop('checked', true)
            }else {
                var vals = val.replace("&#39;", "'")
                if ($('#' + attr_name).prop("type") != "file") {
                    $('#' + attr_name).val(vals)
                }
            }
            if (attr_name == 'group_menu') {
                disableGroupMenu(val);
            }
            if (attr_name == 'user_username') {
                $('#idx_user').hide();
            }
        <?php } ?>

        
    }

    form_show()
    
    $('#form-modal').modal('show');
</script>
<?php } ?>