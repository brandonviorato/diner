<?php

// 328/diner/index.php
// this is my controller

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require the necessary files
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
require_once ('model/validate.php');

//$testFood = '     xy     ';
//echo validFood($testFood) ? "valid": "not valid";
//var_dump(validFood($testFood));
//var_dump(getMeals());

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
    $food = '';
    $meal = '';

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Get the data from the post array
        if (validFood($_POST['food'])) {
            $food = $_POST['food'];
        }
        else {
            $f3->set('errors["food"]', 'Please enter a food');
        }

        if (isset($_POST['meal']) and validMeal($_POST['meal'])) {
            $meal = $_POST['meal'];
        }
        else {
            $f3->set('errors["meal"]', 'Please select a meal');
        }

        // add data to session array
        $f3->set('SESSION.food', $food);
        $f3->set('SESSION.meal', $meal);

        // If there are no errors,
        // send the user to next form
        if (empty($f3->get('errors'))) {
            $f3->reroute('order2');
        }
    }

    // Get the data from the model
    // and add it to the F3 hive
    $meals = getMeals();
    $f3->set('meals', $meals);


    // render a view page
    $view = new Template();
    echo $view->render('views/order1.html');
});

// Order 2
$f3->route('GET|POST /Order2', function($f3) {

    var_dump($f3->get('SESSION'));

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Get the data from the post array
        if (isset($_POST['conds'])) {
            $condiments = implode(", ", $_POST['conds']);
        }
        else {
            $condiments = "None selected";
        }

        // if the data valid
        if (true) {
            // add data to session array
            $f3->set('SESSION.condiments', $condiments);

            // send user to next form
            $f3->reroute('summary');
        } else {
            // temporary
            echo "<p>Validation errors</p>";
        }
    }

    // Get the data from the model
    // and add it to the F3 hive
    $condiments = getCondiments();
    $f3->set('condiments', $condiments);

    // render a view page
    $view = new Template();
    echo $view->render('views/order2.html');
});

// Order summary
$f3->route('GET /summary', function($f3) {

    var_dump($f3->get('SESSION'));

    // render a view page
    $view = new Template();
    echo $view->render('views/order-summary.html');
});

// run fat-free
$f3->run();