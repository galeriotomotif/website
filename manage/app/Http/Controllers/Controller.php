<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\ImageThumbHelper;
use Illuminate\Routing\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $config;
    public $title;
    public $breadcrumb;
    public $view;
    public $route;
    public $datatablesStructure;
    public $datatablesOptions;

    public function __construct()
    {
        $this->title = 'title';
        $this->breadcrumb = [];
        $this->view = '';
        $this->route = '';
        $this->datatablesOptions = [
            // 'searching' => false,
            // 'paging' => false,
            // 'ordering' => false,
            // 'info' => false
        ];
        $this->datatablesStructure = [
            // 'default_order_on_collumn' => 0,
            // 'collumns' => [
            //     [
            //         'name' => 'id',
            //         'data' => 'id',
            //         'label' => 'ID',
            //         'width' => '30px',
            //         'className' => 'text-center',
            //         'orderable' => true
            //     ],
            // ]
        ];
    }

    public function render($view, $param = array())
    {
        $params = array(
            'siteName' => env('APP_SITENAME', 'sitename'),
            'title' => $this->title,
            'breadcrumb' => $this->breadcrumb,
            'route' => $this->route,
            'view' => $this->view,
            'datatablesStructure' => $this->datatablesStructure
        );

        $params = array_merge($params, $param);

        return view($this->view . $view, $params);
    }

    public function makeActionButtons($actions)
    {
        $actionButtons = '';
        $actionButtons .= '<div class="dropdown">
            <a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-sm-left" aria-labelledby="dropdownMenuButton">';

        foreach ($actions as $key => $action) {
            switch ($action->type) {
                case 'button':
                    $datas = '';
                    if (isset($action->datas)) {
                        foreach ($action->datas as $key => $data) {
                            $datas .= 'data-' . $key . '="' . $data . '"';
                            $datas .= ' ';
                        }
                    }

                    $actionButtons .= '<button class="dropdown-item" onclick="' . $action->onclick . '" ' . (isset($action->url) ? 'data-url="' . $action->url . '"' : '') . $datas . '><i class="' . $action->icon . ' mr-1"></i>' . $action->label . '</button>';
                    break;
                case 'link':
                    $actionButtons .= '<a class="dropdown-item" href="' . $action->url . '" ' . (isset($action->target_blank) ? 'target="blank"' : '') . '><i class="' . $action->icon . ' mr-1"></i>' . $action->label . '</a>';
                    break;
                default:
                    # code...
                    break;
            }
        }
        $actionButtons .= '</div></div>';

        return $actionButtons;
    }

    public function makeLastActivity($model)
    {
        $updatedAt = '';

        $updatedAt .= '<span class="d-block"><i class="fas fa-clock mr-1"></i>' . $model->updated_at->diffForHumans() . '</span>';

        // if ($model->activities->count() && $model->activities->last()->causer) {
        //     $updatedAt .= '<span class="d-block"><i class="fas fa-user-clock mr-1"></i>' . $model->activities->last()->description . ' by ' . $model->activities->last()->causer->name . '</span>';
        // } else {
        //     $updatedAt .= '<span class="d-block"><i class="fas fa-user-clock mr-1"></i>Created by system</span>';
        // }

        return $updatedAt;
    }

    public function makePublishedAtStatus($published_at)
    {
        if($published_at){
            return '<div class="badge badge-info">Publised</div><small class="d-block text-muted">Published at '.$published_at->format('d/m/Y H:i').'</small>';
        }else{
            return '<div class="badge badge-secondary">Draft</div>';
        }
    }

    public function makeImageForDatatables($path)
    {
        if($path){
            $path = url($path);
        }else{
            $path = asset('images/no-image.png');
        }

        return '<div class="thumbnail-on-datatables" style="--image:url('.$path.')"></div>';
    }
}
