<?php

declare(strict_types=1);

namespace App\Component\CreateUserComponent;

use App\Model\User\Exception\UsernameTakenException;
use App\Model\User\UserFacade;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

class CreateUserComponent extends Control
{
    private const PASSWORD_MIN_LENGTH = 8;

    /** @var callable */
    private $onSuccess;

    /** @var UserFacade */
    private $userFacade;

    public function __construct(callable $onSuccess, UserFacade $userFacade)
    {
        parent::__construct();
        $this->onSuccess = $onSuccess;
        $this->userFacade = $userFacade;
    }

    public function createComponentForm(): Form
    {
        $form = new Form();
        $form->addText('username', 'Username:')
            ->setRequired();

        $form->addPassword('password', 'Password:')
            ->setRequired('Please create a password.')
            ->addRule(Form::MIN_LENGTH, null, self::PASSWORD_MIN_LENGTH);

        $form->addSubmit('send', 'Create user');

        $form->onSuccess[] = function (Form $form, ArrayHash $values) {
            try {
                $this->userFacade->createUser($values['username'], $values['password']);
                ($this->onSuccess)();
            } catch (UsernameTakenException $e) {
                $form['username']->addError('This username is already taken.');
            }
        };

        return $form;
    }

    public function render(): void
    {
        $this->getTemplate()->setFile(__DIR__.'/CreateUserComponent.latte');
        $this->getTemplate()->render();
    }
}
