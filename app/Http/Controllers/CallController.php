<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use Twilio\TwiML\VoiceResponse;

class CallController extends Controller
{
    public function call()
    {
        $response = new VoiceResponse();
        $welcomeMessage = Quote::welcome()->inRandomOrder()->first();
        $response->say($welcomeMessage->content, $welcomeMessage->languageData);
        return response($response->__toString(), 200)
            ->header('Content-Type', 'text/xml');
    }
}
