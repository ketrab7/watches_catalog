<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Katalog zegarków</title>

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src = "https://code.jquery.com/jquery-3.4.1.min.js" integration = " sha256 -CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin = "anonimowy"></script>

        <!-- jQuery CDN - Slim version (=without AJAX)
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
         -->
        <!-- jQuery Custom Scroller CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
        
    </head>
    <body>
        <div class="container-fluid p-0 overflow-hidden">
            <div class="wrapper">

                <!-- Navbar lewy -->
                <nav class="navbar-dark text-white p-2" style="background-color: #4a3526;" id="sidebar">
                    <div class="sidebar-header pt-2">
                            <h3>Katalog zegarków</h3>                        
                    </div>
                    <hr/>
                    
                    <!-- Zawartość -->
                    <div id="sidebar-content">
                        @yield('sidebar')
                    </div>

                    <div id="footer" class="text-center">
                        <hr/>
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                        </br>
                        &copy; Copyright - 2022
                    </div>
                    
                </nav>

                

                <!-- Content -->
                <div class="container-fluid p-0" style="background-color: #e3d9c6;" id="content">
                    <!-- Navbar poziomy -->
                    <nav class="navbar" style="background-color: #e49e00;">
                        
                        <!-- przycisk chowający navbar lewy -->
                        <div class="p-1">
                            <button type="button" id="sidebarCollapse" style="background-color: Transparent; border: 0px;">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>

                        <!-- wyszukiwarka -->
                        <form class="row" method="POST" action="/search-product">

                            @csrf
                            <div class="col-8">
                                <input class="search-input" type="text" name="search" placeholder="Search" aria-label="Search">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-outline-white" type="submit">
                                    <img src="{{ asset(('thumbnail/search.png')) }}" width=20 alt="search">
                                </button>
                            </div>
                        </form>
                    </nav>

                    <!-- zawartość strony -->
                    <div>
                        @yield('content')
                    </div>
                </div>
            </div>

        </div>

        <!-- Modal z dodawaniem modelu-->
        @include('model.createModelModal')
        
        <!-- Toast w zewnętrznym blade-->
        @if (session('toast'))
            @include('system.toastSystem')
        @endif

        <!-- Skrypt do zamykania navbaru lewego -->
        <script src="{{ asset('js/sidebarCollapse.js') }}"></script>
        <!-- Skrypt do wyświetlania toast'ów -->
        <script src="{{asset('js/toast.js')}}"></script>
    </body>
</html>
