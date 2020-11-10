# iTopClientBundle
iTop rest client bundle for symfony

This bundle help you consume iTop rest webservices


Installation
============

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require combodo/itop-client-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: configure itop serveur 
```yaml
# app/config/config.yml
combodo_itop_client:
    servers:
        itop_server_foo:
            base_url:  "%it_combodo.base_url%"
            auth_user: "%it_combodo.auth_user%"
            auth_pwd:  "%it_combodo.auth_pwd%"
            extra_headers: "%it_combodo.extra_headers%"
```

This bundle will create a service named `itop_client.rest_client.itop_server_foo` that you can then uses in your code.


### Step 3: Start using it

each operation follow the structure available in otop documentation:
follow this struc: https://www.itophub.io/wiki/page?id=latest%3Aadvancedtopics%3Arest_json#operationcore_create


you can use the service container or uses service injection by adding a `Combodo\ItopClientBundle\RestClient\RestClient $foo` in your service constructor.
```php
use Combodo\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreCreate;
use Combodo\ItopClientBundle\RestClient\RestClient;

class Foo
{
    /**
     * @var RestClient
     */
    private $client;
    public function __construct(RestClient $client) 
    {    
        $this->client = $client;
    }

    public function bar()
    {
        $operation = new RequestOperationCoreCreate(
            'Class',
            'id',
            'my comment',
            [
                'title'             => 'foo',
                'description'       => 'bar',
                'caller_email'      => 'boris.vian@example.com',
            ]
        );
        
        $this->client->executeOperation($operation);
    }    
}
```
