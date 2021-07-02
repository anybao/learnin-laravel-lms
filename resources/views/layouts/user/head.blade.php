<title>@yield('title') {{ env('APP_NAME') }}</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Elearn project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/elearn/styles/bootstrap4/bootstrap.min.css">
<link href="/elearn/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="/elearn/plugins/video-js/video-js.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/elearn/styles/contact.css">
<link rel="stylesheet" type="text/css" href="/elearn/styles/contact_responsive.css">
<link rel="stylesheet" type="text/css" href="/elearn/styles/courses.css">
<link rel="stylesheet" type="text/css" href="/elearn/styles/courses_responsive.css">
<link rel="stylesheet" type="text/css" href="/elearn/styles/news.css">
<link rel="stylesheet" type="text/css" href="/elearn/styles/news_responsive.css">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />

<meta property="og:url"                content="{{ url()->current() }}" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="@yield('title') {{ env('APP_NAME') }}" />
<meta property="fb:app_id"              content="783620185378430" />
@yield('meta')

@include('layouts.widgets.js_tracking')
<style>
    .lesson_title{
        font-size: 30px;
        font-weight: 600;
        color: #44425a;
        -webkit-transition: all 200ms ease;
        -moz-transition: all 200ms ease;
        -ms-transition: all 200ms ease;
        -o-transition: all 200ms ease;
        transition: all 200ms ease;
    }
    section.pricing {
        /*background: #007bff;*/
        /*background: linear-gradient(to right, #0062E6, #33AEFF);*/
    }

    .pricing .card {
        border: none;
        border-radius: 1rem;
        transition: all 0.2s;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
    }

    .pricing hr {
        margin: 1.5rem 0;
    }

    .pricing .card-title {
        margin: 0.5rem 0;
        font-size: 0.9rem;
        letter-spacing: .1rem;
        font-weight: bold;
    }

    .pricing .card-price {
        font-size: 3rem;
        margin: 0;
    }

    .pricing .card-price .period {
        font-size: 0.8rem;
    }

    .pricing ul li {
        margin-bottom: 1rem;
    }

    .pricing .text-muted {
        opacity: 0.7;
    }

    .pricing .btn {
        font-size: 80%;
        border-radius: 5rem;
        letter-spacing: .1rem;
        font-weight: bold;
        padding: 1rem;
        opacity: 0.7;
        transition: all 0.2s;
    }

    /* Hover Effects on Card */

    @media (min-width: 992px) {
        .pricing .card:hover {
            margin-top: -.25rem;
            margin-bottom: .25rem;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
        }
        .pricing .card:hover .btn {
            opacity: 1;
        }
    }

    @media (min-width: 992px) {
        .homepage-custom{
            margin-top: 125px;
            margin-bottom: 200px
        }
    }

    @media (max-width: 990px) {
        .homepage-custom{
            margin-top: 160px;
            margin-bottom: 20px
        }
    }

    @media (max-width: 575px) {
        .homepage-custom{
            margin-top: 80px;
            margin-bottom: 20px
        }
    }


    .card-body .lesson-custom:hover{
        background-color: #eee;
    }
</style>
