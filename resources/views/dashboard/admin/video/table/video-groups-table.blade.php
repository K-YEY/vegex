<x-ui-dash.layout>
    <x-slot name="slot">
        <div class="row">
            <div class="col-lg-6">
                <h4>Groups Video</h4>
                <p>Manage Your Groups</p>
            </div>
            <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
                <a href="{{ route('admin.video.create') }}"
                    class="btn bg-gradient-dark mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">Add New Video</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <x-ui-dash.ui.data-table title="Groups Video" subtitle="Manage Your Groups" id="groups-video-table"
                    :columns="['Title', 'Price (Discount)', 'Subscribers', 'Max Videos (Videos)', 'Rate', 'Actions']">
                    @foreach ($groups as $group)
                        <tr>
                            <td class="text-xs font-weight-normal">
                                <div class="d-flex px-2 py-1  align-items-center">
                                    <div>
                                        <img src="{{ $group->cover ? asset('storage/' . $group->cover) : asset('app/assets/img/bg-auth.jpg') }}"
                                            class="avatar avatar-xs me-2" alt="{{ $group->title }}">

                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <span>{{ $group->title }}</span>
                                        <p class="text-xs text-secondary mb-0">
                                            {{ strip_tags(Str::limit($group->description, 50)) }}</p>
                                    </div>
                                </div>

                            </td>

                            <td class="text-sm font-weight-normal">
                                @if ($group->price == 0)
                                    Free
                                @else
                                    @if ($group->discount)
                                        <span
                                            class="text-success text-gradient">${{ number_format($group->price - $group->discount, 2) }}</span>
                                        <s> <sup
                                                class="text-danger text-gradient">${{ number_format($group->price, 2) }}</sup></s>
                                    @else
                                        <span
                                            class="text-success text-gradient">${{ number_format($group->price, 2) }}</span>
                                    @endif
                                @endif
                            </td>
                            <td class="text-sm font-weight-normal">{{ $group->count_subscribers ?? 'NaN' }}</td>
                            <td class="text-sm font-weight-normal">{{ $group->max_videos }}
                                ({{ $group->total_videos ?? 'NaN' }})</td>
                            <td class="text-sm font-weight-normal">{{ $group->rate ?? 'NaN' }}</td>
                            <td class="text-sm">
                                <a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Preview group">
                                    <i
                                        class="material-symbols-rounded text-secondary position-relative text-lg">visibility</i>
                                </a>
                                <a href="{{ route('admin.video.group.edit', $group->id) }}" class="mx-3"
                                    data-bs-toggle="tooltip" data-bs-original-title="Edit group">
                                    <i
                                        class="material-symbols-rounded text-secondary position-relative text-lg">drive_file_rename_outline</i>
                                </a>
                                <a href="javascript:;"
                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $group->id }}').submit();"
                                    data-bs-toggle="tooltip" data-bs-original-title="Delete group">
                                    <i
                                        class="material-symbols-rounded text-secondary position-relative text-lg">delete</i>
                                </a>
                                <form id="delete-form-{{ $group->id }}"
                                    action="{{ route('admin.video.group.destroy', $group->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('PUT')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if ($groups->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">No group videos found</td>
                        </tr>
                    @endif

                </x-ui-dash.ui.data-table>
            </div>
        </div>
    </x-slot>

</x-ui-dash.layout>
