<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','regiao_id','uf_id','municipio_id' ,'apelido', 'main','cep','zap',];

    public function regiao(){
        return $this->belongsTo(Regiao::class);
    }

    public function uf(){
        return $this->belongsTo(Uf::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function municipio(){
        return $this->belongsTo(Municipio::class);
    }



}
