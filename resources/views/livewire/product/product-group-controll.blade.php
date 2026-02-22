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
                                <h5 class="mb-0">Product Groups</h5>
                            </div>
                            <a href="{{ route('Product-Group.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Group</a>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Products</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ProductGroups as $group)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $group->id }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $group->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $group->description }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $group->products->count() }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $group->created_at }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="mx-3" wire:click.prevent="openEdit({{ $group->id }})" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                    <i class="fas fa-edit text-secondary"></i>
                                                </a>
                                                <span wire:click="delete({{ $group->id }})">
                                                    <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{ $ProductGroups->links() }}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="productGroupModal" tabindex="-1" aria-labelledby="productGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productGroupModalLabel">{{ $editingId ? 'Edit Product Group' : 'New Product Group' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" wire:model.defer="name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" rows="3" wire:model.defer="descricao"></textarea>
                    @error('descricao') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click="save" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalEl = document.getElementById('productGroupModal');
        if (!modalEl) return;
        const bsModal = new bootstrap.Modal(modalEl);

        window.addEventListener('show-product-group-modal', () => {
            bsModal.show();
        });
        window.addEventListener('hide-product-group-modal', () => {
            bsModal.hide();
        });
    });
</script>
