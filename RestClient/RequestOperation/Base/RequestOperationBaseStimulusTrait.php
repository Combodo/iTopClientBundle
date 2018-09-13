<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 11/09/18
 * Time: 10:28
 */

namespace Combodo\ItopClientBundle\RestClient\RequestOperation\Base;


use Combodo\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;


trait RequestOperationBaseStimulusTrait
{

    /** @var string */
    private $stimulus;

    /**
     * @uses RequestOperationMetaExposedPropertiesTrait
     */
    private function init()
    {
        $this->appendExposedProperty('stimulus');
    }


    /**
     * @return string
     */
    public function getStimulus(): string
    {
        return $this->stimulus;
    }

    /**
     * @param string $stimulus
     */
    public function setStimulus(string $stimulus): void
    {
        $this->stimulus = $stimulus;
    }


}