<x-slot:title>Renewals</x-slot>
<x-slot:page_title>Renewals</x-slot>
<div>
    <div class="row" wire:show="showAddRenewalForm" x-transition.duration.500ms>
        <div class="card">
            <h5 class="card-header">Add Renewal</h5>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="modal-body">
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
                        <div class="row">
                            @if (!$hideCustomersSelect)
                                <div class="col-{{ $size }} mb-3">
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
                                <div class="col-{{ $size }} mb-3">
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

                            <div class="col-{{ $size }} mb-3">
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

                            <div class="col-4 mb-3">
                                <label for="inception" class="form-label">Insurance Inception</label>
                                <input type="date" id="inception" class="form-control @error('inception') is-invalid @enderror" aria-label="insurance inception" wire:model="inception">
                                @error('inception')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-4 mb-3">
                                <label for="expiration" class="form-label">Insurance Expiration</label>
                                <input type="date" id="expiration" class="form-control @error('expiration') is-invalid @enderror" aria-label="insurance expiration" wire:model="expiration">
                                @error('expiration')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-4 mb-3">
                                <label for="upload" class="form-label">Upload Renewal File (Image/PDF)</label>
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
                        <button type="button" class="btn btn-light" x-on:click="$wire.showAddRenewalForm = false">Close</button>
                        <button type="submit" class="btn btn-primary">
                            Submit <span class="spinner-grow spinner-grow-sm" aria-hidden="true" wire:loading></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Responsive Datatable -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">List</h5>
                    <button type="button" class="btn btn-primary btn-sm" x-on:click="$wire.showAddRenewalForm = true">Add Renewal</button>
                </div><!-- end card header -->
{{--                @include('components.modal')--}}

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>Customer/Company</th>
                            <th>Contact</th>
                            <th>Vehicle Number</th>
                            <th>Document URL</th>
                            <th>Created date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($renewals as $renewal)
                            <tr>
                                <td>{{ ucfirst($renewal?->customer?->name ?? $renewal?->company?->name) }}</td>
                                <td>{{ ucfirst($renewal?->customer?->phone ?? $renewal?->company?->phone) }}</td>
                                <td>{{ $renewal?->vehicle_number }}</td>
                                <td>{{ asset($renewal->document) }}</td>
                                <td>{{ \Carbon\Carbon::parse($renewal->created_at)->toFormattedDayDateString() }}</td>
                                <td>
                                    <span>
                                    <a href="#"
                                       type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                       data-bs-placement="top" data-bs-title="View">
                                        <i class="mdi mdi-eye-outline fs-16 align-middle text-info"
                                           style="cursor: pointer"></i>
                                    </a>
                                    <a href="#"
                                       type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                       data-bs-placement="top" data-bs-title="Edit">
                                        <i class="mdi mdi-pencil fs-16 align-middle text-primary"
                                           style="cursor: pointer"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-title="Delete">
                                        <i class="mdi mdi-trash-can-outline fs-16 align-middle text-danger"
                                           style="cursor: pointer" wire:click="delete({{ $renewal->id }})"></i>
                                    </button>
                                </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
