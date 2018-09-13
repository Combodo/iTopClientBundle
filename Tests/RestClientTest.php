<?php

namespace Combodo\ItopClientBundle\Test\RestClient;


use Combodo\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\OperationInterface;
use Combodo\ItopClientBundle\RestClient\RestClient;
use Combodo\ItopClientBundle\RestResponse\RestResponse;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;


/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 10/09/18
 * Time: 11:52
 */

class RestClientTest extends TestCase
{

    /**
     * @dataProvider defaultDataProvider
     * @dataProvider errorDataProvider
     */
    public function testCreateRequestForOperation(string $operationVersion, string $operationJsonData, array $mockResponses, string $baseUrl, string $auth_user, string $auth_pwd)
    {
        $httpClient = $this->createClientWithResponses($mockResponses);

        $restClient = new RestClient($httpClient, $baseUrl, $auth_user, $auth_pwd);

        $operation = $this->createOperation($operationVersion, $operationJsonData);
        $request = $restClient->createRequestForOperation($operation);

        $requestBodyContents = $request->getBody()->getContents();
        parse_str($requestBodyContents, $postedValues);

        $this->assertSame($operationJsonData, $postedValues['json_data']);

        $this->assertInstanceOf(Request::class, $request);

        $this->assertTrue(is_array($postedValues), 'The posted values is an array');

        $this->assertArrayHasKey('auth_user', $postedValues, 'The auth_user is transmitted int he POST fields');
        $this->assertArrayHasKey('auth_pwd', $postedValues, 'The auth_pwd is transmitted int he POST fields');
        $this->assertArrayHasKey('json_data', $postedValues, 'The json_data is transmitted int he POST fields');


        $this->assertSame($auth_user, $postedValues['auth_user'], 'The correct value of auth_user is transmitted');
        $this->assertSame($auth_pwd, $postedValues['auth_pwd'], 'The correct value of auth_pwd is transmitted');
//        $this->assertSame($operationExposedProperties, $postedValues['json_data'], 'The correct value of json_data is transmitted');
    }

    /**
     * @dataProvider defaultDataProvider
     * @dataProvider errorDataProvider
     */
    public function testGetResponseForOperation(string $operationVersion, string $operationJsonData, array $mockResponses, string $baseUrl, string $auth_user, string $auth_pwd)
    {

        $httpClient = $this->createClientWithResponses($mockResponses);

        $restClient = new RestClient($httpClient, $baseUrl, $auth_user, $auth_pwd);


        $operation = $this->createOperation($operationVersion, $operationJsonData);
        $psrResponse = $restClient->getPsrResponseForOperation($operation);

        $this->assertInstanceOf(Response::class, $psrResponse);
    }

    /**
     * @dataProvider defaultDataProvider
     */
    public function testExec(string $operationVersion, string $operationJsonData, array $mockResponses, string $baseUrl, string $auth_user, string $auth_pwd)
    {

        $httpClient = $this->createClientWithResponses($mockResponses);

        $restClient = new RestClient($httpClient, $baseUrl, $auth_user, $auth_pwd);


        $operation = $this->createOperation($operationVersion, $operationJsonData);
        $psrResponse = $restClient->executeOperation($operation);

        $this->assertInstanceOf(\Combodo\ItopClientBundle\RestResponse\RestResponse::class, $psrResponse);
    }

    public function defaultDataProvider(): array
    {
        return [
            'foo' => [
                'operationVersion' => '1.3',
                'operationJsonData' => '{"foo":"bar, "baz":[1,2]}',
                'responses' => [
                    new Response(200, [], '{"code": 0, "message": "Everything went well"}')
                ],
                'baseUrl' => 'bar',
                'auth_user' => 'JonSnow',
                'auth_pwd' => 'p4ssw0rd',
            ],
            'bar' => [
                'operationVersion' => '1.3',
                'operationJsonData' => '{"1":2}',
                'responses' => [
                    new Response(200, [], '{"code": 0, "message": "baz"}')
                ],
                'baseUrl' => 'bar',
                'auth_user' => 'JonSnow',
                'auth_pwd' => 'p4ssw0rd',
            ],
        ];
    }

    public function errorDataProvider(): array
    {
        return [

            'error' => [
                'operationVersion' => '1.3',
                'operationJsonData' => '{"1":2}',
                'responses' => [
                    new Response(200, [], '{"code": 42, "message": "error"}')
                ],
                'baseUrl' => 'bar',
                'auth_user' => 'JonSnow',
                'auth_pwd' => 'p4ssw0rd',
            ],
        ];
    }

    /**
     * @param  Response[] $responses
     *
     * @return Client
     *
     */

    private function createClientWithResponses(array $responses): Client
    {
//        $history = Middleware::history($historyContainer);

        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);
//        $handler->push($history);
        return new Client(['handler' => $handler]);
    }


    /**
     * @param  Response[] $responses
     *
     * @return Client
     *
     */

    private function createOperation(string $version, string $jsonData ): OperationInterface
    {
        $mock = $this->createMock(OperationInterface::class);
        $mock->method('getVersion')->willReturn($version);
        $mock->method('getJsonData')->willReturn($jsonData);

        return $mock;
    }



}