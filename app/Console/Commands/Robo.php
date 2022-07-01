<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use App\Models\{Regiao,Mesorregiao,Uf,Microrregiao,Municipio};

class Robo extends Command
{
    const URL = "https://servicodados.ibge.gov.br/api/v1/";
    
    protected $signature = 'update:ibge';
    protected $description = 'Atualizar BD';

   
    public function handle()
    {

        $db = $this->choice(
            'Selecione Tipo BD (ainda nao implementei)',
            ['Mysql', 'SqlServer'],
            $allowMultipleSelections = false
        );

        switch($db){
            case "Mysql":
                break;
            case "SqlServer":
                break;

        }

        /*
        #Config::set("database.connections.sqlite.database", $sqlPath );
        config(['database.connections.onthefly' => [
            'driver' => $params->driver,
            'host' => $params->host,
            'username' => $params->username,
            'password' => $params->password
        ]]);

        \Config::set('database.connections.mysql.database', $schemaName);
            */

        $this->populate();

        return 0;
    }

    public function populate(){

        #tem q respeitar a ordem por causa das fks
        $paths = [
            'regioes'=>'localidades/regioes',
            'mesorregioes'=>'localidades/mesorregioes',
            'estados'=>'localidades/estados',
            'microrregioes'=>'localidades/microrregioes',
            'municipios'=>'localidades/municipios',
        ];
        foreach($paths as $type=>$path){
            #$type = end((explode('/', $path, 1)));
            $res = $this->get($path);
            $res = json_decode($res,true);
            if(!is_array($res)){
                continue;
            }
            $this->line("Iniciando recurso $type");
            switch($type){
                case 'regioes':
                    $regioes = array_values($res);
                    $this->upsertRegioes($regioes);
                break;
                case 'mesorregioes':
                    $mesorregioes = array_values($res);
                    $this->upsertMesorregioes($mesorregioes);
                break;
                case 'estados':
                    $estados = array_values($res);
                    $this->upsertEstados($estados);
                break;
                case 'microrregioes':
                    $microrregioes = array_values($res);
                    $this->upsertMicrorregioes($microrregioes);
                break;
                case 'municipios':
                    $municipios = array_values($res);
                    $this->upsertMunicipios($municipios);
                    $this->fixUfMesorregiao($municipios);#tem q percorrer 2x p fix
                break;
            }
        }

        
        $this->line("FIM do Processo");
        
    }

    private function fixUfMesorregiao(array $municipios)
    {
        $total = count($municipios);
        $tot = 0;
        foreach($municipios as $k=>$municipio){
            #dump($municipio);
            extract($municipio);#retornara id,nome, microrregiao, entra em micro e pega a meso
            $mesorregiao_id = $microrregiao['mesorregiao']['id'];
            $id = $microrregiao['mesorregiao']['UF']['id'];
            
            $model = Uf::updateOrCreate(
                compact('id'),                          #pk
                compact('mesorregiao_id')               #var
            );

            $this->msg("Item $k - Uf Mesorregiao Alterado ".$model->id);
            $tot++;
            
        }
        $msg = $tot == $total ? 'Todos os registros OK':'Erro na Atualizacao';
        $this->msg($msg,'warn');
    }

    private function upsertMunicipios(array $municipios)
    {
        $total = count($municipios);
        $tot = 0;
        foreach($municipios as $k=>$municipio){
            #dd($municipio);
            extract($municipio);#retornara id,nome, microrregiao
            $microrregiao_id = $microrregiao['id'];
            $model = Municipio::updateOrCreate(
                compact('id'),                          #pk
                compact('nome','microrregiao_id')       #var
            );
            $this->msg("Item $k - Upsert Recurso Id:".$model->id);
            $tot++;
            
        }
        $msg = $tot == $total ? 'Todos os registros OK':'Erro na Atualizacao';
        $this->msg($msg,'warn');
    }


    private function upsertMicrorregioes(array $microrregioes)
    {
        $total = count($microrregioes);
        $tot = 0;
        foreach($microrregioes as $k=>$microrregiao){
            #dd($microrregiao);
            extract($microrregiao);#retornara id,nome, mesorregiao e UF dentro de mesorregiao
            $uf_id = $mesorregiao['UF']['id'];
            $model = Microrregiao::updateOrCreate(
                compact('id'),              #pk
                compact('nome','uf_id')     #var
            );
            $this->msg("Item $k - Upsert Recurso Id:".$model->id);
            $tot++;
            
        }
        $msg = $tot == $total ? 'Todos os registros OK':'Erro na Atualizacao';
        $this->msg($msg,'warn');
    }


    private function upsertEstados(array $estados)
    {
        $total = count($estados);
        $tot = 0;
        foreach($estados as $k=>$estado){
            #dd($estado);
            #dump($estado['sigla']);
            extract($estado);#retornara id,sigla,nome, regiao e regiao_id dentro de regiao - id
            $regiao_id = $regiao['id'];
            $model = Uf::updateOrCreate(
                compact('id'),                          #pk
                compact('nome','sigla','regiao_id')     #var
            );
            $this->msg("Item $k - Upsert Recurso Id:".$model->id);
            $tot++;
            
        }
        $msg = $tot == $total ? 'Todos os registros OK':'Erro na Atualizacao';
        $this->msg($msg,'warn');
    }


    private function upsertMesorregioes(array $mesorregioes)
    {
        $total = count($mesorregioes);
        $tot = 0;
        foreach($mesorregioes as $k=>$mesorregiao){
            #dd($mesorregiao);
            extract($mesorregiao);#retornara id,nome,UF e regiao_id dentro de UF como id
            $regiao_id = $UF['regiao']['id'];
            $model = Mesorregiao::updateOrCreate(
                [
                    'id'=>$id,
                ],#pk
                [
                    'nome'=>$nome,
                    'regiao_id'=>$regiao_id,
                ]#var
            );
            $this->msg("Item $k - Upsert Recurso Id:".$model->id);
            $tot++;
            
        }
        $msg = $tot == $total ? 'Todos os registros OK':'Erro na Atualizacao';
        $this->msg($msg,'warn');
    }

    private function upsertRegioes(array $regioes)
    {
        $total = count($regioes);
        $tot = 0;
        foreach($regioes as $k=>$regiao){
            extract($regiao);#retornara id,sigla,nome
            $model = Regiao::updateOrCreate(
                [
                    'id'=>$id,
                ],#pk
                [
                    'sigla'=>$sigla,
                    'nome'=>$nome,
                ]#var
            );
            $this->msg("Item $k - Upsert Reg Id:".$model->id);
            $tot++;
            
        }
        $msg = $tot == $total ? 'Todos os registros OK':'Erro na Atualizacao';
        $this->msg($msg,'warn');
    }

    private function msg($msg,$type='info'): void { #error 

        $this->{$type}($msg);
      
    }

    private function get($path,array $param=[])
    {
      
        $url = self::URL.$path;
        $res = Http::withHeaders(['accept' => 'application/json',])->get($url,$param);
            if ($res->ok()){
            return $res->body();
        } else {
            $code = $res->status();
            $msg = "Erro na req - cod http: $code";
            $this->msg($msg,'error');
        }
        
    }

}
