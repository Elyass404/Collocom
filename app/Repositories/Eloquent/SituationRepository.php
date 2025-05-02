<?php

namespace App\Repositories\Eloquent;

use App\Models\Situation;
use App\Repositories\interfaces\SituationRepositoryInterface;

class SituationRepository implements SituationRepositoryInterface
{
    /**
     * Create a new class instance.
     */

    protected $situations;
    public function __construct(Situation $situations)
    {
        $this->situations = $situations;
    }

    public function getAll()
    {
        return $this->situations->paginate(10);
    }

    public function getById(int $id)
    {
        return $this->situations->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->situations->create($data);
    }

    public function update(int $id, array $data)
    {
        $situation= $this->getById($id);
        $situation->update($data);
        return $situation;
    }

    public function delete(int $id)
    {
        $situation = $this->getById($id);
        return $situation->delete();
    }

}
