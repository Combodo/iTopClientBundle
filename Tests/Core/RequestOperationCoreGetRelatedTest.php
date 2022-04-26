<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 12/09/18
 * Time: 17:34
 */

namespace Combodo\ItopClientBundle\Tests\Core;


use Combodo\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreApplyStimulus;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreGet;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreGetRelated;
use PHPUnit\Framework\TestCase;

class RequestOperationCoreGetRelatedTest extends TestCase
{


    /**
     * @dataProvider defaultDataProvider
     */
    public function testGetter($key, $class, $outputFields, $fields, $comment, string $relation, int $depth, bool  $redundancy, string $direction)
    {

        $operation = new RequestOperationCoreGetRelated($key, $class, $outputFields, $relation, $depth, $redundancy, $direction, $comment, $fields);


        $this->assertSame('core/get_related', $operation->getOperation());

        $this->assertSame($key, $operation->getKey());
        $this->assertSame($class, $operation->getClass());
        $this->assertSame($outputFields, $operation->getOutputFields());
        $this->assertSame($fields, $operation->getFields());
        $this->assertSame($comment, $operation->getComment());
        $this->assertSame($relation, $operation->getRelation());
        $this->assertSame($depth, $operation->getDepth());
        $this->assertSame($redundancy, $operation->getRedundancy());
        $this->assertSame($direction, $operation->getDirection());


        $this->assertArrayHasKey('key', $operation->getExposedProperties());
        $this->assertArrayHasKey('class', $operation->getExposedProperties());
        $this->assertArrayHasKey('output_fields', $operation->getExposedProperties());
        $this->assertArrayHasKey('fields', $operation->getExposedProperties());
        $this->assertArrayHasKey('comment', $operation->getExposedProperties());
        $this->assertArrayHasKey('relation', $operation->getExposedProperties());
        $this->assertArrayHasKey('depth', $operation->getExposedProperties());
        $this->assertArrayHasKey('redundancy', $operation->getExposedProperties());
        $this->assertArrayHasKey('direction', $operation->getExposedProperties());
        
        $this->assertArrayNotHasKey('foo', $operation->getExposedProperties());

        $this->assertSame($key, $operation->getExposedProperties()['key']);
        $this->assertSame($class, $operation->getExposedProperties()['class']);
        $this->assertSame($outputFields, $operation->getExposedProperties()['output_fields']);
        $this->assertSame($fields, $operation->getExposedProperties()['fields']);
        $this->assertSame($comment, $operation->getExposedProperties()['comment']);
        $this->assertSame($relation, $operation->getExposedProperties()['relation']);
        $this->assertSame($depth, $operation->getExposedProperties()['depth']);
        $this->assertSame($redundancy, $operation->getExposedProperties()['redundancy']);
        $this->assertSame($direction, $operation->getExposedProperties()['direction']);
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
                'relation' => '6',
                'depth' => 7,
                'redundancy' => true,
                'direction' => '9',
            ],
            'realistic values' => [
                'key' => 2,
                'sClass' => self::class,
                'sOutputFields' => 'bar, baz, biz',
                'fields' => ['bar', 'baz', 'buzz'],
                'comment' => 'I like it',
                'relation' => 'impacts',
                'depth' => 4,
                'redundancy' => true,
                'direction' => 'down',
            ],
            'null' => [
                'key' => null,
                'sClass' => '',
                'sOutputFields' => '',
                'fields' => [],
                'comment' => '',
                'relation' => '',
                'depth' => 0,
                'redundancy' => false,
                'direction' => '',
            ],

        ];
    }

}