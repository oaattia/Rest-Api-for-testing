<?php


namespace Oaattia\RoleBasedGameBundle\DomainManager;


use Doctrine\ORM\EntityManagerInterface;
use Oaattia\RoleBasedGameBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var PasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserManager constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoder $passwordEncoder
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoder $passwordEncoder
    )
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Create new user with email and password
     *
     * @param User $user
     * @param Request $request
     */
    public function createUser(User $user, Request $request)
    {
        $user->setEmail($request->get('email'))
             ->setPassword($this->passwordEncoder->encodePassword($user, $request->get('password')));

        $this->entityManager->persist($user);

        $this->entityManager->flush();
    }
}