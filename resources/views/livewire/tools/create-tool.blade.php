<div>
    <div class="container-fluid" style="margin-top: 15%">

        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row ">
                {{-- <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="../assets/img/tool.jpg" alt="..." class="w-100 border-radius-lg shadow-sm">
                        <a href="javascript:;"
                            class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Edit Image"></i>
                        </a>

                    </div>
                </div> --}}

                <div class="col-auto">
                    <div class="position-relative" style="height: 2%;">
                        <div class="col-md-4">
                            @if ($photo)
                                Photo Preview:

                                <img src="{{ $photo->temporaryUrl() }}" class="w-100 border-radius-lg shadow-sm"
                                    style="height: 100%;">
                            @endif
                        </div>
                        <input type="file" wire:model="photo" >

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
                <h6 class="mb-0">{{ __('Tool Information') }}</h6>
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
                            class="alert-text text-white">{{ __('Your profile information have been successfuly saved!') }}</span>
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
                                <label for="name" class="form-control-label">{{ __('Full Name') }}</label>
                                <div class="@error('tools.name')border border-danger rounded-3 @enderror">
                                    <input wire:model="tools.name" class="form-control" type="text"
                                        placeholder="Name" id="name">
                                </div>
                                @error('tools.name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="make" class="form-control-label">{{ __('Make') }}</label>
                                <div class="@error('tools.make')border border-danger rounded-3 @enderror">
                                    <input wire:model="tools.make" class="form-control" type="text"
                                        placeholder="Make" id="make">
                                </div>
                                @error('tools.make')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Group" class="form-control-label">{{ __('Tools Group') }}</label>
                                <div class="@error('tools.tool_group_id')border border-danger rounded-3 @enderror">

                                    <select wire:model="tools.tool_group_id" class="form-control" id="tool_group">
                                        <option value="0"> Select Group </option>
                                        @foreach ($tool_groups as $tool_group)
                                            <option value="{{ $tool_group->id }}">{{ $tool_group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="model" class="form-control-label">{{ __('Model') }}</label>
                                <div class="@error('tools.model')border border-danger rounded-3 @enderror">
                                    <input wire:model="tools.model" class="form-control" type="text"
                                        placeholder="Model" id="model">
                                </div>
                                @error('tools.model')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reference" class="form-control-label">{{ __('Reference Number') }}</label>
                                <div class="@error('tools.reference_num')border border-danger rounded-3 @enderror">
                                    <input wire:model="tools.reference_num" class="form-control" type="text"
                                        placeholder="Refxxx...05" id="reference_num">
                                </div>
                                @error('tools.reference_num')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Quantity" class="form-control-label">{{ __('Quantity') }}</label>
                                <div class="@error('tools.quantity') border border-danger rounded-3 @enderror">
                                    <input wire:model="tools.quantity" class="form-control" type="number"
                                        placeholder="Quantity" id="quantity">
                                </div>
                                @error('tools.quantity')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Company" class="form-control-label">{{ __('Company') }}</label>
                                <div class="@error('tools.company_id')border border-danger rounded-3 @enderror">

                                    <select wire:model="tools.company_id" class="form-control" id="company">
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
                                <label for="stock" class="form-control-label">{{ __('Stock Place') }}</label>
                                <div class="@error('stock1')border border-danger rounded-3 @enderror">

                                    <select wire:model="stock1" class="form-control" id="stock1">
                                        <option value="0"> Select stock </option>
                                        @foreach ($stocks as $stock)
                                            <option value="{{ $stock->id }}">{{ $stock->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status" class="form-control-label">{{ __('Status') }}</label>
                                <div class="@error('tools.status')border border-danger rounded-3 @enderror">

                                    <select wire:model="tools.status" class="form-control" id="status">
                                        <option value="New"> New </option>
                                        <option value="Old"> Old </option>
                                    </select>

                                </div>
                                <input wire:model="tools.active" class="form-control" type="hidden" placeholder="1"
                                    id="active" value="1" disabled>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="row" style="margin: 1%">

                <div class="col-md-12">

                    <div class="form-group">
                        <label for="description"class="form-control-label">{{ __('Descriptions Tool') }}</label>
                        <div class="@error('tools.description')border border-danger rounded-3 @enderror">
                            <textarea wire:model="tools.description" class="form-control" id="description" rows="3"
                                placeholder="Say something about tools"></textarea>
                        </div>
                        @error('tools.description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
            </div>

            </form>

        </div>
    </div>
</div>
</div>
