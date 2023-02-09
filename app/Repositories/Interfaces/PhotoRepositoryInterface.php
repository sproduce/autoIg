<?php


namespace App\Repositories\Interfaces;
interface PhotoRepositoryInterface
{
    public function getPhotoByHash($hash);
    public function getPhoto($id);
    public function isExistPhoto($hash);
    public function addPhoto($hash,$fileName,$fileExt,$fileType);
    public function saveLink($photoId,$uuid);
    public function getFiles($uuid);
    public function deleteFile($uuid,$fileId);
    public function deleteFiles($uuid);


}
