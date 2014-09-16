<?php
  require 'vendor/autoload.php';

  $app = new \Slim\Slim(array(
    'templates.path' => './templates'
  ));

  $app->get('/hello/:name', function($name){
    echo "Hello, $name";
  });

  $app->get('/', function() use ($app) {
    $app->render('scoresheet.php');
  });

  $app->run();

?>
