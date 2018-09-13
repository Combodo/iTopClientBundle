<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 12/09/18
 * Time: 17:34
 */

namespace BrunoDs\ItopClientBundle\Tests\Core;


use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreGet;
use PHPUnit\Framework\TestCase;

class RequestOperationCoreGetTest extends TestCase
{


    /**
     * @dataProvider defaultDataProvider
     */
    public function testGetter($key, string $sClass, string $sOutputFields)
    {

        $operation = new RequestOperationCoreGet($key, $sClass, $sOutputFields);


        $this->assertSame('core/get', $operation->getOperation());

        $this->assertSame($key, $operation->getKey());
        $this->assertSame($sClass, $operation->getClass());
        $this->assertSame($sOutputFields, $operation->getOutputFields());


        $this->assertArrayHasKey('key', $operation->getExposedProperties());
        $this->assertArrayHasKey('class', $operation->getExposedProperties());
        $this->assertArrayHasKey('outputFields', $operation->getExposedProperties());

        $this->assertArrayNotHasKey('foo', $operation->getExposedProperties());

        $this->assertSame($key, $operation->getExposedProperties()['key']);
        $this->assertSame($sClass, $operation->getExposedProperties()['class']);
        $this->assertSame($sOutputFields, $operation->getExposedProperties()['outputFields']);
    }

    public function defaultDataProvider(): array
    {
        return [
            'simple values' => [
                'key' => '1',
                'sClass' => '2',
                'sOutputFields' => '3',
            ],
            'realistic values' => [
                'key' => 2,
                'sClass' => self::class,
                'sOutputFields' => 'bar, baz, biz',
            ],
            'null' => [
                'key' => null,
                'sClass' => '',
                'sOutputFields' => '',
            ],

        ];
    }

}