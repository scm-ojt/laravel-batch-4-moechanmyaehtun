<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Blog</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo/logo.jpg') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/common.css')}}">

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                  Blog
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item " style="margin-right: 16px; padding-top:12px" >

                            <select class="form-control changeLang">
                                <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                                <option value="mm" {{ session()->get('locale') == 'mm' ? 'selected' : '' }}>Myanmar</option>

                            </select>

                        </li>
                        <li class="nav-item mr-2 mt-2">
                            <a href="{{ route('home') }}" class="nav-link">{{ __('nav.Home') }}</a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item  mr-2 mt-2" >
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('nav.Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item  mr-2 mt-2">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('nav.Register') }}</a>
                                </li>
                            @endif
                        @else

                        <li class="nav-item mr-2 mt-2">
                            <a href="{{ route('product') }}" class="nav-link">{{ __('nav.Product') }}</a>

                        </li>

                                   <li class="nav-item  mr-2 mt-2">
                            <a href="{{ route('profiles', Auth::id()) }}" class="nav-link">{{ __('nav.Profile') }}</a>

                        </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                    <img src="{{ asset(Auth::user()->image?->path)}}" alt="image" style="width:40px; height:40px;  border-radius:50% ;">

                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('nav.Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        @if(session('status'))
        let alert_msg = "<?php echo session('status'); ?>";
        toastr.success(alert_msg, 'SUCCESS', {
            closeButton: true,
            progressBar: true,
        });
        @endif
      </script>
      <script type="text/javascript">

        var url = "{{ route('changeLang') }}";

        $(".changeLang").change(function(){
            window.location.href = url + "?lang="+ $(this).val();
        });

    </script>
      @stack('js')
</body>
</html>
