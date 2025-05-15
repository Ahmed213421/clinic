<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>@yield('title')</title>


    @if (App::getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('admin/rtl/css/simplebar.css') }}">
        <!-- Fonts CSS -->
        <link
            href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
        <!-- Icons CSS -->
        <link rel="stylesheet" href="{{ asset('admin/rtl/css/feather.css') }}">
        <!-- Date Range Picker CSS -->
        <link rel="stylesheet" href="{{ asset('admin/rtl/css/daterangepicker.css') }}">
        <!-- App CSS -->
        <link rel="stylesheet" href="{{ asset('admin/rtl/css/app-light.css') }}" id="lightTheme">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
            integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('admin/rtl/css/app-dark.css') }}" id="darkTheme" disabled>

    @else
        <!-- Simple bar CSS -->
        <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css') }}">
        <!-- Fonts CSS -->
        <link
            href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
        <!-- Icons CSS -->
        <link rel="stylesheet" href="{{ asset('admin/css/feather.css') }}">
        <!-- Date Range Picker CSS -->
        <link rel="stylesheet" href="{{ asset('admin/css/daterangepicker.css') }}">
        <!-- App CSS -->
        <link rel="stylesheet" href="{{ asset('admin/css/app-light.css') }}" id="lightTheme">
        <link rel="stylesheet" href="{{ asset('admin/css/app-dark.css') }}" id="darkTheme" disabled>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
            integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />


        @endif

    @yield('css')

</head>

<body class="vertical  light {{ app()->getLocale() == 'ar' ? 'rtl' : '' }} ">
