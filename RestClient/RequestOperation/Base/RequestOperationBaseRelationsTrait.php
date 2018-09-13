<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 11/09/18
 * Time: 10:28
 */

namespace Combodo\ItopClientBundle\RestClient\RequestOperation\Base;


use Combodo\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;


trait RequestOperationBaseRelationsTrait
{

    /** @var string */
    private $relation;

    /** @var int */
    private $depth;

    /** @var boolean */
    private $redundancy;

    /** @var string */
    private $direction;


    /**
     * @uses RequestOperationMetaExposedPropertiesTrait
     */
    private function init()
    {
        $this->appendExposedProperty('relation');
        $this->appendExposedProperty('depth');
        $this->appendExposedProperty('redundancy');
        $this->appendExposedProperty('direction');
    }

    /**
     * @return string
     */
    public function getRelation(): string
    {
        return $this->relation;
    }

    /**
     * @param string $relation
     */
    public function setRelation(string $relation): void
    {
        $this->relation = $relation;
    }

    /**
     * @return int
     */
    public function getDepth(): int
    {
        return $this->depth;
    }

    /**
     * @param int $depth
     */
    public function setDepth(int $depth): void
    {
        $this->depth = $depth;
    }

    /**
     * @return bool
     */
    public function getRedundancy(): bool
    {
        return $this->redundancy;
    }

    /**
     * @param bool $redundancy
     */
    public function setRedundancy(bool $redundancy): void
    {
        $this->redundancy = $redundancy;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @param string $direction
     */
    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }


}