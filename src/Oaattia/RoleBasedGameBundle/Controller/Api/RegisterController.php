<?php

namespace Oaattia\RoleBasedGameBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use Oaattia\RoleBasedGameBundle\Controller\ApiController;
use Oaattia\RoleBasedGameBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

/**
 * @RouteResource(resource="User", pluralize=false)
 *
 * Class RegisterController
 * @package Oaattia\RoleBasedGameBundle\Controller
 */
class RegisterController extends ApiController
{
    /**
     * Register a new user
     *
     * @param Request $request
     * @return json response
     */
    public function postRegisterAction(Request $request)
    {
        $user = new User();

        $user->setEmail($request->get('email'))
             ->setPassword($this->get('security.password_encoder')->encodePassword($user, $request->get('password')));

        $this->get('doctrine.orm.entity_manager')->persist($user);
        $this->get('doctrine.orm.entity_manager')->flush();

        return $this->respond(['username' => "Created User"], [
            'link' => '',
        ]);

    }

}
