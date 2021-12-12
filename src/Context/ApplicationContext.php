<?php

namespace src\Context;

use Faker\Factory;
use src\Entity\Site;
use src\Entity\User;
use src\Helper\SingletonTrait;

class ApplicationContext
{
    use SingletonTrait;

    /**
     * @var Site
     */
    private $currentSite;
    /**
     * @var User
     */
    private $currentUser;

    protected function __construct()
    {
        $faker = Factory::create();
        $this->currentSite = new Site($faker->randomNumber(), $faker->url);
        $this->currentUser = new User($faker->randomNumber(), $faker->firstName, $faker->lastName, $faker->email);
    }

    public function getCurrentSite()
    {
        return $this->currentSite;
    }

    public function getCurrentUser()
    {
        return $this->currentUser;
    }
}
