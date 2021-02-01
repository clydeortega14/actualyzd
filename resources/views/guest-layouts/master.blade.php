<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ config('app.name') }} - @yield('title')</title>
    
    @include('partials._links')

</head>

<body class="login-page">

    
    <!-- CONTENT -->
    @yield('content')


    @include('partials._scripts')
</body>

</html>