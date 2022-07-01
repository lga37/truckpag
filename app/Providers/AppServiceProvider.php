<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Models\{Lista, Regiao,Mesorregiao,Uf,Microrregiao,Municipio};

use Utils\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{


    public function register()
    {
        //
    }


    public function boot()
    {
        $models = ['Regiao','Mesorregiao','Uf','Microrregiao','Municipio'];

        $rotas = [];
        foreach($models as $m){
            
            $rotas[$m]=[];

            $model = app("App\\Models\\{$m}");
            $tabela = $model->getTable();
            $tot = 0;
            if (Schema::hasTable($tabela)){
                $tot = $model->count();
                $rotas[$m]=$tot;
            }
        }
        
        View::composer(['components.shared.menu'], function ($view) use ($rotas) {
            $view->with('rotas', $rotas);
        });


        Str::macro('anti_slug', function ($slug) {
            $s2 = preg_replace('/-/', ' ', $slug);
            $s3 = Str::title($s2);
            return $s3;
        });

        

        
        
        $lista_model = app("App\\Models\\Lista");
        $tabela = $model->getTable();
        if (Schema::hasTable($tabela)){
            $listas = Lista::get();

        } else {
            $listas = [];
        }

        
        
        View::composer(['layouts.guest'], function ($view) use ($listas) {
            $view->with('listas', $listas);
        });




    }
}
