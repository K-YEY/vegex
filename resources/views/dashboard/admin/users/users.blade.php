<x-ui-dash.layout>
    <x-slot name="slot">
        <div class="row">
            <div class="col-lg-6">
                <h4>Users</h4>
                <p>Manage your members.</p>
            </div>

        </div>

        <div class="row mt-4">
            <div class="col-12">
                <x-ui-dash.ui.data-table title="Members" subtitle="Manage your members" id="users-table" :columns="['ID', 'Email', 'Phone', 'Created', 'Actions']">
                    @forelse($users as $user)
                        <tr>
                            <td class="text-xs font-weight-normal">
                                <div class="d-flex px-2 py-1 align-items-center">
                                    <div>
                                        <img src="{{ $user->pic ? asset('storage/' . $user->pic) : asset('assets/images/vegex.png') }}"
                                            class="avatar avatar-xs me-2" alt="{{ $user->name }}">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <span>{{ $user->name }}</span>
                                        {{ $user->uid }}
                                    </div>
                                </div>
                            </td>
                            <td class="text-sm font-weight-normal">
                                <span
                                    class="badge badge-sm {{ $user->email_verified_at ? 'bg-gradient-success' : 'bg-gradient-danger' }}">
                                    {{ $user->email }}

                                </span>

                            </td>
                            <td class="text-sm font-weight-normal">
                                {{ $user->phone }}

                            </td>
                            <td class="text-sm font-weight-normal">
                                <span
                                    class="badge badge-sm bg-gradient-dark">{{ $user->created_at->format('d/m/Y H:i a') }}</span>
                            </td>
                            <td class="text-sm">
                                <a href="{{ route('admin.video.edit', $user->id) }}" class="mx-3"
                                    data-bs-toggle="tooltip" data-bs-original-title="Edit video">
                                    <i
                                        class="material-symbols-rounded text-secondary position-relative text-lg">drive_file_rename_outline</i>
                                </a>
                                <a href="javascript:;"
                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();"
                                    data-bs-toggle="tooltip" data-bs-original-title="Delete video">
                                    <i
                                        class="material-symbols-rounded text-secondary position-relative text-lg">delete</i>
                                </a>
                                <form id="delete-form-{{ $user->id }}"
                                    action="{{ route('admin.video.destroy', $user->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No videos found</td>
                        </tr>
                    @endforelse
                </x-ui-dash.ui.data-table>

            </div>
        </div>
    </x-slot>
</x-ui-dash.layout>
