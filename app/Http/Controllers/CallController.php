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

        $askMessage = Quote::ask()->inRandomOrder()->first();
        $response->gather([
            'action' => route('call.bye'),
            'input' => 'speech',
            'language' => $askMessage->languageData['language'],
            'timeout' => 2
        ])->say($askMessage->content, $askMessage->languageData);
        $funFactMessage = Quote::funFact()->inRandomOrder()->first();
        $response->say($funFactMessage->content, $funFactMessage->languageData);
        $response->redirect(route('call.bye'));
        return response($response->__toString(), 200)
            ->header('Content-Type', 'text/xml');
    }

    public function bye()
    {
        $response = new VoiceResponse();
        $requestMessage = request()->SpeechResult;
        if($requestMessage){
            $response->say($requestMessage, ['language' => request()->Language]);
        }
        $message = Quote::bye()->inRandomOrder()->first();
        $response->say($message->content, $message->languageData);
        return response($response->__toString(), 200)
            ->header('Content-Type', 'text/xml');
    }
}
