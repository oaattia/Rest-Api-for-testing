<?php

namespace Oaattia\RoleBasedGameBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @RouteResource(resource="User", pluralize=false)
 *
 * Class RegisterController
 * @package Oaattia\RoleBasedGameBundle\Controller
 */
class RegisterController extends Controller
{
    public function postRegisterAction(Request $request)
    {
        $errors =  $this->get('validator')->validate($request->get('username'), [
            new Email(),
            new Length(['min' => 10])
        ]);
        return [
            $errors[0]->getMessage(),
            $request->get('username') ?? "nothing",
            $request->get('password') ?? "nothing"
        ];
    }
}
