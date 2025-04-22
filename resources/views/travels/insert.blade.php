<!-- Modal Tambah Data (Insert Modal) -->
<div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Form Tambah Data -->
            <form id="insertForm">
                @csrf {{-- Token CSRF untuk keamanan request POST --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="insertModalLabel">Add Travel</h5>
                    <!-- Tombol close modal -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Input Nama Tempat -->
                    <div class="mb-3">
                        <label>Place Name</label>
                        <input type="text" name="place_name" class="form-control" required>
                        <span class="text-danger" id="error-place_name"></span> {{-- Menampilkan error validasi --}}
                    </div>
                    <!-- Input Lokasi -->
                    <div class="mb-3">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" required>
                        <span class="text-danger" id="error-location"></span>
                    </div>
                    <!-- Pilihan Jenis Travel -->
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
                    <!-- Input Prioritas -->
                    <div class="mb-3">
                        <label>Priority Level</label>
                        <input type="number" name="priority_level" class="form-control" min="1" max="5" placeholder="Minimum 1 Maximum 5" required>
                        <span class="text-danger" id="error-priority_level"></span>
                    </div>
                    <!-- Input Estimasi Biaya -->
                    <div class="mb-3">
                        <label>Estimated Cost</label>
                        <input type="number" name="estimated_cost" class="form-control" min="100000" placeholder="Minimum Rp. 100.000" required>
                        <span class="text-danger" id="error-estimated_cost"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Tombol submit form dan tombol close -->
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Alert sukses di tengah layar -->
<div id="globalAlert" class="alert alert-success position-fixed top-50 start-50 translate-middle d-none" role="alert" style="z-index: 1055; min-width: 300px; text-align: center;">
  <h4 class="alert-heading">Berhasil!</h4>
  <p>Horayyy, Data yang kamu tambahkan berhasil disimpan.</p>
  <hr>
  <p class="mb-0">Wishlist kali ini harus berhasil.</p>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Ketika form insert disubmit
        $('#insertForm').submit(function(e) {
            e.preventDefault(); // Mencegah reload form

            // AJAX untuk kirim data ke server
            $.ajax({
                url: '/travels/store', // URL ke route store travel
                method: 'POST', // Metode POST
                data: $(this).serialize(), // Mengirim data form
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token untuk keamanan
                },
                success: function(response) {
                    // Sembunyikan modal & tampilkan alert sukses
                    $('#insertModal').modal('hide');
                    $('#globalAlert').removeClass('d-none');

                    // Setelah 3 detik, sembunyikan alert dan reload halaman
                    setTimeout(function() {
                        $('#globalAlert').addClass('d-none');
                        location.reload();
                    }, 3000);
                },
                error: function(xhr) {
                    // Jika error validasi (422), tampilkan pesan error di bawah input
                    if(xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $('.text-danger').text(''); // Bersihkan semua error lama
                        for(let key in errors) {
                            $('#error-' + key).text(errors[key][0]); // Tampilkan error di elemen yang sesuai
                        }
                    } else {
                        alert('Error: ' + xhr.responseText); // Jika error lainnya, tampilkan alert biasa
                    }
                }
            });
        });

        // Ketika modal ditutup, reset form & error
        $('#insertModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset(); // Reset form
            $('.text-danger').text(''); // Kosongkan error
        });
    });
</script>
@endpush
