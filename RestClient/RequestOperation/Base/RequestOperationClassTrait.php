<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 10/09/18
 * Time: 12:07
 */
namespace BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base;

use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;


trait RequestOperationClassTrait
{

    /** @var string */
    private $class;

    /** @var string */
    private $outputFields;

    /**
     * @uses RequestOperationMetaExposedPropertiesTrait
     */
    private function init()
    {
        $this->appendExposedProperty('class');
        $this->appendExposedProperty('outputFields');
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