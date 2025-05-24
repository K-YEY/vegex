<x-ui-dash.layout>
    <x-slot name="slot">
        <div class="row">
            <div class="col-lg-6">
                <h4>Videos</h4>
                <p>Manage your videos.</p>
            </div>
            <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
                <a href="{{ route('admin.video.group.create') }}"
                    class="btn bg-gradient-dark mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">Add New Group</a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <x-ui-dash.ui.data-table title="Videos" subtitle="Manage your videos" id="videos-table" :columns="['Video', 'Group', 'Status', 'Free', 'Views', 'Created', 'Actions']">
                    @forelse($videos as $video)
                        <tr>
                            <td class="text-xs font-weight-normal">
                                <div class="d-flex px-2 py-1 align-items-center">
                                    <div>
                                        <img src="{{ $video->cover ? asset('storage/' . $video->cover) : asset('assets/images/vegex.png') }}"
                                            class="avatar avatar-xs me-2" alt="{{ $video->title }}">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <span>{{ $video->title }}</span>
{{ Str::limit(strip_tags($video->description), 50) }}
                                    </div>
                                </div>
                            </td>
                            <td class="text-sm font-weight-normal">
                                @php
                                    $videoGroup = $video->videoGroups->first();
                                    $groupName = $videoGroup ? $videoGroup->videoGroup->title : 'Not assigned';
                                @endphp
                                {{ $groupName }}
                            </td>
                            <td class="text-sm font-weight-normal">
                                <span
                                    class="badge badge-sm {{ $video->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">{{ $video->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td class="text-sm font-weight-normal">
                                <span
                                    class="badge badge-sm {{ $video->is_free ? 'bg-gradient-info' : 'bg-gradient-warning' }}">{{ $video->is_free ? 'Free' : 'Paid' }}</span>
                            </td>
                            <td class="text-sm font-weight-normal">{{ $video->count_view }}</td>
                            <td class="text-sm font-weight-normal">
                                <span
                                    class="badge badge-sm bg-gradient-dark">{{ $video->created_at->format('d/m/Y H:i a') }}</span>
                            </td>
                            <td class="text-sm">
                                <a href="{{ route('admin.video.edit', $video->id) }}" class="mx-3"
                                    data-bs-toggle="tooltip" data-bs-original-title="Edit video">
                                    <i
                                        class="material-symbols-rounded text-secondary position-relative text-lg">drive_file_rename_outline</i>
                                </a>
                                <a href="javascript:;"
                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $video->id }}').submit();"
                                    data-bs-toggle="tooltip" data-bs-original-title="Delete video">
                                    <i
                                        class="material-symbols-rounded text-secondary position-relative text-lg">delete</i>
                                </a>
                                <form id="delete-form-{{ $video->id }}"
                                    action="{{ route('admin.video.destroy', $video->id) }}" method="POST"
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
