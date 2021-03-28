<?php

namespace App\Models;

use App\Traits\Metaable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Metaable;
    protected $table = 'pages';

    public function scopePublished($q)
    {
        return $q->whereNotNull('published_at');
    }

    public static function list()
    {
        return self::published()->get();
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

    public static function lastUpdateDate()
    {
        $data = self::published()->orderBy('updated_at', 'DESC')->first();

        if ($data) {
            return $data->updated_at->format('Y-m-d');
        }

        return Carbon::now()->format('Y-m-d');
    }
}
