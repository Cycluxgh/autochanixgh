<x-slot:title>DVLA</x-slot>
<x-slot:page_title>DVLA List</x-slot>
<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">List</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Customer/Company</th>
                                <th>Contact</th>
                                <th>Vehicle Number</th>
                                <th>Vehicle Make</th>
                                <th>Chassis Number</th>
                                <th>Manufacture Year</th>
                                <th>Fuel</th>
                                <th>Use</th>
                                <th>Entry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dvlas as $dvla)
                                <tr>
                                    <td>{{ $dvla?->customer?->name ?? $dvla?->company?->name }}</td>
                                    <td>{{ $dvla?->customer?->phone ?? $dvla?->company?->phone }}</td>
                                    <td>{{ $dvla->vehicle_number }}</td>
                                    <td>{{ ucfirst($dvla->vehicle_make) }}</td>
                                    <td>{{ $dvla->chassis_number }}</td>
                                    <td>{{ $dvla->manufacture_year }}</td>
                                    <td>{{ ucfirst($dvla->fuel) }}</td>
                                    <td>{{ ucfirst($dvla->use) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($dvla->entry_date)->toFormattedDayDateString() }}</td>
                                    <td>
                                        <span>
                                            <a href="{{ route('drivers.show', ['dvlaId' => \App\Livewire\Drivers\Show::encrypt($dvla->id)]) }}"
                                                type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="View">
                                                <i class="mdi mdi-eye-outline fs-16 align-middle text-info"
                                                    style="cursor: pointer"></i>
                                            </a>
                                            <a href="{{ route('drivers.edit', ['dvlaId' => \App\Livewire\Drivers\Edit::encrypt($dvla->id)]) }}"
                                                type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Edit">
                                                <i class="mdi mdi-pencil fs-16 align-middle text-primary"
                                                    style="cursor: pointer"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Delete">
                                                <i class="mdi mdi-trash-can-outline fs-16 align-middle text-danger"
                                                    style="cursor: pointer"
                                                    wire:click="delete({{ $dvla->id }})"></i>
                                            </button>
                                            {{--                                    <a type="button" class="btn btn-sm" --}}
                                            {{--                                       href="#" --}}
                                            {{--                                       data-bs-toggle="tooltip" data-bs-placement="top" --}}
                                            {{--                                       data-bs-title="Book appointment"> --}}
                                            {{--                                        <i class="mdi mdi-calendar-outline fs-16 align-middle text-warning" --}}
                                            {{--                                           style="cursor: pointer"></i> --}}
                                            {{--                                    </a> --}}
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
