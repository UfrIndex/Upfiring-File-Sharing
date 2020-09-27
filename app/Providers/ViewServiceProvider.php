<?php

namespace App\Providers;

use App\Advertising;
use App\Category;
use App\Option;
use App\Template;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        $this->composeBannersShowHome();
        $this->composeBannersShow();
        $this->composeBannersShow2();
        $this->composeBannersShow3();
        $this->composeBannersShow4();
        $this->composeBannersShow5();
        $this->Categories();
        $advertisings = Advertising::find(1);
        $option = Option::find(1);
        $data = [
            'seo' => $option,
            'options' => $option,
            'advertisings' => $advertisings,
            'template' => Template::find($option->template)
        ];

        View::share('data', $data);
    */
    }

    private function composeBannersShowHome() {
        View::composer(

            'home',

            function($view)
            {
                $view->with('banners', Advertising::find(1));

            });
    }

    private function Categories() {
        View::composer(

            'site.partials.popup-categories',

            function($view)
            {
                $view->with('categories', Category::get());

            });
    }

    private function composeBannersShow() {
        View::composer(

            'new-template',

            function($view)
            {
                $view->with('banners', Advertising::find(1));

            });
    }

    private function composeBannersShow2() {
        View::composer(

            'lazy-template',

            function($view)
            {
                $view->with('banners', Advertising::find(1));

            });
    }

    private function composeBannersShow3() {
        View::composer(

            '51514-template',

            function($view)
            {
                $view->with('banners', Advertising::find(1));

            });
    }
    private function composeBannersShow4() {
        View::composer(

            '53136-template',

            function($view)
            {
                $view->with('banners', Advertising::find(1));

            });
    }
    private function composeBannersShow5() {
        View::composer(

            '682-template',

            function($view)
            {
                $view->with('banners', Advertising::find(1));

            });
    }
}
