<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 11/09/18
 * Time: 16:58
 */

namespace BrunoDs\ItopClientBundle\RestResponse;


use BrunoDs\ItopClientBundle\JmesPath\JmesPath;
use BrunoDs\ItopClientBundle\JmesPath\JmesPathInterface;
use BrunoDs\ItopClientBundle\RestResponse\RestResponseException;
use GuzzleHttp\Psr7\Response;
use JmesPath\Env;

class RestResponse
{
    /** @var \stdClass  */
    private $oResponse;
    /** @var Env */
    private $jmesPath;

    public function __construct(Response $psrResponse, ?JmesPathInterface $jmesPath = null)
    {
        $this->oResponse = json_decode($psrResponse->getBody(), true);

//        if (! $this->oResponse instanceof \stdClass) {
//            $jsonDecodeError = json_last_error_msg();
//            throw new RestResponseException('Invalid server response, json_decode error: '.$jsonDecodeError);
//        }

        if (false == is_array($this->oResponse)) {
            $jsonDecodeError = json_last_error_msg();
            throw new RestResponseException('Invalid server response, json_decode error: '.$jsonDecodeError);
        }
        if (count($this->oResponse) == 0) {
            throw new RestResponseException('Empty json in server response');
        }

        if ($this->getCode() != 0) {
            throw new RestResponseException($this->getMessage(), $this->getCode());
        }

        $this->jmesPath = $jmesPath ?? new JmesPath();

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
        return isset($this->oResponse[$name]);
    }

    private function get($name)
    {
        if (!isset($this->oResponse[$name])) {
            throw new RestResponseException("invalid key \"$name\"");
        }

        return $this->oResponse[$name];
    }

    public function asArray()
    {
        return $this->oResponse;
    }

    public function asJson(int $options = JSON_PRETTY_PRINT | JSON_OBJECT_AS_ARRAY, int $depth = 512)
    {
        return json_encode($this->oResponse, $options, $depth);
    }

    public function search(string $expression)
    {
        return $this->jmesPath->search($expression, $this->oResponse);
    }

    public function searchOne(string $expression)
    {
        $result = $this->search($expression);
        if (is_array($result) && array_key_exists(0, $result)) {
            return $result[0];
        }

        throw new RestResponseException('Failed fetching exactly one row');
    }
}