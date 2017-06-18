<?php


namespace Oaattia\RoleBasedGameBundle\Transformers;


use Doctrine\Common\Collections\ArrayCollection;

class UserTransformer
{
    /**
     * @var ArrayCollection
     */
    private $arrayCollection;

    /**
     * UseTransformer constructor.
     * @param ArrayCollection $arrayCollection
     */
    public function __construct(ArrayCollection $arrayCollection)
    {
        $this->arrayCollection = $arrayCollection;
    }


    public function transform(array $items)
    {
        return $this->arrayCollection->filter(
            function ($item) use ($items) {
                foreach ($items as $value) {
                    return $value == $item;
                }
            }
        );
    }
}