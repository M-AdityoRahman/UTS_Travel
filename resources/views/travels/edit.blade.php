<!-- Modal Edit Travel -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Form Edit -->
            <form id="editForm">
                @csrf
                <!-- Input hidden untuk ID travel -->
                <input type="hidden" id="editTravelId" name="id">
                <!-- Laravel butuh _method PUT untuk update -->
                <input type="hidden" name="_method" value="PUT">

                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Travel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Isi Form Edit -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Place Name</label>
                        <input type="text" name="place_name" class="form-control" required>
                        <span class="text-danger" id="error-place_name"></span>
                    </div>
                    <div class="mb-3">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" required>
                        <span class="text-danger" id="error-location"></span>
                    </div>
                    <div class="mb-3">
                        <label>Travel Type</label>
                        <select name="travel_type" class="form-control" required>
                            <option value="">-- Select Type --</option>
                            <option value="Liburan">Liburan</option>
                            <option value="Petualangan">Petualangan</option>
                            <option value="Wisata Budaya">Wisata Budaya</option>
                            <option value="Kuliner">Kuliner</option>
                            <option value="Alam">Alam</option>
                        </select>
                        <span class="text-danger" id="error-travel_type"></span>
                    </div>
                    <div class="mb-3">
                        <label>Priority Level</label>
                        <input type="number" name="priority_level" class="form-control" min="1" max="5" required>
                        <span class="text-danger" id="error-priority_level"></span>
                    </div>
                    <div class="mb-3">
                        <label>Estimated Cost</label>
                        <input type="number" name="estimated_cost" class="form-control" min="100000" required>
                        <span class="text-danger" id="error-estimated_cost"></span>
                    </div>
                </div>

                <!-- Tombol Simpan dan Tutup -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Fungsi untuk membuka modal edit dan mengisi data dari server
    function openEditModal(id) {
        $.ajax({
            url: '/travels/' + id, // Ambil data travel via GET
            type: 'GET',
            success: function(response) {
                if(response.success) {
                    let data = response.data;
                    // Set value form sesuai data dari server
                    $('#editTravelId').val(data.id);
                    $('#editForm [name="place_name"]').val(data.place_name);
                    $('#editForm [name="location"]').val(data.location);
                    $('#editForm [name="travel_type"]').val(data.travel_type);
                    $('#editForm [name="priority_level"]').val(data.priority_level);
                    $('#editForm [name="estimated_cost"]').val(data.estimated_cost);
                    $('#editModal').modal('show'); // Tampilkan modal
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Failed to load data for editing');
            }
        });
    }

    // Ketika form edit disubmit
    $('#editForm').submit(function(e) {
        e.preventDefault(); // Prevent form reload
        let id = $('#editTravelId').val(); // Ambil ID dari input hidden
        $.ajax({
            url: '/travels/' + id, // Kirim ke route update
            method: 'POST', // Pakai POST dengan _method=PUT
            data: $(this).serialize(), // Serialize form data
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token Laravel
            },
            success: function(response) {
                $('#editModal').modal('hide'); // Sembunyikan modal
                location.reload(); // Reload halaman untuk lihat hasil update
            },
            error: function(xhr) {
                if(xhr.status === 422) {
                    // Tampilkan pesan error validasi
                    let errors = xhr.responseJSON.errors;
                    $('.text-danger').text('');
                    for(let key in errors) {
                        $('#error-' + key).text(errors[key][0]);
                    }
                } else {
                    alert('Error: ' + xhr.responseText);
                }
            }
        });
    });

    // Reset form dan error saat modal ditutup
    $('#editModal').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $('.text-danger').text('');
    });
</script>
@endpush
