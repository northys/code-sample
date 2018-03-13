<?php

declare(strict_types=1);

namespace App\Presenter;

use App\Component\CreateUserComponent\CreateUserComponent;
use App\Component\CreateUserComponent\CreateUserComponentFactory;
use Nette;

class HomepagePresenter extends Nette\Application\UI\Presenter
{
    /** @var CreateUserComponentFactory */
    private $createUserComponentFactory;

    public function __construct(CreateUserComponentFactory $createUserComponentFactory)
    {
        parent::__construct();
        $this->createUserComponentFactory = $createUserComponentFactory;
    }

    public function createComponentCreateUserForm(): CreateUserComponent
    {
        return $this->createUserComponentFactory->create(function () {
            $this->flashMessage('User was successfully added!');
            $this->redirect('this');
        });
    }
}
