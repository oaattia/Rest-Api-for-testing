<?php

namespace Oaattia\RoleBasedGameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RoleBasedGameBundle:Default:index.html.twig');
    }
}
