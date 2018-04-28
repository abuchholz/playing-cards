<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Let's Play Some Cards</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">

    <link rel="stylesheet" href="{{ elixir('dist/css/main.css') }}">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>


<body>
@section('body')
    <div id="content-wrapper" class="felt">
        @include('includes.buttonbar')
        <div id="above-content-alert" class="alert alert-success @if(!Session::has('message')) hidden @endif" role="alert">
            <p>{!! Session::get('message') !!}</p>
        </div>
        <div id="content" class="content">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>
@show
<script data-main="{{ elixir('dist/js/main.js') }}" src="{{ elixir('dist/js/require.js') }}"></script>
@include('includes.modal')
</body>
</html>