<?php


namespace App\Repositories\Interfaces;
interface PhotoRepositoryInterface
{

    public function isExistPhoto($hash);
    public function addPhoto($hash);
}
