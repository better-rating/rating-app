<?php

namespace App\Models;

class Episode extends BaseModel
{
    //protected $table = '';
    //protected $casts = [];

    //=== RELATIONSHIPS ===//
    public function show()
    {
        return $this->belongsTo(Show::class);
    }

//            $table->string('title');
//            $table->integer('show_id');
//            $table->integer('season_number');
//            $table->integer('episode_number');

    //=== ATTRIBUTES ===//

    //=== SCOPES ===//

}
