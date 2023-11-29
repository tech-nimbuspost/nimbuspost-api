<?php


namespace Nimbuspackage\Nimbuspost\Traits;

use Nimbuspackage\Nimbuspost\ServerCall\Client;
use Nimbuspackage\Nimbuspost\Exceptions\NimbusException;

/**
* @author  Kishan taretiya
*/
trait Authenticate
{
    /**
     * check user credentials
     *
     * @param Client object , credentials array
     * @return object/array
     */
    public function auth(Client $client, $credentials = null)
    {

        if (! is_array($credentials)) {
            throw new NimbusException('Invalid Credentials');
        }

        $endpoint = 'users/login';

        $authDetails = $client->setEndpoint($endpoint)
            ->setHeaders('login')
            ->post($credentials);

        return (object) $authDetails;
    }
}
?>