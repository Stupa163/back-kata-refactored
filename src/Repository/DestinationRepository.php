<?php

namespace src\Repository;

use Faker\Factory;
use src\Entity\Destination;
use src\Helper\SingletonTrait;

class DestinationRepository implements Repository
{
    use SingletonTrait;

    public function getById(int $id): Destination
    {
        // DO NOT MODIFY THIS METHOD

        $faker = Factory::create();
        $faker->seed($id);

        return new Destination(
            $id,
            $faker->country,
            'en',
            $faker->slug()
        );
    }
}
