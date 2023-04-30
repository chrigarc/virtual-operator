<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class OpenIAService
{
    public function chatFriend($message)
    {
        $token = config('services.open_ia.token');
        $url = config('openia.completions.url');
        $model = config('openia.completions.data');
        $model["stop"] = ["You:"];
        $model['prompt'] = $message;
        $result = $client = Http::withToken($token)
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($url, $model);
        return $result->json();
    }
}
