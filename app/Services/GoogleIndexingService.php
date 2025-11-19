<?php

namespace App\Services;

use Google\Client;
use GuzzleHttp\Client as GuzzleClient;

class GoogleIndexingService
{
    protected $googleClient;
    protected $httpClient;
    protected $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

    public function __construct()
    {
        $this->googleClient = new Client();
        $this->googleClient->setAuthConfig(storage_path('app/google/service_account_file.json'));
        $this->googleClient->addScope('https://www.googleapis.com/auth/indexing');

        $this->httpClient = $this->googleClient->authorize();
    }

    public function updateUrl($url)
    {
        $content = json_encode([
            'url' => $url,
            'type' => 'URL_UPDATED'
        ]);

        $response = $this->httpClient->post($this->endpoint, [
            'body' => $content
        ]);

        return $response->getStatusCode();
    }

    public function deleteUrl($url)
    {
        $content = json_encode([
            'url' => $url,
            'type' => 'URL_DELETED'
        ]);

        $response = $this->httpClient->post($this->endpoint, [
            'body' => $content
        ]);

        return $response->getStatusCode();
    }
}
