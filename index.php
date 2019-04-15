<?php
/**
 * practice routing
 * User: Samantha DeSmul
 * Date: 4/15/2019
 * Filename: index.php
 *
 */

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require autoload file
require_once('vendor/autoload.php');

//create an instance of the Base class/ fat free object
//instantiate fat free
$f3 = Base::instance();

//turn on fatfree error reporting
//debugging in fat free is difficult
$f3->set('DEBUG', 3);

//Define a default root, there can be multiple routes
$f3->route('GET /', function(){
    //display a view
    $view = new Template();
    echo $view->render('views/home.html');
});

//define a breakfast route
$f3->route('GET /breakfast', function(){

  $view= new Template();
  echo $view->render('views/breakfast.html');
});

//define a continential breakfast
$f3->route('GET /breakfast/continental', function(){

    $view= new Template();
    echo $view->render('views/bfast-cont.html');
});

//define a lunch route
$f3->route('GET /lunch', function(){

    $view= new Template();
    echo $view->render('views/lunch.html');
});


//define a continential breakfast
$f3->route('GET /lunch/brunch/buffet', function(){

    $view= new Template();
    echo $view->render('views/buffet.html');
});

//define a route with a parameter
$f3->route('GET /@item', function($f3, $params){
    $item = $params['item'];
    $foodsWeServe = array('spaghetti', 'enchiladas',
        'pad thai', 'lumpia');

    if(!in_array($item, $foodsWeServe)){
        echo "We dont serve $item";
    }


    switch($item){
        case 'spaghetti':
            echo "<h3>I like $item with meatballs.</h3>";
            break;
        case 'pizza':
            echo "<h3>pepperoni or vegi?</h3>";
            break;
        case 'tacos':
            echo "<h3>We dont have $item</h3>";
            break;
        case 'bagel':
            $f3->reroute("/breakfast/continental");
            default:
                $f3 ->error(404);

    }

});

//define a route with two parameters, a first and last name
$f3->route('GET /@firstName/@lastName', function($f3, $params){
    $firstName = $params['firstName'];
    $lastName =$params['lastName'];
    echo "hello $firstName $lastName";

});


//run Fat-free
$f3->run();
