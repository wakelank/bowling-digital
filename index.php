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
    $new_roll_score = htmlspecialchars($app->request->put('new_roll_score'));
    $roll_scores = $_SESSION['roll_scores'];
    if(is_valid_roll($new_roll_score)){
      array_push($roll_scores, $new_roll_score);
    }else{
      $app->flash('error', $new_roll_score . ' is invalid.  You must input a digit between 0 and 9, or a X, or a /');
    }

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

function is_valid_roll($roll){
  if(strlen($roll) > 1){ return false; }
  $pattern = '/\d|[X|\/]/';
  if(preg_match($pattern, $roll)){ return true; }
  return false;
}

  $app->run();

?>
