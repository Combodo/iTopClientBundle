<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 10/09/18
 * Time: 12:07
 */

namespace Combodo\ItopClientBundle\RestClient\RequestOperation\Core;

use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseFieldsTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseKeyTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseRelationsTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationClassTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\OperationInterface;

class RequestOperationCoreGetRelated implements OperationInterface
{

    use RequestOperationMetaExposedPropertiesTrait, RequestOperationBaseTrait, RequestOperationClassTrait, RequestOperationBaseKeyTrait, RequestOperationBaseFieldsTrait, RequestOperationBaseRelationsTrait {
        RequestOperationBaseTrait::init as baseInit;
        RequestOperationClassTrait::init as classInit;
        RequestOperationBaseKeyTrait::init as KeyInit;
        RequestOperationBaseFieldsTrait::init as FieldsInit;
        RequestOperationBaseRelationsTrait::init as RelationsInit;
    }
    const OPERATION = 'core/get_related';

    public function init()
    {
        $this->baseInit();
        $this->classInit();
        $this->KeyInit();
        $this->FieldsInit();
        $this->RelationsInit();
    }

    public function __construct($key, string $sClass, string $sOutputFields, string $sRelation, int $iDepth, bool  $bRedundancy, string $sDirection, string $sComment, array $aFields)
    {
        $this->init();

        $this->setKey($key);

        $this->setClass($sClass);
        $this->setOutputFields($sOutputFields);

        $this->setFields($aFields);
        $this->setComment($sComment);

        $this->setRelation($sRelation);
        $this->setDepth($iDepth);
        $this->setRedundancy($bRedundancy);
        $this->setDirection($sDirection);
    }
}
