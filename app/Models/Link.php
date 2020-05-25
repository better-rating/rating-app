<?php

namespace App\Models;

/**
 * Class Link
 * @package App\Models
 *
 * @table links
 * @col media_id integer
 * @col media_type string
 * @col url string
 */
class Link extends BaseModel
{
    //=== RELATIONSHIPS ===//
    public function media()
    {
        return $this->morphTo();
    }

    //=== ATTRIBUTES ===//

    //=== SCOPES ===//

}
