<?php

namespace App\src\Repository;

use App\src\Entity\Entity;

interface Repository
{
    public function getById(int $id): Entity;
}