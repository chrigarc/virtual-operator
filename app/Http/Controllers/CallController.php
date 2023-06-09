<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Services\AwsService;
use App\Services\OpenIAService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Twilio\TwiML\VoiceResponse;

class CallController extends Controller
{
    private $awsService;

    public function __construct()
    {
        $this->awsService = new AwsService();
    }

    public function call()
    {
        $response = new VoiceResponse();
        $welcomeMessage = Quote::welcome()->inRandomOrder()->first();
        $response->play($this->awsService->pollySpeech($welcomeMessage->content));
      //  $response->say($welcomeMessage->content, $welcomeMessage->languageData);
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
            $responseService = $service->chatFriend($requestMessage);
            if(isset($responseService['choices'][0]['text'])){
                $responseMessage = Str::lower($responseService['choices'][0]['text']);
                if(Str::contains($responseMessage, [' adios', ' adiós', 'adios', 'hasta pronto'])){
                    $response->redirect(route('call.bye'));
                    $bye = true;
                }else{
                    $this->runGather($response, $responseMessage, request()->Language);
                }
            }
        }else{
            $askMessage = Quote::ask()->inRandomOrder()->first();
            $this->runGather($response, $askMessage->content, $askMessage->languageData['language']);
            $funFactMessage = Quote::funFact()->inRandomOrder()->first();
            //$response->say($funFactMessage->content, $funFactMessage->languageData);
            $response->play($this->awsService->pollySpeech($funFactMessage->content));
        }
        if(!$bye){
            $response->redirect(route('call.gather'));
        }
        return response($response->__toString(), 200)
            ->header('Content-Type', 'text/xml');
    }

    private function runGather(&$response, $message, $language)
    {
        $response->gather([
            'action' => route('call.gather'),
            'input' => 'speech',
            'language' => $language,
            'timeout' => 2
        ]);
        //$response->say($message, ['language' => $language]);
        $response->play($this->awsService->pollySpeech($message));
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
