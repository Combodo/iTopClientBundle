<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 11/09/18
 * Time: 16:58
 */

namespace BrunoDs\ItopClientBundle\RestClient;


use GuzzleHttp\Psr7\Response;

class RestResponse
{
    /** @var \stdClass  */
    private $oResponse;

    public function __construct(Response $psrResponse)
    {
        $this->oResponse = json_decode($psrResponse->getBody());

        if (! $this->oResponse instanceof \stdClass) {
            $jsonDecodeError = json_last_error_msg();
            throw new RestResponseException('Invalid server response, json_decode error: '.$jsonDecodeError);
        }

        if ($this->getCode() != 0) {
            throw new RestResponseException($this->getMessage(), $this->getCode());
        }
    }

    private function isUcFirst(string $propertyCode)
    {
        $propertyCodeLCF = lcfirst($propertyCode);

        return ($propertyCode != $propertyCodeLCF);
    }

    public function __call($name, $arguments)
    {
        $ThreeFirstLettersOfName = substr($name, 0, 3);

        if ('has' == $ThreeFirstLettersOfName && count($arguments) == 0) {
            $propertyCode = substr($name, 3);
            if ($this->isUcFirst($propertyCode)) {
                return $this->has(lcfirst($propertyCode));
            }
        }
        if ('get' == $ThreeFirstLettersOfName && count($arguments) == 0) {
            $propertyCode = substr($name, 3);
            if ($this->isUcFirst($propertyCode)) {
                return $this->get(lcfirst($propertyCode));
            }
        }

        throw new RestResponseException("invalid method \"$name\" with params ".json_encode($arguments));
    }

    private function has($name)
    {
        return isset($this->oResponse->$name);
    }

    private function get($name)
    {
        if (!isset($this->oResponse->$name)) {
            throw new RestResponseException("invalid key \"$name\"");
        }

        return $this->oResponse->$name;
    }

    public function asJson(int $options = 0, int $depth = 512)
    {
        return json_encode($options, $depth);
    }
}