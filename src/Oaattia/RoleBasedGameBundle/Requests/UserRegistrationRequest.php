<?php

namespace Oaattia\RoleBasedGameBundle\Requests;

use Oaattia\RoleBasedGameBundle\Entity\EntityInterface;
use Oaattia\RoleBasedGameBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class UserRegistrationRequest implements RequestInterface
{

    /**
     * @inheritdoc
     */
    public function handle(Request $request) : EntityInterface
    {
        if (is_null($request)) {
            throw new \HttpRequestException("There is no request found");
        }

        return $this->getEntity($request);
    }

    /**
     * @inheritdoc
     */
    public function getEntity(Request $request) : EntityInterface
    {
        $user = new User();

        $user->setEmail($request->get('email'))
            ->setPassword($request->get('password'));

        return $user;
    }


}