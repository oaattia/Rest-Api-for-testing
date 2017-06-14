<?php

namespace Oaattia\RoleBasedGameBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use Oaattia\RoleBasedGameBundle\Controller\ApiController;
use Oaattia\RoleBasedGameBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

/**
 * @RouteResource(resource="User", pluralize=false)
 *
 * Class RegisterController
 * @package Oaattia\RoleBasedGameBundle\Controller
 */
class RegisterController extends ApiController
{
    public function postRegisterAction(Request $request)
    {
        // we should validate first the request we got

        $user = new User();
        $user->setEmail($request->get('email'))->setPassword($request->get('password'));
        $this->get('doctrine.orm.entity_manager')->persist($user);
        $this->get('doctrine.orm.entity_manager')->flush();

        return $this->respond([ 'username' => "Created User" ], [
            'link' => ''
        ]);
    }

}
