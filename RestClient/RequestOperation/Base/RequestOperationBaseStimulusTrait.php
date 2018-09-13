<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 11/09/18
 * Time: 10:28
 */

namespace BrunoDs\ItopClientBundle\RestClient\RequestOperation\Base;


use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;


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