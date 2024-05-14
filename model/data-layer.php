<?php

/* This is my data layer.
 * It belongs to the Model
 */
class DataLayer
{
    // Get the meal for Diner app
    static function getMeals()
    {
        return array('breakfast', 'lunch', 'dinner', 'dessert');
    }

    static function getCondiments()
    {
        return array('ketchup', 'mustard', 'sriracha', 'ranch');
    }
}
