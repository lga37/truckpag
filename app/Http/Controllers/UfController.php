<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uf;

class UfController extends Controller
{



    public function index(Request $request)
    {
        $ufs = Uf::paginate(10);
        return view('uf.index', compact('ufs'));
    }
}
