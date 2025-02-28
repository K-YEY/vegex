@extends('components.layout')
@section('title', 'Home')
@section('content')
    <div class="intro">
        <div class="logo">
            <img src="{{ asset('assets/images/vegex.png') }}" class="img-fluid" alt="" srcset="">
        </div>
    </div>
    <div id="butter">
        <main class="container text-white flex justify-content-center align-items-center">
            <div class="col text-center img-fluid align-items-center">
                <img src="{{ asset('assets/images/vegex.png') }}" class="img-fluid" id="ve" style="width: 500px;"
                    alt="" srcset="">
            </div>
            <div class="col align-items-start text-center">
                <div class="col">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <input type="submit">
                    </form>
                    <h1 id="mainTitle">Vegex Agency </h1>
                </div>
                <div class="col fs-2 text-center">
                    <a target="_blank" href="https://web.facebook.com/ahmedmomen.amar/">
                        <p id="mainP">From Ahmed Momen</p>
                    </a>
                </div>
            </div>
        </main>

        <!-- First Section -->
        <section style="margin-top: 80px; "
            class="container-fluid d-flex mb-5  align-items-center justify-content-center p-2">
            <div class="row align-items-center text-white w-75 d-flex flex-column-reverse flex-md-row">
                <!-- النص على الموبايل يكون تحت الصورة -->
                <div class="col-md-6  text-md-start">
                    <h2 id="sectionTitle1" class="fw-bold">Latest projects</h2>
                    <p class="text-white px-0 fs-4">
                        We create stunning websites, motion graphics, and designs that bring your vision to life. Let's
                        build something amazing together!
                    </p>
                    <button class="fs-4 mt-4 px-4 py-2" onclick="sectionNotFound()">Get Started</button>
                </div>
                <!-- الصورة -->
                <div class="col-md-6 text-center">
                    <lord-icon id="gear" class=" img-fluid" colors="primary:#ffffff"
                        src="https://cdn.lordicon.com/lecprnjb.json" style="width:700px;height:300px;scale: 1.1; ">
                    </lord-icon>
                </div>
            </div>
        </section>

        <!-- Second Section -->
        <section class="container-fluid d-flex align-items-center justify-content-center mb-5 p-2">
            <div class="row align-items-center text-white w-75 d-flex flex-column-reverse flex-md-row">
                <!-- النص -->
                <div class="col-md-6  text-md-start">
                    <h2 class="fw-bold" id="sectionTitle2">Creative Mastery</h2>
                    <p class="text-white fs-4">
                        Learn web development, motion graphics, and design with expert-led courses. Elevate your skills and
                        turn your passion into a profession!
                    </p>
                    <a href="{{ route('tutorials') }}">
                        <button class="fs-4 mt-4 px-4 py-2" onclick="playClickSound()">Get Started</button>
                    </a>
                </div>
                <!-- الصورة -->
                <div class="col-md-6 text-center">
                    <lord-icon class="img-fluid" id="arrow" src="https://cdn.lordicon.com/aklfruoc.json"
                        colors="primary:#ffffff" style="width:700px;height:300px;scale: 1.3; z-index: -1;">
                    </lord-icon>
                </div>

            </div>
        </section>
    </div>
@endsection
