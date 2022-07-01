<?php
namespace Utils\Breadcrumbs;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class Segment {
    protected $request;
    protected $segment;

    public function __construct(Request $request, $segment)
    {
        $this->request = $request;
        $this->segment = $segment;
    }

    public function model($type){
        return collect($this->request->route()->parameters())
    }

    public function name(){
        return Str::title($this->segment);
    }

    public function url(){
        return url(implode(array_slice($this->request->segments(),0,$this->position()+1),'/'));
    }
    public function position(){
        return array_search($this->segment,$this->request->segments());

    }


}