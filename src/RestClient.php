<?php

namespace SMSPortal;

class RestClient
{
    /**
     * API base URL
     * @var string
     */
    const BASE_REST = 'https://rest.smsportal.com/v1/';

    /**
     * @var string
     */
    const HTTP_GET = 'GET';
    /**
     * @var string
     */
    const HTTP_POST = 'POST';

    /**
     * @var string
     */
    private $apiToken = '';
    private $client;

    /**
     * Create a new API connection
     *
     * @param string $apiToken The token found on your integration
     */
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client;
    }

    public function message()
    {
        return $this;
    }

    /**
     * get apiToken
     *
     * @return $this
     */
    public function authorize()
    {
        $response = $this->client->request(static::HTTP_GET, static::BASE_REST . 'Authentication', [
            'http_errors' => false,
            'headers' => ['Authorization' => 'Basic ' . base64_encode(config('smsportal.client_id') . ':' . config('smsportal.secret'))]
        ]);

        $responseData = $this->getResponse($response->getBody());

        $this->apiToken = $responseData['token'];

        return $this;
    }

    /**
     * Submit API request to send SMS
     *
     * @param array $options
     * @return array
     */
    public function send(array $options)
    {
        $this->authorize();

        $requestBody = ['messages' => [$options]];

        $response = $this->client->request(static::HTTP_POST, static::BASE_REST . 'BulkMessages', [
            'json' => $requestBody,
            'http_errors' => false,
            'headers' => ['Authorization' => 'Bearer ' . $this->apiToken]
        ]);

        return $this->getResponse($response->getBody());
    }

    public function balance()
    {
        $response = $this->client->request(static::HTTP_GET, static::BASE_REST . 'Balance', [
            'http_errors' => false,
            'headers' => ['Authorization' => 'Bearer ' . $this->apiToken]
        ]);

        $responseData = $this->getResponse($response->getBody());

        return $responseData['number'];
    }

    /**
     * Tranform response string to responseData
     *
     * @param string $responseBody
     * @return array
     */
    private function getResponse(string $responseBody)
    {
        return json_decode($responseBody, true);
    }
}
