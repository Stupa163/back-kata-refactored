<?php

namespace App\src\Context;

use Faker\Factory;
use App\src\Entity\User;
use App\src\Helper\SingletonTrait;

class ApplicationContext
{
    use SingletonTrait;

    private User $currentUser;

    protected function __construct()
    {
        $faker = Factory::create();
        $this->currentUser = new User($faker->randomNumber(), $faker->firstName);
    }

    public function getCurrentUser(): User
    {
        return $this->currentUser;
    }
}
