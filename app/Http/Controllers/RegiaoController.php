<?php

namespace App\Http\Controllers;

use App\Models\Regiao;
use Illuminate\Http\Request;

class RegiaoController extends Controller
{
   
    public function index(Request $request)
    {
        $regioes = Regiao::paginate(10);
        return view('regiao.index',compact('regioes'));
    }


}
