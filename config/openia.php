<?php
$URL = 'https://api.openai.com/v1/';
return [
    'completions' => [
        'data' => [
            "model" => "text-davinci-003",
            "temperature" => 0.5,
            "top_p" => 1.0,
            "frequency_penalty" => 0.5,
            "presence_penalty" => 0.0,
            "max_tokens"=> 500,
        ],
        'url' => $URL.'completions'
    ]
];


