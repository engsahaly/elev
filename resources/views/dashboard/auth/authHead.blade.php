<?php
    if (LaravelLocalization::getCurrentLocale() == "ar") {
        $lang = '-rtl' ;
    } else {
        $lang = '' ;
    }
?>

<head>
    <meta charset="utf-8" />
    <title>{{ __('lang.login_title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        {{-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500&display=swap" rel="stylesheet"> --}}
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
        <style>
            * {
                /* font-family: 'Noto Sans Arabic', sans-serif; */
                font-family: 'Tajawal', sans-serif;
            }
        </style>
    @endif

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets') }}/logo/favicon/favicon.ico">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets') }}/css/bootstrap{{$lang}}.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets') }}/css/app{{$lang}}.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>