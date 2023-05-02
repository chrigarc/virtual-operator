<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class TestService
{
    public function test_polly($message)
    {
        $service = new AwsService();
        return $service->pollySpeech($message);
    }
}
