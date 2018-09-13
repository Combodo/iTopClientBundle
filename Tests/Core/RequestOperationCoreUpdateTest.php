<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 12/09/18
 * Time: 17:34
 */

namespace BrunoDs\ItopClientBundle\Tests\Core;


use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreDelete;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreUpdate;
use PHPUnit\Framework\TestCase;

class RequestOperationCoreUpdateTest extends TestCase
{


    /**
     * @dataProvider defaultDataProvider
     */
    public function testGetter($key, string $class, string $outputFields, array $fields, string $comment)
    {

        $operation = new RequestOperationCoreUpdate($key, $class, $outputFields, $comment, $fields);


        $this->assertSame('core/update', $operation->getOperation());

        $this->assertSame($key, $operation->getKey());
        $this->assertSame($class, $operation->getClass());
        $this->assertSame($outputFields, $operation->getOutputFields());
        $this->assertSame($fields, $operation->getFields());
        $this->assertSame($comment, $operation->getComment());


        $this->assertArrayHasKey('key', $operation->getExposedProperties());
        $this->assertArrayHasKey('class', $operation->getExposedProperties());
        $this->assertArrayHasKey('output_fields', $operation->getExposedProperties());
        $this->assertArrayHasKey('fields', $operation->getExposedProperties());
        $this->assertArrayHasKey('comment', $operation->getExposedProperties());

        $this->assertArrayNotHasKey('foo', $operation->getExposedProperties());

        $this->assertSame($key, $operation->getExposedProperties()['key']);
        $this->assertSame($class, $operation->getExposedProperties()['class']);
        $this->assertSame($outputFields, $operation->getExposedProperties()['output_fields']);
        $this->assertSame($fields, $operation->getExposedProperties()['fields']);
        $this->assertSame($comment, $operation->getExposedProperties()['comment']);
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
            ],
            'realistic values' => [
                'key' => 2,
                'sClass' => self::class,
                'sOutputFields' => 'bar, baz, biz',
                'fields' => ['bar', 'baz', 'buzz'],
                'comment' => 'I like it',
            ],
            'null' => [
                'key' => null,
                'sClass' => '',
                'sOutputFields' => '',
                'fields' => [],
                'comment' => '',
            ],

        ];
    }

}