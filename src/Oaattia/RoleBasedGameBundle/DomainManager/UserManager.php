<?php


namespace Oaattia\RoleBasedGameBundle\DomainManager;


use Doctrine\ORM\EntityManagerInterface;
use Oaattia\RoleBasedGameBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

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
    ) {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Create new user with email and password
     *
     * @param User $user
     */
    public function createUser(User $user)
    {
        $this->entityManager->persist($user);

        $this->entityManager->flush();
    }
}