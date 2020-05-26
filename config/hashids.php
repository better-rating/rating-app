<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-hashids
 */

use App\Models\RatingPartial;
use App\Models\Profile;
use App\Models\Rating;
use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'salt' => 'your-salt-string',
            'length' => 'your-length-integer',
        ],

        'alternative' => [
            'salt' => 'your-salt-string',
            'length' => 'your-length-integer',
        ],

        RatingPartial::class => [
            'salt' => RatingPartial::class.env('HASH_SALT', ''),
            'length' => 11
        ],
        Profile::class => [
            'salt' => Profile::class.env('HASH_SALT', ''),
            'length' => 11
        ],
        Rating::class => [
            'salt' => Rating::class.env('HASH_SALT', ''),
            'length' => 11
        ],
        User::class => [
            'salt' => User::class.env('HASH_SALT', ''),
            'length' => 5,
        ],
    ],

];
