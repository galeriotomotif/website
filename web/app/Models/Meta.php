<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table = 'metas';
    protected $hidden = [
        'created_at',
        'updated_at',
        'description'
    ];
}
