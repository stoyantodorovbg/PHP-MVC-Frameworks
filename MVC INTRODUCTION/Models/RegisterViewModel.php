<?php


namespace Models;


class RegisterViewModel
{
    private $allUsers;
    private $activeUsers;

    /**
     * RegisterViewModel constructor.
     * @param $allUsers
     * @param $activeUsers
     */
    public function __construct($allUsers, $activeUsers)
    {
        $this->allUsers = $allUsers;
        $this->activeUsers = $activeUsers;
    }

    /**
     * @return mixed
     */
    public function getAllUsers()
    {
        return $this->allUsers;
    }

    /**
     * @return mixed
     */
    public function getActiveUsers()
    {
        return $this->activeUsers;
    }



}