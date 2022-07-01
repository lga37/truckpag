<?php

namespace App\Traits;
use Illuminate\Support\Str;

trait UseSlug{

    public static function bootUseSlug(): void{
        static::creating(function($model){
            $model->uuid = Str::uuid();
            $model->slug = Str::slug($model->nome);
        });
    }


    public function getRouteKeyName(): string{
        return 'slug';
    }

}