<x-ui-dash.layout :IS_AUTH="true" :PAGE_TITLE="'Sign In'">
    <x-slot name="slot">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('{{ asset('app/assets/img/illustrations/illustration-sign.jpg') }}');">
            <span class="mask bg-gradient-dark opacity-4"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-2">Sign in</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form role="form" class="text-start" action="{{ route('login.post') }}"
                                    method="post">
                                    @csrf
                                    <div
                                        class="input-group input-group-outline @error('email') is-invalid @enderror my-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ old('email') }}"
                                            pattern="^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com|outlook\.com)$"
                                            title="Please enter a Gmail, Yahoo, or Outlook email" inputmode="email"
                                            required>
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                    <div class="form-check form-switch d-flex align-items-center mb-3">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" name="remeber"
                                            checked>
                                        <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign
                                            in</button>
                                    </div>

                                    <a href="{{ route('register') }}" class="btn btn-outline-info w-100 my-4 mb-2">Sign
                                        up</a>
                                    <p class="mt-4 text-sm text-center">
                                        Forgot Password...?
                                        <a href="{{ route('password.request') }}"
                                            class="text-dark text-gradient font-weight-bold">Get Password</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



    </x-slot>

</x-ui-dash.layout>
