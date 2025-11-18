<x-slot:title>Diagnoses</x-slot>
<x-slot:page_title>Diagnoses</x-slot>
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
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Vehicle Number</th>
                                <th>Diagnosis</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diagnoses as $diagnosis)
                                <tr>
                                    <td>{{ $diagnosis?->customer?->name ?? $diagnosis?->company?->name }}</td>
                                    <td>{{ $diagnosis?->customer?->phone ?? $diagnosis?->company?->phone }}</td>
                                    <td>{{ $diagnosis->vehicle_number }}</td>
                                    <td>{{ $diagnosis->diagnosis }}</td>
                                    <td>
                                        <span>
                                            <a href="{{ route('diagnosis.show', ['diagnosisId' => \App\Livewire\Diagnosis\Index::encrypt($diagnosis->id)]) }}"
                                                type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="View">
                                                <i class="mdi mdi-eye-outline fs-16 align-middle text-info"
                                                    style="cursor: pointer"></i>
                                            </a>
                                            <a href="{{ route('diagnosis.edit', ['diagnosisId' => \App\Livewire\Diagnosis\Index::encrypt($diagnosis->id)]) }}"
                                                type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Edit">
                                                <i class="mdi mdi-pencil fs-16 align-middle text-primary"
                                                    style="cursor: pointer"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Delete">
                                                <i class="mdi mdi-trash-can-outline fs-16 align-middle text-danger"
                                                    style="cursor: pointer"
                                                    wire:click="delete({{ $diagnosis->id }})"></i>
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
