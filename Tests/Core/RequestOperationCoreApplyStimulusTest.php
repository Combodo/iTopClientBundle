<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 12/09/18
 * Time: 17:34
 */

namespace BrunoDs\ItopClientBundle\Tests\Core;


use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreApplyStimulus;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreGet;
use PHPUnit\Framework\TestCase;

class RequestOperationCoreApplyStimulusTest extends TestCase
{


    /**
     * @dataProvider defaultDataProvider
     */
    public function testGetter($key, string $class, string $outputFields, array $fields, string $comment, string $stimulus)
    {

        $operation = new RequestOperationCoreApplyStimulus($key, $class, $outputFields, $fields, $comment, $stimulus);


        $this->assertSame('core/apply_stimulus', $operation->getOperation());

        $this->assertSame($key, $operation->getKey());
        $this->assertSame($class, $operation->getClass());
        $this->assertSame($outputFields, $operation->getOutputFields());
        $this->assertSame($fields, $operation->getFields());
        $this->assertSame($comment, $operation->getComment());
        $this->assertSame($stimulus, $operation->getStimulus());


        $this->assertArrayHasKey('key', $operation->getExposedProperties());
        $this->assertArrayHasKey('class', $operation->getExposedProperties());
        $this->assertArrayHasKey('outputFields', $operation->getExposedProperties());
        $this->assertArrayHasKey('fields', $operation->getExposedProperties());
        $this->assertArrayHasKey('comment', $operation->getExposedProperties());
        $this->assertArrayHasKey('stimulus', $operation->getExposedProperties());
        
        $this->assertArrayNotHasKey('foo', $operation->getExposedProperties());

        $this->assertSame($key, $operation->getExposedProperties()['key']);
        $this->assertSame($class, $operation->getExposedProperties()['class']);
        $this->assertSame($outputFields, $operation->getExposedProperties()['outputFields']);
        $this->assertSame($fields, $operation->getExposedProperties()['fields']);
        $this->assertSame($comment, $operation->getExposedProperties()['comment']);
        $this->assertSame($stimulus, $operation->getExposedProperties()['stimulus']);
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
                'stimulus' => '6',
            ],
            'realistic values' => [
                'key' => 2,
                'sClass' => self::class,
                'sOutputFields' => 'bar, baz, biz',
                'fields' => ['bar', 'baz', 'buzz'],
                'comment' => 'I like it',
                'stimulus' => 'close',
            ],
            'null' => [
                'key' => null,
                'sClass' => '',
                'sOutputFields' => '',
                'fields' => [],
                'comment' => '',
                'stimulus' => '',
            ],

        ];
    }

}