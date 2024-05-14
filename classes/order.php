<?php

/** Order class represents a diner order */

class Order
{
    private $_food;
    private $_meal;
    private $_condiments;

    /**
     * Constructor creates an Order object
     * @param $_food the food the user ordered
     * @param $_meal the selected meal
     * @param $_condiments the selected condiments
     */
    public function __construct($_food="", $_meal="", $_condiments="")
    {
        $this->_food = $_food;
        $this->_meal = $_meal;
        $this->_condiments = $_condiments;
    }

    /**
     * @return string
     */
    public function getFood(): string
    {
        return $this->_food;
    }

    /**
     * @param string $food
     */
    public function setFood(string $food): void
    {
        $this->_food = $food;
    }

    /**
     * getMeal returns a meal selection
     * @return string|the meal that was ordered
     */
    public function getMeal(): string
    {
        return $this->_meal;
    }

    /**
     * @param string $meal
     */
    public function setMeal(string $meal): void
    {
        $this->_meal = $meal;
    }

    /**
     * Returns the selected condiments
     * @return array An array of condiments
     */
    public function getCondiments(): string
    {
        return $this->_condiments;
    }

    /**
     * @param string $condiments
     */
    public function setCondiments($condiments): void
    {
        $this->_condiments = $condiments;
    }


}

$order = new Order('pad thai', 'lunch', ['soy sauce']);
var_dump($order);
$order2 = new Order();
$order2->setFood('nachos');
$order2->setMeal('dinner');
$order2->setCondiments(['salsa', 'guacamole']);
var_dump($order2);
echo '</pre>';
