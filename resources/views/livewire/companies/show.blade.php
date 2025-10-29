<x-slot:title>Company</x-slot>
<x-slot:page_title>Company Profile</x-slot>

<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Profile</h5>
                    <button type="button" class="btn btn-primary btn-sm"
                        x-on:click.prevent="$wire.showRenewals = true">View Renewals</button>
                </div>
                <hr>
                <div class="col-8">
                    <div class="row mb-3">
                        <div class="col-4">
                            <label class="form-label">
                                Name:</label>&nbsp;&nbsp;<strong>{{ $company->name }}</strong>
                        </div>
                        <div class="col-4">
                            <label class="form-label">
                                Email:</label>&nbsp;&nbsp;<strong>{{ $company?->email ?? 'No Email' }}</strong>
                        </div>
                        <div class="col-4">
                            <label class="form-label">
                                Contact:</label>&nbsp;&nbsp;<strong>{{ $company->phone }}</strong>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">
                                CEO:</label>&nbsp;&nbsp;<strong>{{ $company?->ceo ?? 'No CEO' }}</strong>
                        </div>

                        <div class="col-6">
                            <label class="form-label">
                                Address:</label>&nbsp;&nbsp;<strong>{{ $company?->address ?? 'No Address' }}</strong>
                        </div>
                    </div>

                </div>
                <div class="col-4">
                    <img src="{{ asset($company?->logo ?? 'assets/images/logo-dark.png') }}" class="img-fluid rounded"
                        alt="logo" data-holder-rendered="true" width="200">
                </div>

            </div>
            <br>
            <h5>Automobile Insurances</h5>
            <hr>
            @foreach ($company->insurances as $insurance)
                @php
                    $isExpired = \Carbon\Carbon::parse($insurance->expiration) <= \Carbon\Carbon::now();
                @endphp
                <div class="row mb-3">
                    <div class="col-3">
                        <label class="form-label">
                            Vehicle Number:
                        </label>&nbsp;&nbsp;<strong>{{ $insurance?->vehicle_number }}</strong>
                    </div>
                    <div class="col-3">
                        <label class="form-label">
                            Insurance Inception:
                        </label>&nbsp;&nbsp;<strong>{{ \Carbon\Carbon::parse($insurance?->inception)->toFormattedDayDateString() }}</strong>
                    </div>
                    <div class="col-3">
                        <label class="form-label">
                            Insurance Expiration:
                        </label>&nbsp;&nbsp;<strong
                            class="{{ $isExpired ? 'text-danger' : 'text-success' }}">{{ \Carbon\Carbon::parse($insurance?->expiration)->toFormattedDayDateString() }}</strong>
                    </div>
                    <div class="col-3">
                        <label class="form-label">
                            Insurance Status:
                        </label>&nbsp;&nbsp;<strong
                            class="{{ $isExpired ? 'text-danger' : 'text-success' }}">{{ $isExpired ? 'Expired' : 'Active' }}</strong>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('livewire.customers.components.renewals-list')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form wire:submit="sendMessage">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <label class="form-label">Compose Message</label>
                        <textarea rows="10" class="form-control mb-3" wire:model="message"></textarea>
                        <button type="submit" class="btn btn-primary btn-md float-end">
                            Send <i data-feather="send"></i>
                            <span class="spinner-grow spinner-grow-sm" aria-hidden="true" wire:loading></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
