<x-slot:title>Customer Profile</x-slot>
<x-slot:page_title>Customer Profile</x-slot>

<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h5>Profile</h5>
                <hr>
                <div class="col-8">
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">
                                Name:</label>&nbsp;&nbsp;<strong>{{ $customer->name }}</strong>
                        </div>
                        <div class="col-6">
                            <label class="form-label">
                                Email:</label>&nbsp;&nbsp;<strong>{{ $customer?->email ?? 'No Email' }}</strong>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">
                                Contact:</label>&nbsp;&nbsp;<strong>{{ $customer->phone }}</strong>
                        </div>
                        <div class="col-6">
                            <label class="form-label">
                                Gender:</label>&nbsp;&nbsp;<strong>{{ ucfirst($customer?->gender ?? 'No Gender') }}</strong>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">
                                Marital Status:</label>&nbsp;&nbsp;<strong>{{ ucfirst($customer?->marital_status ?? 'No Marital Status') }}</strong>
                        </div>
                        <div class="col-6">
                            <label class="form-label">
                                Workplace:</label>&nbsp;&nbsp;<strong>{{ ucfirst($customer?->work_place ?? 'No work place') }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <img src="{{asset($customer?->image ?? 'assets/images/logo-dark.png')}}" class="img-fluid rounded" alt="Thumbnails" data-holder-rendered="true" width="200">
                </div>

            </div>
            <br>
            <h5>Automobile Insurances</h5>
            <hr>
            @foreach($customer->insurances as $insurance)
                @php
                    $isExpired = \Carbon\Carbon::parse($insurance->expiration) <= \Carbon\Carbon::now();
                @endphp
                <div class="row mb-3">
                    <div class="col-3">
                        <label class="form-label">
                            Vehicle Number:
                        </label>&nbsp;&nbsp;<strong>{{ $insurance?->vehicle_number}}</strong>
                    </div>
                    <div class="col-3">
                        <label class="form-label">
                            Insurance Inception:
                        </label>&nbsp;&nbsp;<strong>{{ \Carbon\Carbon::parse($insurance?->inception)->toFormattedDayDateString()}}</strong>
                    </div>
                    <div class="col-3">
                        <label class="form-label">
                            Insurance Expiration:
                        </label>&nbsp;&nbsp;<strong class="{{ $isExpired ? 'text-danger' : 'text-success' }}">{{ \Carbon\Carbon::parse($insurance?->expiration)->toFormattedDayDateString() }}</strong>
                    </div>
                    <div class="col-3">
                        <label class="form-label">
                            Insurance Status:
                        </label>&nbsp;&nbsp;<strong class="{{ $isExpired ? 'text-danger' : 'text-success' }}">{{ $isExpired ? 'Expired' : 'Active' }}</strong>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form>
                        <label class="form-label">Compose Message</label>
                        <textarea rows="10" class="form-control mb-3"></textarea>
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
