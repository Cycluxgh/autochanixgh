<x-slot:title>Renewals</x-slot>
<x-slot:page_title>Renewals</x-slot>
<div>
    @include('livewire.renewals.components.renewals.create')
    @include('livewire.renewals.components.renewals.edit')
    <!-- Responsive Datatable -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">List</h5>
                    <button type="button" class="btn btn-primary btn-sm"
                        x-on:click.prevent="$wire.showAddRenewalForm = true">Add Renewal</button>
                </div><!-- end card header -->
                {{--                @include('components.modal') --}}

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
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
                            @foreach ($renewals as $renewal)
                                <tr>
                                    <td>{{ ucfirst($renewal?->customer?->name ?? $renewal?->company?->name) }}</td>
                                    <td>{{ ucfirst($renewal?->customer?->phone ?? $renewal?->company?->phone) }}</td>
                                    <td>{{ $renewal?->vehicle_number }}</td>
                                    <td>
                                        @if ($renewal->document)
                                            <a href="{{ asset($renewal->document) }}" target="_blank"
                                               class="text-primary">Document link</a>
                                        @else
                                            No File Attached
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($renewal->created_at)->toFormattedDayDateString() }}
                                    </td>
                                    <td>
                                        <span>
                                            {{--                                    <a href="#" --}}
                                            {{--                                       type="button" class="btn btn-sm" data-bs-toggle="tooltip" --}}
                                            {{--                                       data-bs-placement="top" data-bs-title="View"> --}}
                                            {{--                                        <i class="mdi mdi-eye-outline fs-16 align-middle text-info" --}}
                                            {{--                                           style="cursor: pointer"></i> --}}
                                            {{--                                    </a> --}}
                                            <a href="#" type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Edit"
                                                x-on:click="$wire.showEditRenewalForm = true"
                                                wire:click="edit({{ $renewal->id }})">
                                                <i class="mdi mdi-pencil fs-16 align-middle text-primary"
                                                    style="cursor: pointer"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Delete">
                                                <i class="mdi mdi-trash-can-outline fs-16 align-middle text-danger"
                                                    style="cursor: pointer"
                                                    wire:click.prevent="delete({{ $renewal->id }})"></i>
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
