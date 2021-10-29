<?php


namespace App\Repositories\Interfaces;
interface BrandRepositoryInterface
{
    public function getBrandByLetter($letter);
    public function saveBrand($brandName);
    public function getBrandByName($brandName);


}
