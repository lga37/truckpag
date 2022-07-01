<?php

namespace App\Http\Controllers;

use App\Models\Microrregiao;
use Illuminate\Http\Request;

class MicrorregiaoController extends Controller
{
    public function index(Request $request)
    {
        $microrregioes = Microrregiao::paginate(10);
        return view('microrregiao.index',compact('microrregioes'));
    }
}
