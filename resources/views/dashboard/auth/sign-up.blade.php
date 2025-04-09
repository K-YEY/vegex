<x-ui-dash.layout :IS_AUTH="true">
    <x-slot name="slot">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                                style="background-image: url('{{ asset('app/assets/img/bg-auth.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                            <div class="card card-plain">
                                <div class="card-header">
                                    <h4 class="font-weight-bolder">Sign Up</h4>
                                    <p class="mb-0">Enter your email and password to register</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" autocomplete="off" method="post"
                                        action="{{ route('register.post') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="input-group input-group-outline mb-3">
                                                    <label class="form-label">First Name</label>
                                                    <input type="text" name="fname" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group input-group-outline mb-3">
                                                    <label class="form-label">Last Name</label>
                                                    <input type="text" name="lname" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Phone (Whats-App)</label>
                                            <input type="tel" name="phone" class="form-control"
                                                pattern="^\+?[0-9]{7,15}$" title="Enter Your Phone Number"
                                                inputmode="tel" required>

                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" inputmode="email"
                                                required>
                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" minlength="8" class="form-control"
                                                required>
                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" name="password_confirmation" minlength="8"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-check form-check-info text-start ps-0">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="flexCheckDefault" checked required>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                I agree the <a href="javascript:;"
                                                    class="text-dark font-weight-bolder">Terms and Conditions</a>
                                            </label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Sign
                                                Up</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-2 text-sm mx-auto">
                                        Already have an account?
                                        <a href="{{ route('login') }}"
                                            class="text-dark text-gradient font-weight-bold">Sign in</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <x-ui-dash.ui.alert :IS_ERROR="true" :HEAD="'A problem occurred'">
                    <x-slot name="TITLE">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </x-slot>

                </x-ui-dash.ui.alert>
            @endif

        </section>



    </x-slot>


</x-ui-dash.layout>
