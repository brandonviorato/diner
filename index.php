<?php

// 328/diner/index.php
// this is my controller

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require the necessary files
require_once('vendor/autoload.php');

//if (Validate::validFood("tacos")) {
//    echo "<p>This is valid</p>";
//}

/* test the datalayer class */
//var_dump(DataLayer::getMeals());


/* Test the Order class */
//$order = new Order('pad thai', 'lunch', ['soy sauce']);
//var_dump($order);
//$order2 = new Order();
//$order2->setFood('nachos');
//$order2->setMeal('dinner');
//$order2->setCondiments(['salsa', 'guacamole']);
//var_dump($order2);
//echo '</pre>';

//$testFood = '     xy     ';
//echo validFood($testFood) ? "valid": "not valid";
//var_dump(validFood($testFood));
//var_dump(getMeals());

// instantiate the base F3 class
$f3 = Base::instance();
$con = new Controller($f3);

// define a default route
$f3->route('GET /', function() {
    $GLOBALS['con']->home();
});

// Breakfast menu
$f3->route('GET /menus/breakfast', function() {
    $GLOBALS['con']->breakfast();
});

// Breakfast menu
$f3->route('GET /menus/lunch', function() {
    $GLOBALS['con']->lunch();
});

// Dinner menu
$f3->route('GET /menus/dinner', function() {
    //echo '<h1>My dinner menu</h1>';

    // render a view page
    $view = new Template();
    echo $view->render('views/dinner-menu.html');
});

// Order 1
$f3->route('GET|POST /Order1', function() {
    $GLOBALS['con']->order1();
});

// Order 2
$f3->route('GET|POST /Order2', function($f3) {
    $GLOBALS['con']->order2();
});

// Order summary
$f3->route('GET /summary', function($f3) {

    // render a view page
    $view = new Template();
    echo $view->render('views/order-summary.html');

    //var_dump($f3->get('SESSION'));
    session_destroy();
});

// run fat-free
$f3->run();