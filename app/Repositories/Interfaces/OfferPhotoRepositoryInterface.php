<?php

namespace App\Repositories\Interfaces;

interface OfferPhotoRepositoryInterface
{
    public function storePhoto(array $data);
    public function getOfferPhotos($id);
}
