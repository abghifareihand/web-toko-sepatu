<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoyInterface;

class CategoryRepository implements CategoryRepositoyInterface
{
    public function getAllCategories()
    {
        return Category::latest()->get();
    }
}
