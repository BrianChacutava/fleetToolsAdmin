<div>
    <div class="container-fluid" style="margin-top: 5%">
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row">
                <div class="col-12">
                    @if ($showSuccesNotification)
                        <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">Company criada com sucesso.</span>
                        </div>
                    @endif

                    <div>
                        @if (session()->has('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif
                    </div>

                    <div class="card">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">{{ __('Company Information') }}</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <form wire:submit.prevent="save" action="#" method="POST" role="form text-left">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Nome</label>
                                            <div class="@error('company.name')border border-danger rounded-3 @enderror">
                                                <input wire:model="company.name" class="form-control" type="text" placeholder="Nome">
                                            </div>
                                            @error('company.name')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Acrónimo</label>
                                            <div class="@error('company.acronym')border border-danger rounded-3 @enderror">
                                                <input wire:model="company.acronym" class="form-control" type="text" placeholder="Acrónimo">
                                            </div>
                                            @error('company.acronym')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Email</label>
                                            <div class="@error('company.email')border border-danger rounded-3 @enderror">
                                                <input wire:model="company.email" class="form-control" type="email" placeholder="email@exemplo.com">
                                            </div>
                                            @error('company.email')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Endereço</label>
                                            <div class="@error('company.adress')border border-danger rounded-3 @enderror">
                                                <input wire:model="company.adress" class="form-control" type="text" placeholder="Endereço">
                                            </div>
                                            @error('company.adress')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">NUIT</label>
                                            <div class="@error('company.nuit')border border-danger rounded-3 @enderror">
                                                <input wire:model="company.nuit" class="form-control" type="text" placeholder="NUIT">
                                            </div>
                                            @error('company.nuit')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('companies.index') }}" class="btn btn-secondary btn-md mt-4 mb-4 me-2">Cancelar</a>
                                    <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
