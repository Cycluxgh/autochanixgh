<div class="row" wire:show="showAddRenewalForm" x-transition.duration.500ms>
    <div class="card">
        <h5 class="card-header">Add Renewal</h5>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="modal-body">
                    {{--                    @if (session('success')) --}}
                    {{--                        <div class="alert alert-success alert-dismissible fade show" role="alert"> --}}
                    {{--                            {{ session('success')}} --}}
                    {{--                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                    {{--                        </div> --}}
                    {{--                    @endif --}}
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="row">
                        @if (!$hideCustomersSelect)
                            <div class="col-{{ $size }} mb-3">
                                <label for="customers" class="form-label">Existing Customers</label> <span
                                    class="text-danger">*</span>
                                <select
                                    class="form-select message-customers @error('form.customer_id') is-invalid @enderror"
                                    data-placeholder="Select a customer" wire:model="form.customer_id"
                                    wire:change.prevent="handleCustomersOption($event.target.value)">
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ ucfirst($customer->name) }}</option>
                                    @endforeach
                                </select>
                                @error('form.customer_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif

                        @if (!$hideCompaniesSelect)
                            <div class="col-{{ $size }} mb-3">
                                <label for="companies" class="form-label">Existing Companies</label> <span
                                    class="text-danger">*</span>
                                <select
                                    class="form-select existing-company @error('form.company_id') is-invalid @enderror"
                                    id="companies" data-placeholder="Select a company" wire:model="form.company_id"
                                    wire:change.prevent="handleCompaniesOption($event.target.value)">
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ ucfirst($company->name) }}</option>
                                    @endforeach
                                </select>
                                @error('form.company_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif

                        <div class="col-{{ $size }} mb-3">
                            <label for="vehicle-number" class="form-label">Vehicle Number</label> <span
                                class="text-danger">*</span>
                            <select
                                class="form-select existing-vehicle number @error('form.vehicle_number') is-invalid @enderror"
                                id="vehicle-number" data-placeholder="Select a vehicle number"
                                wire:model="form.vehicle_number">
                                @if (count($vehicleNumbers) === 0)
                                    <option>No Vehicle Numbers available</option>
                                @else
                                    <option>Choose...</option>
                                    @foreach ($vehicleNumbers as $vehicleNumber)
                                        <option value="{{ $vehicleNumber }}">{{ $vehicleNumber }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('form.vehicle_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-4 mb-3">
                            <label for="inception" class="form-label">Insurance Inception</label> <span
                                class="text-danger">*</span>
                            <input type="date" id="inception"
                                class="form-control @error('form.inception') is-invalid @enderror"
                                aria-label="insurance inception" wire:model="form.inception">
                            @error('form.inception')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-4 mb-3">
                            <label for="expiration" class="form-label">Insurance Expiration</label> <span
                                class="text-danger">*</span>
                            <input type="date" id="expiration"
                                class="form-control @error('form.expiration') is-invalid @enderror"
                                aria-label="insurance expiration" wire:model="form.expiration">
                            @error('form.expiration')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-4 mb-3">
                            <label for="policy-number" class="form-label">Policy Number</label> <span
                                class="text-danger">*</span>
                            <input type="text" id="policy-number"
                                class="form-control @error('form.policy_number') is-invalid @enderror"
                                placeholder="Enter policy number" aria-label="insurance policy number"
                                wire:model="form.policy_number">
                            @error('form.policy_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="row mb-3">
                        <label for="upload" class="form-label">Upload Renewal File (Image/PDF)
                            <input type="file" id="upload"
                                class="form-control @error('form.document') is-invalid @enderror"
                                aria-label="upload image/pdf" wire:model="form.document">
                            @error('form.document')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                        x-on:click="$wire.showAddRenewalForm = false">Close</button>
                    <button type="submit" class="btn btn-primary">
                        Submit <span class="spinner-grow spinner-grow-sm" aria-hidden="true" wire:loading></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
