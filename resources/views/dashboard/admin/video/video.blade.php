<x-ui-dash.layout>
    <x-slot name="slot">
        <form action="{{ isset($video) ? route('admin.video.update', $video->id) : route('admin.video.store') }}"
            method="POST" enctype="multipart/form-data">
            @if (isset($video))
                @method('PUT')
            @endif
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <h4>{{ isset($video) ? 'Edit' : 'Create' }} Video</h4>
                    <p>{{ isset($video) ? 'Update' : 'Create' }} a video and assign it to a group.</p>
                </div>
                <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
                    <button type="submit"
                        class="btn bg-gradient-dark mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">{{ isset($video) ? 'Update' : 'Create' }}</button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_free" value="1" id="fcustomCheck1"
                            {{ (isset($video) && $video->is_free) || old('is_free') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="fcustomCheck1">Make it Free</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                            id="fcustomCheck2"
                            {{ (isset($video) && $video->is_active) || old('is_active', true) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="fcustomCheck2">Active</label>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-4">
                    <div class="card mt-4" data-animation="true">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <a class="d-block blur-shadow-image">
                                <img id="coverPreview"
                                    src="{{ isset($video) && $video->cover ? asset('storage/' . $video->cover) : 'https://demos.creative-tim.com/material-dashboard-pro/assets/img/products/product-11.jpg' }} "
                                    alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                            </a>
                            <div id="coverShadow" class="colored-shadow"
                                style="background-image: url({{ isset($video) && $video->cover ? asset('storage/' . $video->cover) : 'https://demos.creative-tim.com/material-dashboard-pro/assets/img/products/product-11.jpg' }});">
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <input type="file" name="cover" id="coverUpload"
                                accept="image/jpeg,image/png,image/jpg,image/webp" style="display: none"
                                onchange="previewImage(this)">
                            <div class="mt-n6 mx-auto">
                                <button class="btn bg-gradient-dark btn-sm mb-0 me-2" type="button"
                                    onclick="document.getElementById('coverUpload').click()">Edit</button>
                                <button class="btn btn-outline-dark btn-sm mb-0" type="button"
                                    onclick="resetCover()">Remove</button>
                            </div>
                            <div id="imageError" class="text-danger mt-2" style="display: none"></div>
                            <h5 class="font-weight-normal mt-4">
                                Video Cover
                            </h5>
                            <p class="mb-0">
                                Choose a suitable cover image.
                            </p>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="font-weight-bolder">Video File</h5>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <input type="file" name="video_file" class="form-control"
                                        accept="video/mp4,video/mov,video/avi,video/wmv"
                                        {{ !isset($video) ? 'required' : '' }}>
                                    @if (isset($video) && $video->video_path)
                                        <div class="mt-2">
                                            <small class="text-muted">Current video:
                                                {{ basename($video->video_path) }}</small>
                                            <div class="mt-2">
                                                <video width="320" height="240" controls>
                                                    <source src="{{ asset('storage/' . $video->video_path) }}"
                                                        type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-lg-0 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="font-weight-bolder">Video Information</h5>
                            <div class="row mt-4">
                                <div class="col-12 col-sm-12">
                                    <div class="input-group input-group-static">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control w-100"
                                            aria-describedby="Title" placeholder="title"
                                            value="{{ isset($video) ? $video->title : old('title') }}"
                                            onfocus="focused(this)" onfocusout="defocused(this)" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label class="form-label mt-4 ms-0">Video Group</label>
                                    <select class="form-control" name="group_video_id" id="group_video_id">
                                        <option value="">Select a group</option>
                                        @foreach ($groupVideos as $group)
                                            <option value="{{ $group->id }}"
                                                {{ (isset($videoGroup) && $videoGroup->video_group_id == $group->id) || old('group_video_id') == $group->id ? 'selected' : '' }}>
                                                {{ $group->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id="tinymceExample" rows="10">{{ isset($video) ? $video->description : old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </x-slot>
    <x-slot name="slot_script">
        <script>
            if (document.getElementById('group_video_id')) {
                var groupvideo = document.getElementById('group_video_id');
                const example = new Choices(groupvideo);
            }
        </script>
        <script src="{{ asset('app/assets/js/video.js') }}"></script>
    </x-slot>
</x-ui-dash.layout>
