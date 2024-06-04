<?php

// 328/diner/index.php
// this is my controller

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require the necessary files
require_once('vendor/autoload.php');

// instantiate the base F3 class
$f3 = Base::instance();
$con = new Controller($f3);
$dataLayer = new DataLayer();

//$myOrder = new Order('breakfast', 'pancakes', 'maple syrup');
//$id = $dataLayer->saveOrder($myOrder);
//echo "Order $id inserted successfully!";

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
    $GLOBALS['con']->summary();
});

// run fat-free
$f3->run();