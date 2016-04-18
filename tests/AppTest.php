<?php
namespace Tests\KiezelPay\Client;

use KiezelPay\Client\App;
use KiezelPay\Client\Responses\Status;

class AppTest extends \PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        \Mockery::close();
    }

    public function test_status()
    {
        $appId = 123456;
        $account = 'ABCDEF9876';
        $deviceId = 9;
        $code = 97531;

        $response = \Mockery::mock(\GuzzleHttp\Message\ResponseInterface::class);
        $response->shouldReceive('json')->once()->andReturn(['paymentCode' => $code]);

        $http = \Mockery::mock(\GuzzleHttp\Client::class);
        $http->shouldReceive('get')->with(
            'https://kiezelpay.com/api/v1/status',
            \Mockery::on(function (array $params) use ($appId, $account, $deviceId) {
                return $params['query']['appid' ] === $appId
                    && $params['query']['accounttoken'] === $account
                    && $params['query']['devicetoken'] === $deviceId;
            })
        )->once()->andReturn($response);

        $app = new App($appId);
        $app->setHttpClient($http);

        $status = $app->status($account, $deviceId);

        $this->assertInstanceOf(Status::class, $status);
        $this->assertEquals($code, $status->getPaymentCode());
    }
}
