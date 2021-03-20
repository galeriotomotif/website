<?php

namespace App\Models;

use App\Traits\Metaable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Metaable;
    protected $table = 'pages';

    public function scopePublished($q)
    {
        return $q->whereNotNull('published_at');
    }

    public static function getForStaticPage($name)
    {
        return  self::where('for_static_page', $name)->first();
    }

    public static function findBySlug($slug)
    {
        $data = self::published()->where('slug', $slug)->first();

        if (!$data) {
            return false;
        }
        return $data;
    }
}
