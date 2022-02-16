<?php


namespace App\Repositories\Interfaces;
interface PhotoRepositoryInterface
{
    public function getPhotoByHash($hash);
    public function getPhoto($id);
    public function isExistPhoto($hash);
    public function addPhoto($hash);
    public function saveLink($photoId,$uuid);
}
