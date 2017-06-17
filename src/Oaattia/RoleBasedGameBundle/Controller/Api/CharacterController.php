<?php

namespace Oaattia\RoleBasedGameBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use Oaattia\RoleBasedGameBundle\Controller\ApiController;
use Oaattia\RoleBasedGameBundle\Entity\User;
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
        $credentials = $this->get('oaattia.role_based_game_authenticator.token.authenticator')->getCredentials(
            $request
        );
        $user = $this->get('lexik_jwt_authentication.encoder')->decode($credentials['token']);

        $user = $this->getDoctrine()->getRepository(User::class)->loadUserByUsername($user['username']);

        $character = $this->get('oaattia_role_based_game.requests.character_request')->handle(
            $request->get('title'),
            $request->get('attack'),
            $request->get('defense'),
            $user
        );

        $violations = $this->get('oaattia_role_based_game.validator.validation')->validate($character);

        if (!empty($violations)) {
            return $this->respondUnprocessedEntityError($violations);
        }

        $this->get('oaattia_role_based_game.domain_manager.character_manager')->createCharacter($character);

        return $this->respondCreated();
    }
}