<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\ValueOption;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('MauNenProvider', ValueOption::getItemByName("mau_nen") );
        View::share('MauNenContentProvider', ValueOption::getItemByName("mau_nen_content") );
        View::share('LogoProvider', ValueOption::getItemByName("logo") );
        View::share('StoUrl', getenv("STO_URL") );
        View::share('AdminResUrl', getenv("ADMIN_RES_URL") );
        View::share('PublicResUrl', getenv("PUBLIC_RES_URL") );
        View::share('LogoUrl', getenv("LOGO_URL") );
        View::share('ProductUrl', getenv("PRODUCT_URL") );
        View::share('SlideUrl', getenv("SLIDE_URL") );
        View::share('DefaultImg', getenv("DEFAULT_IMG") );
        View::share('AdminRowCount', getenv("ADMIN_ROW_COUNT") );
        View::share('TienTe', getenv("TIEN_TE") );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
