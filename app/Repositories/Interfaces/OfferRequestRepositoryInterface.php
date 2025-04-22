<?php

namespace App\Repositories\Interfaces;

interface OfferRequestRepositoryInterface
{
    public function askToJoin(array $data);
    public function getRequests($id);
    public function acceptRequest($id);
    public function rejectRquest($id);
}
