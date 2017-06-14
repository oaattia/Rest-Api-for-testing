<?php

namespace Oaattia\RoleBasedGameBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testIfRespondTheRightFormat()
    {
        $this->client->request(
            'POST',
            '/api/user/register',
            ['email' => 'asdasd@asdasdasd.net', 'password' => 'asd']
        );



//        var_dump($this->client->getResponse()->getStatusCode());die();
        var_dump($this->client->getResponse());die();

    }
}
