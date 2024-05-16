<?php

/**
 *
 */
class Controller
{
    private $_f3; // Fat-free router

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        // render a view page
        $view = new Template();
        echo $view->render('views/home-page.html');
    }

    function breakfast()
    {
        // render a view page
        $view = new Template();
        echo $view->render('views/breakfast-menu.html');
    }

    function lunch()
    {
        // render a view page
        $view = new Template();
        echo $view->render('views/lunch-menu.html');
    }

    function order1()
    {
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
                $this->_f3->set('errors["food"]', 'Please enter a food');
            }

            if (isset($_POST['meal']) and Validate::validMeal($_POST['meal'])) {
                $meal = $_POST['meal'];
            }
            else {
                $this->_f3->set('errors["meal"]', 'Please select a meal');
            }

            // add the data to session array
            $order = new Order($food, $meal);
            $this->_f3->set('SESSION.order', $order);

            // If there are no errors,
            // send the user to next form
            if (empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('order2');
            }
        }

        // Get the data from the model
        // and add it to the F3 hive
        $meals = DataLayer::getMeals();
        $this->_f3->set('meals', $meals);


        // render a view page
        $view = new Template();
        echo $view->render('views/order1.html');
    }

    function order2()
    {
        var_dump($this->_f3->get('SESSION'));

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
                $this->_f3->get('SESSION.order')->setCondiments($condiments);

                // send user to next form
                $this->_f3->reroute('summary');
            } else {
                // temporary
                echo "<p>Validation errors</p>";
            }
        }

        // Get the data from the model
        // and add it to the F3 hive
        $condiments = DataLayer::getCondiments();
        $this->_f3->set('condiments', $condiments);

        // render a view page
        $view = new Template();
        echo $view->render('views/order2.html');
    }
}
