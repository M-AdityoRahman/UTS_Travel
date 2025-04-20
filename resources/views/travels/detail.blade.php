<div class="modal-header">
    <h5 class="modal-title">Travel Detail</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <p><strong>Place Name:</strong> {{ $travel->place_name }}</p>
    <p><strong>Location:</strong> {{ $travel->location }}</p>
    <p><strong>Type:</strong> {{ $travel->travel_type }}</p>
    <p><strong>Priority:</strong> {{ $travel->priority_level }}</p>
    <p><strong>Estimated Cost:</strong> {{ number_format($travel->estimated_cost, 0, ',', '.') }}</p>
</div>
