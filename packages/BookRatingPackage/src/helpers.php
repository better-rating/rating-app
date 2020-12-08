<?php

function default_view($view = null, $data = [], $mergeData = [])
{
    $factory = app(Illuminate\Contracts\View\Factory::class);

    if (func_num_args() === 0) {
        return $factory;
    }

    //convert view name
    $view = 'default.'.$view;

    //convert model variable name
    $name = config('bookratingpackage.name');
    if (key_exists($name, $data)) {
        $data['item'] = $data[$name];
        unset($data[$name]);
    }

    $plural = Str::plural($name);
    if (key_exists($plural, $data)) {
        $data['items'] = $data[$plural];
        unset($data[$plural]);
    }

    //get columns
    // This might work better as a request file or a middleware
    $data['config_name'] = 'bookratingpackage';
    $data['display_columns'] = config('bookratingpackage.columns');
    $data['default_columns'] = [
        'rating' => config('bookratingpackage.use_default_rating_column'),
        'rated_on' => config('bookratingpackage.use_default_rated_on_column')
    ];

    return $factory->make($view, $data, $mergeData);
}
