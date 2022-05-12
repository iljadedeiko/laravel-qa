<?php

namespace App\Http\Controllers\Service;

use Illuminate\Support\Facades\Http;

class CompilerAPI
{
    private $script;
    private $language;

    public function __construct($script, $language)
    {
        $this->script = $script;
        $this->language = $language;
    }

    public function fetchData()
    {
        $response = Http::post('https://api.jdoodle.com/v1/execute', [
            "clientId" => "8e4a20639e427767c72eeb155df3a0cc",
            "clientSecret" => "ba51f3113248fb04a1ea2d7a1aa67adb88f3c4fc64fe77988e05f3f4cee119ea",
            "script" => $this->script,
            "language" => $this->language,
            "versionIndex" => "0"
        ]);

        return $response->json();
    }
}
