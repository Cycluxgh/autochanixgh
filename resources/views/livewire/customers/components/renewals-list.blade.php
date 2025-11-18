<!-- Alternative Pagination Datatable -->
<div class="col-12" wire:show="showRenewals" x-transition.duration.500ms>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Renewals</h5>
            <button type="button" class="btn btn-primary btn-sm"
                x-on:click.prevent="$wire.showRenewals = false">Hide</button>
        </div><!-- end card header -->

        <div class="card-body">
            <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>Vehicle Number</th>
                        <th>Policy Number</th>
                        <th>Renewal Document</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($renewals as $renewal)
                        <tr>
                            <td>{{ $renewal->vehicle_number }}</td>
                            <td>{{ $renewal->policy_number }}</td>
                            <td>
                                @if ($renewal->document)
                                    <a href="{{ asset($renewal->document) }}" class="text-primary" target="_blank">Document
                                        Link</a>
                                @else
                                    <span class="text-danger">No Document Attached</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
