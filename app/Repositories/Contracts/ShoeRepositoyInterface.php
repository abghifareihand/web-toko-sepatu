<?php

namespace App\Repositories\Contracts;


interface ShoeRepositoyInterface
{
    public function getPopularShoes($limit);

    public function searchByName(string $keyword);

    public function getAllNewShoes();

    public function find($id);

    public function getPrice($shoeId);
}
