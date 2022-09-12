<!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="" id="delete_form">
                <div class="modal-header  bg-danger py-4 text-white">
                    <h5 class="modal-title" id="delete-modal-title">Modal title</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="act" name="act" value="delete">
                   Apakah anda yakin ingin menghapus Data ini?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>