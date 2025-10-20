<div class="card" wire:show="showEditRenewalForm" x-transition.duration.500ms>
    <div class="card-header">
        <h5>Edit</h5>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="customer-company" class="form-label">Customer/Company</label>
                    <input type="text" id="customer-company" class="form-control" readonly wire:model="customer_company">
                </div>
                <div class="col-4 mb-3">
                    <label for="vehicle-number" class="form-label">Vehicle Number</label>
                    <input type="text" id="vehicle-number" class="form-control" readonly wire:model="vehicle_number">
                </div>
                <div class="col-4 mb-3">
                    <label for="upload-document" class="form-label">Upload Document (Image/PDF)</label>
                    <input type="file" id="upload-document" class="form-control" required wire:model="edit_document">
                    @error('document')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-6 mb-3">
                    <label for="edit-inception" class="form-label">Insurance Inception</label>
                    <input type="date" id="edit-inception" class="form-control" required wire:model="edit_inception">
                    @error('inception')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-6 mb-3">
                    <label for="edit-expiration" class="form-label">Insurance Expiration</label>
                    <input type="date" id="edit-expiration" class="form-control" required wire:model="edit_expiration">
                    @error('expiration')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-primary float-end">
                        Save <span class="spinner-grow spinner-grow-sm" aria-hidden="true" wire:loading></span>
                    </button>
                    <button type="button" class="btn btn-light float-end" x-on:click="$wire.showEditRenewalForm = false">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
