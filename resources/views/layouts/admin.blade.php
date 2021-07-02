<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.admin.head')
</head>
<body class="c-app">
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <img class="c-sidebar-brand-full" height="46" src="/images/logo.png" alt=""> <a href="/" target="_blank" class="text-white">DTVP</a>
        <img class="c-sidebar-brand-minimized" height="46" src="/images/logo.png" alt="">
{{--        <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">--}}
{{--            <use xlink:href="/coreui/dist/assets/brand/coreui.svg#full"></use>--}}
{{--        </svg>--}}
{{--        <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">--}}
{{--            <use xlink:href="/coreui/dist/assets/brand/coreui.svg#signet"></use>--}}
{{--        </svg>--}}
    </div>
    @include('layouts.admin.sidebar')
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
<div class="c-wrapper c-fixed-components">
    @include('layouts.admin.header')
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>
        <footer class="c-footer">
            <div> © 2020 creativeLabs.</div>
            <div class="ml-auto">Powered by&nbsp; Quang Huy</div>
        </footer>
    </div>
</div>
<!-- CoreUI and necessary plugins-->
<script src="/coreui/dist/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
<!--[if IE]><!-->
<script src="/coreui/dist/vendors/@coreui/icons/js/svgxuse.min.js"></script>
<!--<![endif]-->
<!-- Plugins and scripts required by this view-->
<script src="/coreui/dist/vendors/@coreui/chartjs/js/coreui-chartjs.bundle.js"></script>
<script src="/coreui/dist/vendors/@coreui/utils/js/coreui-utils.js"></script>
<script src="/coreui/dist/js/main.js"></script>
<script
    src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
    crossorigin="anonymous"></script>
<script src="https://vjs.zencdn.net/7.7.5/video.js"></script>
@stack('scripts')

</body>
</html>
