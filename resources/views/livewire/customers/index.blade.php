<x-slot:title>Customers</x-slot>
<x-slot:page_title>Customers</x-slot>

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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone number</th>
                        <th>Gender</th>
                        <th>Marital Status</th>
                        <th>Work Place</th>
                        <th>Insurance Expiration</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td><img src="{{asset($customer?->image ?? 'assets/images/logo-sm.png')}}" alt="" class="img-fluid rounded-circle avatar-sm"></td>
                            <td>{{ ucfirst($customer->name) }}</td>
                            <td>{{ ucfirst($customer->email ?? 'No Email') }}</td>
                            <td>{{ ucfirst($customer->phone) }}</td>
                            <td>{{ ucfirst($customer->gender ?? 'No Gender') }}</td>
                            <td>{{ ucfirst($customer->marital_status) }}</td>
                            <td>{{ ucfirst($customer->work_place ?? 'No Work place') }}</td>
                            <td>
                                <span
                                    class="text-{{ \Carbon\Carbon::parse($customer?->insurance?->expiration) <= \Carbon\Carbon::now() ? 'danger' : 'success' }}">
                                    {{ $customer?->insurance?->expiration ? \Carbon\Carbon::parse($customer?->insurance?->expiration)->toFormattedDayDateString() : null }}
                                </span>
                            </td>
                            <td>
                                <span>
                                    <a href="{{ route('customers.show', ['customerId' => \App\Livewire\Customers\Index::encrypt($customer->id)]) }}"
                                       type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                       data-bs-placement="top" data-bs-title="View">
                                        <i class="mdi mdi-eye-outline fs-16 align-middle text-info"
                                           style="cursor: pointer"></i>
                                    </a>
                                    <a href="{{ route('customers.edit', ['customerId' => \App\Livewire\Customers\Index::encrypt($customer->id)]) }}"
                                       type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-title="Edit">
                                        <i class="mdi mdi-pencil fs-16 align-middle text-primary"
                                           style="cursor: pointer"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-title="Delete">
                                        <i class="mdi mdi-trash-can-outline fs-16 align-middle text-danger"
                                           style="cursor: pointer" wire:click="delete({{ $customer->id }})"></i>
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
