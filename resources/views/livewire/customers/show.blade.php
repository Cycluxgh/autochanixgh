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
            @php
                $now = \Carbon\Carbon::now();
                $insuranceExpire = $insurance?->expiration ? \Carbon\Carbon::parse($insurance?->expiration) : null;
                $nowInstance = \Carbon\Carbon::create($now->year, $now->month, $now->day, $now->hour, $now->minute, $now->second);
                $expirationInstance = $insurance?->expiration ? \Carbon\Carbon::create($insuranceExpire->year, $insuranceExpire->month, $insuranceExpire->day, $insuranceExpire->hour, $insuranceExpire->minute, $insuranceExpire->second) : null;
                $isExpired = $insurance?->expiration ? $expirationInstance <= $nowInstance : false;
            @endphp
            @if($insurance?->expiration)
            <h5>Automobile Insurance</h5>
            <hr>
            <div class="row mb-3">
                <div class="col-4">
                    <label class="form-label">
                        Insurance Inception:</label>&nbsp;&nbsp;<strong>{{ $insurance?->inception ? \Carbon\Carbon::parse($insurance?->inception)->toFormattedDayDateString() : null}}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">
                        Insurance Expiration:</label>&nbsp;&nbsp;<strong class="{{ $isExpired ? 'text-danger' : 'text-success' }}">{{ $insurance?->expiration ? \Carbon\Carbon::parse($insurance?->expiration)->toFormattedDayDateString() : null }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">
                        Insurance Status:</label>&nbsp;&nbsp;<strong class="{{ $isExpired ? 'text-danger' : 'text-success' }}">{{ $isExpired ? 'Expired' : 'Active' }}</strong>
                </div>
            </div>
            @endif
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
