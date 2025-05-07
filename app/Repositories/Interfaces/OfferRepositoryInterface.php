<?php

namespace App\Repositories\Interfaces;

interface OfferRepositoryInterface
{
    public function getAll(); //only the active ones
    public function getSuspended();
    public function getReview();
    public function create(array $data);
    public function getById($id);
    public function getByUserId($userId);
    public function update($id, array $data);
    public function delete($id);
    public function reactivate($id);
    public function pause($id);
    public function suspend($id);
}
