<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page-title') | JobSite</title>
    <link rel="stylesheet" href="{{asset('/public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
@yield('css')
</head>
<body style="background-color: whitesmoke">
@include('include.navbar')

@include('include.msg')

<div class="container my-4">
    @yield('content')
</div>

<script src="{{asset('/public/js/jquery.min.js')}}" ></script>
<script src="{{asset('/public/js/bootstrap.bundle.js')}}" ></script>
<script >
    $(document).ready(function () {
        $('.alert').delay(4000).slideUp(1000);
    });
</script>
@yield('js')
</body>
</html>

