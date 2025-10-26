<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoyInterface;
use App\Repositories\Contracts\ShoeRepositoyInterface;

class FrontService
{
    protected $shoeRepository;
    protected $categoryRepository;

    public function __construct(ShoeRepositoyInterface $shoeRepository, CategoryRepositoyInterface $categoryRepository)
    {
        $this->shoeRepository = $shoeRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function searchShoes(string $keyword)
    {
        return $this->shoeRepository->searchByName($keyword);
    }

    public function getFrontPageData()
    {
        $categories = $this->categoryRepository->getAllCategories();
        $popularShoes = $this->shoeRepository->getPopularShoes(4);
        $newShoes = $this->shoeRepository->getAllNewShoes();

        return compact('categories', 'popularShoes', 'newShoes');
    }
}
