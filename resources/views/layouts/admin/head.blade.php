<base href="/coreui/dist/./">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
<meta name="author" content="Łukasz Holeczek">
<meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
<title>{{ env('APP_NAME', 'eLearn') }} - @yield('title')</title>
<link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

<meta name="theme-color" content="#ffffff">
<!-- Main styles for this application-->
<link href="/coreui/dist/css/style.css" rel="stylesheet">
<link href="/coreui/dist/vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
<link href="https://vjs.zencdn.net/7.7.5/video-js.css" rel="stylesheet" />
<!-- Video.js base CSS -->
<link href="https://unpkg.com/video.js@7/dist/video-js.min.css" rel="stylesheet">

<!-- City -->
<link href="https://unpkg.com/@videojs/themes@1/dist/city/index.css" rel="stylesheet">

<!-- Fantasy -->
<link href="https://unpkg.com/@videojs/themes@1/dist/fantasy/index.css" rel="stylesheet">

<!-- Forest -->
<link href="https://unpkg.com/@videojs/themes@1/dist/forest/index.css" rel="stylesheet">

<!-- Sea -->
<link href="https://unpkg.com/@videojs/themes@1/dist/sea/index.css" rel="stylesheet">

<!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
<script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>

<link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
<link href="/elearn/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="/elearn/plugins/video-js/video-js.css" rel="stylesheet" type="text/css">
<script src="https://cdn.tiny.cloud/1/hm88argpdtr2468zdrtum3zzdb37j58yjj1jpj9ddotnqxrz/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@stack('header-scripts')
