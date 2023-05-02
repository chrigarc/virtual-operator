<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AwsService
{
    public function pollySpeech($message)
    {
        /* @var $polly \Aws\Polly\PollyClient */
        $pollyClient = \AWS::createClient('polly');
        $args = [
            'OutputFormat' => 'mp3',
            'Text' => $message,
            'TextType' => 'text',
            'LanguageCode' => 'es-ES',
            'VoiceId' => 'Lucia', //pass preferred voice id here
            'Engine' => 'neural'
        ];

        $result = $pollyClient->synthesizeSpeech($args);
        $resultData = $result->get('AudioStream')->getContents();
        $filename = 'audios-polly/'.Str::uuid().'.mp3';
        Storage::put('public/'.$filename,$resultData);
        return url('storage/'.$filename);
    }
}
