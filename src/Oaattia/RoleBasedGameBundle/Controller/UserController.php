<?php

namespace Oaattia\RoleBasedGameBundle\Controller;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * @RouteResource("User")
 *
 * Class DefaultController
 * @package Oaattia\RoleBasedGameBundle\Controller
 */
class UserController
{
    public function postAction()
    {
        return [
            "done",
            Response::HTTP_CREATED
        ];
    }

    public function putAction($id)
    {
        return [
            "code" => Response::HTTP_OK,
            "message" => "updated {$id}",
        ];
    }

    public function getCommentAction($userId)
    {

    }

}
