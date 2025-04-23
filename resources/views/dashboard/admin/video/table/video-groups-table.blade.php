<x-ui-dash.layout>
    <x-slot name="slot">
        <div class="row mt-4">
            <div class="col-12">
                <x-ui-dash.ui.data-table title="Groups Video" subtitle="Groups for all videos" id="groups-video-table"
                    :columns="[
                        'Title',
                        'description',
                        'Price (Discount)',
                        'Subscribers',
                        'Max Videos (Videos)',
                        'Rate',
                        'Actions',
                    ]">
                    @foreach ($groups as $group)
                        <tr>
                            <td class="text-xs font-weight-normal">
                                <div class="d-flex align-items-center">
                                    @if ($group->cover)
                                        <img src="{{ asset('storage/' . $group->cover) }}" class="avatar avatar-xs me-2"
                                            alt="{{ $group->title }}">
                                    @else
                                        <img src="../../../assets/img/team-2.jpg" class="avatar avatar-xs me-2"
                                            alt="default image">
                                    @endif
                                    <span>{{ $group->title }}</span>
                                </div>
                            </td>
                            <td class="text-sm font-weight-normal">{{ strip_tags(Str::limit($group->description, 50)) }}
                            </td>
                            <td class="text-sm font-weight-normal">
                                @if ($group->price == 0)
                                    Free
                                @else
                                    ${{ number_format($group->price, 2) }}
                                    @if ($group->discount)
                                        <span class="text-success">({{ number_format($group->discount, 2) }})</span>
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
