<?php

namespace BrunoDs\ItopClientBundle\RestClient;


use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\OperationInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;


/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 10/09/18
 * Time: 11:52
 */

class RestClient
{
    use RequestOperationMetaExposedPropertiesTrait;
    /**
     * @var ClientInterface
     */
    private $httpClient;
    /**  @var string */
    private $baseUrl;
    /** @var string */
    private $auth_user;
    /**  @var string */
    private $auth_pwd;


    public function __construct(ClientInterface $httpClient, string $baseUrl, string $auth_user, string $auth_pwd)
    {
        $this->httpClient = $httpClient;
        $this->baseUrl = $baseUrl;
        $this->auth_user = $auth_user;
        $this->auth_pwd = $auth_pwd;
    }

    public function executeOperation(OperationInterface $operation): RestResponse
    {
        $psrResponse = $this->getResponseForOperation($operation);

        $restResponse = new RestResponse($psrResponse);

        return $restResponse;
    }


    /**
     * @param OperationInterface $operation
     *
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getResponseForOperation(OperationInterface $operation): Response
    {
        $psrRequest = $this->createRequestForOperation($operation);

        $response = $this->httpClient->send($psrRequest);

        return $response;
    }



    /**
     * @param OperationInterface $operation
     *
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createRequestForOperation(OperationInterface $operation): Request
    {
        $requestUri = $this->getBaseUrl().'?'.$operation->getVersion();

        $json_data = $operation->getExposedProperties();

        $requestBody = http_build_query(
            [
                'auth_user' => $this->getAuthUser(),
                'auth_pwd'  => $this->getAuthPwd(),
                'json_data' => $json_data,
            ],
            '',
            '&'
        );

        $psrRequest = new Request('POST', $requestUri, [], $requestBody);


        return $psrRequest;
    }



    /**
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }


    /**
     * @return string
     */
    private function getAuthUser(): string
    {
        return $this->auth_user;
    }

    /**
     * @return string
     */
    private function getAuthPwd(): string
    {
        return $this->auth_pwd;
    }


}