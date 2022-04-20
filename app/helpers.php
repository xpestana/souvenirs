<?php 

use App\Models\Api;

if (! function_exists('connect')) {
    function connect()
    {
        return auth()->user();
    }
}