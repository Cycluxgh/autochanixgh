<x-slot:title>Dashboard</x-slot>
<x-slot:page_title>Dashboard</x-slot>
<div>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="row g-3">

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="fs-14 mb-1">Total Customers</div>
                            </div>

                            <div class="d-flex align-items-baseline mb-2">
                                <div class="fs-22 mb-0 me-2 fw-semibold text-black">
                                    {{ $dashboardStats['customers']['total'] }}</div>
                                <div class="me-auto">
                                    <span
                                        class="text-{{ $dashboardStats['customers']['trend'] === \App\TrendEnum::Upwards->value ? 'success' : 'danger' }} d-inline-flex align-items-center">
                                        {{ $dashboardStats['customers']['percent'] }}%
                                        <i data-feather="{{ $dashboardStats['customers']['trend'] === \App\TrendEnum::Upwards->value ? 'trending-up' : 'trending-down' }}"
                                            class="ms-1" style="height: 22px; width: 22px;"></i>
                                    </span>
                                </div>
                            </div>
                            <div id="website-visitors" class="apex-charts"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="fs-14 mb-1">Total Companies</div>
                            </div>

                            <div class="d-flex align-items-baseline mb-2">
                                <div class="fs-22 mb-0 me-2 fw-semibold text-black">
                                    {{ $dashboardStats['companies']['total'] }}</div>
                                <div class="me-auto">
                                    <span
                                        class="text-{{ $dashboardStats['companies']['trend'] === \App\TrendEnum::Upwards->value ? 'success' : 'danger' }} d-inline-flex align-items-center">
                                        {{ $dashboardStats['companies']['percent'] }}%
                                        <i data-feather="{{ $dashboardStats['companies']['trend'] === \App\TrendEnum::Upwards->value ? 'trending-up' : 'trending-down' }}"
                                            class="ms-1" style="height: 22px; width: 22px;"></i>
                                    </span>
                                </div>
                            </div>
                            <div id="conversion-visitors" class="apex-charts"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="fs-14 mb-1">Total Insurances</div>
                            </div>

                            <div class="d-flex align-items-baseline mb-2">
                                <div class="fs-22 mb-0 me-2 fw-semibold text-black">
                                    {{ $dashboardStats['insurances']['total'] }}</div>
                                <div class="me-auto">
                                    <span
                                        class="text-{{ $dashboardStats['insurances']['trend'] === \App\TrendEnum::Upwards->value ? 'success' : 'danger' }} d-inline-flex align-items-center">
                                        {{ $dashboardStats['insurances']['percent'] }}%
                                        <i data-feather="{{ $dashboardStats['insurances']['trend'] === \App\TrendEnum::Upwards->value ? 'trending-up' : 'trending-down' }}"
                                            class="ms-1" style="height: 22px; width: 22px;"></i>
                                    </span>
                                </div>
                            </div>
                            <div id="session-visitors" class="apex-charts"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="fs-14 mb-1">Total Renewals</div>
                            </div>

                            <div class="d-flex align-items-baseline mb-2">
                                <div class="fs-22 mb-0 me-2 fw-semibold text-black">
                                    {{ $dashboardStats['renewals']['total'] }}</div>
                                <div class="me-auto">
                                    <span
                                        class="text-{{ $dashboardStats['renewals']['trend'] === \App\TrendEnum::Upwards->value ? 'success' : 'danger' }} d-inline-flex align-items-center">
                                        {{ $dashboardStats['renewals']['percent'] }}%
                                        <i data-feather="{{ $dashboardStats['renewals']['trend'] === \App\TrendEnum::Upwards->value ? 'trending-up' : 'trending-down' }}"
                                            class="ms-1" style="height: 22px; width: 22px;"></i>
                                    </span>
                                </div>
                            </div>
                            <div id="active-users" class="apex-charts"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end sales -->
    </div> <!-- end row -->

    <!-- Start Monthly Sales -->
    <div class="row">
        <div class="col-md-6 col-xl-8">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                            <i data-feather="bar-chart" class="widgets-icons"></i>
                        </div>
                        <h5 class="card-title mb-0">Chart</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div id="chart" class="apex-charts"></div>
                </div>

            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card overflow-hidden">

                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                            <i data-feather="tablet" class="widgets-icons"></i>
                        </div>
                        <h5 class="card-title mb-0">Growth</h5>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-traffic mb-0">
                            <tbody>
                                <thead>
                                    <tr>
                                        <th>Sector</th>
                                        <th colspan="2">Progress</th>
                                    </tr>
                                </thead>

                                <tr>
                                    <td>Customers</td>
                                    <td>{{ $dashboardStats['customers']['total'] }}</td>
                                    <td class="w-50">
                                        <div class="progress progress-md mt-0">
                                            <div class="progress-bar bg-dark"
                                                style="width: {{ $dashboardStats['customers']['total_percent'] }}%">
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Companies</td>
                                    <td>{{ $dashboardStats['companies']['total'] }}</td>
                                    <td class="w-50">
                                        <div class="progress progress-md mt-0">
                                            <div class="progress-bar bg-info"
                                                style="width: {{ $dashboardStats['companies']['total_percent'] }}%">
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Insurances</td>
                                    <td>{{ $dashboardStats['insurances']['total'] }}</td>
                                    <td class="w-50">
                                        <div class="progress progress-md mt-0">
                                            <div class="progress-bar bg-primary"
                                                style="width: {{ $dashboardStats['insurances']['total_percent'] }}%">
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Diagnosis</td>
                                    <td>{{ $dashboardStats['diagnoses']['total'] }}</td>
                                    <td class="w-50">
                                        <div class="progress progress-md mt-0">
                                            <div class="progress-bar bg-secondary"
                                                style="width: {{ $dashboardStats['diagnoses']['total_percent'] }}%">
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Expirations</td>
                                    <td>{{ $dashboardStats['expirations']['total'] }}</td>
                                    <td class="w-50">
                                        <div class="progress progress-md mt-0">
                                            <div class="progress-bar bg-danger"
                                                style="width: {{ $dashboardStats['expirations']['total_percent'] }}%">
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Renewals</td>
                                    <td>{{ $dashboardStats['renewals']['total'] }}</td>
                                    <td class="w-50">
                                        <div class="progress progress-md mt-0">
                                            <div class="progress-bar bg-success"
                                                style="width: {{ $dashboardStats['renewals']['total_percent'] }}%">
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Monthly Sales -->

    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                            <i data-feather="minus-square" class="widgets-icons"></i>
                        </div>
                        <h5 class="card-title mb-0">Insurances</h5>
                    </div>
                </div>

                <div class="card-body">
                    @include('components.insurance-list')
                </div>

            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        var options = {
            series: [{
                name: 'Statistics',
                type: 'column',
                data: [
                    {{ $dashboardStats['customers']['total'] }},
                    {{ $dashboardStats['companies']['total'] }},
                    {{ $dashboardStats['insurances']['total'] }},
                    {{ $dashboardStats['renewals']['total'] }},
                    {{ $dashboardStats['diagnoses']['total'] }},
                    {{ $dashboardStats['expirations']['total'] }},
                ]
            },],
            chart: {
                height: 350,
                type: 'line',
            },
            stroke: {
                width: [0, 4]
            },
            dataLabels: {
                enabled: true,
                enabledOnSeries: [1]
            },
            labels: ['Customers', 'Companies', 'Insurances', 'Renewals', 'Diagnoses', 'Expirations'],
            yaxis: [{
                title: {
                    text: 'Statistics',
                },

            },]
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
</x-slot:scripts>
