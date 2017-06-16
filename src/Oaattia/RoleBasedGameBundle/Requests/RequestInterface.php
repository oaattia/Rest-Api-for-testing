<?php
/**
 * Created by PhpStorm.
 * User: oaattia
 * Date: 6/15/17
 * Time: 2:20 AM
 */

namespace Oaattia\RoleBasedGameBundle\Requests;

use Oaattia\RoleBasedGameBundle\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\Request;

interface RequestInterface
{

    /**
     * Handle the incoming request
     *
     * This class should contain the handling for the request.
     *
     * @param Request $request
     * @return EntityInterface
     * @throws \HttpRequestException
     */
    public function handle(Request $request) : EntityInterface;


    /**
     * Return the entity related to the request
     *
     * @param Request $request
     * @return EntityInterface
     */
    public function getEntity(Request $request) : EntityInterface;
}