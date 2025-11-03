<x-slot:title>Message</x-slot>
<x-slot:page_title>Send Message</x-slot>
<div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <form wire:submit="save">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="example-select" class="form-label">Select existing customer</label>
                            <select class="form-select" data-placeholder="Select a customer"
                                wire:model="customerContacts" multiple>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->phone }}">{{ ucfirst($customer->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="example-select" class="form-label">Select existing company</label>
                            <select class="form-select" data-placeholder="Select a company"
                                wire:model="companyContacts" multiple>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->phone }}">{{ ucfirst($company->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleColorInput" class="form-label">Compose Message</label>
                            <textarea rows="20" id="diagnosis" class="form-control @error('message') is-invalid @enderror"
                                      wire:model="message"></textarea>
                            @error('message')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-md float-end">
                            Send <i data-feather="send"></i>
                            <span class="spinner-grow spinner-grow-sm" aria-hidden="true" wire:loading></span>
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
