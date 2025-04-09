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

                                    <h4 class="font-weight-bolder">Verify Email</h4>
                                    <p class="mb-0">If don't get mail resend request</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" autocomplete="off" method="post"
                                        action="{{ route('verification.send') }}">
                                        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                                        <dotlottie-player
                                            src="https://lottie.host/9dca53b5-ab7f-404a-bee6-299f2e102d99/gaksfAGFNo.lottie"
                                            background="transparent" speed="1" style="width: 300px; height: 300px"
                                            loop autoplay></dotlottie-player>
                                        @csrf
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">
                                                Resend</button>
                                        </div>
                                    </form>
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
