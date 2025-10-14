<x-slot:title>Edit Customers</x-slot>
<x-slot:page_title>Edit Customer</x-slot>

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
                    <form class="novalidated" wire:submit="update">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label> <span class="text-danger">*</span>
                                    <input class="form-control" id="name" placeholder="Enter name" required wire:model="name">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class=" mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" wire:model="email">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone number</label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="phone" maxlength="10" aria-label="phone number" placeholder="Enter phone number" required wire:model="phone">
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" aria-label="gender" wire:model="gender">
                                        <option>Choose...</option>
                                        @foreach(\App\GenderEnum::cases() as $gender)
                                            <option value="{{ $gender->value }}">{{ ucfirst($gender->value) }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-6"><div class="mb-3">
                                    <label for="marital-status" class="form-label">Marital Status</label>
                                    <select class="form-select" id="marital-status" aria-label="marital status" wire:model="marital_status">
                                        <option>Choose...</option>
                                        @foreach(\App\MaritalStatusEnum::cases() as $status)
                                            <option value="{{ $status->value }}">{{ ucfirst($status->value) }}</option>
                                        @endforeach
                                    </select>
                                    @error('marital_status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div></div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="work-place" class="form-label">Workplace</label>
                                    <input type="text" class="form-control" id="work-place" aria-label="work place" placeholder="Enter work place" wire:model="work_place">
                                    @error('work_place')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" aria-label="image" accept="image/*" wire:model="image">
                                    @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" aria-label="address" placeholder="Enter address" wire:model="address"></textarea>
                                    @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <h6>Automobile Insurance</h6>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="work-place" class="form-label">Inception</label> <span class="text-danger">*</span>
                                    <input type="date" class="form-control" id="inception" aria-label="inception" required placeholder="Enter inception" wire:model="inception">
                                    @error('inception')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="work-place" class="form-label">Expiration</label> <span class="text-danger">*</span>
                                    <input type="date" class="form-control" id="expiration" aria-label="expiration" required placeholder="Enter expiration" wire:model="expiration">
                                    @error('expiration')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary float-end" type="submit">Save
                            <span class="spinner-grow spinner-grow-sm" aria-hidden="true" wire:loading></span>
                        </button>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
</div>
