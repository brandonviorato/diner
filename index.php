<?php

// 328/diner/index.php
// this is my controller

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require the necessary files
require_once('vendor/autoload.php');
require_once('controllers/controller.php');

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

});

// Order 1
$f3->route('GET|POST /Order1', function($f3) {
    //echo '<h1>Order 1</h1>';
    $food = '';
    $meal = '';

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Get the data from the post array
        if (Validate::validFood($_POST['food'])) {
            $food = $_POST['food'];
        }
        else {
            $f3->set('errors["food"]', 'Please enter a food');
        }

        if (isset($_POST['meal']) and Validate::validMeal($_POST['meal'])) {
            $meal = $_POST['meal'];
        }
        else {
            $f3->set('errors["meal"]', 'Please select a meal');
        }

        // add the data to session array
        $order = new Order($food, $meal);
        $f3->set('SESSION.order', $order);

        // If there are no errors,
        // send the user to next form
        if (empty($f3->get('errors'))) {
            $f3->reroute('order2');
        }
    }

    // Get the data from the model
    // and add it to the F3 hive
    $meals = DataLayer::getMeals();
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
            $f3->get('SESSION.order')->setCondiments($condiments);

            // send user to next form
            $f3->reroute('summary');
        } else {
            // temporary
            echo "<p>Validation errors</p>";
        }
    }

    // Get the data from the model
    // and add it to the F3 hive
    $condiments = DataLayer::getCondiments();
    $f3->set('condiments', $condiments);

    // render a view page
    $view = new Template();
    echo $view->render('views/order2.html');
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