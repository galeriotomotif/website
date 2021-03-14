<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogVisitor extends Model
{
    protected $fillable = [
        'ip',
        'host'
    ];

    public static function createData($request)
    {
        $data = new self;
        $data->fill($request);
        $data->save();
    }
}
