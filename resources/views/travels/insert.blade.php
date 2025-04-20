@extends('layout.app')
@section('title', 'travels')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Add New WishList</h1>

<div class="row">
    <div class="col-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New WishList Travel Form</h6>
            </div>
            <div class="card-body">
                <form id="travelForm" action="{{ route('travels.add.insert') }}" method="post">
                    <script>
                        $('#travelForm').submit(function(e) {
                            e.preventDefault();
                            const formData = $(this).serialize();
                    
                            $.ajax({
                                url: '{{ isset($travel) ? route("travels.update", $travel->id) : route("travels.add.insert") }}',
                                method: '{{ isset($travel) ? "PUT" : "POST" }}',
                                data: formData,
                                success: function(response) {
                                    $('#travelModal').modal('hide');
                                    location.reload();
                                },
                                error: function(err) {
                                    // Optional: handle validation error
                                    alert("Something went wrong.");
                                }
                            });
                        });
                    </script>
                    
                    @csrf
                    <div class="form-group">
                        <label>Place Name</label>
                        <input type="text" name="place_name" class="form-control" value="{{ old('place_name') }}">
                        @error('place_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location') }}">
                        @error('location')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label>Travel Type</label>
                        <select name="travel_type" class="form-control" required>
                            <option value="">-- Select Type --</option>
                            <option value="Liburan" {{ old('travel_type') == 'Liburan' ? 'selected' : '' }}>Liburan</option>
                            <option value="Petualangan" {{ old('travel_type') == 'Petualangan' ? 'selected' : '' }}>Petualangan</option>
                            <option value="Wisata Budaya" {{ old('travel_type') == 'Wisata Budaya' ? 'selected' : '' }}>Wisata Budaya</option>
                            <option value="Kuliner" {{ old('travel_type') == 'Kuliner' ? 'selected' : '' }}>Kuliner</option>
                            <option value="Alam" {{ old('travel_type') == 'Alam' ? 'selected' : '' }}>Alam</option>
                        </select>
                        @error('travel_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label>Priority Level (1-5)</label>
                        <input type="number" name="priority_level" class="form-control" min="1" max="5" value="{{ old('priority_level') }}">
                        @error('priority_level')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label>Estimated Cost (min. 100,000)</label>
                        <input type="number" name="estimated_cost" class="form-control" min="100000" value="{{ old('estimated_cost') }}">
                        @error('estimated_cost')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Submit</button>
                    <a href="{{ route('travels') }}" class="btn btn-secondary btn-sm">Cancel</a>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
