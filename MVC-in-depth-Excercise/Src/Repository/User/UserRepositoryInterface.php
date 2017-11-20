<?php


namespace Src\Repository\User;

use Src\Models\BindingModels\UserRegisterBindingModel;
use Src\Models\Entity\User;

interface UserRepositoryInterface
{
    public function insert(UserRegisterBindingModel $user):bool;

    public function findOneByUsername(string $username): ?User;
}