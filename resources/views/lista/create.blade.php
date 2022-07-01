<x-guest-layout>

    <div class="p-5">
        <form method="post" 
        @switch($acao)
        @case('show')
        action="#"
        @break
        @case('new')
        action="{{route('lista.store')}}
        @break
        @case('edit')
        action="{{route('lista.save',$lista)}}
        @break
        @endswitch

        
        
        ">
            @csrf
    
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="apelido"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 
                    border-gray-300 appearance-none 
                    dark:text-white dark:border-gray-600 
                    dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 
                    peer"
                    placeholder=" "  
                    @if($acao=='show') disabled @endif  
                    value="{{ old('apelido')??$lista->apelido??'' }}" 
                    />
                <label for="Apelido" class="peer-focus:font-medium absolute text-sm 
                    text-gray-500 dark:text-gray-400 duration-300 
                    
                    transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 
                    peer-focus:text-blue-600 peer-focus:dark:text-blue-500 
                    peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 
                    peer-focus:-translate-y-6">Apelido</label>
    
                    @error('apelido')
                        <p class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">ERRO</span> {{ $message }}</p>
                    @enderror
    
            </div>
    
    
            <label for="default-toggle" class="relative inline-flex i   tems-center mb-4 cursor-pointer">
                <input type="checkbox" name="main" value="1" id="default-toggle" class="sr-only peer">
                <div
                    class="w-11 h-6 border-gray-200 rounded-full peer peer-focus:ring-4 
                    peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full 
                    peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] 
                    after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all 
                    dark:border-gray-600 peer-checked:bg-blue-600">
                </div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Principal</span>
            </label>
    
    
            <div class="grid xl:grid-cols-2 xl:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="cep" id="cep"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none 
                        dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        
                        
                        @if($acao=='show') disabled @endif  
                        value="{{ old('cep')??$lista->cep??'' }}" 
    
                        />
                    <label for="cep"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 
                        scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 
                        peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Cep</label>
                        @error('cep')
                        <p class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">ERRO</span> {{ $message }}</p>
                        @enderror

                </div>
    
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="zap" id="zap"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none 
                        dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " 
                        value="{{ old('zap')??$lista->zap??'' }}"
                        @if($acao=='show') disabled @endif  
                        />
                    <label for="zap"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 
                        scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 
                        peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Whatsapp</label>
                        @error('zap')
                        <p class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">ERRO</span> {{ $message }}</p>
                        @enderror
                </div>
    
    
            </div>
            @if($acao == 'new')


            <div class="grid xl:grid-cols-3 xl:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <select 
                    name="regiao_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Selecione Regiao</option>
                        @foreach($regioes as $regiao)
                        <option {{ old('regiao_id')==$regiao->id ? 'selected':'' }}
                        value="{{$regiao->id }}">{{$regiao->nome }}</option>
                        @endforeach
                    </select>
                    @error('regiao_id')
                        <p class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">ERRO</span> {{ $message }}</p>
                    @enderror
                </div>

                <div class="relative z-0 w-full mb-6 group">
                    <select 
                    name="uf_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Selecione Uf</option>
                        @foreach($ufs as $uf)
                        <option {{ old('uf_id')==$uf->id ? 'selected':'' }}
                        value="{{$uf->id }}">{{$uf->nome }}</option>
                        @endforeach
                    </select>
                    @error('uf_id')
                        <p class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">ERRO</span> {{ $message }}</p>
                    @enderror
                </div>

                <div class="relative z-0 w-full mb-6 group">
                    <select 
                    name="municipio_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Selecione Municipio</option>
                        @foreach($municipios as $municipio)
                        <option {{ old('municipio_id')==$municipio->id ? 'selected':'' }}
                        value="{{$municipio->id }}">{{$municipio->nome }}</option>
                        @endforeach
                    </select>
                    @error('municipio_id')
                        <p class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">ERRO</span> {{ $message }}</p>
                    @enderror
                </div>
                
            </div>

            @else 



            <div class="grid xl:grid-cols-3 xl:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <select 
                    @if($acao=='show') disabled @endif
                    name="regiao_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($regioes as $regiao)
                        <option {{ $lista->regiao_id==$regiao->id ? 'selected':'' }}
                        value="{{$regiao->id }}">{{$regiao->nome }}</option>
                        @endforeach
                    </select>
                    @error('regiao_id')
                        <p class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">ERRO</span> {{ $message }}</p>
                    @enderror
                </div>

                <div class="relative z-0 w-full mb-6 group">
                    <select 
                    @if($acao=='show') disabled @endif
                    name="uf_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($ufs as $uf)
                        <option {{ $lista->uf_id==$uf->id ? 'selected':'' }}
                        value="{{$uf->id }}">{{$uf->nome }}</option>
                        @endforeach
                    </select>
                    @error('uf_id')
                        <p class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">ERRO</span> {{ $message }}</p>
                    @enderror
                </div>

                
                
                <div class="relative z-0 w-full mb-6 group">
                    <select 
                    @if($acao=='show') disabled @endif
                    name="municipio_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($municipios as $municipio)
                        <option {{ $lista->municipio_id==$municipio->id ? 'selected':'' }}
                        value="{{$municipio->id }}">{{$municipio->nome }}</option>
                        @endforeach
                    </select>
                    @error('municipio_id')
                        <p class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">ERRO</span> {{ $message }}</p>
                    @enderror
                </div>
            </div>


            @endif
   
            

    
            @if($acao != 'show')
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium 
                rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 
                dark:focus:ring-blue-800">
                {{ Str::title($acao) }}
            </button>

            @endif
        </form>
    
    </div>


</x-guest-layout>