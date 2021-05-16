<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    {{ Html::style('modules/dashboard/coreui/dist/css/style.css') }}
    {{ Html::style('modules/order/css/pdf.css') }}
    <style>
        .width-5 {
            width: 5px;
        }

        .width-10 {
            width: 10px;
        }

        .width-15 {
            width: 15px;
        }

        .width-20 {
            width: 20px;
        }

        .width-75 {
            width: 75px;
        }

        .width-130 {
            width: 130px;
        }

        .height-200 {
            height: 200px;
        }

        .height-50 {
            height: 50px;
        }

        .height-75 {
            height: 75px;
        }

        .w-65 {
            width: 65%
        }

        .fs-15 {
            font-size: 15px;
        }

        .fs-20 {
            font-size: 20px;
        }

        .fs-25 {
            font-size: 25px;
        }

        .fs-30 {
            font-size: 30px;
        }

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-row-group;
        }

        tr {
            page-break-inside: avoid;
        }

        .border-dark-2 {
            border-color: #000 !important;
        }
    </style>
</head>

<body class="bg-white text-body">
    @include('dashboard::pdfs.layouts.header')
    @yield('content')
    @include('dashboard::pdfs.layouts.footer')
</body>

</html>