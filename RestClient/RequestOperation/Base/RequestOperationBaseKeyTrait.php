<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 11/09/18
 * Time: 10:28
 */

namespace BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base;


use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;


trait RequestOperationBaseKeyTrait
{

    /** @var array|string|int */
    private $key;

    /**
     * @uses RequestOperationMetaExposedPropertiesTrait
     */
    private function init()
    {
        $this->appendExposedProperty('key');
    }

    /**
     * @return array|string|int
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param array|string|int $key
     */
    public function setKey($key): void
    {
        $this->key = $key;
    }
}