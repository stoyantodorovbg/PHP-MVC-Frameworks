<?php


namespace Src\Service\Dummy;


use Src\Repository\User\UserRepositoryInterface;
use Src\Service\User\UserServiceInterface;

class DummyService implements DummyServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    public function print()
    {
        echo 'Dummy service is hire.';
        var_dump($this->userService);
        var_dump($this->userRepository);
    }


    /**
     * @return UserRepositoryInterface
     */
    public function getUserRepository(): UserRepositoryInterface
    {
        return $this->userRepository;
    }

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function setUserRepository(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return UserServiceInterface
     */
    public function getUserService(): UserServiceInterface
    {
        return $this->userService;
    }

    /**
     * @param UserServiceInterface $userService
     */
    public function setUserService(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }


}