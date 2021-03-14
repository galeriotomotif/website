<?php

namespace App\Models\Post;

use App\Helpers\SlugHelper;
use App\Traits\Metaable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Metaable;

    protected $table = 'post_categories';
    protected $fillable = [
        'name',
        'image',
        'content'
    ];

    protected $dates = [
        'published_at'
    ];

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

        $data->meta()->create([
            'title' => $request->meta_title,
            'description' => $request->meta_description
        ]);

        return $data;
    }

    public static function updateData($category, $request)
    {
        $data = $category;
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
