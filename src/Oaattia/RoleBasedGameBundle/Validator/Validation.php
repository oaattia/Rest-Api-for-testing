<?php

namespace Oaattia\RoleBasedGameBundle\Validator;

use Oaattia\RoleBasedGameBundle\Entity\EntityInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validation
{
    /**
     * @var ValidatorInterface
     */
    private $validator;


    /**
     * Validation constructor.
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Handle entity validation.
     *
     * @param EntityInterface $entity
     * @return array violation messages
     */
    public function handle(EntityInterface $entity) : array
    {
        $violations = $this->validator->validate($entity);

        $keys = [];
        $values = [];

        if ($violations->count() > 0) {
            foreach ($violations as $violation) {
                $keys[]   = $violation->getPropertyPath();
                $values[] = $violation->getMessage();
            }
        }

        return array_combine($keys, $values);
    }

}