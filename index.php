<?php
  session_start();
  $roll_scores = array();

  require 'vendor/autoload.php';
//  require 'frame_row.php';

  $app = new \Slim\Slim(array(
    'templates.path' => './templates',
    //  'view' => new \Slim\Views\Twig()
  ));

  //$frame_row = new frame_row(10);

  // $app->get('/hello/:name', function($name){
  //   echo "Hello, $name";
  // });

  $app->get('/', function() use ($app) {
    $app->render('scoresheet.php');
  });

  $app->put('/', function() use ($app) {
    $new_roll_score = $app->request->put('new_roll_score');
    // $roll = $app->request->put('roll');
    // $frame_row->set_roll_score($roll, $roll_score);
    //
    // $score = $frame_row->get_roll_score($roll);
    // $scores = $frame_row->get_roll_scores();
    //
    // $app->render('scoresheet.php', array('score' => $score, 'roll' => $roll, 'scores' => $scores ));
    $roll_scores = $_SESSION['roll_scores'];
    array_push($roll_scores, $new_roll_score);
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
