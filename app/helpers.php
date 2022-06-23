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
if (! function_exists('orderId')) {
    function orderId()
    {
        $alfa = [
            0 => 'B',
            1 => 'C',
            2 => 'D',
            3 => 'E',
            4 => 'F',
            5 => 'G',
            6 => 'H',
            7 => 'I',
            8 => 'J',
            9 => 'K',
            10 => 'L',
            11 => 'M',
            12 => 'N',
            13 => 'O',
            14 => 'P',
            15 => 'Q',
            16 => 'R',
            17 => 'S',
            18 => 'T',
            19 => 'U',
            20 => 'V',
            21 => 'W',
            22 => 'X',
            23 => 'Y',
            24 => 'Z',
        ];

        $first = $alfa[mt_Rand(0, 24)];
        $second = mt_Rand(100, 999);
        return $first.$second;
    }
}
if (! function_exists('step')) {
    function step()
    {
        $cont = 0;
        $user = auth()->user();
        $profile = $user->profile;

        if ($profile->firstname != null && $user->email != null && $profile->phone != null) {
            $cont++;
        }
        
        if ($profile->identify != null && $profile->nif != null && $profile->address != null && $profile->city != null) {
            $cont++;
        }

        return $cont;
    }
}