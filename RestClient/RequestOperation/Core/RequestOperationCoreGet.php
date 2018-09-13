<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 10/09/18
 * Time: 12:07
 */

namespace BrunoDs\ItopClientBundle\RestClient\RequestOperation\Core;


use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseKeyTrait;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseTrait;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationClassTrait;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\OperationInterface;

class RequestOperationCoreGet implements OperationInterface
{
    use RequestOperationMetaExposedPropertiesTrait, RequestOperationBaseTrait, RequestOperationClassTrait, RequestOperationBaseKeyTrait {
        RequestOperationBaseTrait::init as baseInit;
        RequestOperationClassTrait::init as classInit;
        RequestOperationBaseKeyTrait::init as KeyInit;
    }

    const OPERATION = 'core/get';

    public function init()
    {
        $this->baseInit();
        $this->classInit();
        $this->KeyInit();
    }

    public function __construct($key, string $sClass, string $sOutputFields)
    {
        $this->init();

        $this->setKey($key);

        $this->setClass($sClass);
        $this->setOutputFields($sOutputFields);

    }


}