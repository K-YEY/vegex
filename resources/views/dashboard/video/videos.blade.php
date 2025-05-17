{{--

TODO: Check eleaments on save video  description filter
--}}

<x-ui-dash.layout>
    <x-slot name="slot">

        <div class="row mt-3">
            @foreach ($videos as $video)
                <div class="col-lg-4 col-md-6">
                    <div class="card" @if ($isAdmin) data-animation="true" @endif>
                        <div class="card-header p-2 position-relative z-index-2 bg-transparent">
                            <a class="d-block blur-shadow-image">
                                <img src="{{ App\Helpers\VideoGroupHelper::AssetMedia($video->cover) ?? App\Helpers\VideoGroupHelper::AssetMedia(null) }}"
                                    alt="{{ $video->title }}" class="img-fluid shadow border-radius-lg">
                            </a>
                            <div class="colored-shadow"
                                style="background-image: url({{ App\Helpers\VideoGroupHelper::AssetMedia($video->cover) ?? App\Helpers\VideoGroupHelper::AssetMedia(null) }})">
                            </div>
                        </div>
                        <div class="card-body text-left">
                            <div class="d-flex mt-n6 mx-auto">
                                <a class="btn btn-link text-primary ms-auto border-0" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-original-title="Status">
                                    <i class="material-symbols-rounded text-lg">monitoring</i>
                                </a>
                                @if ($isAdmin)
                                    <button class="btn btn-link text-info me-auto border-0" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" data-bs-original-title="Edit">
                                        <i class="material-symbols-rounded text-lg">edit</i>
                                    </button>
                                @endif
                            </div>
                            <h5 class="font-weight-bold mt-3">
                                <a
                                    href="{{ route('user.video.show', ['id' => $video->id, 'courseid' => $videoGroup->videoGroup->id]) }}">{{ $video->title }}</a>
                            </h5>
                            <p class="mb-0 text-sm">
                                {{ Str::limit(strip_tags($video->description ?? 'No description available'), 100) }}
                            </p>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer d-flex justify-content-between align-items-center">

                            <div class="d-flex align-items-center">
                                <div class="feedback">
                                    @php
                                        $rating = $video->rating ?? 0;
                                        $ratingClass = match (true) {
                                            $rating >= 4.5 => 'happy',
                                            $rating >= 3.5 => 'good',
                                            $rating >= 2.5 => 'ok',
                                            $rating >= 1.5 => 'sad',
                                            default => 'happy',
                                        };
                                    @endphp
                                    <label class="{{ $ratingClass }}">
                                        <input type="radio" disabled name="show{{$video->id}}" checked />
                                        <div>
                                            <svg class="eye left">
                                                <use xlink:href="#eye">
                                            </svg>
                                            <svg class="eye right">
                                                <use xlink:href="#eye">
                                            </svg>
                                            <svg class="mouth">
                                                <use xlink:href="#mouth">
                                            </svg>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <i class="material-symbols-rounded text-lg me-1">schedule</i>
                                <p class="font-weight-bold text-dark my-auto">
                                    {{ App\Helpers\VideoGroupHelper::formatDuration($video->duration) }}</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="material-symbols-rounded text-lg me-1">visibility</i>
                                <p class="font-weight-bold text-dark my-auto">
                                    {{ $video->count_view }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </x-slot>
</x-ui-dash.layout>
