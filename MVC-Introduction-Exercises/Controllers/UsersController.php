<?php


namespace Controllers;


class UsersController
{
    public function hello(string $firstName, string $lastName)
    {
        echo 'Hello Mr/Ms '.$firstName.' '. $lastName;
    }
}