<x-slot:title>DVLA</x-slot>
<x-slot:page_title>Edit DVLA</x-slot>
<div>
    <div class="card">
        <div class="card-body">
            <form class="row g-3" wire:submit="update">
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
                <div class="col-md-6">
                    <label for="customer-list" class="form-label">Customer/Company</label> <span
                        class="text-danger">*</span>
                    <input type="text" class="form-control" readonly wire:model="customer">
                </div>
                <div class="col-md-6">
                    <label for="vehicle-number" class="form-label">Vehicle Number</label> <span
                        class="text-danger">*</span>
                    <input type="text" class="form-control @error('form.vehicle_number') is-invalid @enderror"
                        id="vehicle-number" wire:model="form.vehicle_number" required>
                    @error('form.vehicle_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{--                <div class="col-md-3"> --}}
                {{--                    <label for="owner" class="form-label">Owner</label> <span class="text-danger">*</span> --}}
                {{--                    <input type="text" class="form-control" id="owner" wire:model="owner" required> --}}
                {{--                    @error('owner') --}}
                {{--                    <div class="invalid-feedback"> --}}
                {{--                        {{ $message }} --}}
                {{--                    </div> --}}
                {{--                    @enderror --}}
                {{--                </div> --}}
                {{--                <div class="col-md-3"> --}}
                {{--                    <label for="post-address" class="form-label">Post Address</label> <span class="text-danger">*</span> --}}
                {{--                    <textarea type="text" class="form-control" id="post-address" aria-describedby="post address" wire:model="post_address" required> --}}
                {{--                    </textarea> --}}
                {{--                    @error('post_address') --}}
                {{--                    <div class="invalid-feedback"> --}}
                {{--                        {{ $message }} --}}
                {{--                    </div> --}}
                {{--                    @enderror --}}
                {{--                </div> --}}
                {{--                <div class="col-md-3"> --}}
                {{--                    <label for="residential-address" class="form-label">Residential Address</label> <span class="text-danger">*</span> --}}
                {{--                    <textarea type="text" class="form-control" id="residential-address" aria-describedby="residential address" wire:model="residential_address" required> --}}
                {{--                    </textarea> --}}
                {{--                    @error('residential_address') --}}
                {{--                    <div class="invalid-feedback"> --}}
                {{--                        {{ $message }} --}}
                {{--                    </div> --}}
                {{--                    @enderror --}}
                {{--                </div> --}}
                <div class="col-md-6">
                    <label for="make-vehicle" class="form-label">Make of Vehicle</label>
                    <input type="text" class="form-control @error('form.vehicle_make') is-invalid @enderror"
                        id="make-vehicle" aria-describedby="make of vehicle" wire:model="form.vehicle_make">
                    @error('form.vehicle_make')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="colour" class="form-label">Colour</label>
                    <input type="text" class="form-control @error('form.colour') is-invalid @enderror" id="colour"
                        aria-describedby="colour" wire:model="form.colour">
                    @error('form.colour')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" class="form-control @error('form.model') is-invalid @enderror" id="model"
                        aria-describedby="model" wire:model="form.model">
                    @error('form.model')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="type" class="form-label">Type</label>
                    <input type="text" class="form-control @error('form.type') is-invalid @enderror" id="type"
                        aria-describedby="type" wire:model="form.type">
                    @error('form.type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="chassis-number" class="form-label">Chassis Number</label>
                    <input type="text" class="form-control @error('form.chassis_number') is-invalid @enderror"
                        id="chassis-number" aria-describedby="chassis number" wire:model="form.chassis_number">
                    @error('form.chassis_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="origin-country" class="form-label">Country of Origin</label>
                    <input type="text" class="form-control" id="origin-country" aria-describedby="country of origin"
                        wire:model="form.origin_country">
                    @error('form.origin_country')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="manufacture-year" class="form-label">Year of manufacture</label>
                    <input type="date" class="form-control @error('manufacture_year') is-invalid @enderror"
                        id="manufacture-year" aria-describedby="year of manufacture" wire:model="form.manufacture_year">
                    @error('form.manufacture_year')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <h5>Measurement (cm)</h5>
                <div class="col-md-4">
                    <label for="length" class="form-label">Length</label>
                    <input type="number" class="form-control @error('form.length') is-invalid @enderror"
                        id="length" aria-describedby="length" wire:model="form.length">
                    @error('form.length')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="width" class="form-label">Width</label>
                    <input type="number" class="form-control @error('form.width') is-invalid @enderror"
                        id="width" aria-describedby="width" wire:model="form.width">
                    @error('form.width')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="height" class="form-label">Height</label>
                    <input type="number" class="form-control @error('form.height') is-invalid @enderror"
                        id="height" aria-describedby="height" wire:model="form.height">
                    @error('form.height')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="axles-number" class="form-label">Number of Axles</label>
                    <input type="number" class="form-control @error('form.axles_number') is-invalid @enderror"
                        id="axles-number" aria-describedby="number of axles" wire:model="form.axles_number">
                    @error('form.axles-number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="wheels-number" class="form-label">Number of Wheels</label>
                    <input type="number" class="form-control @error('form.wheels_number') is-invalid @enderror"
                        id="wheels-number" aria-describedby="number of wheels" wire:model="form.wheels_number">
                    @error('form.wheels_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <h5>Sizes of Tyres</h5>
                <div class="col-md-4">
                    <label for="front" class="form-label">Front</label>
                    <input type="text" class="form-control @error('form.front_tyres') is-invalid @enderror"
                        id="front" aria-describedby="front" wire:model="form.front_tyres">
                    @error('form.front_tyres')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="middle" class="form-label">Middle</label>
                    <input type="text" class="form-control @error('form.middle.tyres') is-invalid @enderror"
                        id="middle" aria-describedby="middle" wire:model="form.middle_tyres">
                    @error('form.middle_tyres')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="rear" class="form-label">Rear</label>
                    <input type="text" class="form-control @error('form.rear_tyres') is-invalid @enderror"
                        id="rear" aria-describedby="rear" wire:model="form.rear_tyres">
                    @error('form.rear_tyres')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <h5>Perm. Axle Load (kg)</h5>
                <div class="col-md-4">
                    <label for="front-axle" class="form-label">Front</label>
                    <input type="text" class="form-control @error('form.front_axle_load') is-invalid @enderror"
                        id="front-axle" aria-describedby="front" wire:model="form.front_axle_load">
                    @error('form.front_axle_load')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="middle-axle" class="form-label">Middle</label>
                    <input type="text" class="form-control @error('form.middle_axle_load') is-invalid @enderror"
                        id="middle-axle" aria-describedby="middle" wire:model="form.middle_axle_load">
                    @error('form.middle-axle_load')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="rear-axle" class="form-label">Rear</label>
                    <input type="text" class="form-control @error('form.rear_axle_load') is-invalid @enderror"
                        id="rear-axle" aria-describedby="rear" wire:model="form.rear_axle_load">
                    @error('form.rear-axle_load')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <h5>Weight (Kg)</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nvw" class="form-label">NVW</label>
                                <input type="number" class="form-control @error('form.nvw') is-invalid @enderror"
                                    id="nvw" aria-describedby="nvw" wire:model="form.nvw">
                                @error('form.nvw')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="gvm" class="form-label">GVW</label>
                                <input type="number" class="form-control @error('form.gvw') is-invalid @enderror"
                                    id="gvw" aria-describedby="gvw" wire:model="form.gvw">
                                @error('form.gvw')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Perm. Capacity</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="load" class="form-label">Load (Kg)</label>
                                <input type="number" class="form-control @error('form.load') is-invalid @enderror"
                                    id="load" aria-describedby="load" wire:model="form.load">
                                @error('form.load')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="persons-capacity" class="form-label">Number of Persons</label>
                                <input type="number"
                                    class="form-control @error('form.persons_number') is-invalid @enderror"
                                    id="persons-capacity" aria-describedby="number of persons"
                                    wire:model="form.persons_number">
                                @error('form.persons_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <h5>Engine</h5>
                <div class="col-md-3">
                    <label for="make" class="form-label">Make</label>
                    <input type="text" class="form-control @error('form.engine_make') is-invalid @enderror"
                        id="make" aria-describedby="make" wire:model="form.engine_make">
                    @error('form.engine_make')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="engine-number" class="form-label">Engine Number</label>
                    <input type="number" class="form-control @error('form.engine_number') is-invalid @enderror"
                        id="engine-number" aria-describedby="engine number" wire:model="form.engine_number">
                    @error('form.engine_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="cylinder-number" class="form-label">Number of Cylinders</label>
                    <input type="number" class="form-control @error('form.cylinders_number') is-invalid @enderror"
                        id="cylinder-number" aria-describedby="number of cylinders"
                        wire:model="form.cylinders_number">
                    @error('form.cylinder_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="cc" class="form-label">CC</label>
                    <input type="text" class="form-control @error('form.cc') is-invalid @enderror" id="cc"
                        aria-describedby="cc" wire:model="form.cc">
                    @error('form.cc')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="hp" class="form-label">HP</label>
                    <input type="text" class="form-control" id="hp" aria-describedby="hp"
                        wire:model="form.hp">
                    @error('form.hp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="fuel" class="form-label">Fuel</label>
                    <input type="text" class="form-control @error('form.fuel') is-invalid @enderror"
                        id="fuel" aria-describedby="fuel" wire:model="form.fuel">
                    @error('form.fuel')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="private-commercial" class="form-label">Use Private/Commercial</label>
                    <input type="text" class="form-control @error('form.use') is-invalid @enderror"
                        id="private-commercial" aria-describedby="use private/commercial" wire:model="form.use">
                    @error('form.use')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="date-entry" class="form-label">Date of Entry</label>
                    <input type="date" class="form-control @error('form.entry_date') is-invalid @enderror"
                        id="date-entry" aria-describedby="date of entry" wire:model="form.entry_date">
                    @error('form.entry_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-12">
                    <button class="btn btn-primary float-end" type="submit">
                        Save
                        <span class="spinner-grow spinner-grow-sm" aria-hidden="true" wire:loading></span>
                    </button>
                </div>
            </form>
        </div> <!-- end card-body -->
    </div>
</div>
