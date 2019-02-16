<?php
namespace App\Repositories;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface {
    function __construct(Product $prodcut)
    {
        parent::__construct($prodcut);
    }
}