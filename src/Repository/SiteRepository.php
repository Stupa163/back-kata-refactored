<?php

namespace src\Repository;

use Faker\Factory;
use src\Entity\Site;
use src\Helper\SingletonTrait;

class SiteRepository implements Repository
{
    use SingletonTrait;

    /**
     * @param int $id
     *
     * @return Site
     */
    public function getById($id)
    {
        // DO NOT MODIFY THIS METHOD
        $faker = Factory::create();
        $faker->seed($id);
        return new Site($id, $faker->url);
    }
}
