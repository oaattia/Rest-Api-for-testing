<?php

namespace Oaattia\RoleBasedGameBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\View\View;
use Oaattia\RoleBasedGameBundle\Controller\ApiController;
use Oaattia\RoleBasedGameBundle\Entity\User;

/**
 * @RouteResource("User")
 *
 * Class UserController
 * @package Oaattia\RoleBasedGameBundle\Controller
 */
class UserController extends ApiController
{
    /**
     * view the user character ( only the user can have one character )
     *
     * @param $userId
     *
     * @return View (JSON Response)
     */
    public function getCharacterAction($userId)
    {
        // let's get the user id character
        $user = $this->getDoctrine()->getRepository(User::class)->findOneById($userId);

        if (!$user) {
            return $this->respondNotFound("There is no user for the specified ID");
        }

        if (is_null($user->getCharacter())) {
            return $this->respondNotFound("Character not found for this user");
        }

        return $this->respondCreated(['character' => [
            'title' => $user->getCharacter()->getTitle(),
            'attack' => $user->getCharacter()->getAttack(),
            'defense' => $user->getCharacter()->getDefense(),
        ]]);
    }



}
