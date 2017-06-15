<?php


namespace Oaattia\RoleBasedGameBundle\Requests;

use Oaattia\RoleBasedGameBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class RegistrationRequest implements RequestInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * RegistrationRequest constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * This class should contain the handler of the request itself
     * @param User $user
     */
    public function handle(User $user)
    {
        var_dump($user);
    }
}