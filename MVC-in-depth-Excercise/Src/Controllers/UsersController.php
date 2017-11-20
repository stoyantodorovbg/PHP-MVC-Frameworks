<?php

namespace Src\Controllers;


use Core\Views\Views;
use Core\Views\ViewsInterface;
use Src\Models\BindingModels\UserRegisterBindingModel;
use Src\Models\UsersModel\ProfileViewModel;
use Src\Service\Dummy\DummyServiceInterface;
use Src\Service\User\UserServiceInterface;

class UsersController extends  AbstractController
{

    public function profile(string $name, string $called)
    {
        $model = new ProfileViewModel($name, $called);
        $this->render('users/profile', $model);
    }

    public function register()
    {
        $this->render('users/register');
    }

    public function registerProcess(
        UserRegisterBindingModel $userBindModel,
        UserServiceInterface $userService,
        DummyServiceInterface $dummyService
)
    {
        $userService->register($userBindModel);
        $dummyService->print();
        $this->redirect('home', 'index', $userBindModel->getUsername());
    }
}