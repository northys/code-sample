<?php

declare(strict_types=1);

namespace App\Model\User;

use Doctrine\ORM\Mapping as ORM;
use Nette\Security\Passwords;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class UserEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=60, unique=true)
     *
     * @var string
     */
    private $username;

    /**
     * @ORM\Column(type="text", length=255)
     *
     * @var string
     */
    private $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = Passwords::hash($password);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function validatePassword(string $password): bool
    {
        return Passwords::verify($password, $this->password);
    }

    public function changePassword(string $password): void
    {
        $this->password = Passwords::hash($password);
    }
}
