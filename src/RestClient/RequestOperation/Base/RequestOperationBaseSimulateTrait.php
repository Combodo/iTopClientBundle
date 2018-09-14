<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 11/09/18
 * Time: 10:28
 */

namespace Combodo\ItopClientBundle\RestClient\RequestOperation\Base;

use Combodo\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;

trait RequestOperationBaseSimulateTrait
{

    /** @var boolean */
    private $simulate;

    /**
     * @uses RequestOperationMetaExposedPropertiesTrait
     */
    private function init()
    {
        $this->appendExposedProperty('simulate');
    }

    /**
     * @return bool
     */
    public function getSimulate(): bool
    {
        return $this->simulate;
    }

    /**
     * @param bool $simulate
     */
    public function setSimulate(bool $simulate): void
    {
        $this->simulate = $simulate;
    }
}
