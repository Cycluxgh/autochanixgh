<x-slot:title>Diagnosis</x-slot>
<x-slot:page_title>Diagnosis Details</x-slot>
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">Customer/Company: &nbsp;</label>
                        <strong>{{ $diagnosis?->customer?->name ?? $diagnosis?->company?->name }}</strong>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">Vehicle Number: &nbsp;</label>
                        <strong>{{ $diagnosis?->vehicle_number }}</strong>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Diagnosis Report: &nbsp;</label>
                    <strong>{{ $diagnosis?->diagnosis }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
