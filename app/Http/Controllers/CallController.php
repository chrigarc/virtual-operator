<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Services\OpenIAService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Twilio\TwiML\VoiceResponse;

class CallController extends Controller
{
    public function call()
    {
        $response = new VoiceResponse();
        $welcomeMessage = Quote::welcome()->inRandomOrder()->first();
        $response->say($welcomeMessage->content, $welcomeMessage->languageData);
        $response->redirect(route('call.gather'));
        return response($response->__toString(), 200)
            ->header('Content-Type', 'text/xml');
    }

    public function gather()
    {
        $response = new VoiceResponse();
        $service = new OpenIAService();
        $bye = false;
        $requestMessage = request()->SpeechResult;
        if($requestMessage){
            $response = $service->chatFriend($requestMessage);
            if(isset($response['choices'][0]['text'])){
                $responseMessage = $response['choices'][0]['text'];
                info('responseMessage', $responseMessage);
                if(Str::contains($responseMessage, [' adios'])){
                    $response->redirect(route('call.bye'));
                    $bye = true;
                }else{
                    info('responseMessage', [$responseMessage]);
                    $response->say($responseMessage, ['language' => request()->Language]);
                }
            }
            //$response->say($requestMessage, ['language' => request()->Language]);
        }else{
            $askMessage = Quote::ask()->inRandomOrder()->first();
            $response->gather([
                'action' => route('call.gather'),
                'input' => 'speech',
                'language' => $askMessage->languageData['language'],
                'timeout' => 3
            ])->say($askMessage->content, $askMessage->languageData);
            $funFactMessage = Quote::funFact()->inRandomOrder()->first();
            $response->say($funFactMessage->content, $funFactMessage->languageData);
        }
        if(!$bye){
            $response->redirect(route('call.gather'));
        }
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
