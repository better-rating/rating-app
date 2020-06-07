<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $guarded = ['id'];

    public static function retrieve($value)
    {
        return self::where('slug', $value)->firstOrFail();
    }
}
