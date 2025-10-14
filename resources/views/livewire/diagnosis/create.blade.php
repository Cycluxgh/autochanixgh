<x-slot:title>Diagnosis</x-slot>
<x-slot:page_title>Add Diagnosis</x-slot>
<div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <form wire:submit="save">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="example-select" class="form-label">Select a customer</label>
                            <select class="form-select customers-select" data-placeholder="Select a customer" required wire:model="customerId">
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ ucfirst($customer->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleColorInput" class="form-label">Diagnosis report</label>
                            <textarea rows="20" id="diagnosis" class="form-control" required wire:model="diagnosis" placeholder="Write your diagnosis..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-md float-end">
                            Submit <span class="spinner-grow spinner-grow-sm" aria-hidden="true" wire:loading></span>
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
