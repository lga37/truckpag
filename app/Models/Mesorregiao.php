<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UseSlug;

class Mesorregiao extends Model
{
    use HasFactory;
    use UseSlug;

    protected $fillable = ['id','nome','regiao_id',];

    public function regiao(){
        return $this->belongsTo(Regiao::class);
    }

    public function ufs(){
        return $this->hasMany(Uf::class);
    }

}
