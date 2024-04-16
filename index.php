<?php

// 328/diner/index.php
// this is my controller

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require
require_once('vendor/autoload.php');

// instantiate the base F3 class
$f3 = Base::instance();

// define a default route
$f3->route('GET /', function() {
    //echo '<h1>Hello diner</h1>';

    // render a view page
    $view = new Template();
    echo $view->render('views/home-page.html');
});

// Breakfast menu
$f3->route('GET /menus/breakfast', function() {
    //echo '<h1>My breakfast menu</h1>';

    // render a view page
    $view = new Template();
    echo $view->render('views/breakfast-menu.html');
});

// Breakfast menu
$f3->route('GET /menus/lunch', function() {
    //echo '<h1>My lunch menu</h1>';

    // render a view page
    $view = new Template();
    echo $view->render('views/lunch-menu.html');
});

// Dinner menu
$f3->route('GET /menus/dinner', function() {
    //echo '<h1>My lunch menu</h1>';

    // render a view page
    $view = new Template();
    echo $view->render('views/dinner-menu.html');
});

// Order 1
$f3->route('GET|POST /Order1', function($f3) {
    //echo '<h1>Order 1</h1>';

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

//        echo "<p>You got here using the POST method</p>";
//        var_dump($_POST);

        // Get the data from the post array
        $food = $_POST['food'];
        $meal = $_POST['meal'];

        // if the data valid
        if (true) {
            $f3->set('SESSION.food', $food);
            $f3->set('SESSION.meal', $meal);
        }

    } else {
        echo "<p>You got here using the GET method</p>";
    }

    // render a view page
    $view = new Template();
    echo $view->render('views/order1.html');
});

// Order 2
$f3->route('GET /Order2', function() {
    //echo '<h1>Order 2</h1>';

    // render a view page
    $view = new Template();
    echo $view->render('views/order2.html');
});

// run fat-free
$f3->run();