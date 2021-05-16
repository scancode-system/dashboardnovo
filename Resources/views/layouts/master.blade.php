<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v3.2.0
* @link https://coreui.io
* Copyright (c) 2020 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>CoreUI Free Bootstrap Admin Template</title>
    <link rel="apple-touch-icon" sizes="57x57" href="/modules/dashboard/coreui/dist/assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/modules/dashboard/coreui/dist/assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/modules/dashboard/coreui/dist/assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/modules/dashboard/coreui/dist/assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/modules/dashboard/coreui/dist/assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/modules/dashboard/coreui/dist/assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/modules/dashboard/coreui/dist/assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/modules/dashboard/coreui/dist/assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/modules/dashboard/coreui/dist/assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/modules/dashboard/coreui/dist/assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/modules/dashboard/coreui/dist/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/modules/dashboard/coreui/dist/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/modules/dashboard/coreui/dist/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/modules/dashboard/coreui/dist/assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Main styles for this application-->
    <link href="/modules/dashboard/coreui/dist/css/style.css" rel="stylesheet">

    <!-- Depois mudar isto de CDN para local -->
    <link rel="stylesheet" href="/modules/dashboard/coreui/dist/vendors/@coreui/icons/css/free.min.css">

    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
    </script>
    <link href="/modules/dashboard/coreui/dist/vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
    <style>
        .pagination {
            margin-bottom: 0px;
        }
    </style>
    @stack('styles')
</head>

<body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand d-lg-down-none bg-white">
            <img src="/modules/dashboard/img/logo.png" width="60%" class="c-sidebar-brand-full">
            <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="/modules/dashboard/coreui/dist/assets/brand/coreui-pro.svg#signet"></use>
            </svg>
        </div>
        <ul class="c-sidebar-nav">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('dashboard') }}">
                <i class="c-sidebar-nav-icon cil-speedometer"></i> Dashboard
                </a>
            </li>
            <li class="c-sidebar-nav-title">Menu</li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('orders.index') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="/modules/dashboard/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-clipboard"></use>
                    </svg> Pedidos
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('products.index') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="/modules/dashboard/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-tags"></use>
                    </svg> Produtos
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('clients.index') }}">
                <i class="c-sidebar-nav-icon cil-people"></i> Clientes
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('payments.index') }}">
                <i class="c-sidebar-nav-icon cil-wallet"></i> Pagamentos
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('sallers.index') }}">
                    <i class="c-sidebar-nav-icon cil-address-book"></i> Representantes
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('reports.index') }}">
                    <i class="c-sidebar-nav-icon cil-spreadsheet"></i> Relatórios
                </a>
            </li>
            <li class="c-sidebar-nav-title">Configurações</li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('companies.edit', 0) }}">
                    <i class="c-sidebar-nav-icon cil-factory"></i> Empresa
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('settings.index', 0) }}">
                    <i class="c-sidebar-nav-icon cil-cog"></i> Sistema
                </a>
            </li>
            <li class="c-sidebar-nav-item mt-auto"><a class="c-sidebar-nav-link c-sidebar-nav-link-info" href="{{ route('imports.index') }}" target="_top">
                    <i class="c-sidebar-nav-icon cil-cloud-download"></i> Importação</a>
            </li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link c-sidebar-nav-link-dark" href="https://coreui.io/pro/" target="_top">
                    <i class="c-sidebar-nav-icon cil-cloud-upload"></i> Backup</strong></a>
            </li>
        </ul>
        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>
    <div class="c-wrapper c-fixed-components">
        <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
                <svg class="c-icon c-icon-lg">
                    <use xlink:href="/modules/dashboard/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                </svg>
            </button><a class="c-header-brand d-lg-none" href="#">
                <svg width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="/modules/dashboard/coreui/dist/assets/brand/coreui-pro.svg#full"></use>
                </svg></a>
            <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
                <svg class="c-icon c-icon-lg">
                    <use xlink:href="/modules/dashboard/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                </svg>
            </button>
            <ul class="c-header-nav ml-auto mr-4">

                <li class="c-header-nav-item dropdown">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="c-avatar"><img class="c-avatar-img" src="{{ url($company->logo) }}" alt="user@email.com"></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pt-0">
                        {{ Form::open(['route' => 'logout']) }}
                        @csrf
                        {{ Form::button('<svg class="c-icon mr-2">
                                <use xlink:href="/modules/dashboard/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                            </svg> Logout', ['type' => 'submit', 'class' => 'dropdown-item']) }}
                        {{ Form::close() }}

                    </div>
                </li>
            </ul>
            <div class="c-subheader px-3">
                <!-- Breadcrumb-->
                <ol class="breadcrumb border-0 m-0">
                    @yield('breadcrumb')
                </ol>
            </div>
        </header>
        <div class="c-body">
            <main class="c-main">
                <div class="container">
                    <div class="fade-in">
                        @alert_errors()
                        @alert_success()
                        @yield('content')
                    </div>
                </div>
            </main>
            <footer class="c-footer">
                <div>Desenvolvido pela&nbsp;<a href="https://coreui.io/">Scancode</a></div>
                <div class="ml-auto">Versão 1.0.0</div>
            </footer>
        </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="/modules/dashboard/coreui/dist/vendors/@coreui/coreui-pro/js/coreui.bundle.min.js"></script>
    <!--[if IE]><!-->
    <script src="/modules/dashboard/coreui/dist/vendors/@coreui/icons/js/svgxuse.min.js"></script>
    <!--<![endif]-->
    <!-- Plugins and scripts required by this view-->
    <script src="/modules/dashboard/coreui/dist/vendors/@coreui/chartjs/js/coreui-chartjs.bundle.js"></script>
    <script src="/modules/dashboard/coreui/dist/vendors/@coreui/utils/js/coreui-utils.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    @stack('scripts')
</body>

</html>