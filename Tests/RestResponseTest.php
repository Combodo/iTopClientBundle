<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 11/09/18
 * Time: 16:58
 */

namespace BrunoDs\ItopClientBundle\Test\RestClient;


use BrunoDs\ItopClientBundle\RestClient\RestResponse;
use BrunoDs\ItopClientBundle\RestClient\RestResponseException;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class RestResponseTest extends TestCase
{

    /**
     * @dataProvider ValidDataProvider
     * @dataProvider ValidAndInvalidDataProvider
     * @dataProvider invalidDataProvider
     *
     */
    public function testBasic(Response $psrResponse, ?string $okHas, ?string $okGet, ?string $KoHas, ?string $KoGet)
    {
        $restResponse = new RestResponse($psrResponse);

        if (!empty($okHas)) {
            $this->assertTrue($restResponse->$okHas(), "okHas must return true for this PsrResponse");
        }
        if (!empty($okGet)) {
            $restResponse->$okGet();
        }

        if (!empty($KoHas)) {
            $this->expectException(RestResponseException::class);
            $this->assertFalse($restResponse->$KoHas(), "$KoHas must return false for this PsrResponse");
        }
        if (!empty($KoGet)) {
            $this->expectException(RestResponseException::class);
            $restResponse->$KoGet();
        }
    }

    /**
     * @dataProvider ValidDataProvider
     * @dataProvider ValidAndInvalidDataProvider
     */
    public function testGetWithParametersException(Response $psrResponse, ?string $okHas, ?string $okGet, ?string $KoHas, ?string $KoGet)
    {
        if (is_null($okGet)) {
            $this->markTestSkipped();
            return;
        }

        $restResponse = new RestResponse($psrResponse);

        $this->expectException(RestResponseException::class);
        $restResponse->$okGet('invalidParam');

    }

    /**
     * @dataProvider ValidDataProvider
     * @dataProvider ValidAndInvalidDataProvider
     */
    public function testHasWithParametersException(Response $psrResponse, ?string $okHas, ?string $okGet, ?string $KoHas, ?string $KoGet)
    {
        if (is_null($okHas)) {
            $this->markTestSkipped();
            return;
        }

        $restResponse = new RestResponse($psrResponse);

        $this->expectException(RestResponseException::class);
        $restResponse->$okHas('invalidParam');
    }

    /**
     * @dataProvider ValidDataProvider
     * @dataProvider ValidAndInvalidDataProvider
     */
    public function testNoSetterException(Response $psrResponse, ?string $okHas, ?string $okGet, ?string $KoHas, ?string $KoGet)
    {
        if (is_null($okGet)) {
            $this->markTestSkipped();
            return;
        }

        $restResponse = new RestResponse($psrResponse);
        $setter = 's' . substr($okGet, 1);

        $this->expectException(RestResponseException::class);
        $restResponse->$setter();
    }


    /**
     * @dataProvider constructExceptionDataProvider
     */
    public function testConstructException(string $expectedExceptionClassName, Response $psrResponse)
    {
        $this->expectException($expectedExceptionClassName);
        $restResponse = new RestResponse($psrResponse);
    }

    public function constructExceptionDataProvider(): array
    {
        return [
            'responseNotJson' => [
                'expectedExceptionClassName' => RestResponseException::class,
                'psrResponse' => new Response(200, [], '{no a valid json]'),
            ],
            'responseWithErrorCode' => [
                'expectedExceptionClassName' => RestResponseException::class,
                'psrResponse' => new Response(200, [], '{"code": 42,"message": "hu ho!"}'),
            ],
        ];
    }

    public function ValidDataProvider(): array
    {
        return [
            'validGetAndHasCode' => [
                'psrResponse' => new Response(200, [], '{"code": 0, "message": "Everything went well"}'),
                'okHas' => 'hasCode',
                'okGet' => 'getCode',
                'KoHas' => null,
                'KoGet' => null,
            ],
            'validGetAndHasMessage' => [
                'psrResponse' => new Response(200, [], '{"code": 0, "message": "Everything went well"}'),
                'okHas' => 'hasMessage',
                'okGet' => 'getMessage',
                'KoHas' => null,
                'KoGet' => null,
            ],

        ];
    }


    public function ValidAndInvalidDataProvider(): array
    {
        return [

            'otherProperty' => [
                'psrResponse' => new Response(200, [], '{"code": 0, "whoo": [1,2,3]}'),
                'okHas' => 'hasWhoo',
                'okGet' => 'getWhoo',
                'KoHas' => 'hasMessage',
                'KoGet' => 'getMessage',
            ],
        ];
    }

    public function invalidDataProvider(): array
    {
        return [

            'directPropertyAccesBlocked' => [
                'psrResponse' => new Response(200, [], '{"code": 0, "message": "Everything went well"}'),
                'okHas' => null,
                'okGet' => null,
                'KoHas' => 'code',
                'KoGet' => 'code',
            ],
            'property_ucFirst' => [
                'psrResponse' => new Response(200, [], '{"code": 0, "message": "Everything went well"}'),
                'okHas' => null,
                'okGet' => null,
                'KoHas' => 'hascode',
                'KoGet' => 'getcode',
            ],
            'lcFirst' => [
                'psrResponse' => new Response(200, [], '{"code": 0, "message": "Everything went well"}'),
                'okHas' => null,
                'okGet' => null,
                'KoHas' => 'HasCode',
                'KoGet' => 'Getcode',
            ],
            'noUpperCase' => [
                'psrResponse' => new Response(200, [], '{"code": 0, "message": "Everything went well"}'),
                'okHas' => null,
                'okGet' => null,
                'KoHas' => 'hasCODE',
                'KoGet' => 'getCODE',
            ],
            'notInTheMiddle' => [
                'psrResponse' => new Response(200, [], '{"code": 0, "message": "Everything went well"}'),
                'okHas' => null,
                'okGet' => null,
                'KoHas' => 'codeHasCode',
                'KoGet' => 'codeGetCode',
            ],
            'noYoda' => [
                'psrResponse' => new Response(200, [], '{"code": 0, "message": "Everything went well"}'),
                'okHas' => null,
                'okGet' => null,
                'KoHas' => 'codeHas',
                'KoGet' => 'codeGet',
            ],
            'noSuffix' => [
                'psrResponse' => new Response(200, [], '{"code": 0, "message": "Everything went well"}'),
                'okHas' => null,
                'okGet' => null,
                'KoHas' => 'hasCodefoo',
                'KoGet' => 'getCodefoo',
            ],

        ];
    }


}