<?php

declare(strict_types=1);

namespace App\Model\User\Exception;

use Throwable;

class UsernameTakenException extends \RuntimeException
{
    public function __construct(string $username, Throwable $previous = null)
    {
        $message = sprintf('Username %s is already taken.', $username);
        parent::__construct($message, 0, $previous);
    }
}
