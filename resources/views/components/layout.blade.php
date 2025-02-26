<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-barba="wrapper">
@include('components.layout.header')
<body id="page" data-barba="container" data-barba-namespace="home">
    <!-- Language Switcher -->
    <div id="languageSwitcher" style="z-index: 100;" class="position-absolute top-0 end-0 m-3">
        <button id="toggleLang" class="lang-btn" aria-label="Toggle Language">ع</button>
    </div>

    <!-- Content Slot -->
    <div id="content" data-i18n-align>
        @yield('content')

    </div>

    @include('components.layout.footer')
    @include('components.layout.scripts')

</body>
</html>
