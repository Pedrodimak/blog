<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //La primera vez que entra, no debe estar guardado en caché, 
        //por lo que lo guardamos
        View::composer('*', function ($view) {
            $id = session('key');
            if ($id == null) return;

            if ($user = Cache::get('user_id')) {
                return $view->with('user', $user);
            }

            Cache::rememberForever('user_id', function () use($id){
                return User::findOrFail($id);
            });
            

            return $view->with('user', Cache::get('user_id'));
        });
    }
}
