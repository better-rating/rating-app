<?php

return [
    'name'        => 'book',
    'name_plural' => 'books',
    'table'       => 'books',
    'model'       => 'Book',

    /*
    |--------------------------------------------------------------------------
    | Columns
    |--------------------------------------------------------------------------
    |
    | These are the columns that the default view will try to render using the
    | key as the label and the value as the model attribute. If there is no value,
    | it will try to render against a lowercase version of the key.
    |
    */
    'columns' => [
        'Title' => [
            'column' => 'title',
            'type' => 'string'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Use Default Rating Column
    |--------------------------------------------------------------------------
    |
    | Automatically use the built in 'Rating' column. If true, 'Rating' can be
    | omitted from the 'columns' config. This is recommended since the Rating
    | Model is owned by the App.
    |
    */
    'use_default_rating_column' => true,

    /*
    |--------------------------------------------------------------------------
    | Use Default Rated On Column
    |--------------------------------------------------------------------------
    |
    | Automatically use the built in 'Rated On' column. If true, 'Rated On' can
    | be omitted from the 'columns' config. This is recommended since the Rating
    | Model is owned by the App.
    |
    */
    'use_default_rated_on_column' => true,
];
