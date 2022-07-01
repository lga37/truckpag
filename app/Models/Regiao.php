<?php

namespace App\Models;

use App\Traits\UseSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{
    use HasFactory;
    use UseSlug;

    protected $fillable = ['id','nome','sigla',];


    public function mesorregioes(){
        return $this->hasMany(Mesorregiao::class);
    }

    public function getMeso(){
        #return implode('--',$this->mesorregioes->toArray());
    }

}
