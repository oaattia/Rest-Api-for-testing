<?php

namespace Oaattia\RoleBasedGameBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use Oaattia\RoleBasedGameBundle\Controller\ApiController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @RouteResource("Character")
 *
 * Class UserController
 * @package Oaattia\RoleBasedGameBundle\Controller
 */
class CharacterController extends ApiController
{
    /**
     * Create a new character
     *
     * @param Request $request
     * @return \FOS\RestBundle\View\View|mixed
     */
    public function postAction(Request $request)
    {

    }
}
