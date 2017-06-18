<?php
/**
 * Created by PhpStorm.
 * User: oaattia
 * Date: 6/18/17
 * Time: 9:09 AM
 */

namespace Oaattia\RoleBasedGameBundle\Transformers;


interface Transformer
{

    /**
     * This method used to transform the results
     * we shouldn't expose all the data from the tables but
     * we should only show what we want to show
     *
     * @param array $items
     * @return array
     */
    public function transform(array $items) : array;
}