<?php


namespace Src\Service\User;


use Src\Models\BindingModels\UserRegisterBindingModel;

interface UserServiceInterface
{
    public function register(UserRegisterBindingModel $userDTO):bool;
}