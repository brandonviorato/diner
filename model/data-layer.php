<?php

/* This is my data layer.
 * It belongs to the Model
 */

// Get the meal for Diner app
function getMeals() {
    return array('breakfast', 'lunch', 'dinner', 'dessert');
}

function getCondiments() {
    return array('ketchup', 'mustard', 'sriracha', 'ranch');
}