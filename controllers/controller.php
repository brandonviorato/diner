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
        echo '<h1>My lunch menu</h1>';

        // render a view page
        $view = new Template();
        echo $view->render('views/dinner-menu.html');
    }
}
