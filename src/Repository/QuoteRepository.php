<?php

namespace src\Repository;

use Faker\Factory;
use src\Entity\Quote;
use src\Helper\SingletonTrait;

class QuoteRepository implements Repository
{
    use SingletonTrait;

    public function getById(int $id): Quote
    {
        $generator = Factory::create();
        $generator->seed($id);

        return new Quote(
            $id,
            $generator->numberBetween(1, 10),
            $generator->numberBetween(1, 200)
        );
    }
}
