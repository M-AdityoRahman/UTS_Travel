<!-- Modal konfirmasi hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this travel item?
            </div>
            <div class="modal-footer">
                <!-- Tombol konfirmasi delete -->
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                <!-- Tombol batal -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Alert sukses setelah berhasil menghapus -->
<div id="globalDeleteAlert" class="alert alert-success position-fixed top-50 start-50 translate-middle d-none" role="alert" style="z-index: 1055; min-width: 300px; text-align: center;">
  Data berhasil Dihapus!
</div>

@push('scripts')
<script>
    $(document).ready(function() {

        // Jika deleteId belum didefinisikan, set ke null (untuk menyimpan ID travel yang akan dihapus)
        if (typeof deleteId === 'undefined') {
            window.deleteId = null;
        }

        // Fungsi untuk membuka modal delete dan menyimpan id travel yang akan dihapus
        window.openDeleteModal = function(id) {
            console.log('openDeleteModal called with id:', id);
            window.deleteId = id;
            $('#globalDeleteAlert').addClass('d-none'); // Sembunyikan alert jika sebelumnya muncul
            $('#deleteModal').modal('show'); // Tampilkan modal
        };

        // Event saat tombol "Delete" di modal ditekan
        $('#confirmDeleteBtn').click(function() {
            console.log('confirmDeleteBtn clicked, deleteId:', window.deleteId);

            if(window.deleteId) {
                $.ajax({
                    url: '/travels/' + window.deleteId, // Endpoint untuk hapus data
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Sertakan token CSRF
                    },
                    success: function(response) {
                        if(response.success) {
                            $('#deleteModal').modal('hide'); // Tutup modal
                            $('#row-' + window.deleteId).remove(); // Hapus baris dari DOM
                            $('#globalDeleteAlert').removeClass('d-none'); // Tampilkan alert sukses
                            setTimeout(function() {
                                $('#globalDeleteAlert').addClass('d-none'); // Sembunyikan alert setelah 3 detik
                            }, 3000);
                        } else {
                            alert(response.message); // Tampilkan pesan error dari server
                        }
                    },
                    error: function() {
                        alert('Failed to delete travel'); // Error umum jika AJAX gagal
                    }
                });
            }
        });
    });
</script>
@endpush
