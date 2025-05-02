<?php

namespace App\Repositories\interfaces;

interface SituationRepositoryInterface
{
    public function getAll();
    public function create(array $data);
    public function getById(int $id);
    public function update(int $id, array $data);
    public function delete(int $id);
}
