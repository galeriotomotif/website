<?php

namespace App\Models;

use App\Models\Post\Category;
use App\Models\Post\Tag;
use App\Traits\Metaable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use Metaable;

    protected $table = 'posts';
    protected $dates = [
        'published_at'
    ];

    protected $with = [
        'meta'
    ];

    public function scopePublished($q)
    {
        $q->whereNotNull('published_at');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_post_tag', 'post_id', 'tag_id');
    }

    public static function list()
    {
        return self::published()->get();
    }

    public static function findBySlug($slug)
    {
        $data = self::published()->where('slug', $slug)->first();

        if (!$data) {
            return false;
        }
        return $data;
    }

    public static function getByTagName($name = null, $limit = 10)
    {
        return self::published()->published()->whereHas('tags', function ($q) use ($name) {
            $q->where('name', $name);
        })->limit($limit)->get();
    }

    public static function getNewPosts($without = [])
    {
        return self::published()->published()->orderBy('published_at', 'DESC')->whereNotIn('id', $without)->get();
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
