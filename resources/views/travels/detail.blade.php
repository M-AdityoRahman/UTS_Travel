<!-- Modal untuk menampilkan detail travel -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Travel Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Isi modal (data akan diisi via JavaScript) -->
            <div class="modal-body">
                <p><strong>Place Name:</strong> <span id="detailPlaceName"></span></p>
                <p><strong>Location:</strong> <span id="detailLocation"></span></p>
                <p><strong>Type:</strong> <span id="detailTravelType"></span></p>
                <p><strong>Priority:</strong> <span id="detailPriority"></span></p>
                <p><strong>Estimated Cost:</strong> <span id="detailEstimatedCost"></span></p>
            </div>
            <!-- Footer modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Fungsi untuk membuka modal detail berdasarkan ID travel
    function openDetailModal(id) {
        $.ajax({
            url: '/travels/' + id, // Ambil data travel berdasarkan ID
            type: 'GET',
            success: function(response) {
                if(response.success) {
                    let data = response.data;
                    // Isi elemen HTML dengan data dari server
                    $('#detailPlaceName').text(data.place_name);
                    $('#detailLocation').text(data.location);
                    $('#detailTravelType').text(data.travel_type);
                    $('#detailPriority').text(data.priority_level);
                    $('#detailEstimatedCost').text(new Intl.NumberFormat().format(data.estimated_cost)); // Format angka
                    $('#detailModal').modal('show'); // Tampilkan modal
                } else {
                    alert(response.message); // Tampilkan error dari server
                }
            },
            error: function() {
                alert('Failed to load travel details'); // Error umum jika AJAX gagal
            }
        });
    }
</script>
@endpush
