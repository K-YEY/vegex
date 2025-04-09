<x-ui-dash.layout>
    <x-slot name="slot">
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4" id="header-background">
                <span class="mask bg-gradient-dark opacity-6"></span>
            </div>
            <div class="card card-body mx-2 mx-md-2 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ $user->pic ?? asset('assets/images/vegex.png') }}" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ $user->name }}
                            </h5>

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="row">

                        <div class="col-12 col-xl-6">
                            <div class="card card-plain h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="mb-0">Profile Information</h6>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <a href="javascript:;">
                                                <i class="fas fa-user-edit text-secondary text-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Edit Profile"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">

                                    <ul class="list-group">

                                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark">Mobile:</strong> &nbsp; {{ $user->phone }}</li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark">Email:</strong> &nbsp; {{ $user->email }}</li>

                                        <li class="list-group-item border-0 ps-0 pb-0">
                                            <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                            <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0"
                                                href="javascript:;">
                                                <i class="fab fa-facebook fa-lg"></i>
                                            </a>
                                            <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0"
                                                href="javascript:;">
                                                <i class="fab fa-twitter fa-lg"></i>
                                            </a>
                                            <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0"
                                                href="javascript:;">
                                                <i class="fab fa-instagram fa-lg"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="card card-plain h-100">
                                <div class="card-header pb-0 p-3">
                                    <h6 class="mb-0">My Videos</h6>
                                </div>
                                <div class="card-body p-3">
                                    <ul class="list-group">
                                        {{-- 4 videos --}}
                                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                            <div class="avatar me-3">
                                                <img src="../assets/img/kal-visuals-square.jpg" alt="kal"
                                                    class="border-radius-lg shadow">
                                            </div>
                                            <div class="d-flex align-items-start flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">video name</h6>
                                                <p class="mb-0 text-xs">desc</p>
                                            </div>
                                            <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto"
                                                href="javascript:;">view</a>
                                        </li>

                                        <li
                                            class="list-group-item border-0 d-flex align-items-center px-0 justify-content-center">
                                            <a class="btn btn-link pe-0 ps-0 mb-0 w-100 w-md-auto"
                                                href="javascript:;">More</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="slot_script">
        <script>
            // Define constants for Unsplash API and local storage keys
            const accessKey = "rlNSh8ic1QSapWVmjk9iRL0ZR83AlrtUg5pMzjCr5Q4";
            const storageKey = "unsplash_image";
            const expirationKey = "unsplash_expiration";

            // Fetch a random space-themed image from Unsplash API
            function fetchUnsplashImage() {
                fetch(`https://api.unsplash.com/photos/random?query=space&client_id=${accessKey}`)
                    .then(response => response.json())
                    .then(data => {
                        const imageUrl = data.urls.regular;
                        document.getElementById("header-background").style.backgroundImage = `url('${imageUrl}')`;

                        // Cache the image URL and set expiration time (24 hours)
                        localStorage.setItem(storageKey, imageUrl);
                        localStorage.setItem(expirationKey, Date.now() + 24 * 60 * 60 * 1000); // 24 hours
                    })
                    .catch(error => console.error("Error fetching image:", error));
            }

            // Load background image from cache or fetch new one
            function loadBackgroundImage() {
                const savedImage = localStorage.getItem(storageKey);
                const expirationTime = localStorage.getItem(expirationKey);

                // Use cached image if available and not expired, otherwise fetch new one
                if (savedImage && expirationTime && Date.now() < expirationTime) {
                    document.getElementById("header-background").style.backgroundImage = `url('${savedImage}')`;
                } else {
                    fetchUnsplashImage();
                }
            }

            // Initialize background image on page load
            loadBackgroundImage();
        </script>
    </x-slot>

</x-ui-dash.layout>
