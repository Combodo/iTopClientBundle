<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 11/09/18
 * Time: 16:49
 */

namespace BrunoDs\ItopClientBundle\RestClient\RequestOperation;


interface OperationInterface
{
    /**
     * Version of the targeted iTop API
     * @return string
     */
    public function getVersion(): string ;

    /**
     * array of attributes of this operation
     * @return array
     */
    public function getExposedProperties(): array ;

    /**
     * array of attributes of this operation
     * @return array
     */
    public function getJsonData(): string ;
}