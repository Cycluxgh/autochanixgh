<x-slot:title>Company</x-slot>
<x-slot:page_title>Add Company</x-slot>
<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
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
                    <form class="novalidated" wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label> <span class="text-danger">*</span>
                                    <input class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter name" required wire:model="name">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class=" mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" wire:model="email">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone number</label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" maxlength="10" aria-label="phone number" placeholder="Enter phone number" required wire:model="phone">
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="ceo" class="form-label">CEO</label>
                                    <input type="text" class="form-control @error('ceo') is-invalid @enderror" id="work-place" aria-label="CEO" placeholder="Enter CEO" wire:model="ceo">
                                    @error('ceo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" aria-label="logo" accept="image/*" wire:model="logo">
                                    @error('logo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address @error('address') is-invalid @enderror" aria-label="address" placeholder="Enter address" wire:model="address"></textarea>
                                    @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Automobile Insurance</h5>
                            <button type="button" class="btn btn-primary" wire:click.prevent="addInsurance">Add More Insurance</button>
                        </div>

                        @foreach($insurances as $index => $insurance)
                            <div class="row d-flex align-items-center" wire:key="insurance-{{ $insurance['id'] ?? $index }}">
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label for="vehicle-number" class="form-label">Vehicle Number</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('insurances.' . $index . '.vehicle_number') is-invalid @enderror" id="vehicle-number" aria-label="vehicle number" required placeholder="Enter vehicle number" wire:model="insurances.{{ $index }}.vehicle_number">
                                        @error('insurances.' . $index . '.vehicle_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label for="inception" class="form-label">Inception</label> <span class="text-danger">*</span>
                                        <input type="date" class="form-control @error('insurances.' . $index . '.inception') is-invalid @enderror" id="inception" aria-label="inception" required placeholder="Enter inception" wire:model="insurances.{{ $index }}.inception">
                                        @error('insurances.' . $index . '.inception')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label for="expiration" class="form-label">Expiration</label> <span class="text-danger">*</span>
                                        <input type="date" class="form-control @error('insurances.' . $index . '.expiration') is-invalid @enderror" id="expiration" aria-label="expiration" required placeholder="Enter expiration" wire:model="insurances.{{ $index }}.expiration">
                                        @error('insurances.' . $index . '.expiration')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <br>
                                        <button type="button" class="btn btn-danger" wire:click.prevent="removeInsurance({{ $index }})">Remove</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <button class="btn btn-primary float-end" type="submit">Submit
                            <span class="spinner-grow spinner-grow-sm" aria-hidden="true" wire:loading></span>
                        </button>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
</div>

