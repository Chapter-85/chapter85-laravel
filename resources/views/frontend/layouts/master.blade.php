<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layouts.header_scripts')
    @stack('frontend.layouts.header_scripts')
</head>

<body class="appear-animate">

    <div class="page-loader">
        <div class="loader">Loading...</div>
    </div>

    <a href="#main" class="btn skip-to-content">Skip to Content</a>

    <div class="page" id="top">

        @include('frontend.layouts.nav')


        <main id="main">
            @yield('content')
        </main>

        @include('frontend.layouts.footer')

    </div>

    @include('frontend.layouts.footer_scripts')
    @stack('frontend.layouts.footer_scripts')
</body>

</html>
