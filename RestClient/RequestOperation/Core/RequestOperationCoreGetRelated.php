<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 10/09/18
 * Time: 12:07
 */

namespace BrunoDs\ItopClientBundle\RestClient\RequestOperation\Core;


use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseFieldsTrait;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseKeyTrait;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseRelationsTrait;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseTrait;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\OperationInterface;

class RequestOperationCoreGetRelated implements OperationInterface
{

    use RequestOperationBaseTrait, RequestOperationBaseKeyTrait, RequestOperationBaseFieldsTrait, RequestOperationBaseRelationsTrait {
        RequestOperationBaseTrait::init as baseInit;
        RequestOperationBaseKeyTrait::init as KeyInit;
        RequestOperationBaseFieldsTrait::init as FieldsInit;
        RequestOperationBaseRelationsTrait::init as RelationsInit;
    }
    const OPERATION = 'core/get_related';

    public function init()
    {
        $this->baseInit();
        $this->KeyInit();
        $this->FieldsInit();
        $this->RelationsInit();
    }

    public function __construct($key, string $sClass, string $sOutputFields, array $aFields, string $sComment, string $sRelation, int $iDepth, bool  $bRedundancy, string $sDirection)
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