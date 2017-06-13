<?php

namespace Oaattia\RoleBasedGameBundle\Controller;


class RegisterController
{
    public function postAction($username, $password)
    {
        return [
            $username ?? "nothing",
            $password ?? "nothing"
        ];
    }
}
