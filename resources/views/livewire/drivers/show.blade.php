<x-slot:title>DVLA</x-slot>
<x-slot:page_title>DVLA Profile</x-slot>
<div>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-4">
                    <label class="form-label">Customer/Company:</label>
                    <strong>{{ $dvla?->customer?->name ?? $dvla?->company?->name }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Vehicle Number:</label>
                    <strong>{{ $dvla->vehicle_number }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Vehicle Make:</label>
                    <strong>{{ $dvla?->vehicle_make ?? 'No make' }}</strong>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-4">
                    <label class="form-label">Colour:</label>
                    <strong>{{ $dvla?->colour ?? 'No Colour' }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Model:</label>
                    <strong>{{ $dvla?->model ?? 'No Model' }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Type:</label>
                    <strong>{{ $dvla?->type ?? 'No Type' }}</strong>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-4">
                    <label class="form-label">Chassis Number:</label>
                    <strong>{{ $dvla?->chassis_number ?? 'No Chassis Number' }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Country of Origin:</label>
                    <strong>{{ $dvla?->origin_country ?? 'No Country of Origin' }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Manufacture Year:</label>
                    <strong>{{ $dvla?->manufacture_year ?? 'No Manufacture Year' }}</strong>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-4">
                    <label class="form-label">Length:</label>
                    <strong>{{ $dvla?->length ?? 'No Length' }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Width:</label>
                    <strong>{{ $dvla?->width ?? 'No Width' }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Height:</label>
                    <strong>{{ $dvla?->height ?? 'No Height' }}</strong>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-4">
                    <label class="form-label">Axles Number:</label>
                    <strong>{{ $dvla?->axles_number ?? 0 }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Wheels Number:</label>
                    <strong>{{ $dvla?->wheels_number ?? 0 }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Front Tyres:</label>
                    <strong>{{ $dvla?->front_tyres ?? 'No Front Tyres' }}</strong>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-4">
                    <label class="form-label">Middle Tyres:</label>
                    <strong>{{ $dvla?->middle_tyres ?? 'No Middle Tyres' }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Rear Tyres:</label>
                    <strong>{{ $dvla?->rear_tyres ?? 'No Rear Tyres' }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Front Axle Load:</label>
                    <strong>{{ $dvla?->front_axle_load ?? 'No Front Axle Load' }}</strong>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-4">
                    <label class="form-label">Middle Axle Load:</label>
                    <strong>{{ $dvla?->middle_axle_load ?? 'No Middle Axle Load' }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Rear Axle Load:</label>
                    <strong>{{ $dvla?->rear_axle_load ?? 'No Rear Axle Load' }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">NVW:</label>
                    <strong>{{ $dvla?->nvw ?? 0 }}</strong>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-4">
                    <label class="form-label">GVW:</label>
                    <strong>{{ $dvla?->gvw ?? 0 }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Load:</label>
                    <strong>{{ $dvla?->load ?? 0 }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Persons Capacity:</label>
                    <strong>{{ $dvla?->persons_number ?? 'No Capacity' }}</strong>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-4">
                    <label class="form-label">Engine Number:</label>
                    <strong>{{ $dvla?->engine_number ?? 0 }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Engine Make:</label>
                    <strong>{{ $dvla?->engine_make ?? 'No Engine Make' }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Number of Cylinders:</label>
                    <strong>{{ $dvla?->cylinders_number ?? 0 }}</strong>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-4">
                    <label class="form-label">CC:</label>
                    <strong>{{ $dvla?->cc ?? 'No CC' }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">HP:</label>
                    <strong>{{ $dvla?->hp ?? 'No HP' }}</strong>
                </div>
                <div class="col-4">
                    <label class="form-label">Fuel:</label>
                    <strong>{{ $dvla?->fuel ?? 'No Fuel' }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
