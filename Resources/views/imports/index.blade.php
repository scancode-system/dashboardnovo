@extends('dashboard::layouts.master')

@section('content')

<div class="row">
    <div class="col-6 col-lg-3">
        <a href="{{ route('imports.client') }}" class="text-decoration-none">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-info py-4 px-5 mfe-3">
                        <svg class="c-icon c-icon-xl">
                            <use xlink:href="/modules/dashboard/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-address-book"></use>
                        </svg>
                    </div>
                    <div>
                        <div class="text-value text-info">Clientes</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-lg-3">
        <a href="{{ route('imports.product') }}" class="text-decoration-none">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-secondary py-4 px-5 mfe-3">
                        <svg class="c-icon c-icon-xl">
                            <use xlink:href="/modules/dashboard/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-tags"></use>
                        </svg>
                    </div>
                    <div>
                        <div class="text-value text-secondary">Produtos</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-lg-3">
        <a href="{{ route('imports.saller') }}" class="text-decoration-none">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-primary py-4 px-5 mfe-3">
                        <svg class="c-icon c-icon-xl">
                            <use xlink:href="/modules/dashboard/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-address-book"></use>
                        </svg>
                    </div>
                    <div>
                        <div class="text-value text-primary">Representantes</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-lg-3">
        <a href="{{ route('imports.payment') }}" class="text-decoration-none">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-dark py-4 px-5 mfe-3">
                        <svg class="c-icon c-icon-xl">
                            <use xlink:href="/modules/dashboard/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-wallet"></use>
                        </svg>
                    </div>
                    <div>
                        <div class="text-value text-dark">Pagamentos</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
    Importações
</li>
@endsection