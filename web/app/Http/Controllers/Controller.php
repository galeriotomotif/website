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
    public $amp_available = false;
    public $amp_url;

    public function render($view, $param = [], $render = false)
    {
        $params = array_merge($param, [
            'meta' => $this->meta,
            'structureData' => $this->structureData,
            'breadcrumb' => $this->breadcrumb,
            'amp' => $this->amp,
            'amp_available' => $this->amp_available,
            'amp_url' => $this->amp_url
        ]);

        if ($render) {
            return view($view)->with($params)->render();
        }

        return view($view)->with($params);
    }
}
