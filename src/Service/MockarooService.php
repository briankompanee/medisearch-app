<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class MockarooService
{
    private HttpClientInterface $client;
    private string $apiUrl = 'https://my.api.mockaroo.com'; // Base URL for Mockaroo API
    private ApiKeyFetcher $apiKeyFetcher;

    public function __construct(HttpClientInterface $client, ApiKeyFetcher $apiKeyFetcher)
    {
        $this->client = $client;
        $this->apiKeyFetcher = $apiKeyFetcher;
    }

    public function getDoctorAvailability(int $doctorId): array
    {
        $apiKey = $this->apiKeyFetcher->getApiKey();
        $response = $this->client->request('GET', $this->apiUrl . '/doctor/availability/' . $doctorId . '?key=' . $apiKey);
        return $response->toArray();
    }
}
