<?php
/**
 * Created by SmashingTeam.
 * User: sandra1n
 * Date: 11/28/16
 * Time: 11:34 AM
 */

namespace App;


class Order
{
    protected $products = [];

    public function add(Product $product)
    {
        $this->products[] = $product;
    }

    public function products()
    {
        return $this->products;
    }

    public function total()
    {
        return array_reduce($this->products, function ($carry, $product) {
            return $carry + $product->cost();
        });
    }
}