<?php 

use Illuminate\Support\Facades\Http;

if (! function_exists('connect')) {
    function connect()
    {
        $response = Http::post('https://app.turitop.com/v1/authorization/grant', [
                        'short_id'   => 'N184',
                        'secret_key' => 'xJ43NpXgNoBS0JprTR3zj4aJNNvtc6al',
                    ])->collect();

        return $response['data'];
    }
}