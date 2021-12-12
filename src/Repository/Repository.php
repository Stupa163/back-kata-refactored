<?php

namespace src\Repository;

use src\Entity\Entity;

interface Repository
{
    public function getById(int $id): Entity;
}