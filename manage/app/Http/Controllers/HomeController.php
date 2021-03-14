<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Repositories\ConfigInterface;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->title = 'Home';
        $this->breadcrumb = [
            'Home'
        ];
        $this->route = '';
        $this->view = '';
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return $this->render('index');
    }
}
