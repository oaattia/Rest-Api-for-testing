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
     * UserManager constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
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