<x-ui-dash.layout>
    <x-slot name="slot">
        <div class="row">
            <div class="col-lg-6">
                <h4>Group Videos</h4>
                <p>Create a group to organize videos.</p>
            </div>
            <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
                <button type="button"
                    class="btn bg-gradient-dark mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">Create</button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1" checked="">
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
                                src="https://demos.creative-tim.com/material-dashboard-pro/assets/img/products/product-11.jpg"
                                alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                        </a>
                        <div id="coverShadow" class="colored-shadow"
                            style="background-image: url(https://demos.creative-tim.com/material-dashboard-pro/assets/img/products/product-11.jpg);">
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <input type="file" id="coverUpload" accept="image/jpeg,image/png,image/gif"
                            style="display: none" onchange="previewImage(this)">
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
                                    <input type="text" class="form-control w-100" aria-describedby="Title"
                                        onfocus="focused(this)" onfocusout="defocused(this)">
                                </div>
                            </div>

                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">Max Videos</label>
                                    <input type="number" min="1" class="form-control w-100"
                                        onfocus="focused(this)" onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">Max Users</label>
                                    <input type="number" min="1" class="form-control w-100"
                                        onfocus="focused(this)" onfocusout="defocused(this)">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4" id="row_price">
                            <div class="col-6">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">Price</label>
                                    <input type="email" class="form-control w-100" onfocus="focused(this)"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">Discount (LE)</label>
                                    <input type="email" class="form-control w-100" onfocus="focused(this)"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="desc" id="tinymceExample" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </x-slot>
    <x-slot name="slot_script">
        <script src="{{ asset('app/assets/js/video-g-create-edit.js') }}"></script>
    </x-slot>
</x-ui-dash.layout>
