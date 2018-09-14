<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 10/09/18
 * Time: 12:07
 */

namespace Combodo\ItopClientBundle\RestClient\RequestOperation\Core;

use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseFieldsTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseKeyTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationClassTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\OperationInterface;

class RequestOperationCoreUpdate implements OperationInterface
{
    use RequestOperationMetaExposedPropertiesTrait, RequestOperationBaseTrait, RequestOperationClassTrait, RequestOperationBaseKeyTrait, RequestOperationBaseFieldsTrait {
        RequestOperationBaseTrait::init as baseInit;
        RequestOperationClassTrait::init as classInit;
        RequestOperationBaseKeyTrait::init as KeyInit;
        RequestOperationBaseFieldsTrait::init as FieldsInit;
    }
    const OPERATION = 'core/update';

    public function init()
    {
        $this->baseInit();
        $this->classInit();
        $this->KeyInit();
        $this->FieldsInit();
    }

    public function __construct($key, string $sClass, string $sOutputFields, string $sComment, array $aFields)
    {
        $this->init();

        $this->setKey($key);

        $this->setClass($sClass);
        $this->setOutputFields($sOutputFields);

        $this->setFields($aFields);
        $this->setComment($sComment);
    }
}
