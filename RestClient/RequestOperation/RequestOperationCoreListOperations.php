<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 10/09/18
 * Time: 12:07
 */

namespace BrunoDs\ItopClientBundle\RestClient\RequestOperation;


use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseTrait;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationClassTrait;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\OperationInterface;

class RequestOperationCoreListOperations implements OperationInterface
{
    use RequestOperationMetaExposedPropertiesTrait, RequestOperationBaseTrait;

    const OPERATION = 'list_operations';

    public function __construct()
    {
        $this->init();
    }


}