<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Stock Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">


                <form wire:submit.prevent="save" action="#" method="POST" role="form text-left">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">{{ __('Full Name') }}</label>
                                <div class="@error('stocks.name')border border-danger rounded-3 @enderror">
                                    <input wire:model="stocks.name" class="form-control" type="text"
                                        placeholder="Name" id="name">
                                </div>
                                @error('stocks.name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Company" class="form-control-label">{{ __('Company') }}</label>
                                <div class="@error('stocks.company_id')border border-danger rounded-3 @enderror">

                                    <select wire:model="stocks.company_id" class="form-control" id="model">
                                        <option value="0">Select Company</option>
                                        @foreach ($companies as $company)
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
                                <label for="description"class="form-control-label">{{ __('Descriptions stocks') }}</label>
                                <div class="@error('stocks.description')border border-danger rounded-3 @enderror">
                                    <textarea wire:model="stocks.description" class="form-control" id="description" rows="3"
                                        placeholder="Say something about stocks"></textarea>
                                </div>
                                @error('stocks.description')
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


        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Stocks</h5>
                            </div>
                            {{-- <a href="{{ route('tool-create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                                type="button">+&nbsp; New stocks</a> --}}
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th> --}}
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Descriptio</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Company</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stockList as $stock)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">

                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $stock->id }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $stock->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $stock->description }}</p>
                                                {{-- <p class="text-xs text-secondary mb-0">{{ $tool->model }}</p> --}}
                                            </td>

                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $stock->company->name }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $stock->created_at }}</span>
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
        {{-- @include('livewire.custumer.CreatCustumerModal') --}}
        {{-- <livewire:tools.create-tool /> --}}

    </div>
</div>
