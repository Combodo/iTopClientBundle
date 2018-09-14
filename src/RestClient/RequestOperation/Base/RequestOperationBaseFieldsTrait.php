<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 11/09/18
 * Time: 10:28
 */

namespace Combodo\ItopClientBundle\RestClient\RequestOperation\Base;


use Combodo\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;


trait RequestOperationBaseFieldsTrait
{

    /** @var array */
    private $fields;

    /** @var string|array */
    private $comment;

    /**
     * @uses RequestOperationMetaExposedPropertiesTrait
     */
    private function init()
    {
        $this->appendExposedProperty('fields');
        $this->appendExposedProperty('comment');
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields): void
    {
        $this->fields = $fields;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }


}