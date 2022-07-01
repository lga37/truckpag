<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UseSlug;

class Uf extends Model
{
    use HasFactory;
    use UseSlug;

    protected $fillable = ['id','nome','sigla','regiao_id','mesorregiao_id',];

    public function mesorregiao(){
        return $this->belongsTo(Mesorregiao::class);
    }

    public function microrregioes(){
        return $this->hasMany(Microrregiao::class);
    }
}
