<?php


namespace Oaattia\RoleBasedGameBundle\Transformers;


class UserTransformer implements Transformer
{

    /**
     * @inheritdoc
     */
    public function transform(array $elements) : array
    {
        $data = [];

        foreach ($elements as $item) {
            $data[] = [
                'username' => $item->getUsername(),
                'email' => $item->getEmail(),
                'password' => $item->getPassword(),
                'character' => [
                    'title' => $item->getCharacter()->getTitle(),
                    'attack' => $item->getCharacter()->getAttack(),
                    'defense' => $item->getCharacter()->getDefense(),
                ],
            ];
        }

        return $data;
    }
}