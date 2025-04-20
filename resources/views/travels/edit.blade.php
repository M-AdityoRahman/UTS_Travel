@extends('layout.app')
@section('title', 'Edit Travel')
@section('content')

<h1 class="h3 mb-2 text-gray-800">Edit WishList Travel</h1>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Form</h6>
            </div>
            <div class="card-body">
                <form id="travelEditForm">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $travel->id }}">

                    <div class="form-group">
                        <label>Place Name</label>
                        <input type="text" name="place_name" class="form-control" value="{{ $travel->place_name }}">
                        <span class="text-danger" id="error-place_name"></span>
                    </div>

                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" value="{{ $travel->location }}">
                        <span class="text-danger" id="error-location"></span>
                    </div>

                    <div class="form-group">
                        <label>Travel Type</label>
                        <select name="travel_type" class="form-control">
                            @foreach(['Liburan', 'Petualangan', 'Wisata Budaya', 'Kuliner', 'Alam'] as $type)
                                <option value="{{ $type }}" {{ $travel->travel_type == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="error-travel_type"></span>
                    </div>

                    <div class="form-group">
                        <label>Priority Level (1-5)</label>
                        <input type="number" name="priority_level" class="form-control" value="{{ $travel->priority_level }}" min="1" max="5">
                        <span class="text-danger" id="error-priority_level"></span>
                    </div>

                    <div class="form-group">
                        <label>Estimated Cost (min. 100,000)</label>
                        <input type="number" name="estimated_cost" class="form-control" value="{{ $travel->estimated_cost }}" min="100000">
                        <span class="text-danger" id="error-estimated_cost"></span>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Update</button>
                    <a href="{{ route('travels') }}" class="btn btn-secondary btn-sm">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $('#travelEditForm').submit(function(e) {
        e.preventDefault();

        const formData = $(this).serialize();
        const travelId = $('input[name="id"]').val();

        $.ajax({
            url: `/travels/update/${travelId}`,
            method: 'POST',
            data: formData,
            success: function(response) {
                alert(response.message);
                window.location.href = "{{ route('travels') }}";
            },
            error: function(xhr) {
                $('.text-danger').html('');
                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $('#error-' + key).text(value[0]);
                    });
                }
            }
        });
    });
</script>
@endpush
