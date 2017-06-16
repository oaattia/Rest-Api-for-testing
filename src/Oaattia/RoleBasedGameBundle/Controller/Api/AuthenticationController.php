<?php

namespace Oaattia\RoleBasedGameBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use Oaattia\RoleBasedGameBundle\Controller\ApiController;
use Oaattia\RoleBasedGameBundle\Requests\RegistrationRequest;
use Symfony\Component\HttpFoundation\Request;

/**
 * @RouteResource(resource="User", pluralize=false)
 *
 * Class AuthenticationController
 * @package Oaattia\RoleBasedGameBundle\Controller
 */
class AuthenticationController extends ApiController
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
            [
                'next' =>  $this->generateUrl('oaattia.role_based_game.post_user_login'),
                'prev' => $this->generateUrl($request->get('_route'))
            ]
        );
    }


    /**
     * Login user and generate JWT token
     *
     * @param Request $request
     */
    public function postLoginAction(Request $request)
    {
        $user = $this->get('oaattia.role_based_game.registration_request')->handle($request);


    }


}
