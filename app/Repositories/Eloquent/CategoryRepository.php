<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Create a new class instance.
     */

     protected $categories;
    public function __construct(Category $categories)
    {
        $this->categories= $categories;
    }

    public function getAll()
    {
        return $this->categories->paginate(2);
    }

    public function getById(int $id)
    {
        return $this->categories->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->categories->create($data);
    }

    public function update(int $id, array $data)
    {
        $category= $this->getById($id);
        $category->update($data);
        return $category;
    }

    public function delete(int $id)
    {
        $category = $this->getById($id);
        return $category->delete();
    }
}
