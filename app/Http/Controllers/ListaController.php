<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use App\Models\Municipio;
use App\Models\Regiao;
use App\Models\Uf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ListaController extends Controller
{
    
    public function edit(Request $request, Lista $lista){
        $regioes = Regiao::all();
        $ufs = Uf::orderBy('sigla')->get();
        $municipios = Municipio::orderBy('nome')->get();

        $acao="edit";

        return view('lista.create',compact('acao','lista','regioes','ufs','municipios'));


    }    
    
    public function show(Request $request, Lista $lista){

        $regioes = Regiao::all();
        $ufs = Uf::orderBy('sigla')->get();
        $municipios = Municipio::orderBy('nome')->get();

        $acao="show";

        return view('lista.create',compact('acao','lista','regioes','ufs','municipios'));
      
        
    }

    public function index(){
        $listas = Lista::all();
        return view('lista.index',compact('listas'));
    }

    public function new(){

        $regioes = Regiao::all();
        $ufs = Uf::orderBy('sigla')->get();
        $municipios = Municipio::orderBy('nome')->get();
        $acao="new";

        return view('lista.create',compact('acao','regioes','ufs','municipios'));
    }

    public function del(Request $request, Lista $lista){
        $lista->delete();
        return back()->withSuccess('Lista excluida com Sucesso');
    }



    public function save(Request $request,Lista $lista){
        
        $validator = Validator::make($request->all(), [
            'apelido' => 'required|alpha_num|min:5|max:25',
            'main' => Rule::in(['0', '1']),
            'cep'=> 'required|digits:8',
            'zap'=> 'required|digits:11',
            'regiao_id'=> 'required|numeric',
            'uf_id'=> 'required|numeric',
            'municipio_id'=> 'required|numeric',

            
        ]);
 
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
            
        }
 

        $validated = $validator->safe()->only(['regiao_id','uf_id','municipio_id' ,'apelido', 'main','cep','zap',]);

        $user_id = auth()->id();
        $validated['user_id']=$user_id;


        #dd($validated);

        if($lista instanceof Lista){
            if($lista->user_id === $user_id){
                $res = $lista->update($validated);            
            } else {
                return back()->withError('Vc nao pode alterar uma lista que nao e sua.');
            }
           # dd('fff');
        } else {
            return back()->withErrors('Erro - sem lista no controller');            
        }

        #dd($res);
        
        if($res){
            return redirect()->route('lista.edit',compact('lista'))->with('success','Registro alterado');
        } else {
            return back()->withErrors('Erro no BD');
        }
          
        
    }

    public function store(Request $request){
        
        $validator = Validator::make($request->all(), [
            'apelido' => 'required|alpha_num|min:5|max:25',
            'main' => Rule::in(['0', '1']),
            'cep'=> 'required|digits:8',
            'zap'=> 'required|digits:11',
            'regiao_id'=> 'required|numeric',
            'uf_id'=> 'required|numeric',
            'municipio_id'=> 'required|numeric',

            
        ]);
 
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
            
        }
 

        $validated = $validator->safe()->only(['regiao_id','uf_id','municipio_id' ,'apelido', 'main','cep','zap',]);

        $user_id = auth()->id();
        $validated['user_id']=$user_id;

       

        $res = Lista::create($validated);            

        
        #dd($res);
        
        if($res){
            return back()->withSuccess('Lista inserida com Sucesso');
        } else {
            return back()->withErrors('Erro no BD');
        }
          
        
    }








}
