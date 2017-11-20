<?php


namespace Src\Models\UsersModel;


class ProfileViewModel
{
    private $username;

    private $called;

    /**
     * ProfileViewModel constructor.
     * @param $username
     * @param $called
     */
    public function __construct($username, $called)
    {
        $this->username = $username;
        $this->called = $called;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getCalled()
    {
        return $this->called;
    }

    /**
     * @param mixed $called
     */
    public function setCalled($called)
    {
        $this->called = $called;
    }




}