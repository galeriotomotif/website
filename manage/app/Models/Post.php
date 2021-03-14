<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use App\Models\Post\Category;
use App\Models\Post\Tag;
use App\Traits\Metaable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Metaable;

    protected $table = 'posts';
    protected $fillable = [
        'name',
        'image',
        'content',
        'category_id'
    ];

    protected $dates = [
        'published_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_post_tag', 'post_id', 'tag_id');
    }

    public static function datatables()
    {
        return self::select('*');
    }

    public static function createData($request)
    {
        $data = new self;
        $data->fill($request->all());
        $data->slug = SlugHelper::make($request->name);

        if($request->published){
            $data->published_at = Carbon::now();
        }

        $data->save();

        $data->tags()->sync($request->tags);

        $data->meta()->create([
            'title' => $request->meta_title,
            'description' => $request->meta_description
        ]);

        return $data;
    }

    public static function updateData($post, $request)
    {
        $data = $post;
        $data->fill($request->all());

        if(!$data->published_at){
            $data->slug = SlugHelper::make($request->name);
        }

        if(!$data->published_at && $request->published){
            $data->published_at = Carbon::now();
        }

        if($request->slug){
            $data->slug = $request->slug;
        }

        $data->save();

        $data->tags()->sync($request->tags);

        $data->meta()->update([
            'title' => $request->meta_title,
            'description' => $request->meta_description
        ]);

        return $data;
    }

    public static function deleteData($data)
    {
        return $data->delete();
    }
}
