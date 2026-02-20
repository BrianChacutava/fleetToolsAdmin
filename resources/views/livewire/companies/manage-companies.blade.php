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
                                    <h5 class="mb-0">All Companies</h5>
                                </div>
                                <div>
                                    <a href="{{ route('companies.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Nova Company</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                            {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Telefone</th> --}}
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companies as $company)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $company->id }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $company->name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0 text-center">{{ $company->name }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ $company->email }}</p>
                                                </td>
                                                {{-- <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">{{ $company->phone ?? '-' }}</span>
                                                </td> --}}
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">{{ $company->created_at }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center" style="width:20px; height:20px;" aria-label="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="#" wire:click.prevent="confirmDelete({{ $company->id }})" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center" style="width:20px; height:20px;" aria-label="Apagar">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        {{ $companies->links() }}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</main>

{{-- (Edit modal removed; editing uses separate page at companies.edit) --}}

{{-- Delete confirmation modal --}}
@if($confirmingDelete)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded w-96">
            <p class="mb-4">Tem certeza que deseja apagar esta company?</p>
            <div class="flex justify-end space-x-2">
                <button wire:click="cancelDelete" class="px-3 py-1 border rounded">Cancelar</button>
                <button wire:click="delete" class="px-3 py-1 bg-red-600 text-white rounded">Apagar</button>
            </div>
        </div>
    </div>
@endif

<script>
    // Initialize Bootstrap tooltips and re-init after Livewire updates
    function initCompanyTooltips() {
        if (typeof bootstrap === 'undefined') return;
        var triggers = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        triggers.forEach(function (el) {
            try {
                // avoid double-initialization
                if (!el._bs_tooltip) {
                    el._bs_tooltip = new bootstrap.Tooltip(el);
                }
            } catch (e) {
                // ignore
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initCompanyTooltips();
    });

    if (typeof Livewire !== 'undefined') {
        document.addEventListener('livewire:load', function () {
            initCompanyTooltips();
            Livewire.hook('message.processed', function () {
                initCompanyTooltips();
            });
        });
    }
</script>
