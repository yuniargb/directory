<!-- Modal -->
<div class="modal fade" id="logout-modal" tabindex="-1" role="dialog" aria-labelledby="logout-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-danger py-4 text-white">
                <h5 class="modal-title" id="logout-modal-title">Logout</h5>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin keluar?
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('logout') ?>" class="btn btn-danger ">Logout</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>