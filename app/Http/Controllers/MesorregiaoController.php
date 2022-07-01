<?php

namespace App\Http\Controllers;

use App\Models\Mesorregiao;
use Illuminate\Http\Request;

class MesorregiaoController extends Controller
{
    public function index(Request $request)
    {
        $mesorregioes = Mesorregiao::paginate(10);
        return view('mesorregiao.index',compact('mesorregioes'));
    }

}
