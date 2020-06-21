<!doctype html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>SabinFood | @yield('title')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('webfonts/fontawsome/css/all.min.css')}}">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/4.5/assets/img/favicons/apple-touch-icon.png"
          sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32"
          type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16"
          type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/4.5/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/4.5/assets/img/favicons/safari-pinned-tab.svg"
          color="#563d7c">
    <link rel="icon" href="https://getbootstrap.com/docs/4.5/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
    @stack('css')

</head>
<body>
@include('layout.nav')
<div class="container-fluid">
    <div class="row">
        @include('layout.sidebar')
        <main role="main" class="col-md-9 mr-sm-auto col-lg-10 px-md-4">
            @yield('body')
        </main>
    </div>


    @if(session()->get('type'))
        <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
            <!-- Position it -->
            <div style="position: absolute; top: 0; left: 0;">

                <!-- Then put toasts within -->
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <img src="..." class="rounded ml-2" alt="...">
                        <strong class="ml-auto">Bootstrap</strong>
                        {{--                        <small class="text-muted">just now</small>--}}
                        <button type="button" class="mr-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        {{session()->get('message')}}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
{{--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"--}}
{{--        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"--}}
{{--        crossorigin="anonymous"></script>--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="{{asset('webfonts/fontawsome/js/all.min.js')}}"></script>
@stack('script')
</body>
</html>
