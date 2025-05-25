<?php

declare(strict_types=1);

namespace App\Services\Request;

use Illuminate\Support\Facades\Http;

final class HttpRequest implements RequestInterface
{
    public function __construct()
    {
        $this->baseUrl = config('services.tmdb.base_url');
        $this->token = config('services.tmdb.token');
    }

    public function get(string $endpoint, array $params = []): array
    {
        return $this->request('get', $endpoint, $params);
    }

    private function request(string $method, string $endpoint, array $params = []): array
    {
        $url = "{$this->baseUrl}/{$endpoint}";

        $params = array_merge($params, [
            'api_key' => $this->token,
        ]);

        $response = Http::acceptJson()
            ->$method($url, $params);

        if ($response->failed()) {
            throw new \Exception("TMDB API request failed: " . $response->body());
        }

        return $response->json();
    }
}
