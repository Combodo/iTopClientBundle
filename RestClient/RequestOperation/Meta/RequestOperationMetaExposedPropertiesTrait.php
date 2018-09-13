<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 11/09/18
 * Time: 10:28
 */

namespace BrunoDs\ItopClientBundle\RestClient\RequestOperation\Meta;


trait RequestOperationMetaExposedPropertiesTrait
{
    /** @var array */
    private $exposedPropertiesList = [];


    /**
     * @param array $exposedProperties
     */
    public function appendExposedProperty(string $exposedProperty): void
    {
        $this->exposedPropertiesList[$exposedProperty] = $exposedProperty;
    }

    /**
     * @return array
     */
    public function getExposedProperties(): array
    {
        $exposedPropertiesWithValues = [];
        foreach ($this->exposedPropertiesList as $propertyName)
        {
            $getter = 'get'.ucfirst($propertyName);
            $exposedPropertiesWithValues[$propertyName] = $this->$getter();
        }

        return $exposedPropertiesWithValues;
    }

    public function getJsonData(): string {
        return json_encode($this->getExposedProperties());
    }

}