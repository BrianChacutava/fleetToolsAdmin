<div>
    <div class="container-fluid" style="margin-top: 15%">

        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row ">

                <div class="col-auto">
                    <div class="position-relative" style="height: 2%;">
                        <div class="col-md-4">
                            @if ($photo)
                                Photo Preview:

                                <img src="{{ $photo->temporaryUrl() }}" class="w-100 border-radius-lg shadow-sm"
                                    style="height: 100%;">
                            @endif
                        </div>
                        <input type="file" wire:model="photo">

                        <div wire:loading wire:target="photo">Uploading...</div>
                        @error('photo')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ __('Upload File') }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ __(' jpg, jpeg, png') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Employer Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                @if ($showDemoNotification)
                    <div wire:model="showDemoNotification" class="mt-3  alert alert-primary alert-dismissible fade show"
                        role="alert">
                        <span class="alert-text text-white">
                            {{ __('You are in a demo version, you can\'t update the profile.') }}</span>
                        <button wire:click="$set('showDemoNotification', false)" type="button" class="btn-close"
                            data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif

                @if ($showSuccesNotification)
                    <div wire:model="showSuccesNotification"
                        class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                        <span class="alert-icon text-white"><i class="ni ni-like-2"></i></span>
                        <span
                            class="alert-text text-white">{{ __('Your information have been successfuly saved!') }}</span>
                        <button wire:click="$set('showSuccesNotification', false)" type="button" class="btn-close"
                            data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif

                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">

                            {{ session('message') }}

                        </div>
                    @endif
                </div>

                <form wire:submit.prevent="save" action="#" method="POST" role="form text-left">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name" class="form-control-label">{{ __('First Name') }}</label>
                                <div class="@error('employer.first_name')border border-danger rounded-3 @enderror">
                                    <input wire:model="employer.first_name" class="form-control" type="text"
                                        placeholder="First Name" id="first_name">
                                </div>
                                @error('employer.name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_name" class="form-control-label">{{ __('Last Name') }}</label>
                                <div class="@error('employer.last_name')border border-danger rounded-3 @enderror">
                                    <input wire:model="employer.last_name" class="form-control" type="text"
                                        placeholder="Last Name" id="last_name">
                                </div>
                                @error('employer.name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('employer.email')border border-danger rounded-3 @enderror">
                                    <input wire:model="employer.email" class="form-control" type="email"
                                        placeholder="Email" id="email">
                                </div>
                                @error('employer.email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Group" class="form-control-label">{{ __('ID Type') }}</label>
                                <div
                                    class="@error('employer.identification_type')border border-danger rounded-3 @enderror">

                                    <select wire:model="employer.identification_type" class="form-control"
                                        id="identification_type">
                                        <option value="0">insert ID</option>
                                        <option value="BI">BI</option>
                                        <option value="Passaport">Passaport</option>
                                        <option value="DIR">DIR</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reference" class="form-control-label">{{ __('ID Number') }}</label>
                                <div
                                    class="@error('employer.identification_num')border border-danger rounded-3 @enderror">
                                    <input wire:model="employer.identification_num" class="form-control"
                                        type="text" placeholder="Tec00111....." id="identification_num">
                                </div>
                                @error('employer.identification_num')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="adress" class="form-control-label">{{ __('Adress') }}</label>
                                    <div class="@error('employer.adress')border border-danger rounded-3 @enderror">
                                        <textarea wire:model="employer.adress" class="form-control" id="adress" rows="2" placeholder="Adress"></textarea>
                                    </div>
                                    @error('employer.adress')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="reference"
                                        class="form-control-label">{{ __('Phone Number') }}</label>
                                    <div class="@error('employer.phone1')border border-danger rounded-3 @enderror">
                                        <input wire:model="employer.phone1" class="form-control" type="text"
                                            placeholder="258........." id="phone1">
                                    </div>
                                    @error('employer.phone1')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="reference" class="form-control-label">{{ __('Bage Number') }}</label>
                                    <div
                                        class="@error('employer.bage_number')border border-danger rounded-3 @enderror">
                                        <input wire:model="employer.bage_number" class="form-control" type="text"
                                            placeholder="Bage Number" id="bage_number">
                                    </div>
                                    @error('employer.bage_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category_id" class="form-control-label">{{ __('Category') }}</label>
                                    <div
                                        class="@error('employer.category_id')border border-danger rounded-3 @enderror">

                                        <select wire:model="employer.category_id" class="form-control"
                                            id="category_id">
                                            <option value="0">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Company" class="form-control-label">{{ __('Company') }}</label>
                                    <div class="@error('employer.company_id')border border-danger rounded-3 @enderror">

                                        <select wire:model="employer.company_id" class="form-control" id="company">
                                            <option value="0">Select Company</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="reference"
                                        class="form-control-label">{{ __('Create password') }}</label>
                                    <div class="@error('user.password')border border-danger rounded-3 @enderror">
                                        <input wire:model.defer="user.password" class="form-control"
                                            type="password" placeholder="Password" id="password">
                                    </div>
                                    @error('user.password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                        </div>

                </form>

            </div>
        </div>
    </div>
</div>
