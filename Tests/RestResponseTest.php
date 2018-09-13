<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 11/09/18
 * Time: 16:58
 */

namespace Combodo\ItopClientBundle\Test\RestClient;


use Combodo\ItopClientBundle\RestResponse\RestResponse;
use Combodo\ItopClientBundle\RestResponse\RestResponseException;
use GuzzleHttp\Psr7\Response;
use JmesPath\SyntaxErrorException;
use PHPUnit\Framework\TestCase;

class RestResponseTest extends TestCase
{


    /**
     * @dataProvider ValidDataProvider
     *
     */
    public function testGetCode(string $response, int $code, string $message, array $asArray, string $asJson, array $jMesPath)
    {
        $restResponse = new RestResponse($response);

        $this->assertSame($code, $restResponse->getCode(), "getCode must return $code");
    }

    /**
     * @dataProvider ValidDataProvider
     *
     */
    public function testGetMessage(string $response, int $code, string $message, array $asArray, string $asJson, array $jMesPath)
    {
        $restResponse = new RestResponse($response);

        $this->assertSame($message, $restResponse->getMessage(), "getMessage must return \"$message\"");
    }

    /**
     * @dataProvider ValidDataProvider
     *
     */
    public function testAsArray(string $response, int $code, string $message, array $asArray, string $asJson, array $jMesPath)
    {
        $restResponse = new RestResponse($response);

        $this->assertSame($asArray, $restResponse->asArray());
    }

    /**
     * @dataProvider ValidDataProvider
     *
     */
    public function testAsJson(string $response, int $code, string $message, array $asArray, string $asJson, array $jMesPath)
    {
        $restResponse = new RestResponse($response);

        $this->assertSame($asJson, $restResponse->asJson(0));
    }

    /**
     * @dataProvider ValidDataProvider
     *
     */
    public function testSearch(string $response, int $code, string $message, array $asArray, string $asJson, array $jMesPath)
    {
        $restResponse = new RestResponse($response);

        $this->assertSame($jMesPath['result'], $restResponse->search($jMesPath['expression']));
    }



    public function testSearchInvalid()
    {
        $response = '{"code": 0, "message": "foo"}';
        $restResponse = new RestResponse($response);

        $this->expectException(SyntaxErrorException::class);
        $restResponse->search('.][(');
    }



    /**
     * @dataProvider constructExceptionDataProvider
     */
    public function testConstructException(string $expectedExceptionClassName, string $response)
    {
        $this->expectException($expectedExceptionClassName);
        new RestResponse($response);
    }

    public function constructExceptionDataProvider(): array
    {
        return [
            'responseNotJson' => [
                'expectedExceptionClassName' => RestResponseException::class,
                'psrResponse' => '{no a valid json]',
            ],
            'responseWithErrorCode' => [
                'expectedExceptionClassName' => RestResponseException::class,
                'psrResponse' => '{"code": 42,"message": "hu ho!"}',
            ],
        ];
    }

    public function validDataProvider(): array
    {
        $codesAndMessages = [
            'basic' => [
                'httpStatus' => 200,
                'code' => 0,
                'message' => "Everything went well",
                'search' => [
                    'in_response'   => ',"foo":"bar"',
                    'has_array'     => ['foo' => 'bar'],
                    'jMesPath'      => ['expression' => 'foo', 'result' => 'bar']
                ]
            ],
            'empty_message' => [
                'httpStatus' => 200,
                'code' => 0,
                'message' => "",
                'search' => [
                    'in_response'   => ',"foo":"bar"',
                    'has_array'     => ['foo' => 'bar'],
                    'jMesPath'      => ['expression' => 'foo', 'result' => 'bar']
                ]
            ],
            'special_chars_in__message' => [
                'httpStatus' => 200,
                'code' => 0,
                'message' => "I'm \"happy\" thanks gor your € & $ !! \\ / ",
                'search' => [
                    'in_response'   => ',"foo":"bar"',
                    'has_array'     => ['foo' => 'bar'],
                    'jMesPath'      => ['expression' => 'foo', 'result' => 'bar']
                ]
            ],
            'complexeJmesPath' => [
                'httpStatus' => 200,
                'code' => 0,
                'message' => "Everything went well",
                'search' => [
                    'in_response'   => ',"foo":{"bar":["baz","biz"],"buzz":["aldreen","lightyear"]}',
                    'has_array'     => ['foo' => ['bar' => ["baz", "biz"], "buzz" => ["aldreen", "lightyear"]]],
                    'jMesPath'      => ['expression' => 'foo.buzz[0]', 'result' => 'aldreen']
                ]
            ],
        ];

        $dataProvider = [];
        foreach ($codesAndMessages as $name => $params) {
            $json = '{"code":'.$params['code'].',"message":'.json_encode($params['message']).$params['search']['in_response'].'}';

            $dataProvider[$name] = [
//                'psrResponse' => new Response($params['httpStatus'], [], $json),
                'response' => $json,
                'code' => $params['code'],
                'message' => $params['message'],
                'asArray' => array_merge(['code' => $params['code'], 'message' => $params['message']], $params['search']['has_array']),
                'asJson' => $json,
                'jMesPath' => $params['search']['jMesPath'],
            ];
        }

        return$dataProvider;
    }





}