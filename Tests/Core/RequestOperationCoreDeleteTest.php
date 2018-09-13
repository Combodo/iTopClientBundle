<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 12/09/18
 * Time: 17:34
 */

namespace BrunoDs\ItopClientBundle\Tests\Core;


use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreApplyStimulus;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreDelete;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreGet;
use PHPUnit\Framework\TestCase;

class RequestOperationCoreDeleteTest extends TestCase
{


    /**
     * @dataProvider defaultDataProvider
     */
    public function testGetter($key, string $class, string $outputFields, array $fields, string $comment, bool $simulate)
    {

        $operation = new RequestOperationCoreDelete($key, $class, $outputFields, $simulate, $comment, $fields);


        $this->assertSame('core/delete', $operation->getOperation());

        $this->assertSame($key, $operation->getKey());
        $this->assertSame($class, $operation->getClass());
        $this->assertSame($outputFields, $operation->getOutputFields());
        $this->assertSame($fields, $operation->getFields());
        $this->assertSame($comment, $operation->getComment());
        $this->assertSame($simulate, $operation->getSimulate());


        $this->assertArrayHasKey('key', $operation->getExposedProperties());
        $this->assertArrayHasKey('class', $operation->getExposedProperties());
        $this->assertArrayHasKey('output_fields', $operation->getExposedProperties());
        $this->assertArrayHasKey('fields', $operation->getExposedProperties());
        $this->assertArrayHasKey('comment', $operation->getExposedProperties());
        $this->assertArrayHasKey('simulate', $operation->getExposedProperties());

        $this->assertArrayNotHasKey('foo', $operation->getExposedProperties());

        $this->assertSame($key, $operation->getExposedProperties()['key']);
        $this->assertSame($class, $operation->getExposedProperties()['class']);
        $this->assertSame($outputFields, $operation->getExposedProperties()['output_fields']);
        $this->assertSame($fields, $operation->getExposedProperties()['fields']);
        $this->assertSame($comment, $operation->getExposedProperties()['comment']);
        $this->assertSame($simulate, $operation->getExposedProperties()['simulate']);
    }

    public function defaultDataProvider(): array
    {
        return [
            'simple values' => [
                'key' => '1',
                'sClass' => '2',
                'sOutputFields' => '3',
                'fields' => ['4'],
                'comment' => '5',
                'simulate' => true,
            ],
            'realistic values' => [
                'key' => 2,
                'sClass' => self::class,
                'sOutputFields' => 'bar, baz, biz',
                'fields' => ['bar', 'baz', 'buzz'],
                'comment' => 'I like it',
                'simulate' => false,
            ],
            'null' => [
                'key' => null,
                'sClass' => '',
                'sOutputFields' => '',
                'fields' => [],
                'comment' => '',
                'simulate' => 1,
            ],

        ];
    }

}