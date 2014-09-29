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
    if(is_valid_roll($new_roll_score)){
      array_push($roll_scores, $new_roll_score);
    }else{
      $app->flash('error','invalid roll');
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
    $validity = false;

    if($roll == 'X'){
      $validity = true;
    }elseif ($roll == '/'){
      $validity = true;
    }elseif($roll >= 0 && $roll <= 9){
      $validity = true;
    }

    return $validity;
  }

  $app->run();

?>
