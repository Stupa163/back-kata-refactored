<?php

namespace src\Repository;

use Faker\Factory;
use src\Entity\Site;
use src\Helper\SingletonTrait;

class SiteRepository implements Repository
{
    use SingletonTrait;

    public function getById(int $id): Site
    {
        // DO NOT MODIFY THIS METHOD
        $faker = Factory::create();
        $faker->seed($id);

        return new Site($id, $faker->url);
    }
}
