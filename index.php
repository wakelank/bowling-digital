<?php
  session_start();
  $roll_scores = array();
  $message = '';

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
    global $message;
    $new_roll_score = htmlspecialchars($app->request->put('new_roll_score'));
    // $current_frame_index = $app->request->put('current_frame_index');
    $current_roll_index = $app->request->put('current_roll_index');
    $has_bonus_roll = $app->request->put('has_bonus_roll');

    // $params = $app->request->params();
    // $p='';
    // foreach($params as $key=>$param){
    //   $p = $p . " | " . $key."=>".$param;
    // }

    // $app->flash('error', 'frame: ' . $current_frame_index . '<br> roll: '. $current_roll_index . '<br> params: '. $p .'<br>');

    $roll_scores = $_SESSION['roll_scores'];

    if(is_valid_roll($new_roll_score, $current_roll_index, $has_bonus_roll, $roll_scores)){
      array_push($roll_scores, $new_roll_score);
    }else{
      $app->flash('error', $message);
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

function is_valid_roll($roll, $current_roll_index, $has_bonus_roll, $roll_scores){
  global $message;

  $previous_roll_value = null;

  $previous_roll = end($roll_scores);
  if ($previous_roll == 'X' || $previous_roll == '/'){
    $previous_roll_value = 10;
  }

  if(strlen($roll) > 1){ return false; }

  $pattern = '/\d|[X|\/]/';
  if(!preg_match($pattern, $roll)){
    $message = 'Score must be a digit between 0-9, an X, or a /.<br>';
    return false;
  }else{

    if($current_roll_index == 0 && $roll == '/'){
      $message = 'Cannot enter a / for the first roll.<br>';
      return false;
    }

    if($current_roll_index != 0 && $roll == '/' && $previous_roll_value == 10){
      $message = "Cannot enter a / after a X or /.<br>";
      return false;
    }

    if ($current_roll_index == 1 && $roll == 'X' && !$has_bonus_roll){
      $message = 'Cannot enter a X for the second roll.<br>';
      return false;
    }

    if($current_roll_index != 0 && $roll == 'X' && $has_bonus_roll && $previous_roll_value != 10){
      $message = "Cannot enter an X unless previous roll was an X or / in the previous roll.<br>";
      return false;
    }

  }

  return true;
}

  $app->run();

?>
