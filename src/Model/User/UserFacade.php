<?php

declare(strict_types=1);

namespace App\Model\User;

use App\Model\User\Exception\UsernameTakenException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManager;

class UserFacade
{
    /** @var EntityManager */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws UsernameTakenException
     */
    public function createUser(string $username, string $password): UserEntity
    {
        $user = new UserEntity($username, $password);

        $this->entityManager->persist($user);
        try {
            $this->entityManager->flush();
        } catch (UniqueConstraintViolationException $exception) {
            throw new UsernameTakenException($username, $exception);
        }

        return $user;
    }
}
