<?php

namespace App\Models;

use App\Traits\Metaable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Metaable;
    protected $table = 'pages';

    public static function getForStaticPage($name)
    {
        return  self::where('for_static_page', $name)->first();
    }
}
