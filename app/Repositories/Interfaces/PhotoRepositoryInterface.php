<?php
namespace App\Repositories\Interfaces;

use App\Models\photoLink;

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

    public function getFileLink($fileLinkId): photoLink;

    public function getUnlinkFiles();

    
    
    
    
}
