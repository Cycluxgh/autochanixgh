<table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>Customer/Company</th>
            <th>Vehicle Number</th>
            <th>Inception</th>
            <th>Expiration</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($insurances as $insurance)
            @php
                $isExpired = \Carbon\Carbon::parse($insurance->expiration) <= \Carbon\Carbon::today();
                $isCustomer = !!$insurance?->customer?->name;
            @endphp
            <tr>
                <td>
                    @if ($isCustomer)
                        <a href="{{ route('customers.show', ['customerId' => \App\Livewire\Dashboard::encrypt($insurance?->customer_id)]) }}"
                            class="text-primary">{{ $insurance?->customer?->name }}</a>
                    @else
                        <a href="{{ route('companies.show', ['companyId' => \App\Livewire\Dashboard::encrypt($insurance?->company_id)]) }}"
                            class="text-success">{{ $insurance?->company?->name }}</a>
                    @endif
                </td>
                <td>{{ $insurance->vehicle_number }}</td>
                <td>{{ \Carbon\Carbon::parse($insurance->inception)->toFormattedDayDateString() }}</td>
                <td>{{ \Carbon\Carbon::parse($insurance->expiration)->toFormattedDayDateString() }}</td>
                <td>
                    <span
                        class="{{ $isExpired ? 'text-danger' : 'text-success' }}">{{ $isExpired ? 'Expired' : 'Active' }}</span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
