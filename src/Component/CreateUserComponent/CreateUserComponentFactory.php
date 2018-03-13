<?php

declare(strict_types=1);

namespace App\Component\CreateUserComponent;

interface CreateUserComponentFactory
{
    public function create(callable $onSuccess): CreateUserComponent;
}
