<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 12/09/18
 * Time: 17:34
 */

namespace Combodo\ItopClientBundle\Tests\Core;


use Combodo\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreApplyStimulus;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreCreate;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreGet;
use PHPUnit\Framework\TestCase;

class RequestOperationCoreCreateTest extends TestCase
{


    /**
     * @dataProvider defaultDataProvider
     */
    public function testGetter( string $class, string $outputFields, array $fields, string $comment)
    {

        $operation = new RequestOperationCoreCreate($class, $outputFields, $comment, $fields);


        $this->assertSame('core/create', $operation->getOperation());

        $this->assertSame($class, $operation->getClass());
        $this->assertSame($outputFields, $operation->getOutputFields());
        $this->assertSame($fields, $operation->getFields());
        $this->assertSame($comment, $operation->getComment());


        $this->assertArrayHasKey('class', $operation->getExposedProperties());
        $this->assertArrayHasKey('output_fields', $operation->getExposedProperties());
        $this->assertArrayHasKey('fields', $operation->getExposedProperties());
        $this->assertArrayHasKey('comment', $operation->getExposedProperties());

        $this->assertArrayNotHasKey('foo', $operation->getExposedProperties());

        $this->assertSame($class, $operation->getExposedProperties()['class']);
        $this->assertSame($outputFields, $operation->getExposedProperties()['output_fields']);
        $this->assertSame($fields, $operation->getExposedProperties()['fields']);
        $this->assertSame($comment, $operation->getExposedProperties()['comment']);
    }

    public function defaultDataProvider(): array
    {
        return [
            'simple values' => [
                'sClass' => '2',
                'sOutputFields' => '3',
                'fields' => ['4'],
                'comment' => '5',
            ],
            'realistic values' => [
                'sClass' => self::class,
                'sOutputFields' => 'bar, baz, biz',
                'fields' => ['bar', 'baz', 'buzz'],
                'comment' => 'I like it',
            ],
            'null' => [
                'sClass' => '',
                'sOutputFields' => '',
                'fields' => [],
                'comment' => '',
            ],

        ];
    }

}