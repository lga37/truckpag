<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{ListaController,RegiaoController,MesorregiaoController,UfController,MicrorregiaoController,MunicipioController};

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('regiao', RegiaoController::class)->names(['index'=>'regiao']);

#Route::apiResource('regiao', RegiaoController::class);

Route::resource('uf', UfController::class)->names(['index'=>'uf']);
Route::resource('regiao', RegiaoController::class)->names(['index'=>'regiao']);
Route::resource('microrregiao', MicrorregiaoController::class)->names(['index'=>'microrregiao']);
Route::resource('municipio', MunicipioController::class)->names(['index'=>'municipio']);

Route::resource('mesorregiao', MesorregiaoController::class)->names(['index'=>'mesorregiao']);


#Route::get('/list', [ListController::class,'index'])->name('list.index');


Route::group(
    [
        'prefix' => 'lista',
        'as' => 'lista.',
    ],
    function () {
        Route::get('/', [ListaController::class, 'index'])->name('index');
        Route::get('/new', [ListaController::class, 'new'])->name('new');
        
        Route::post('/save/{lista}', [ListaController::class, 'save'])->name('save');
        Route::post('/store', [ListaController::class, 'store'])->name('store');
        
        Route::delete('/del/{lista}', [ListaController::class, 'del'])->name('del');

        Route::get('/{lista}', [ListaController::class, 'show'])->name('show');
        Route::get('/upd/{lista}', [ListaController::class, 'edit'])->name('edit');

        
    }
);


/*
Route::resource('regiao.mesorregiao', MesorregiaoController::class)
    ->shallow()
    ->names(['index'=>'mesorregiao'])
    ->scoped([
        'mesorregiao' => 'slug',
    ]);
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
