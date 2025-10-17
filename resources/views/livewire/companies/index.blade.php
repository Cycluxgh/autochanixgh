<x-slot:title>Companies</x-slot>
<x-slot:page_title>Companies</x-slot>

<!-- Button Datatable -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone number</th>
                        <th>CEO</th>
                        <th>Address</th>
                        <th>Total Insured Vehicles</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td><img src="{{asset($company?->logo ?? 'assets/images/logo-sm.png')}}" alt="" class="img-fluid rounded-circle avatar-sm"></td>
                            <td>{{ ucfirst($company->name) }}</td>
                            <td>{{ $company?->email ?? 'No Email' }}</td>
                            <td>{{ $company->phone }}</td>
                            <td>{{ ucfirst($company?->ceo ?? 'No CEO') }}</td>
                            <td>{{ ucfirst($company?->address ?? 'No Address') }}</td>
                            <td>{{ count($company->insurances) }}</td>
                            <td>
                                <span>
                                    <a href="{{ route('companies.show', ['companyId' => \App\Livewire\Companies\Index::encrypt($company->id)]) }}"
                                       type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                       data-bs-placement="top" data-bs-title="View">
                                        <i class="mdi mdi-eye-outline fs-16 align-middle text-info"
                                           style="cursor: pointer"></i>
                                    </a>
                                    <a href="{{ route('companies.edit', ['companyId' => \App\Livewire\Companies\Index::encrypt($company->id)]) }}"
                                       type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                       data-bs-placement="top" data-bs-title="Edit">
                                        <i class="mdi mdi-pencil fs-16 align-middle text-primary"
                                           style="cursor: pointer"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-title="Delete">
                                        <i class="mdi mdi-trash-can-outline fs-16 align-middle text-danger"
                                           style="cursor: pointer" wire:click="delete({{ $company->id }})"></i>
                                    </button>
{{--                                    <a type="button" class="btn btn-sm"--}}
                                    {{--                                       href="#"--}}
                                    {{--                                       data-bs-toggle="tooltip" data-bs-placement="top"--}}
                                    {{--                                       data-bs-title="Book appointment">--}}
                                    {{--                                        <i class="mdi mdi-calendar-outline fs-16 align-middle text-warning"--}}
                                    {{--                                           style="cursor: pointer"></i>--}}
                                    {{--                                    </a>--}}
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
