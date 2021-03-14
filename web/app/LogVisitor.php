<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogVisitor extends Model
{
    protected $fillable = [
        'ip',
        'host',
        'count'
    ];

    public static function createData($request)
    {
        $data = new self;
        $data->fill($request);
        $data->save();
    }

    public static function findByIp($ip)
    {
        return self::where('ip', $ip)->first();
    }

    public function addCount()
    {
        $this->count = $this->count + 1;
        $this->save();

        return $this;
    }
}
