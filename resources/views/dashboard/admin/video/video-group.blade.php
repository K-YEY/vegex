<x-ui-dash.layout>
    <x-slot name="slot">
        <form
            action="{{ isset($groupVideo) ? route('admin.video.group.update', $groupVideo) : route('admin.video.group.store') }}"
            method="POST" enctype="multipart/form-data">
            @if (isset($groupVideo))
                @method('PUT')
            @endif
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <h4>Group Videos</h4>
                    <p>{{ isset($groupVideo) ? 'Update' : 'Create' }} a group to organize videos.</p>
                </div>
                <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
                    <button type="submit"
                        class="btn bg-gradient-dark mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">{{ isset($groupVideo) ? 'Update' : 'Create' }}</button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_free" value="1" id="fcustomCheck1"
                            {{ (isset($groupVideo) && !$groupVideo->price) || old('is_free') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="fcustomCheck1">Make it Free</label>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-4">
                    <div class="card mt-4" data-animation="true">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <a class="d-block blur-shadow-image">
                                <img id="coverPreview"
                                    src="{{ isset($groupVideo) ? asset('storage/' . $groupVideo->cover) : asset('app/assets/img/bg-auth.jpg') }} "
                                    alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                            </a>
                            <div id="coverShadow" class="colored-shadow"
                                style="background-image: url({{ isset($groupVideo) ? asset('storage/' . $groupVideo->cover) : asset('app/assets/img/bg-auth.jpg') }} );">
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <input type="file" name="cover"
                                value="{{ isset($groupVideo) ? $groupVideo->cover : '' }}" id="coverUpload"
                                accept="image/jpeg,image/png,image/gif" style="display: none"
                                onchange="previewImage(this)">
                            <div class="mt-n6 mx-auto">
                                <button class="btn bg-gradient-dark btn-sm mb-0 me-2" type="button"
                                    onclick="document.getElementById('coverUpload').click()">Edit</button>
                                <button class="btn btn-outline-dark btn-sm mb-0" type="button"
                                    onclick="resetCover()">Remove</button>
                            </div>
                            <div id="imageError" class="text-danger mt-2" style="display: none"></div>
                            <h5 class="font-weight-normal mt-4">
                                Cover Group
                            </h5>
                            <p class="mb-0">
                                Choose a suitable cover of 1200x1200 pixels.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-lg-0 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="font-weight-bolder">Group Information</h5>
                            <div class="row mt-4">
                                <div class="col-12 col-sm-12">
                                    <div class="input-group input-group-dynamic">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control w-100"
                                            aria-describedby="Title"
                                            value="{{ isset($groupVideo) ? $groupVideo->title : old('title') }}"
                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="input-group input-group-dynamic">
                                        <label class="form-label">Max Videos</label>
                                        <input type="number" name="max_videos" min="1"
                                            class="form-control w-100"
                                            value="{{ isset($groupVideo) ? $groupVideo->max_videos : old('max_videos') }}"
                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group input-group-dynamic">
                                        <label class="form-label">Max Users</label>
                                        <input type="number" name="max_users" min="1" class="form-control w-100"
                                            value="{{ isset($groupVideo) ? $groupVideo->join_max : old('max_users') }}"
                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4" id="row_price">
                                <div class="col-6">
                                    <div class="input-group input-group-dynamic">
                                        <label class="form-label">Price</label>
                                        <input type="number" name="price" step="0.01" min="0"
                                            class="form-control w-100"
                                            value="{{ isset($groupVideo) ? $groupVideo->price : old('price') }}"
                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group input-group-dynamic">
                                        <label class="form-label">Discount (LE)</label>
                                        <input type="number" name="discount" step="0.01" min="0"
                                            class="form-control w-100"
                                            value="{{ isset($groupVideo) ? $groupVideo->discount : old('discount') }}"
                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="desc" id="tinymceExample" rows="10">{{ isset($groupVideo) ? $groupVideo->description : old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </x-slot>
    <x-slot name="slot_script">
        <script src="{{ asset('app/assets/js/video.js') }}"></script>
    </x-slot>
</x-ui-dash.layout>
