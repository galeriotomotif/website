<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use App\Traits\Metaable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Metaable;

    protected $table = 'pages';
    protected $fillable = [
        'name',
        'slug',
        'image',
        'content',
        'for_static_page'
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

    public static function updateData($page, $request)
    {
        $data = $page;
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
