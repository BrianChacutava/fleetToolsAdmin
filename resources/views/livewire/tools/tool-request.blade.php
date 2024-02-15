<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Create Out Request') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">


                <form wire:submit.prevent="save" action="#" method="POST" role="form text-left">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Tools" class="form-control-label">{{ __('Tools') }}</label>
                                <div class="@error('req.tools_id')border border-danger rounded-3 @enderror">

                                    <select wire:model="req.tools_id" class="form-control" id="tools_id">
                                        <option value="0">Select Tools - Quantity</option>
                                        @foreach ($toolList as $tool)
                                            <option value="{{ $tool->id }}">
                                                {{ $tool->tool_group->name }}-{{ $tool->name }} - {{ $tool->quantity }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Stock" class="form-control-label">{{ __('Stock') }}</label>
                                <div class="@error('req.stock_id')border border-danger rounded-3 @enderror">

                                    <select wire:model="req.stock_id" class="form-control" id="stock_id">
                                        <option value="0">Select Stock</option>
                                        @foreach ($stockList as $stock)
                                            <option value="{{ $stock->id }}">{{ $stock->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantity" class="form-control-label">{{ __('Quantity') }}</label>
                                <div class="@error('req.quantity')border border-danger rounded-3 @enderror">
                                    <input wire:model="req.quantity" class="form-control" type="number"
                                        placeholder="12xxxxx" id="quantity">
                                </div>
                                @error('req.quantity')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Tecnition" class="form-control-label">{{ __('Tecnition') }}</label>
                                <div class="@error('req.employer_id')border border-danger rounded-3 @enderror">

                                    <select wire:model="req.employer_id" class="form-control" id="employer_id">
                                        <option value="0">Select Tecnition</option>
                                        @foreach ($TecnicalList as $Tecnition)
                                            <option value="{{ $Tecnition->id }}">{{ $Tecnition->first_name }}
                                                {{ $tool->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-4">
                            <div class="form-group">
                                <label for="Outtime" class="form-control-label">{{ __('Out Time') }}</label>
                                <div class="@error('out.initial_time')border border-danger rounded-3 @enderror">
                                    <input wire:model="out.initial_time" class="form-control" type="datetime-local">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="company" class="form-control-label">{{ __('Company') }}</label>
                                <div class="@error('out.company_id')border border-danger rounded-3 @enderror">

                                    <select wire:model="out.company_id" class="form-control" id="company_id">
                                        <option value="0">Select Company</option>
                                        @foreach ($companyList as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">

                        <div class="col-md-12">

                            <div class="form-group">
                                <label
                                    for="description"class="form-control-label">{{ __('Descriptions stocks') }}</label>
                                <div class="@error('out.description')border border-danger rounded-3 @enderror">
                                    <textarea wire:model="out.description" class="form-control" id="description" rows="3"
                                        placeholder="Say something about this Request"></textarea>
                                </div>
                                @error('out.description')
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

    <div class="container-fluid py-4">


                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Requests</h5>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        @if ($showSuccesNotification)
                            <div wire:model="showSuccesNotification"
                                class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-icon text-white"><i class="ni ni-like-2"></i></span>
                                <span
                                    class="alert-text text-white">{{ __('Your request information have been successfuly saved!') }}</span>
                                <button wire:click="$set('showSuccesNotification', false)" type="button"
                                    class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        @endif
                        @if ($showFailureNotification)
                            <div wire:model="showFailureNotification"
                                class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white">
                                    {{ __('The quantity not mutch or is out of stock') }}
                                <button wire:click="$set('showFailureNotification', false)" type="button"
                                    class="btn-close" style="color: aliceblue" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        @endif
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            #</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tools</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Stock</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Operation type</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Operatin Quantity </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Atual Quantity</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tecnition</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requestList as $request)
                                        <tr>

                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $request->id }}</p>
                                                {{-- <p class="text-xs text-secondary mb-0">{{ $tool->model }}</p> --}}
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">

                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $request->tool->id }}</h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $request->tool->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">

                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $request->stock->id }}</h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $request->stock->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>

                                            @if ($request->operation_type == 'E')
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    Entry</p>
                                                {{-- <p class="text-xs text-secondary mb-0">{{ $tool->model }}</p> --}}
                                            </td>
                                            @else
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    Out</p>
                                                {{-- <p class="text-xs text-secondary mb-0">{{ $tool->model }}</p> --}}
                                            </td>
                                            @endif


                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $request->quantity }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $request->atual_qty }}</span>
                                            </td>

                                            <td>
                                                <div class="d-flex px-2 py-1">

                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $request->employer->id }}</h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $request->employer->first_name }}
                                                            {{ $request->employer->last_name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $request->created_at }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit Stock">
                                                    <i class="fas fa-edit text-secondary"></i>
                                                </a>
                                                <span>
                                                    <i class="cursor-pointer fas fa-trash text-secondary"></i>
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
</div>
