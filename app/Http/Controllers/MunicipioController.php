<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipio;

class MunicipioController extends Controller
{
    public function index(Request $request)
    {
        $municipios = Municipio::paginate(10);
        return view('municipio.index',compact('municipios'));
    }
}
