<?php

require_once __DIR__.'/../../../vendor/autoload.php';

use Combodo\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreGet;
use Combodo\ItopClientBundle\RestClient\RestClient;

$httpClient = new \GuzzleHttp\Client();
$baseUrl = 'http://localhost/itop/itop-github/webservices/rest.php';
$auth_user = 'api';
$auth_pwd = 'api';

$restClient = new RestClient($httpClient, $baseUrl, $auth_user, $auth_pwd, ['Cookie' => 'XDEBUG_SESSION=XDEBUG_ECLIPSE;']);


$operation = new RequestOperationCoreGet('SELECT UserRequest', 'UserRequest', 'ref, org_id');

$restResponse = $restClient->executeOperation($operation);





foreach($restResponse->search('objects|keys(@)') as $userRequestKey) {
    echo "\n - $userRequestKey => ". $restResponse->search('objects."'.$userRequestKey.'".fields.title');
}


//var_dump($restResponse->search('objects."UserRequest::101".fields.title'));