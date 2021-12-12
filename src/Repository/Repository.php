<?php

namespace src\Repository;

interface Repository
{
    public function getById(int $id);
}