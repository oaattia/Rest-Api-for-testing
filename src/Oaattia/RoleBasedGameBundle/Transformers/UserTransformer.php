<?php

namespace Oaattia\RoleBasedGameBundle\Transformers;

use Oaattia\RoleBasedGameBundle\Entity\EntityInterface;

class UserTransformer extends Transformers
{

    /**
     * @inheritdoc
     */
    public function transforming(EntityInterface $item) : array
    {
        return [
            'username' => $item->getUsername(),
            'email' => $item->getEmail(),
            'character' => [
                'title' => $item->getCharacter()->getTitle(),
                'attack' => $item->getCharacter()->getAttack(),
                'defense' => $item->getCharacter()->getDefense(),
            ],
        ];
    }
}