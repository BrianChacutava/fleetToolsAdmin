<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">

        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">Edit Company</h5>
                            </div>
                            <a href="{{ route('companies.index') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">← Back</a>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <form wire:submit.prevent="save" class="p-4">
                            <!-- Logo Section -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    @if (!empty($logo))
                                        <div>
                                            <label class="form-control-label"><strong>Logo Preview:</strong></label>
                                            <img src="{{ $logo->temporaryUrl() }}" class="img-fluid border-radius-lg shadow-sm mt-2" alt="logo preview" style="max-width: 100%;">
                                            <div class="mt-2">
                                                <button type="button" wire:click="$set('logo', null)" class="btn btn-sm btn-outline-secondary">Remover</button>
                                            </div>
                                        </div>
                                    @elseif (!empty($company) && $company->logo)
                                        <div>
                                            <label class="form-control-label"><strong>Logo Atual:</strong></label>
                                            <img src="{{ asset('storage/'.$company->logo) }}" class="img-fluid border-radius-lg shadow-sm mt-2" alt="logo" style="max-width: 100%;">
                                            <div class="mt-2">
                                                <button type="button" wire:click="removeLogo" class="btn btn-sm btn-outline-danger">Remover</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <label class="form-control-label">Upload Logo</label>
                                    <input type="file" wire:model="logo" class="form-control" accept="image/*">
                                    <div wire:loading wire:target="logo">
                                        <small class="text-secondary">Uploading...</small>
                                    </div>
                                    @error('logo') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Nome</label>
                                        <input wire:model="company.name" class="form-control" type="text" placeholder="Nome">
                                        @error('company.name') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Acrónimo</label>
                                        <input wire:model="company.acronym" class="form-control" type="text" placeholder="Acrónimo">
                                        @error('company.acronym') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Email</label>
                                        <input wire:model="company.email" class="form-control" type="email" placeholder="email@exemplo.com">
                                        @error('company.email') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Endereço</label>
                                        <input wire:model="company.adress" class="form-control" type="text" placeholder="Endereço">
                                        @error('company.adress') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">NUIT</label>
                                        <input wire:model="company.nuit" class="form-control" type="text" placeholder="NUIT">
                                        @error('company.nuit') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('companies.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
                                <button type="submit" class="btn bg-gradient-primary btn-sm">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
