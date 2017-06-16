<?php

namespace Oaattia\RoleBasedGameBundle\Requests;

use Oaattia\RoleBasedGameBundle\Entity\EntityInterface;
use Oaattia\RoleBasedGameBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserRegistrationRequest implements RequestInterface
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserRegistrationRequest constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

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

        $user =  $user->setPlainPassword($request->get('password'));

        $user->setEmail($request->get('email'))
             ->setPassword($this->passwordEncoder->encodePassword($user, $user->getPlainPassword()));

        return $user;
    }


}