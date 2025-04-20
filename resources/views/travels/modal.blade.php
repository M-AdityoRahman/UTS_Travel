<!-- Modal -->
<div class="modal fade" id="travelModal" tabindex="-1" aria-labelledby="travelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="travelForm">
                @csrf
                <input type="hidden" id="travelId" name="id">
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="travelModalLabel">Add Travel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
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
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
