<?php
  session_start();
  $roll_scores = array();

  require 'vendor/autoload.php';
//  require 'frame_row.php';

  $app = new \Slim\Slim(array(
    'templates.path' => './templates',
    //  'view' => new \Slim\Views\Twig()
  ));

  $app->get('/', function() use ($app) {
    $app->render('scoresheet.php');
  });

  $app->put('/', function() use ($app) {
    $new_roll_score = $app->request->put('new_roll_score');
    $roll_scores = $_SESSION['roll_scores'];
    array_push($roll_scores, $new_roll_score);
    // if ((string)$new_roll_score == "X"){
    //   array_push($roll_scores, "-");
    // }
    $_SESSION['roll_scores'] = $roll_scores;
    $app->redirect('/');
  });

  // Can't get this to work
  // $app->delete('/', function() use ($app) {
  //   $roll_scores = array();
  //   $_SESSION['roll_scores'] = $roll_scores;
  //   $app->redirect('/');
  // });

  $app->post('/delete', function() use ($app) {
    $roll_scores = array();
    $_SESSION['roll_scores'] = $roll_scores;
    $app->redirect('/');
  });

  $app->run();

?>
