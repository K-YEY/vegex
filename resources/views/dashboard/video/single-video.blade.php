<x-ui-dash.layout>
    <x-slot name="slot">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">Course Details</h5>
                        <div class="row">
                            <div class="col-md-12 text-center ">
                                <div class="h-100 w-100"> <x-ui-dash.ui.ui-video
                                        src="{{ App\Helpers\VideoGroupHelper::AssetMedia($video->video_path) }}"
                                        poster="{{ App\Helpers\VideoGroupHelper::AssetMedia($video->cover) }}"></x-ui-dash.ui.ui-video>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3 class="mt-lg-0 mt-4 mb-0">{{ $video->title }}</h3>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rating">
                                                <span class="badge bg-warning d-flex align-items-center">
                                                    {{ $video->rating == 0 ? 'Be First smile' : number_format($video->rating, 1) }}
                                                </span>
                                            </div>
                                            <div class="duration">
                                                <span class="badge bg-light-subtle d-flex align-items-center text-dark">
                                                    <i class="material-symbols-rounded me-1">schedule</i>
                                                    {{ \App\Helpers\VideoGroupHelper::formatDuration($video->duration) }}
                                                </span>
                                            </div>
                                            <div class="duration">
                                                <span
                                                    class="badge bg-info-subtle d-flex align-items-center text-white-50">
                                                    <i class="material-symbols-rounded me-1">visibility</i>
                                                    {{ $video->count_view }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="rating">
                                <x-ui-dash.ui.rating is_rating="{{$video->rateing}}"></x-ui-dash.ui.rating>

                            </div>
                            <h6 class="mt-4 text-bold">Description</h6>
                            {!! $video->description !!}
                        </div>
                        <div class="row mt-4">
                            @if ($video->previousVideo || $video->nextVideo)
                                <div class="d-flex justify-content-between w-100">
                                    @if ($video->previousVideo)
                                        <div class="col-md-5 prev-video-card">
                                            <div class="promo" style="--overlay-color: #E7F0FF">
                                                <div class="image-wrapper">
                                                    <img src="{{ App\Helpers\VideoGroupHelper::AssetMedia($video->previousVideo->cover) ?? App\Helpers\VideoGroupHelper::AssetMedia($media) }}"
                                                        alt="Previous lesson thumbnail">
                                                </div>
                                                <h2 class="title text-truncate" data-cta="Watch →">
                                                    {{ Str::limit($video->previousVideo->title, 6) }}</h2>
                                                <a href="{{ route('dashboard.video.show', $video->previousVideo->id) }}"
                                                    class="stretched-link"></a>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($video->nextVideo)
                                        <div class="col-md-5 next-video-card w-auto">
                                            <div class="promo" style="--overlay-color: #E7F0FF">
                                                <div class="image-wrapper">
                                                    <img src="{{ App\Helpers\VideoGroupHelper::AssetMedia($video->nextVideo->cover) ?? App\Helpers\VideoGroupHelper::AssetMedia($media) }}"
                                                        alt="Next lesson thumbnail">
                                                </div>
                                                <h2 class="title text-truncate" data-cta="Continue →">
                                                    {{ Str::limit($video->nextVideo->title, 6) }}</h2>
                                                <a href="{{ route('dashboard.video.show', $video->nextVideo->id) }}"
                                                    class="stretched-link"></a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-ui-dash.layout>
