<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ScooterControllerTest extends WebTestCase
{
    private $client;
    private $url;
    public function setUp(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $this->client = static::createClient([], [
                            'HTTP_X_API_KEY'  => 'c0a062b7-b225-c294-b8a0-06b98931a45b1123'
                         ]);

        $this->url = 'http://localhost:8001/scooter-ride/';
        parent::setUp();
    }

    /**
     * @dataProvider provideAddScooterData
     */
    public function testAddScooter(string $expectedResult, array $requestParams): void
    {
        $this->client->request('POST', $this->url . 'addScooter', [ 'body' => $requestParams]);
        $response = $this->client->getResponse();
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals($expectedResult, $responseData['message']);
    }


    public function provideAddScooterData()
    {
        yield 'add scooter without param' => [
            'Expecting longitude in `lng` key and latitude in `lat` key',
            [],
        ];

        yield 'add scooter without lng' => [
            'Expecting longitude in `lng` key and latitude in `lat` key',
            ["lat" => 52.5296115]
        ];

       yield 'add scooter without lat' => [
            'Expecting longitude in `lng` key and latitude in `lat` key',
            ["lng" => 23.3378023]
        ];

    }
}