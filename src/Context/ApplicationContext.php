<?php

namespace src\Context;

use Faker\Factory;
use src\Entity\User;
use src\Helper\SingletonTrait;

class ApplicationContext
{
    use SingletonTrait;

    private User $currentUser;

    protected function __construct()
    {
        $faker = Factory::create();
        $this->currentUser = new User($faker->randomNumber(), $faker->firstName, $faker->lastName, $faker->email);
    }

    public function getCurrentUser(): User
    {
        return $this->currentUser;
    }
}
