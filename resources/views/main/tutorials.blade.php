@extends('components.layout')
@section('title', 'Tutorials')
@section('content')
<style>

    @import url('https://fonts.cdnfonts.com/css/xeroda');

    @font-face {
      font-family: "VIP Hakm";
      src: url("VIP\ Hakm.ttf") format("ttf"),
  }
      body {
        background: #000000;
        font-family: "VIP Hakm" , sans-serif , 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
         font-size: 14px;
        color: #000;
        margin: 0;
        padding: 0;
      }

      .nav-icons { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
  .nav-icons a { color: white; font-size: 30px; text-decoration: none; padding: 20px 10px 10px 30px; transition: 0.3s; }
  .nav-icons a:hover { color: #bbb; }

      .swiper {
        width: 100%;
        height: 100%;
        flex-grow: 1;
        border: 1px solid rgb(36, 36, 36);
        padding-bottom: 40px;


      }
      #mainTitle2{
        font-size: clamp(2rem, 6vw, 5rem) !important;

      }

      .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #000000;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        transform: scale(.7);
      }
      .custom-cancel-button {
      background-color: white !important; /* ✅ خلفية بيضاء */
      color: black !important;
      border-radius: 5px;
      padding: 10px 20px;
      border: 1px solid black !important;
      transition: background 0.3s, color 0.3s;
  }

  .custom-cancel-button:hover {
      background-color: black !important; /* ✅ يتحول للأسود عند الهوفر */
      color: white !important;
  }


    </style>
<main class="container text-white d-flex justify-content-center align-items-center">
  <div class="row align-items-start">
    <div class="col align-items-start">
      <div class="col">
        <h1 id="mainTitle2">Explore Avilable Tutorials</h1>
      </div>
      <div class="col fs-2">
        <p id="mainP2"></p>
      </div>
    </div>
  </div>
</main>

<!-- Swiper -->
<div class="swiper mySwiper">
  <div class="swiper-wrapper">
    <div class="swiper-slide" data-course="After Effects">
      <div class="row align-items-center text-white w-75">
        <div class="col-md-6 text-center">
          <img class="img-fluid" src="{{asset('assets/images/ico/after effects.png')}}" alt="">
        </div>
        <div class="col-md-6 text-center text-md-start">
          <h2 class="title"></h2>
          <p class="text-white fs-4 par"></p>
          <a href="course-details.html?course=After Effects">
            <button class="fs-4 mt-4 px-4 py-2 button">Get Started</button>
          </a>
        </div>
      </div>
    </div>

    <div class="swiper-slide" data-course="PowerPoint">
      <div class="row align-items-center text-white w-75">
        <div class="col-md-6 text-center">
          <img class="img-fluid" src="{{asset('assets/images/ico/point.png')}}" alt="">
        </div>
        <div class="col-md-6 text-center text-md-start">
          <h2 class="title"></h2>
          <p class="text-white fs-4 par"></p>
          <a>
            <button onclick="courseNotFound()" class="fs-4 mt-4 px-4 py-2 button">Get Started</button>
          </a>
        </div>
      </div>
    </div>

    <div class="swiper-slide" data-course="Operating System">
      <div class="row align-items-center text-white w-75">
        <div class="col-md-6 text-center">
          <img class="img-fluid" src="{{asset('assets/images/ico/win.png')}}" alt="">
        </div>
        <div class="col-md-6 text-center text-md-start">
          <h2 class="title"></h2>
          <p class="text-white fs-4 par"></p>
          <a href="course-details.html?course=Operating System">
            <button class="fs-4 mt-4 px-4 py-2 button">Get Started</button>
          </a>
        </div>
      </div>
    </div>
    <div class="swiper-slide" data-course="Operating System">
        <div class="row align-items-center text-white w-75">
          <div class="col-md-6 text-center">
            <img class="img-fluid" src="{{asset('assets/images/ico/win.png')}}" alt="">
          </div>
          <div class="col-md-6 text-center text-md-start">
            <h2 class="title"></h2>
            <p class="text-white fs-4 par"></p>
            <a href="course-details.html?course=Operating System">
              <button class="fs-4 mt-4 px-4 py-2 button">Get Started</button>
            </a>
          </div>
        </div>
      </div>
  </div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-pagination"></div>
  <div class="swiper-pagination"></div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{asset('assets/js/tutorials.js')}}"></script>
@endsection
