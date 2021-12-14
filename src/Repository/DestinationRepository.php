<?php

namespace App\src\Repository;

use Faker\Factory;
use App\src\Entity\Destination;
use App\src\Helper\SingletonTrait;

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
