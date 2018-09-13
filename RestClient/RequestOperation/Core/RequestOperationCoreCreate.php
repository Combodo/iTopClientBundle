<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 10/09/18
 * Time: 12:08
 */

namespace BrunoDs\ItopClientBundle\RestClient\RequestOperation\Core;


use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseFieldsTrait;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseKeyTrait;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base\RequestOperationBaseTrait;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\OperationInterface;

class RequestOperationCoreCreate implements OperationInterface
{

    use RequestOperationBaseTrait, RequestOperationBaseFieldsTrait {
        RequestOperationBaseTrait::init as baseInit;
        RequestOperationBaseFieldsTrait::init as fieldsInit;
    }

    const OPERATION = 'core/create';

    public function init()
    {
        $this->baseInit();
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