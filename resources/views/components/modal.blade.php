<!-- Default Modal -->
<div class="modal fade" id="standard-modal" tabindex="-1" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="standard-modalLabel">Add Renewal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="save">
                <div class="modal-body">
                    <div class="row">
                        @if (!$hideCustomersSelect)
                        <div class="col-12 mb-3">
                            <label for="customers" class="form-label">Existing Customers</label>
                            <select class="form-select message-customers @error('customer_id') is-invalid @enderror" data-placeholder="Select a customer" wire:model="customer_id" wire:change.prevent="handleCustomersOption($event.target.value)">
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ ucfirst($customer->name) }}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @endif

                        @if (!$hideCompaniesSelect)
                        <div class="col-12 mb-3">
                            <label for="companies" class="form-label">Existing Companies</label>
                            <select class="form-select existing-company @error('company_id') is-invalid @enderror" id="companies" data-placeholder="Select a company" wire:model="company_id" wire:change.prevent="handleCompaniesOption($event.target.value)">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ ucfirst($company->name) }}</option>
                                @endforeach
                            </select>
                            @error('company_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @endif

                        <div class="col-12 mb-3">
                            <label for="vehicle-number" class="form-label">Vehicle Number</label>
                            <select class="form-select existing-vehicle number @error('vehicle_number') is-invalid @enderror" id="vehicle-number" data-placeholder="Select a vehicle number" wire:model="vehicle_number">
                                @if(count($vehicleNumbers) === 0)
                                    <option>No Vehicle Numbers available</option>
                                @else
                                    <option>Choose...</option>
                                    @foreach($vehicleNumbers as $vehicleNumber)
                                        <option value="{{ $vehicleNumber }}">{{ $vehicleNumber }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('vehicle_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="upload" class="form-label">Upload Image/PDF</label>
                            <input type="file" id="upload" class="form-control @error('document') is-invalid @enderror" aria-label="upload image/pdf" wire:model="document">
                            @error('document')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        Submit <span class="spinner-grow spinner-grow-sm" aria-hidden="true" wire:loading></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
