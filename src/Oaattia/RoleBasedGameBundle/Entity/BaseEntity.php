<?php


namespace Oaattia\RoleBasedGameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass()
 *
 * Class BaseEntity
 * @package Oaattia\RoleBasedGameBundle\Entity
 */
class BaseEntity
{

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\PrePersist()
     */
    public function prePresist()
    {
        if(is_null($this->createdAt)) {
            $this->createdAt = new \DateTime("now");
        }

        $this->updatedAt = new \DateTime("now");
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime("now");
    }
}