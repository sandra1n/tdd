<?php
/**
 * Created by SmashingTeam.
 * User: sandra1n
 * Date: 11/28/16
 * Time: 11:26 AM
 */

namespace App;


class Product
{
    public $name;
    public $cost;

    /**
     * Product constructor.
     * @param $name
     * @param $cost
     */
    public function __construct($name, $cost)
    {

        $this->name = $name;
        $this->cost = $cost;
    }

    public function name()
    {
        return $this->name;
    }

    public function cost()
    {
        return $this->cost;
    }
}