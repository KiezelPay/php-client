<?php
namespace KiezelPay\Client;

use GuzzleHttp\Client;

class App
{
    /**
     * @var string
     */
    protected $domain = 'https://kiezelpay.com';

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var int
     */
    protected $appId;

    /**
     * App constructor.
     *
     * @param int $appId
     */
    public function __construct($appId)
    {
        $this->appId = $appId;

        $this->httpClient = new Client;
    }

    /**
     * @param string $accountToken
     * @param int $deviceId
     * @return Responses\Status
     */
    public function status($accountToken, $deviceId)
    {
        $parameters = [
            'appid'        => $this->appId,
            'accounttoken' => $accountToken,
            'devicetoken'  => $deviceId,
            'rand'         => mt_rand(),
        ];

        $response = $this->httpClient->get($this->domain.'/api/v1/status', ['query' => $parameters])->json();

        return new Responses\Status($response);
    }

    /**
     * @param Client $httpClient
     */
    public function setHttpClient(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }
}
