<?php


namespace App\Repository;


use App\Entity\Product;

interface ProductRepositoryInterface
{
    public function create(Product $product);
    public function delete(Product $product);

}