<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 10/09/18
 * Time: 12:08
 */

namespace Combodo\ItopClientBundle\RestClient\RequestOperation\Core;

use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseFieldsTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseKeyTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationClassTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\OperationInterface;

class RequestOperationCoreCreate implements OperationInterface
{

    use RequestOperationMetaExposedPropertiesTrait, RequestOperationBaseTrait, RequestOperationClassTrait, RequestOperationBaseFieldsTrait {
        RequestOperationBaseTrait::init as baseInit;
        RequestOperationClassTrait::init as classInit;
        RequestOperationBaseFieldsTrait::init as fieldsInit;
    }

    const OPERATION = 'core/create';

    public function init()
    {
        $this->baseInit();
        $this->classInit();
        $this->fieldsInit();
    }

    public function __construct(string $sClass, string $sOutputFields, string $sComment, array $aFields)
    {
        $this->init();

        $this->setClass($sClass);
        $this->setOutputFields($sOutputFields);

        $this->setFields($aFields);
        $this->setComment($sComment);
    }
}
