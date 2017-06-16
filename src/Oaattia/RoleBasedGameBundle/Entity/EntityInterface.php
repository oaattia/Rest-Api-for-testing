<?php
/**
 * Created by PhpStorm.
 * User: oaattia
 * Date: 6/16/17
 * Time: 2:08 AM
 */

namespace Oaattia\RoleBasedGameBundle\Entity;


interface EntityInterface
{
    /**
     * updated created_at if null
     * updated updated_at with datetime
     *
     * @return void
     */
    public function prePresist();


    /**
     * updated updated_at with datetime
     *
     * @return void
     */
    public function preUpdate();

}