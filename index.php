<?php
  require 'vendor/autoload.php';

  $app = new \Slim\Slim(array(
    'templates.path' => './templates',
    'view' => new \Slim\Views\Twig()
  ));

  $app->get('/hello/:name', function($name){
    echo "Hello, $name";
  });

  $app->get('/', function() use ($app) {
    $app->render('scoresheet.php');
  });

  $app->put('/framerow', function() use ($app) {
    $roll_score = $app->request->put('roll_score');
    $roll = $app->request->put('roll');
    $app->render('scoresheet.php', array('roll_score' => $roll_score, 'roll' => $roll));
  });

  $app->run();

?>
