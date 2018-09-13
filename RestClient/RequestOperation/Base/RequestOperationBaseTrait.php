<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 10/09/18
 * Time: 12:07
 */
namespace BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base;

use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;


trait RequestOperationBaseTrait
{
    use RequestOperationMetaExposedPropertiesTrait;

    /** @var string */
    private $version = '1.3';

    /** @var string */
    private $operation;

    /** @var string */
    private $class;

    /** @var string */
    private $outputFields;

    /**
     * @uses RequestOperationMetaExposedPropertiesTrait
     */
    private function init()
    {
        $this->appendExposedProperty('operation');
        $this->appendExposedProperty('class');
        $this->appendExposedProperty('outputFields');


        $this->setOperation(static::OPERATION);
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * @param string $operation
     */
    public function setOperation(string $operation): void
    {
        $this->operation = $operation;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function getOutputFields(): string
    {
        return $this->outputFields;
    }

    /**
     * @param string $outputFields
     */
    public function setOutputFields(string $outputFields): void
    {
        $this->outputFields = $outputFields;
    }
}