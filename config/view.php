<?php

$viewCompiledPath = env('VIEW_COMPILED_PATH');

return [

    'paths' => [
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | Use storage_path() directly — do not use realpath() here. On a fresh deploy,
    | if the directory does not exist yet, realpath() returns false and Laravel
    | throws "Please provide a valid cache path". AppServiceProvider ensures
    | storage/framework/views exists at boot.
    |
    | An empty VIEW_COMPILED_PATH in .env must not override the default (same error).
    |
    */

    'compiled' => (is_string($viewCompiledPath) && $viewCompiledPath !== '')
        ? $viewCompiledPath
        : storage_path('framework/views'),

];
