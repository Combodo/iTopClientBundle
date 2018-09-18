<?php

namespace Combodo\ItopClientBundle\RestClient;

use Combodo\ItopClientBundle\RestClient\RequestOperation\Meta\RequestOperationMetaExposedPropertiesTrait;
use Combodo\ItopClientBundle\RestClient\RequestOperation\OperationInterface;
use Combodo\ItopClientBundle\RestResponse\RestResponse;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

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
    /** @var array */
    private $extraHeaders;
    /** @var null|LoggerInterface */
    private $logger;

    /**
     * RestClient constructor.
     *
     * @param ClientInterface      $httpClient
     * @param string               $baseUrl
     * @param string               $auth_user
     * @param string               $auth_pwd
     * @param null|array           $extraHeaders
     * @param null|LoggerInterface $logger
     */
    public function __construct(ClientInterface $httpClient, string $baseUrl, string $auth_user, string $auth_pwd, ?array $extraHeaders = [], ?LoggerInterface $logger = null)
    {
        $this->httpClient = $httpClient;
        $this->baseUrl = $baseUrl;
        $this->auth_user = $auth_user;
        $this->auth_pwd = $auth_pwd;
        $this->extraHeaders = $extraHeaders;
        $this->logger = $logger;
    }

    public function executeOperation(OperationInterface $operation): RestResponse
    {
        $psrResponse = $this->getPsrResponseForOperation($operation);

        $restResponse = new RestResponse($psrResponse->getBody());

        return $restResponse;
    }


    /**
     * @param OperationInterface $operation
     *
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPsrResponseForOperation(OperationInterface $operation): Response
    {
        $psrRequest = $this->createRequestForOperation($operation);

        $response = $this->httpClient->send($psrRequest);

        if ($this->logger) {
            $this->log(
                LogLevel::DEBUG,
                'response obtained',
                [
                    'status code' => $response->getStatusCode(),
                    'status reason' => $response->getReasonPhrase(),
                    'headers' => $response->getHeaders(),
                    'body' => $response->getBody()->getContents(),

                ]
            );
        }

        if (200 != $response->getStatusCode()) {
            throw new RestClientException('remote Server Error: '. $response->getStatusCode().' '.$response->getReasonPhrase());
        }

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
        $requestUri = $this->getBaseUrl();

        $json_data = $operation->getJsonData();

        $requestHeaders = array_merge([
            'Content-Type' => 'application/x-www-form-urlencoded',
        ], $this->extraHeaders);

        $requestBody = http_build_query(
            [
                'auth_user' => $this->getAuthUser(),
                'auth_pwd'  => $this->getAuthPwd(),
                'version'   => $operation->getVersion(),
                'json_data' => $json_data,
            ],
            '',
            '&'
        );

        $psrRequest = new Request('POST', $requestUri, $requestHeaders, $requestBody);

        if ($this->logger) {
            $this->log(
                LogLevel::DEBUG,
                'request created',
                [
                    'uri'       => $requestUri,
                    'version'   => $operation->getVersion(),
                    'headers'   => $requestHeaders,
                    'raw_data' => $operation->getExposedProperties(),
                    //I prefer to be overcautious and to not use the body stored by the psrRequest in case of an additional escaping that would end in no password censorship...
                    'body_censored' => str_replace(http_build_query(['auth_pwd'  => $this->getAuthPwd()]), http_build_query(['auth_pwd'  => 'xxxxxx']), $requestBody),
                ]
            );
        }

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

    private function log($level, string $message, array $context = array())
    {
        if (!$this->logger) {
            return;
        }

        $message = 'Itop REST client: '.$message;

        return $this->logger->log($level, $message, $context);
    }
}
