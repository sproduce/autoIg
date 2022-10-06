<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CRM</title>
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/dashboard.css" rel="stylesheet">
        <link href="/css/style.css?version={{config('global.version')}}" rel="stylesheet">
        @yield('css')
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
                            <a class="nav-link" href="/contract/list">
                                <i class="fas fa-file-alt"></i>
                                Договора
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/motorPool/list">
                                <i class="fas fa-taxi"></i>
                                Автопарк
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/carGroup/list">
                                <i class="fas fa-users-cog"></i>
                                Группа машин
                            </a>
                        </li>

{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link"  href="/carDriver/list">--}}
{{--                                <i class="fas fa-user-tie"></i>--}}
{{--                                Водители--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link"  href="/subject/list">
                                <i class="fas fa-user-tie"></i>
                                Субьекты
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="/timesheet/list">
                                <i class="fas fa-calendar-alt"></i>
                                Табель
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="/timesheet/listByEvent">
                                <i class="fas fa-calendar-alt"></i>
                               События
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="/timesheet/listEvents">
                                <i class="fas fa-calendar-alt"></i>
                                События ()
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
                            <a class="nav-link"  href="/payment/list">
                                <i class="fas fa-ruble-sign"></i>
                                Платежи
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="/payment/toPay">
                                <i class="fas fa-hand-holding-usd"></i>
                                К оплате
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Администрирование</span>
                    </h6>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link"  href="/rentEvent/list">
                                <i class="fas fa-bars"></i>
                                События
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

                        <li class="nav-item">
                            <a class="nav-link"  href="/reference/engineTransmissionBody">
                                <i class="fas fa-cogs"></i>
                                Кпп двигатель кузов
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contract/ContractTypes">
                                <i class="fas fa-file-alt"></i>
                                Типы договоров
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contract/statusList">
                                <i class="fas fa-file-alt"></i>
                                Статусы договоров
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contract/tariffList">
                                <i class="fas fa-file-alt"></i>
                                Тарифы договоров
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    @yield('header')
                </div>
                @yield('content')
            </main>
        </div>
    </div>





    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/ready.js?version='.config('global.version'))}}" defer></script>
    <script src="{{ asset('js/js.cookie.min.js') }}" defer></script>
    <script src="{{ asset('js/user.js?version='.config('global.version'))}}" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    @yield('js')

    </body>
</html>
