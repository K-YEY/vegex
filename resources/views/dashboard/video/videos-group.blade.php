<x-ui-dash.layout>
    <x-slot name="slot">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">Course Details</h5>
                        <div class="row">
                            <div class="col-xl-5 col-lg-6 text-center">
                                <img class="w-100 border-radius-lg shadow-lg mx-auto"
                                    src="{{ $videoGroup->videoGroup->cover ? asset('storage/' . $videoGroup->videoGroup->cover) : asset('app/assets/img/bg-auth.jpg') }}"
                                    alt="{{ $videoGroup->videoGroup->title }}">

                            </div>
                            <div class="col-lg-5 mx-auto">
                                <h3 class="mt-lg-0 mt-4">{{ $videoGroup->videoGroup->title }}</h3>
                                <div class="progress mx-auto my-4">
                                    @php
                                        $percentage =
                                            ($videoGroup->videoGroup->count_subscribers /
                                                $videoGroup->videoGroup->join_max) *
                                            100;
                                        $progressClass = 'bg-gradient-success';
                                        if ($percentage >= 90) {
                                            $progressClass = 'bg-gradient-danger';
                                        } elseif ($percentage >= 70) {
                                            $progressClass = 'bg-gradient-warning';
                                        }
                                    @endphp
                                    <div class="progress-bar {{ $progressClass }}" role="progressbar"
                                        style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <div class="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= number_format($videoGroup->videoGroup->rate, 1))
                                            <i class="material-symbols-rounded text-lg text-warning">grade</i>
                                        @else
                                            <i class="material-symbols-rounded text-lg">star_outline</i>
                                        @endif
                                    @endfor
                                    <span class="text-xs">({{ $videoGroup->videoGroup->rate }})</span>
                                </div>
                                <br>
                                <h6 class="mb-0 mt-2">Course Hours</h6>
                                <span class="badge bg-gradient-dark">
                                    {{ \App\Helpers\VideoGroupHelper::formatDuration($videoGroup->videoGroup->duration) }}
                                </span>
                                <br>
                                <h6 class="mb-0 mt-2">Price</h6>
                                <h5>${{ number_format($videoGroup->videoGroup->price - $videoGroup->videoGroup->discount, 2) }}
                                </h5>
                                @if ($videoGroup->videoGroup->price == 0)
                                    <span class="badge bg-gradient-faded-success">FREE</span>
                                @elseif($videoGroup->videoGroup->discount > 0)
                                    <span
                                        class="badge bg-gradient-faded-danger">-${{ $videoGroup->videoGroup->discount }}</span>
                                @endif

                                <br>
                                <label class="mt-4">Description</label>
                                <div class="description-content">
                                    {!! $videoGroup->videoGroup->description !!}
                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-5">
                                        <a href="{{ route('user.subscription.courses.create', $videoGroup->videoGroup->id) }}"
                                            class="btn bg-gradient-dark mb-0 mt-lg-auto w-100">Subscribe</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <h5 class="ms-3">Videos in this Course</h5>
                                <div class="table table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Video</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Duration</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Rating</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Views</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($videos as $video)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="{{ $video->cover ? asset('storage/' . $video->cover) : asset('app/assets/img/bg-auth.jpg') }}"
                                                                    class="avatar avatar-md me-3"
                                                                    alt="{{ $video->title }}">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $video->title }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm text-secondary mb-0">
                                                            {{ \App\Helpers\VideoGroupHelper::formatDuration($video->duration) }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <div class="rating ms-lg-n4">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $video->rate)
                                                                    <i
                                                                        class="material-symbols-rounded text-lg">grade</i>
                                                                @else
                                                                    <i
                                                                        class="material-symbols-rounded text-lg">star_outline</i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-sm">{{ $video->count_view }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="{{ route('dashboard.video.show', $video->id) }}"
                                                            class="btn btn-sm bg-gradient-info">Watch</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">
                                                        <p class="text-sm text-secondary mb-0">No videos available in
                                                            this course yet.</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>
</x-ui-dash.layout>
