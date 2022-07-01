<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UseSlug;

class Microrregiao extends Model
{
    use HasFactory;
    use UseSlug;

    protected $fillable = ['id','nome','uf_id',];


    public function municipios(){
        return $this->hasMany(Municipio::class);
    }

    public function uf(){
        return $this->belongsTo(Uf::class);
    }

}
