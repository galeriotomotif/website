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

    public function render($view, $param = [])
    {
        $params = array_merge($param, [
            'meta' => $this->meta,
            'structureData' => $this->structureData,
            'breadcrumb' => $this->breadcrumb
        ]);

        return view($view)->with($params);
    }
}
