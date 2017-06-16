<?php

namespace Oaattia\RoleBasedGameBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use Oaattia\RoleBasedGameBundle\Controller\ApiController;
use Oaattia\RoleBasedGameBundle\Requests\RegistrationRequest;
use Symfony\Component\HttpFoundation\Request;

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
        $user = $this->get('oaattia.role_based_game.registration_request')->handle($request);

        $violations = $this->get('oaattia_role_based_game.validator.validation')->handle($user);

        if (!empty($violations)) {
            return $this->respondUnprocessedEntityError($violations);
        }

        $this->get('oaattia.role_based_game.user_manager')->createUser($user);

        return $this->respondCreated(
            ['next' => "route after login let's say", 'prev' => 'current url if something happened']
        );
    }

}
