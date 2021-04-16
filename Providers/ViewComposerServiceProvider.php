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
use Modules\Dashboard\Http\ViewComposers\Settings\IndexComposer as IndexSettingComposer;

use Modules\Dashboard\Http\ViewComposers\Clients\IndexComposer as IndexClientComposer;
use Modules\Dashboard\Http\ViewComposers\Clients\FormComposer as FormClientComposer;
use Modules\Dashboard\Http\ViewComposers\Clients\EditComposer as EditClientComposer;

use Modules\Dashboard\Http\ViewComposers\Products\IndexComposer as IndexProductComposer;
use Modules\Dashboard\Http\ViewComposers\Products\FormComposer as FormProductComposer;
use Modules\Dashboard\Http\ViewComposers\Products\EditComposer as EditProductComposer;

use Modules\Dashboard\Http\ViewComposers\Orders\IndexComposer as IndexOrderComposer;

class ViewComposerServiceProvider extends ServiceProvider
{


    public function boot() {
        View::composer('dashboard::layouts.master', MasterComposer::class);

        View::composer('dashboard::settings.index', IndexSettingComposer::class);

        View::composer('dashboard::sallers.index', IndexComposer::class);
        View::composer('dashboard::sallers.edit', EditComposer::class);

        View::composer('dashboard::payments.index', IndexPaymentComposer::class);
        View::composer('dashboard::payments.edit', EditPaymentComposer::class);

        View::composer('dashboard::clients.index', IndexClientComposer::class);
        View::composer('dashboard::clients.form', FormClientComposer::class);
        View::composer('dashboard::clients.edit', EditClientComposer::class);

        View::composer('dashboard::products.index', IndexProductComposer::class);
        View::composer('dashboard::products.form', FormProductComposer::class);
        View::composer('dashboard::products.edit', EditProductComposer::class);

        View::composer('dashboard::imports.widget.index', WidgetComposer::class);

        View::composer('dashboard::companies.edit', EditCompanyComposer::class);

        View::composer('dashboard::orders.index', IndexOrderComposer::class);
    }
    
    public function register() {
        //
    }
    
}
    

