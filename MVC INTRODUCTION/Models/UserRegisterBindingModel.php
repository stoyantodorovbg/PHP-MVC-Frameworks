<?php


namespace Models;


class UserRegisterBindingModel
{
    private $username;
    private $password;
    private $confirmPassword;
    private $name;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }



}