<?php

namespace src\Repository;

use Faker\Factory;
use src\Entity\Quote;
use src\Helper\SingletonTrait;

class QuoteRepository implements Repository
{
    use SingletonTrait;

    /**
     * @param int $id
     *
     * @return Quote
     */
    public function getById($id)
    {
        $generator = Factory::create();
        $generator->seed($id);
        return new Quote(
            $id,
            $generator->numberBetween(1, 10),
            $generator->numberBetween(1, 200),
            $generator->dateTime()
        );
    }
}
