<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('storage/icon/logo.jpg') }}" type="image/gif" sizes="16x16">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('storage/animatecss/animatecss.css') }}" rel="stylesheet">

    <!-- Google font and icon -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .modal-backdrop {
            z-index: 0 !important;
        }
    </style>
</head>
<body>
<div id="app">
    <transition name="custom-classes-transition" enter-active-class="animated bounceInUp">
        <router-view></router-view>
    </transition>
</div>


<script src="https://js.pusher.com/7.0/pusher.min.js"></script>


<script>
    // // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;
    //
    // var pusher = new Pusher('66799a7de1a190499614', {
    //     cluster: 'ap1'
    // });
    //
    // var channel = pusher.subscribe('my-channel');
    // channel.bind('my-event', function(data) {
    //     //
    // });
</script>
</body>
</html>
