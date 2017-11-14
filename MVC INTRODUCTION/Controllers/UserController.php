<?php

namespace Controllers;


use Core\View;
use Models\RegisterViewModel;
use Models\LoginViewModel;
use Models\UserRegisterBindingModel;

class UserController
{
    public function register()
    {
        $view = new View();
        $model = new RegisterViewModel(100, 50);
        $view->render('users/register', $model);
    }

    public function registerProcess(UserRegisterBindingModel $userRegisterBindingModel)
    {
        var_dump($userRegisterBindingModel);
    }

    public function login($param1, $param2)
    {
        $view = new View();
        $model = new LoginViewModel($param1, $param2);
        $view->render('users/login', $model);
    }

    public function delete($param1, $param2)
    {
        echo 'delete';
        echo $param1, $param2;
    }


}