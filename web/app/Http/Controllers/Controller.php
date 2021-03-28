<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $meta;
    public $breadcrumb;
    public $structureData;
    public $canonical;
    public $amp;

    public function render($view, $param = [], $render = false)
    {
        $params = array_merge($param, [
            'meta' => $this->meta,
            'structureData' => $this->structureData,
            'breadcrumb' => $this->breadcrumb,
            'amp' => $this->amp
        ]);

        if($render){
            return view($view)->with($params)->render();
        }

        return view($view)->with($params);
    }
}
