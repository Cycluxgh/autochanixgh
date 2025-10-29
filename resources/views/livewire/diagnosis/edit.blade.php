<x-slot:title>Diagnosis</x-slot>
<x-slot:page_title>Edit Diagnosis</x-slot>
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <form wire:submit="update">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Customer/Company: &nbsp;</label>
                        <strong>{{ $_diagnosis?->customer?->name ?? $_diagnosis?->company?->name }}</strong>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Vehicle Number: &nbsp;</label>
                        <strong>{{ $_diagnosis?->vehicle_number }}</strong>
                    </div>

                    <div class="mb-3">
                        <label for="diagnosis" class="form-label">Diagnosis report</label>
                        <textarea rows="20" id="diagnosis" class="form-control" required wire:model="diagnosis"
                            placeholder="Write your diagnosis..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md float-end">
                        Save <span class="spinner-grow spinner-grow-sm" aria-hidden="true" wire:loading></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
