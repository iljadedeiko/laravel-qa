<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Exceptions\HttpResponseException;
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
        try {
            $response = Http::post('https://api.jdoodle.com/v1/execute', [
                "clientId" => "c95575ff0dcf59d2164301cf4e5a5800",
                "clientSecret" => "4d7e9ca6b218157d1b87ae8e83dba2af5f1940f77a684642a447db248df6901",
                "script" => $this->script,
                "language" => $this->language,
                "versionIndex" => "0"
            ]);
        } catch (HttpResponseException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $response->json();
    }
}
