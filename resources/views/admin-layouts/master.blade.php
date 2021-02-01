<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title')</title>
    
    @include('partials._links')

</head>

<body class="theme-red">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->



    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->


    <!-- Search Bar -->
    
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>

    <!-- #END# Search Bar -->


    <!-- Top Bar -->
    @include('partials._top-bar')
    <!--#END Top bar -->

    <section>
        <!-- Left Sidebar -->
        @include('partials._leftsidebar')
        <!-- #END# Left Sidebar -->


        <!-- Right Sidebar -->
        @include('partials._rightsidebar')
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        @yield('content')
    </section>

    @include('partials._scripts')
</body>

</html>