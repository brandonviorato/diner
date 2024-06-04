<?php

/* This is my data layer.
 * It belongs to the Model
 */

class DataLayer
{
    // add a field to store the db connection object
    private $_dbh;

    /**
     * Datalayer constructor connects to PDO Database
     */
    function __construct()
    {
        // require my PDO database connection credentials
        require_once $_SERVER['DOCUMENT_ROOT'].'/../config.php';

        try {
            // Instantiate our PDO database object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            // echo 'Connected to database!!!!';
        } catch (PDOException $e) {
            //die($e->getMessage());
            die("<p>Something went wrong!</p>");
        }
    }

    /**
     * save a restaurant order to the database
     * @param $order an Order object
     * @return int the Order ID
     */
    function saveOrder($order)
    {
        // PDO
        // 1. Define the query
        $sql = 'INSERT INTO orders (food, meal, condiments)
        VALUES (:food, :meal, :condiments)';

        // 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Bind the parameters
        $food = $order->getFood();
        $meal = $order->getMeal();
        $condiments = $order->getCondiments();
        $statement->bindParam(':food', $food);
        $statement->bindParam(':meal', $meal);
        $statement->bindParam(':condiments', $condiments);

        // 4. Execute the query
        $statement->execute();

        // 5. Process the results
        $id = $this->_dbh->lastInsertId();
        return $id;
    }

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
