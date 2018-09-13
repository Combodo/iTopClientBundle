<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 11/09/18
 * Time: 10:28
 */

namespace Combodo\ItopClientBundle\RestClient\RequestOperation\Base;


use Combodo\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;


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