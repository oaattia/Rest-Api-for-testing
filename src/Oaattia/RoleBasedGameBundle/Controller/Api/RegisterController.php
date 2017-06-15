<?php

namespace Oaattia\RoleBasedGameBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use Oaattia\RoleBasedGameBundle\Controller\ApiController;
use Oaattia\RoleBasedGameBundle\Entity\User;
use Oaattia\RoleBasedGameBundle\Requests\RegistrationRequest;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Length;

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

        // handleRequest Class here to validate the request
        // Zay ma laravel 3amla, Request class
        // validate User first

//        $this->get('oaattia.role_based_game.registration_request')->handle($user);

        $this->get('oaattia.role_based_game.user_manager')->createUser($user, $request);

        return $this->respondCreated(['next' => "route after login let's say", 'prev' => 'current url if something happened']);
    }

}
