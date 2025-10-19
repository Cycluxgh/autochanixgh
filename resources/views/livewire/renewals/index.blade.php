<x-slot:title>Renewals</x-slot>
<x-slot:page_title>Renewals</x-slot>
<div>
    <div class="row" wire:show="showForm" x-transition.duration.500ms>
        <div class="card">
            <h5 class="card-header">Add Renewal</h5>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row">
                            @if (!$hideCustomersSelect)
                                <div class="col-{{ $size }} mb-3">
                                    <label for="customers" class="form-label">Existing Customers</label>
                                    <select class="form-select message-customers @error('customer_id') is-invalid @enderror" data-placeholder="Select a customer" wire:model="customer_id" wire:change.prevent="handleCustomersOption($event.target.value)">
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ ucfirst($customer->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            @endif

                            @if (!$hideCompaniesSelect)
                                <div class="col-{{ $size }} mb-3">
                                    <label for="companies" class="form-label">Existing Companies</label>
                                    <select class="form-select existing-company @error('company_id') is-invalid @enderror" id="companies" data-placeholder="Select a company" wire:model="company_id" wire:change.prevent="handleCompaniesOption($event.target.value)">
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">{{ ucfirst($company->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('company_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            @endif

                            <div class="col-{{ $size }} mb-3">
                                <label for="vehicle-number" class="form-label">Vehicle Number</label>
                                <select class="form-select existing-vehicle number @error('vehicle_number') is-invalid @enderror" id="vehicle-number" data-placeholder="Select a vehicle number" wire:model="vehicle_number">
                                    @if(count($vehicleNumbers) === 0)
                                        <option>No Vehicle Numbers available</option>
                                    @else
                                        <option>Choose...</option>
                                        @foreach($vehicleNumbers as $vehicleNumber)
                                            <option value="{{ $vehicleNumber }}">{{ $vehicleNumber }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('vehicle_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-{{ $size }} mb-3">
                                <label for="upload" class="form-label">Upload Image/PDF</label>
                                <input type="file" id="upload" class="form-control @error('document') is-invalid @enderror" aria-label="upload image/pdf" wire:model="document">
                                @error('document')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" x-on:click="$wire.showForm = false">Close</button>
                        <button type="submit" class="btn btn-primary">
                            Submit <span class="spinner-grow spinner-grow-sm" aria-hidden="true" wire:loading></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Responsive Datatable -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">List</h5>
                    <button type="button" class="btn btn-primary btn-sm" x-on:click="$wire.showForm = true">Add Renewal</button>
                </div><!-- end card header -->
                @include('components.modal')

                <div class="card-body">
                    <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>John Smith</td>
                            <td>Project Manager</td>
                            <td>Los Angeles</td>
                            <td>35</td>
                            <td>2023-08-10</td>
                            <td>$110,000</td>
                        </tr>
                        <tr>
                            <td>Emily Davis</td>
                            <td>Marketing Specialist</td>
                            <td>Chicago</td>
                            <td>29</td>
                            <td>2022-12-05</td>
                            <td>$85,000</td>
                        </tr>
                        <tr>
                            <td>Michael Brown</td>
                            <td>Software Engineer</td>
                            <td>San Francisco</td>
                            <td>31</td>
                            <td>2023-04-18</td>
                            <td>$120,000</td>
                        </tr>
                        <tr>
                            <td>Sarah Wilson</td>
                            <td>Financial Analyst</td>
                            <td>Houston</td>
                            <td>28</td>
                            <td>2023-10-30</td>
                            <td>$95,000</td>
                        </tr>
                        <tr>
                            <td>David Miller</td>
                            <td>Product Manager</td>
                            <td>Seattle</td>
                            <td>33</td>
                            <td>2022-09-15</td>
                            <td>$125,000</td>
                        </tr>
                        <tr>
                            <td>Jessica Thompson</td>
                            <td>HR Specialist</td>
                            <td>Miami</td>
                            <td>30</td>
                            <td>2023-01-25</td>
                            <td>$80,000</td>
                        </tr>
                        <tr>
                            <td>Matthew Lee</td>
                            <td>Data Scientist</td>
                            <td>Denver</td>
                            <td>34</td>
                            <td>2022-11-08</td>
                            <td>$130,000</td>
                        </tr>
                        <tr>
                            <td>Olivia Garcia</td>
                            <td>Graphic Designer</td>
                            <td>Atlanta</td>
                            <td>27</td>
                            <td>2023-07-20</td>
                            <td>$75,000</td>
                        </tr>
                        <tr>
                            <td>James Hernandez</td>
                            <td>Business Analyst</td>
                            <td>Phoenix</td>
                            <td>32</td>
                            <td>2023-03-12</td>
                            <td>$100,000</td>
                        </tr>
                        <tr>
                            <td>Emma Martinez</td>
                            <td>UX/UI Designer</td>
                            <td>Portland</td>
                            <td>29</td>
                            <td>2023-09-05</td>
                            <td>$90,000</td>
                        </tr>
                        <tr>
                            <td>William Clark</td>
                            <td>Software Developer</td>
                            <td>Boston</td>
                            <td>28</td>
                            <td>2023-05-28</td>
                            <td>$115,000</td>
                        </tr>
                        <tr>
                            <td>Ava Taylor</td>
                            <td>Content Writer</td>
                            <td>Philadelphia</td>
                            <td>26</td>
                            <td>2022-10-22</td>
                            <td>$70,000</td>
                        </tr>
                        <tr>
                            <td>Joseph White</td>
                            <td>Project Coordinator</td>
                            <td>Dallas</td>
                            <td>31</td>
                            <td>2023-02-15</td>
                            <td>$85,000</td>
                        </tr>
                        <tr>
                            <td>Sophia Perez</td>
                            <td>Systems Analyst</td>
                            <td>San Diego</td>
                            <td>30</td>
                            <td>2023-12-10</td>
                            <td>$105,000</td>
                        </tr>
                        <tr>
                            <td>Daniel Scott</td>
                            <td>Marketing Manager</td>
                            <td>Charlotte</td>
                            <td>33</td>
                            <td>2023-06-18</td>
                            <td>$110,000</td>
                        </tr>
                        <tr>
                            <td>Isabella Rodriguez</td>
                            <td>Financial Advisor</td>
                            <td>Las Vegas</td>
                            <td>27</td>
                            <td>2023-11-05</td>
                            <td>$95,000</td>
                        </tr>
                        <tr>
                            <td>Logan Nguyen</td>
                            <td>Product Designer</td>
                            <td>Minneapolis</td>
                            <td>32</td>
                            <td>2022-12-30</td>
                            <td>$120,000</td>
                        </tr>
                        <tr>
                            <td>Mia Kim</td>
                            <td>HR Manager</td>
                            <td>Orlando</td>
                            <td>29</td>
                            <td>2023-08-25</td>
                            <td>$100,000</td>
                        </tr>
                        <tr>
                            <td>Benjamin King</td>
                            <td>Data Engineer</td>
                            <td>Salt Lake City</td>
                            <td>34</td>
                            <td>2022-09-10</td>
                            <td>$125,000</td>
                        </tr>
                        <tr>
                            <td>Charlotte Thomas</td>
                            <td>Business Development Manager</td>
                            <td>Tampa</td>
                            <td>31</td>
                            <td>2023-03-28</td>
                            <td>$95,000</td>
                        </tr>
                        <tr>
                            <td>Ethan Martinez</td>
                            <td>Software Tester</td>
                            <td>Austin</td>
                            <td>28</td>
                            <td>2023-10-15</td>
                            <td>$115,000</td>
                        </tr>
                        <tr>
                            <td>Madison Jackson</td>
                            <td>UX/UI Developer</td>
                            <td>Washington D.C.</td>
                            <td>30</td>
                            <td>2023-01-10</td>
                            <td>$90,000</td>
                        </tr>
                        <tr>
                            <td>Lucas Adams</td>
                            <td>Content Manager</td>
                            <td>San Jose</td>
                            <td>27</td>
                            <td>2022-07-22</td>
                            <td>$75,000</td>
                        </tr>
                        <tr>
                            <td>Chloe Walker</td>
                            <td>Project Analyst</td>
                            <td>Detroit</td>
                            <td>32</td>
                            <td>2023-05-05</td>
                            <td>$110,000</td>
                        </tr>
                        <tr>
                            <td>Jack Wright</td>
                            <td>Technical Writer</td>
                            <td>Indianapolis</td>
                            <td>26</td>
                            <td>2023-02-20</td>
                            <td>$80,000</td>
                        </tr>
                        <tr>
                            <td>Hannah Baker</td>
                            <td>Systems Administrator</td>
                            <td>Charlotte</td>
                            <td>33</td>
                            <td>2023-09-18</td>
                            <td>$105,000</td>
                        </tr>
                        <tr>
                            <td>Liam Hall</td>
                            <td>Marketing Coordinator</td>
                            <td>San Francisco</td>
                            <td>28</td>
                            <td>2023-06-15</td>
                            <td>$95,000</td>
                        </tr>
                        <tr>
                            <td>Grace Young</td>
                            <td>Product Owner</td>
                            <td>Denver</td>
                            <td>29</td>
                            <td>2022-11-30</td>
                            <td>$120,000</td>
                        </tr>
                        <tr>
                            <td>Dylan Evans</td>
                            <td>Business Consultant</td>
                            <td>Seattle</td>
                            <td>34</td>
                            <td>2023-04-05</td>
                            <td>$100,000</td>
                        </tr>
                        <tr>
                            <td>Victoria Moore</td>
                            <td>Software Developer</td>
                            <td>Boston</td>
                            <td>27</td>
                            <td>2023-07-12</td>
                            <td>$115,000</td>
                        </tr>
                        <tr>
                            <td>Nathan Lopez</td>
                            <td>Marketing Specialist</td>
                            <td>Chicago</td>
                            <td>33</td>
                            <td>2023-02-28</td>
                            <td>$85,000</td>
                        </tr>
                        <tr>
                            <td>Hailey Adams</td>
                            <td>Product Manager</td>
                            <td>San Francisco</td>
                            <td>30</td>
                            <td>2022-10-15</td>
                            <td>$125,000</td>
                        </tr>
                        <tr>
                            <td>Andrew Thompson</td>
                            <td>Financial Analyst</td>
                            <td>Houston</td>
                            <td>29</td>
                            <td>2023-12-05</td>
                            <td>$95,000</td>
                        </tr>
                        <tr>
                            <td>Madeline Wilson</td>
                            <td>HR Specialist</td>
                            <td>Miami</td>
                            <td>32</td>
                            <td>2023-06-20</td>
                            <td>$80,000</td>
                        </tr>
                        <tr>
                            <td>Aiden Garcia</td>
                            <td>Data Scientist</td>
                            <td>Denver</td>
                            <td>28</td>
                            <td>2023-11-08</td>
                            <td>$130,000</td>
                        </tr>
                        <tr>
                            <td>Kayla Hernandez</td>
                            <td>Graphic Designer</td>
                            <td>Atlanta</td>
                            <td>31</td>
                            <td>2023-04-20</td>
                            <td>$75,000</td>
                        </tr>
                        <tr>
                            <td>Landon Scott</td>
                            <td>Business Analyst</td>
                            <td>Phoenix</td>
                            <td>26</td>
                            <td>2023-09-12</td>
                            <td>$100,000</td>
                        </tr>
                        <tr>
                            <td>Sophie Martinez</td>
                            <td>UX/UI Designer</td>
                            <td>Portland</td>
                            <td>33</td>
                            <td>2023-01-05</td>
                            <td>$90,000</td>
                        </tr>
                        <tr>
                            <td>Henry Clark</td>
                            <td>Content Writer</td>
                            <td>Philadelphia</td>
                            <td>29</td>
                            <td>2022-08-22</td>
                            <td>$70,000</td>
                        </tr>
                        <tr>
                            <td>Grace White</td>
                            <td>Project Coordinator</td>
                            <td>Dallas</td>
                            <td>30</td>
                            <td>2023-03-15</td>
                            <td>$85,000</td>
                        </tr>
                        <tr>
                            <td>Lucas Perez</td>
                            <td>Systems Analyst</td>
                            <td>San Diego</td>
                            <td>27</td>
                            <td>2023-10-10</td>
                            <td>$105,000</td>
                        </tr>
                        <tr>
                            <td>Emma Scott</td>
                            <td>Marketing Manager</td>
                            <td>Charlotte</td>
                            <td>34</td>
                            <td>2022-12-18</td>
                            <td>$110,000</td>
                        </tr>
                        <tr>
                            <td>Noah Rodriguez</td>
                            <td>Financial Advisor</td>
                            <td>Las Vegas</td>
                            <td>31</td>
                            <td>2023-07-05</td>
                            <td>$95,000</td>
                        </tr>
                        <tr>
                            <td>Chloe Nguyen</td>
                            <td>Product Designer</td>
                            <td>Minneapolis</td>
                            <td>28</td>
                            <td>2023-02-20</td>
                            <td>$120,000</td>
                        </tr>
                        <tr>
                            <td>William Kim</td>
                            <td>HR Manager</td>
                            <td>Orlando</td>
                            <td>33</td>
                            <td>2022-09-25</td>
                            <td>$100,000</td>
                        </tr>
                        <tr>
                            <td>Emily King</td>
                            <td>Data Engineer</td>
                            <td>Salt Lake City</td>
                            <td>30</td>
                            <td>2023-04-10</td>
                            <td>$125,000</td>
                        </tr>
                        <tr>
                            <td>Nicholas Thomas</td>
                            <td>Business Development Manager</td>
                            <td>Tampa</td>
                            <td>27</td>
                            <td>2023-11-28</td>
                            <td>$95,000</td>
                        </tr>
                        <tr>
                            <td>Oliver Martinez</td>
                            <td>Software Tester</td>
                            <td>Austin</td>
                            <td>34</td>
                            <td>2023-08-15</td>
                            <td>$115,000</td>
                        </tr>
                        <tr>
                            <td>Sophia Brown</td>
                            <td>UX/UI Developer</td>
                            <td>Washington D.C.</td>
                            <td>31</td>
                            <td>2022-07-10</td>
                            <td>$90,000</td>
                        </tr>
                        <tr>
                            <td>Liam Wilson</td>
                            <td>Content Manager</td>
                            <td>San Jose</td>
                            <td>28</td>
                            <td>2023-12-22</td>
                            <td>$75,000</td>
                        </tr>
                        <tr>
                            <td>Charlotte Garcia</td>
                            <td>Project Analyst</td>
                            <td>Detroit</td>
                            <td>33</td>
                            <td>2023-05-05</td>
                            <td>$110,000</td>
                        </tr>
                        <tr>
                            <td>Ethan Wright</td>
                            <td>Technical Writer</td>
                            <td>Indianapolis</td>
                            <td>30</td>
                            <td>2023-01-20</td>
                            <td>$80,000</td>
                        </tr>
                        <tr>
                            <td>Isabella Baker</td>
                            <td>Systems Administrator</td>
                            <td>Charlotte</td>
                            <td>27</td>
                            <td>2023-09-18</td>
                            <td>$105,000</td>
                        </tr>
                        <tr>
                            <td>James Hall</td>
                            <td>Marketing Coordinator</td>
                            <td>San Francisco</td>
                            <td>34</td>
                            <td>2022-06-15</td>
                            <td>$95,000</td>
                        </tr>
                        <tr>
                            <td>Emma Young</td>
                            <td>Product Owner</td>
                            <td>Denver</td>
                            <td>29</td>
                            <td>2022-11-30</td>
                            <td>$120,000</td>
                        </tr>
                        <tr>
                            <td>Aiden Evans</td>
                            <td>Business Consultant</td>
                            <td>Seattle</td>
                            <td>32</td>
                            <td>2023-04-05</td>
                            <td>$100,000</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
