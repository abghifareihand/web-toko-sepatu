<?php

namespace App\Repositories\Contracts;


interface PromoCodeRepositoyInterface
{
    public function getAllPromoCode();

    public function findByCode(string $code);
}
