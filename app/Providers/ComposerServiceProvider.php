<?php

namespace App\Providers;

use App\Models\Subsection;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//        view()->composer('pages.layouts.block.header', 'App\Http\Views\PageViewComposer@compose');
//        view()->composer('pages.layouts.block.footer', 'App\Http\Views\PageViewComposer@compose');
//        view()->composer('pages.layouts.sections.ultimas-noticias', 'App\Http\Views\LastNewsViewComposer@compose');
//        view()->composer('pages.layouts.block.header', 'App\Http\Views\SubsectionViewComposer@compose');
//        view()->composer('pages.layouts.block.footer', 'App\Http\Views\SubsectionViewComposer@compose');

    }
}
