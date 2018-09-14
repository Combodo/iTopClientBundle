<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 10/09/18
 * Time: 12:07
 */

namespace Combodo\ItopClientBundle\RestClient\RequestOperation\Core;

use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseKeyTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationClassTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\OperationInterface;

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
