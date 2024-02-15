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
            {{-- <livewire:tools.tool-table /> --}}

                    <div class="card mb-4 mx-4">
                        <div class="card-header pb-0">
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <h5 class="mb-0">All Tools</h5>
                                </div>
                                <a href="{{ route('tool-create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button" >+&nbsp; New Tool</a>
                            </div>
                        </div>

                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Designation</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Make</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Qty</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Date</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Tools as $tool)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            @if ($tool->photo)

                                                            <img src='{{ asset("storage/$tool->photo") }}'
                                                                class="avatar avatar-sm me-3">
                                                            @else

                                                            <img src="../assets/img/Circle-icons-tools.png"
                                                                class="avatar avatar-sm me-3">
                                                            @endif
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $tool->id }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $tool->name }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $tool->make }}</p>
                                                    <p class="text-xs text-secondary mb-0">{{ $tool->model }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if ($tool->active == 1)
                                                        <span class="badge badge-sm bg-gradient-success">Online</span>
                                                    @else
                                                        <span
                                                            class="badge badge-sm bg-gradient-secondary">Offline</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $tool->quantity }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $tool->created_at }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="mx-3" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Edit user">
                                                        <i class="fas fa-edit text-secondary"></i>
                                                    </a>
                                                    <span>
                                                        <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        {{ $Tools->links() }}
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
</main>
