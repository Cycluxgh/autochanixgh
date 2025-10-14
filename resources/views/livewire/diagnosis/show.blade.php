<x-slot:title>Diagnosis</x-slot>
<x-slot:page_title>Diagnosis Details</x-slot>
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="mb-3">
                    <label class="form-label">Customer: &nbsp;</label>
                    <strong>{{ $diagnosis?->customer?->name }}</strong>
                </div>

                <div class="mb-3">
                    <label class="form-label">Diagnosis Report: &nbsp;</label>
                    <strong>{{ $diagnosis?->diagnosis }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
