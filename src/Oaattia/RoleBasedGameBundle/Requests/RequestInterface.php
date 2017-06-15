<?php
/**
 * Created by PhpStorm.
 * User: oaattia
 * Date: 6/15/17
 * Time: 2:20 AM
 */

namespace Oaattia\RoleBasedGameBundle\Requests;


use Oaattia\RoleBasedGameBundle\Entity\BaseEntity;
use Oaattia\RoleBasedGameBundle\Entity\User;

interface RequestInterface
{

    /**
     * This class should contain the handler of the request itself
     * @param BaseEntity $baseEntity
     * @return
     */
    public function handle(User $user);
}