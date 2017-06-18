<?php

namespace Oaattia\RoleBasedGameBundle\Controller\Api;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\View\View;
use Oaattia\RoleBasedGameBundle\Controller\ApiController;
use Oaattia\RoleBasedGameBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

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

        return $this->respondCreated(
            [
                'character' => [
                    'title' => $user->getCharacter()->getTitle(),
                    'attack' => $user->getCharacter()->getAttack(),
                    'defense' => $user->getCharacter()->getDefense(),
                ],
            ]
        );
    }


    public function patchCharacterAttackAction()
    {
        // the current user and the score you want to attack
        // there is default number to attack and it's 5 points
    }


    /**
     * Then method responsible for the user how want to explore
     * and see if there is any character want to fight
     * @param Request $request
     * @return View|mixed
     */
    public function getExploreAction(Request $request)
    {
        $extracted = $this->get('oaattia.role_based_game_authenticator.token.authenticator')->getCredentials($request);
        $data = $this->get('oaattia_role_based_game.security.token_encoder_decoder')->decode($extracted['token']);

        // the user should here get list of the all characters that have status ready
        $users = $this->getDoctrine()->getRepository(User::class)->findOtherReadyUsers($data['id']);

        if (empty($users)) {
            return $this->respondNotFound("There is no users ready for fighting");
        }


        return $this->respondOK([
            'users' => $this->get('oaattia_role_based_game.transformers.user_transformer')->transform($users)
        ]);
    }

}
