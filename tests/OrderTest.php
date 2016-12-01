<?php

use App\Order;
use App\Product;

class OrderTest extends PHPUnit_Framework_TestCase
{

    /**  @test  */
    function an_order_consists_of_products()
    {
        $order = new Order();

        $product = new Product('Fallout 4', 59);
        $product2 = new Product('Fallout 4', 7);

        $order->add($product);
        $order->add($product2);

        $this->assertEquals(2, count($order->products()));
        $this->assertCount(2, $order->products());
    }

    /** @test */
    function an_order_can_determine_the_tool_cost_of_all_its_products(){
        $order = new Order();

        $product = new Product('Fallout 4', 59);
        $product2 = new Product('Fallout 4', 7);

        $order->add($product);
        $order->add($product2);

        $this->assertEquals(66, $order->total());
    }
}
