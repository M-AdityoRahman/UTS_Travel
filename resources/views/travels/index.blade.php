@extends('layout.app')
@section('title', 'Wishlist Travels')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Wishlist Travels</h1>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#travelModal">Tambah</button>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Place Name</th>
                            <th>Location</th>
                            <th>Travel Type</th>
                            <th>Priority</th>
                            <th>Estimate Cost</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($travels as $i => $t)
                        <tr id="row-{{ $t->id }}">
                            <td>{{ $i+1 }}</td>
                            <td>{{ $t->place_name }}</td>
                            <td>{{ $t->location }}</td>
                            <td>{{ $t->travel_type }}</td>
                            <td>{{ $t->priority_level }}</td>
                            <td>{{ number_format($t->estimated_cost) }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" onclick="showDetail({{ $t->id }})">Detail</button>
                                <button class="btn btn-warning btn-sm" onclick="editData({{ $t->id }})">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteData({{ $t->id }})">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('travels.modal')
@endsection

@push('scripts')
<script>
    // Function to show detail in modal
    function showDetail(id) {
        $.ajax({
            url: '/travels/' + id,
            type: 'GET',
            success: function(response) {
                if(response.success) {
                    let data = response.data;
                    let modalHTML = `
                        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Travel Detail</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Place Name:</strong> ${data.place_name}</p>
                                        <p><strong>Location:</strong> ${data.location}</p>
                                        <p><strong>Type:</strong> ${data.travel_type}</p>
                                        <p><strong>Priority:</strong> ${data.priority_level}</p>
                                        <p><strong>Estimated Cost:</strong> ${new Intl.NumberFormat().format(data.estimated_cost)}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    $('body').append(modalHTML);
                    $('#detailModal').modal('show');
                    $('#detailModal').on('hidden.bs.modal', function() {
                        $(this).remove();
                    });
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert('Failed to load details');
            }
        });
    }

    // Function to edit data
    function editData(id) {
        $.ajax({
            url: '/travels/' + id,
            type: 'GET',
            success: function(response) {
                if(response.success) {
                    let data = response.data;
                    $('#travelId').val(data.id);
                    $('[name="place_name"]').val(data.place_name);
                    $('[name="location"]').val(data.location);
                    $('[name="travel_type"]').val(data.travel_type);
                    $('[name="priority_level"]').val(data.priority_level);
                    $('[name="estimated_cost"]').val(data.estimated_cost);
                    $('#travelModalLabel').text('Edit Travel');
                    $('#travelModal').modal('show');
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert('Failed to load edit data');
            }
        });
    }

    // Function to delete data
    function deleteData(id) {
        if(confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                url: '/travels/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.success) {
                        $('#row-' + id).remove();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('Delete failed');
                }
            });
        }
    }

    // Handle form submission for add/edit
    $('#travelForm').submit(function(e) {
        e.preventDefault();

        let id = $('#travelId').val();
        let url = id ? '/travels/' + id : '/travels/store';
        let method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#travelModal').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                console.error('AJAX error:', xhr);
                if(xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $('.text-danger').text('');
                    for(let key in errors) {
                        $('#error-' + key).text(errors[key][0]);
                    }
                } else {
                    let message = 'Error: ' + xhr.status + ' ' + xhr.statusText;
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        message += '\\n' + xhr.responseJSON.message;
                    }
                    alert(message);
                }
            }
        });
    });

    // Reset form when modal is closed
    $('#travelModal').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $('#travelId').val('');
        $('#travelModalLabel').text('Add Travel');
        $('.text-danger').text('');
    });
</script>
@endpush
