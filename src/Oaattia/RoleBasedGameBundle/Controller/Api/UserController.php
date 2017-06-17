<?php

namespace Oaattia\RoleBasedGameBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\View\View;

/**
 * @RouteResource("User")
 *
 * Class UserController
 * @package Oaattia\RoleBasedGameBundle\Controller
 */
class UserController
{
    public function getAction()
    {
        return new View("hello world");
    }

    public function getTestAction()
    {
        return new View("hello world");
    }

}
