<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UseSlug;

class Municipio extends Model
{
    use HasFactory;
    use UseSlug;

    protected $fillable = ['id','nome','microrregiao_id',];


    public function microrregiao(){
        return $this->belongsTo(Microrregiao::class);
    }
}
