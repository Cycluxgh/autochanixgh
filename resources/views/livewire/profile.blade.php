<x-slot:title>Profile</x-slot>
<x-slot:page_title>Profile</x-slot>
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">
                @php
                    $user = auth()->user();
                @endphp
                <div class="align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($image?->temporaryUrl() ?? ($user?->image ?? 'assets/images/logo-dark.png')) }}"
                            class="rounded-circle avatar-xxl img-thumbnail float-start" alt="image profile">

                        <div class="overflow-hidden ms-4">
                            <h4 class="m-0 text-dark fs-20">{{ ucfirst($user->name) }}</h4>
                            <p class="my-1 text-muted fs-16">{{ $user->email }}</p>
                            @if ($user?->phone != null)
                                <span class="fs-15"><i class="mdi mdi-phone me-2 align-middle"></i>
                            @endif{{ $user?->phone ?? null }} <span> <span
                                    class="badge bg-primary-subtle text-primary px-2 py-1 fs-13 fw-normal">{{ ucfirst($user->role->name) }}</span>
                                @if ($user?->address != null)
                                    ,
                                @endif {{ $user?->address }}
                            </span></span>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-underline border-bottom pt-2" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active p-2" id="profile_edit_tab" data-bs-toggle="tab" href="#profile_edit"
                            role="tab">
                            <span class="d-block d-sm-none"><i class="mdi mdi-information"></i></span>
                            <span class="d-none d-sm-block">Edit</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-2" id="profile_password_tab" data-bs-toggle="tab" href="#profile_password"
                            role="tab">
                            <span class="d-block d-sm-none"><i class="mdi mdi-sitemap-outline"></i></span>
                            <span class="d-none d-sm-block">Change Password</span>
                        </a>
                    </li>
                    @if ($user->role->name === \App\RoleEnum::SuperAdmin->value)
                    <li class="nav-item">
                        <a class="nav-link p-2" id="portfolio_role_tab" data-bs-toggle="tab" href="#profile_role"
                            role="tab">
                            <span class="d-block d-sm-none"><i class="mdi mdi-school"></i></span>
                            <span class="d-none d-sm-block">Change Role</span>
                        </a>
                    </li>
                    @endif
                    {{--                        <li class="nav-item"> --}}
                    {{--                            <a class="nav-link p-2" id="setting_tab" data-bs-toggle="tab" href="#profile_setting" role="tab"> --}}
                    {{--                                <span class="d-block d-sm-none"><i class="mdi mdi-school"></i></span> --}}
                    {{--                                <span class="d-none d-sm-block">Setting</span> --}}
                    {{--                            </a> --}}
                    {{--                        </li> --}}
                </ul>

                <div class="tab-content text-muted bg-white">
                    <div class="tab-pane active show pt-4" id="profile_edit" role="tabpanel">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form wire:submit="update">
                                <div class="row">
                                    <div class="form-group mb-3 col-6">
                                        <label class="form-label">Name</label>
                                        <div class="col-lg-12 col-xl-12">
                                            <input class="form-control" type="text" wire:model="name">
                                            <div class="text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 col-6">
                                        <label class="form-label">Contact Phone</label>
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="input-group">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-phone-outline"></i></span>
                                                <input class="form-control" type="text" placeholder="Phone"
                                                    maxlength="10" aria-describedby="phone number" wire:model="phone">
                                                <div class="text-danger">
                                                    @error('phone')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 col-6">
                                        <label class="form-label">Email Address</label>
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                                                <input type="text" class="form-control" placeholder="Email"
                                                    aria-describedby="email address" wire:model="email">
                                                <div class="text-danger">
                                                    @error('email')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 col-6">
                                        <label class="form-label">Upload Profile Image</label>
                                        <div class="col-lg-12 col-xl-12">
                                            <input class="form-control" type="file" wire:model="image"
                                                accept="image/*">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Address</label>
                                        <div class="col-lg-12 col-xl-12">
                                            <textarea class="form-control" wire:model="address"></textarea>
                                            <div class="text-danger">
                                                @error('address')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-12 col-xl-12">
                                            <button type="submit" class="btn btn-primary float-end">Save <span
                                                    class="spinner-grow spinner-grow-sm" aria-hidden="true"
                                                    wire:loading></span>
                                            </button>
                                        </div>
                                        <div class="text-danger" wire:dirty>Unsaved changes...</div>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div><!-- end Experience -->

                    <div class="tab-pane pt-4" id="profile_password" role="tabpanel">
                        <div class="card-body mb-0">
                            @if (session('change-success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('change-success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('change-error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('change-error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form wire:submit="changePassword">
                                <div class="row">
                                    <div class="form-group mb-3 col-4">
                                        <label class="form-label">Old Password</label>
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="input-group">
                                                <input class="form-control" type="password" id="oldPassword"
                                                    placeholder="Old Password" wire:model="old_password">
                                                <span class="input-group-text" onclick="onOldPasswordVisible()"><i
                                                        class="mdi mdi-lock-outline" id="old-lock-icon"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 col-4">
                                        <label class="form-label">New Password</label>
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="input-group">
                                                <input class="form-control" type="password" id="newPassword"
                                                    placeholder="New Password" wire:model="new_password">
                                                <span class="input-group-text" onclick="onNewPasswordVisible()"><i
                                                        class="mdi mdi-lock-outline" id="new-lock-icon"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 col-4">
                                        <label class="form-label">Confirm Password</label>
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="input-group">
                                                <input class="form-control" type="password" id="confirmPassword"
                                                    placeholder="Confirm Password" wire:model="confirm_password">
                                                <span class="input-group-text" onclick="onConfirmPasswordVisible()"><i
                                                        class="mdi mdi-lock-outline"
                                                        id="confirm-lock-icon"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-12 col-xl-12">
                                            <button type="submit" class="btn btn-primary float-end">Change Password
                                                <span class="spinner-grow spinner-grow-sm" aria-hidden="true"
                                                    wire:loading></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div> <!-- end Experience -->
                    @if ($user->role->name === \App\RoleEnum::SuperAdmin->value)
                    <div class="tab-pane pt-4" id="profile_role" role="tabpanel">
                        <div class="card-body mb-0">
                            @if (session('role-success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('role-success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('role-error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('role-error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form wire:submit="changeRole">
                                <div class="row">
                                    <div class="form-group mb-3 col-6">
                                        <label class="form-label">Email</label>
                                        <div class="col-lg-12 col-xl-12">
                                            <input class="form-control" type="email" placeholder="Email"
                                                wire:model="role_email">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 col-6">
                                        <label class="form-label">Select Role</label>
                                        <select class="form-select" id="role" name="role" wire:model="role">
                                            <option>Choose...</option>
                                            @foreach (\App\RoleEnum::cases() as $role)
                                                <option value="{{ $role->value }}">{{ ucfirst($role->value) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-12 col-xl-12">
                                            <button type="submit" class="btn btn-primary float-end">Change Role
                                                <span class="spinner-grow spinner-grow-sm" aria-hidden="true"
                                                    wire:loading></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> <!-- end education -->
                    @endif
                    {{--                        <div class="tab-pane pt-4" id="profile_setting" role="tabpanel"> --}}
                    {{--                            <div class="row"> --}}

                    {{--                                <div class="row"> --}}
                    {{--                                    <div class="col-lg-6 col-xl-6"> --}}
                    {{--                                        <div class="card border mb-0"> --}}

                    {{--                                            <div class="card-header"> --}}
                    {{--                                                <div class="row align-items-center"> --}}
                    {{--                                                    <div class="col"> --}}
                    {{--                                                        <h4 class="card-title mb-0">Personal Information</h4> --}}
                    {{--                                                    </div><!--end col--> --}}
                    {{--                                                </div> --}}
                    {{--                                            </div> --}}

                    {{--                                            <div class="card-body"> --}}
                    {{--                                                <div class="form-group mb-3 row"> --}}
                    {{--                                                    <label class="form-label">First Name</label> --}}
                    {{--                                                    <div class="col-lg-12 col-xl-12"> --}}
                    {{--                                                        <input class="form-control" type="text" value="Charles"> --}}
                    {{--                                                    </div> --}}
                    {{--                                                </div> --}}

                    {{--                                                <div class="form-group mb-3 row"> --}}
                    {{--                                                    <label class="form-label">Last Name</label> --}}
                    {{--                                                    <div class="col-lg-12 col-xl-12"> --}}
                    {{--                                                        <input class="form-control" type="text" value="Buncle"> --}}
                    {{--                                                    </div> --}}
                    {{--                                                </div> --}}

                    {{--                                                <div class="form-group mb-3 row"> --}}
                    {{--                                                    <label class="form-label">Contact Phone</label> --}}
                    {{--                                                    <div class="col-lg-12 col-xl-12"> --}}
                    {{--                                                        <div class="input-group"> --}}
                    {{--                                                            <span class="input-group-text"><i class="mdi mdi-phone-outline"></i></span> --}}
                    {{--                                                            <input class="form-control" type="text" placeholder="Phone" aria-describedby="basic-addon1" value="+61 399615"> --}}
                    {{--                                                        </div> --}}
                    {{--                                                    </div> --}}
                    {{--                                                </div> --}}

                    {{--                                                <div class="form-group mb-3 row"> --}}
                    {{--                                                    <label class="form-label">Email Address</label> --}}
                    {{--                                                    <div class="col-lg-12 col-xl-12"> --}}
                    {{--                                                        <div class="input-group"> --}}
                    {{--                                                            <span class="input-group-text"><i class="mdi mdi-email"></i></span> --}}
                    {{--                                                            <input type="text" class="form-control" value="CharlesBuncle@dayrep.com" placeholder="Email" aria-describedby="basic-addon1"> --}}
                    {{--                                                        </div> --}}
                    {{--                                                    </div> --}}
                    {{--                                                </div> --}}

                    {{--                                                <div class="form-group mb-3 row"> --}}
                    {{--                                                    <label class="form-label">Company</label> --}}
                    {{--                                                    <div class="col-lg-12 col-xl-12"> --}}
                    {{--                                                        <input class="form-control" type="text" value="zoyothemes"> --}}
                    {{--                                                    </div> --}}
                    {{--                                                </div> --}}

                    {{--                                                <div class="form-group mb-3 row"> --}}
                    {{--                                                    <label class="form-label">City</label> --}}
                    {{--                                                    <div class="col-lg-12 col-xl-12"> --}}
                    {{--                                                        <input class="form-control" type="text" value="Adelaide"> --}}
                    {{--                                                    </div> --}}
                    {{--                                                </div> --}}

                    {{--                                                <div class="form-group mb-3 row"> --}}
                    {{--                                                    <label class="form-label">Address</label> --}}
                    {{--                                                    <div class="col-lg-12 col-xl-12"> --}}
                    {{--                                                        <input class="form-control" type="text" value="Australia"> --}}
                    {{--                                                    </div> --}}
                    {{--                                                </div> --}}

                    {{--                                            </div><!--end card-body--> --}}
                    {{--                                        </div> --}}
                    {{--                                    </div> --}}

                    {{--                                    <div class="col-lg-6 col-xl-6"> --}}
                    {{--                                        <div class="card border mb-0"> --}}

                    {{--                                            <div class="card-header"> --}}
                    {{--                                                <div class="row align-items-center"> --}}
                    {{--                                                    <div class="col"> --}}
                    {{--                                                        <h4 class="card-title mb-0">Change Password</h4> --}}
                    {{--                                                    </div><!--end col--> --}}
                    {{--                                                </div> --}}
                    {{--                                            </div> --}}

                    {{--                                            <div class="card-body mb-0"> --}}
                    {{--                                                <div class="form-group mb-3 row"> --}}
                    {{--                                                    <label class="form-label">Old Password</label> --}}
                    {{--                                                    <div class="col-lg-12 col-xl-12"> --}}
                    {{--                                                        <input class="form-control" type="password" placeholder="Old Password"> --}}
                    {{--                                                    </div> --}}
                    {{--                                                </div> --}}
                    {{--                                                <div class="form-group mb-3 row"> --}}
                    {{--                                                    <label class="form-label">New Password</label> --}}
                    {{--                                                    <div class="col-lg-12 col-xl-12"> --}}
                    {{--                                                        <input class="form-control" type="password" placeholder="New Password"> --}}
                    {{--                                                    </div> --}}
                    {{--                                                </div> --}}
                    {{--                                                <div class="form-group mb-3 row"> --}}
                    {{--                                                    <label class="form-label">Confirm Password</label> --}}
                    {{--                                                    <div class="col-lg-12 col-xl-12"> --}}
                    {{--                                                        <input class="form-control" type="password" placeholder="Confirm Password"> --}}
                    {{--                                                    </div> --}}
                    {{--                                                </div> --}}

                    {{--                                                <div class="form-group row"> --}}
                    {{--                                                    <div class="col-lg-12 col-xl-12"> --}}
                    {{--                                                        <button type="submit" class="btn btn-primary">Change Password</button> --}}
                    {{--                                                        <button type="button" class="btn btn-danger">Cancel</button> --}}
                    {{--                                                    </div> --}}
                    {{--                                                </div> --}}

                    {{--                                            </div><!--end card-body--> --}}
                    {{--                                        </div> --}}
                    {{--                                    </div> --}}

                    {{--                                </div> --}}
                    {{--                            </div> --}}
                    {{--                        </div> <!-- end education --> --}}

                </div> <!-- Tab panes -->
            </div>
        </div>
    </div>
</div>
