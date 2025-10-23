<div class="card" wire:show="showEditRenewalForm" x-transition.duration.500ms>
    <div class="card-header">
        <h5>Edit</h5>
    </div>
    <div class="card-body">
{{--        @if (session('success'))--}}
{{--            <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--                {{ session('success')}}--}}
{{--                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--            </div>--}}
{{--        @endif--}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="customer-company" class="form-label">Customer/Company</label> <span class="text-danger">*</span>
                    <input type="text" id="customer-company" class="form-control" readonly wire:model="form.customer_company">
                </div>
                <div class="col-4 mb-3">
                    <label for="vehicle-number" class="form-label">Vehicle Number</label> <span class="text-danger">*</span>
                    <input type="text" id="vehicle-number" class="form-control" readonly wire:model="form.vehicle_number">
                </div>
                <div class="col-4 mb-3">
                    <label for="upload-document" class="form-label">Upload Document (Image/PDF)</label>
                    <input type="file" id="upload-document" class="form-control @error('form.document') is-invalid @enderror" wire:model="form.document">
                    @error('form.document')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-6 mb-3">
                    <label for="edit-inception" class="form-label">Insurance Inception</label> <span class="text-danger">*</span>
                    <input type="date" id="edit-inception" class="form-control @error('form.inception') is-invalid @enderror" required wire:model="form.inception">
                    @error('form.inception')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-6 mb-3">
                    <label for="edit-expiration" class="form-label">Insurance Expiration</label> <span class="text-danger">*</span>
                    <input type="date" id="edit-expiration" class="form-control @error('form.expiration') is-invalid @enderror" required wire:model="form.expiration">
                    @error('form.expiration')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label for="edit-policy-number" class="form-label">Policy Number</label> <span class="text-danger">*</span>
                    <input type="text" id="edit-policy-number" class="form-control @error('form.policy_number') is-invalid @enderror" aria-label="insurance policy number" wire:model="form.policy_number">
                    @error('form.policy_number')
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
