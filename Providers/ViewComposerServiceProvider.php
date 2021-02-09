<?php

namespace Modules\Dashboard\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Dashboard\Http\ViewComposers\Saller\EditComposer;
use Modules\Dashboard\Http\ViewComposers\Saller\IndexComposer;
use Modules\Dashboard\Http\ViewComposers\Import\WidgetComposer;
use Modules\Dashboard\Http\ViewComposers\Layouts\MasterComposer;
use Modules\Dashboard\Http\ViewComposers\Payment\EditComposer as EditPaymentComposer;
use Modules\Dashboard\Http\ViewComposers\Companies\EditComposer as EditCompanyComposer;
use Modules\Dashboard\Http\ViewComposers\Payment\IndexComposer as IndexPaymentComposer;

class ViewComposerServiceProvider extends ServiceProvider
{


    public function boot() {
        View::composer('dashboard::layouts.master', MasterComposer::class);

        View::composer('dashboard::sallers.index', IndexComposer::class);
        View::composer('dashboard::sallers.edit', EditComposer::class);

        View::composer('dashboard::payments.index', IndexPaymentComposer::class);
        View::composer('dashboard::payments.edit', EditPaymentComposer::class);

        View::composer('dashboard::imports.widget.index', WidgetComposer::class);

        View::composer('dashboard::companies.edit', EditCompanyComposer::class);
    }
    
    public function register() {
        //
    }
    
}
    

