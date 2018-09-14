<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 10/09/18
 * Time: 12:07
 */

namespace Combodo\ItopClientBundle\RestClient\RequestOperation\Core;


use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseFieldsTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseKeyTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseSimulateTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationClassTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\OperationInterface;

class RequestOperationCoreDelete implements OperationInterface
{
    use RequestOperationMetaExposedPropertiesTrait, RequestOperationBaseTrait, RequestOperationClassTrait, RequestOperationBaseKeyTrait, RequestOperationBaseFieldsTrait, RequestOperationBaseSimulateTrait {
        RequestOperationBaseTrait::init as baseInit;
        RequestOperationClassTrait::init as classInit;
        RequestOperationBaseKeyTrait::init as KeyInit;
        RequestOperationBaseFieldsTrait::init as FieldsInit;
        RequestOperationBaseSimulateTrait::init as SimulateInit;
    }

    const OPERATION = 'core/delete';

    public function init()
    {
        $this->baseInit();
        $this->classInit();
        $this->KeyInit();
        $this->FieldsInit();
        $this->SimulateInit();
    }

    public function __construct($key, string $sClass, string $sOutputFields, bool $bSimulate, string $sComment, array $aFields)
    {
        $this->init();

        $this->setKey($key);

        $this->setClass($sClass);
        $this->setOutputFields($sOutputFields);

        $this->setFields($aFields);
        $this->setComment($sComment);

        $this->setSimulate($bSimulate);
    }
}