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
    public function handleRequest(Request $request) : EntityInterface
    {
        if (is_null($request)) {
            throw new \HttpException("There is no request found");
        }

        return $this->setEntity([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(array $data) : EntityInterface
    {
        $user = new User();

        $user =  $user->setPlainPassword($data['password']);

        $user->setEmail($data['email'])
             ->setPassword($this->passwordEncoder->encodePassword($user, $user->getPlainPassword()));

        return $user;
    }


}