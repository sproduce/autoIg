<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CRM</title>

        <!-- Scripts -->


        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">
        <link href="/css/dashboard.css" rel="stylesheet">
    </head>

    <body class="antialiased">

        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div id="modal-dialog" class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" id="modal-content"></div>
            </div>
        </div>




    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/"> CRM</a>
        <div class="bg-danger w-100 text-center h-100" id="notice"></div>
        <ul class="navbar-nav mr-auto">
        </ul>


        <a class="btn btn-sm btn-outline-info rounded-pill ml-3" href="">Выход</a>



    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <i class="fas fa-file-alt"></i>
                                Договора
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Бухгалтерия</span>
                    </h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link"  href="/">
                                <i class="far fa-chart-bar"></i>
                                Отчеты
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="/">
                                <i class="fas fa-ruble-sign"></i>
                                Доход/Расход
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Администрирование</span>
                    </h6>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link"  href="">
                                <i class="fas fa-user-tie"></i>
                                Владельцы машин
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">

                        <span>Справочники</span>
                        <i class="fas fa-book"></i>
                    </h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link"  href="/reference/brand">
                                <i class="fas fa-car"></i>
                                Машины
                            </a>
                        </li>
                    </ul>




                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

                <div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    @yield('header')



                </div>
                @yield('content')


            </main>
        </div>
    </div>





    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/ready.js') }}" defer></script>
    <script src="{{ asset('js/js.cookie.min.js') }}" defer></script>
    <script src="{{ asset('js/user.js') }}" defer></script>
    @yield('js')

    </body>
</html>
