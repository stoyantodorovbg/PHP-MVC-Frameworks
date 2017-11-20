<?php


namespace Src\Service\User;

use Src\Models\BindingModels\UserRegisterBindingModel;
use Src\Repository\User\UserRepositoryInterface;


class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserRegisterBindingModel $userDTO):bool
    {
        if ($userDTO->getPassword() !== $userDTO->getConfirmPassword()) {
            throw new \Exception('The the confirm password mismatches.');
        }

        if (null !== $this->userRepository->findOneByUsername($userDTO->getUsername())) {
            throw new \Exception('This username is already used.');
        }

        $plainPassword = $userDTO->getPassword();
        $passwordHash = password_hash($plainPassword, PASSWORD_BCRYPT);
        $userDTO->setPassword($passwordHash);

        return $this->userRepository->insert($userDTO);
    }
}