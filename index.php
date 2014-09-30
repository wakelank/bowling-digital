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
    $current_frame_index = $app->request->put('current_frame_index');
    $current_roll_index = $app->request->put('current_roll_index');
    $params = $app->request->params();
    $p='';
    foreach($params as $key=>$param){
      $p = $p . " | " . $key."=>".$param;
    }

    $app->flash('error', 'frame: ' . $current_frame_index . '<br> roll: '. $current_roll_index . '<br> params: '. $p .'<br>');

    $roll_scores = $_SESSION['roll_scores'];

    if(is_valid_roll($new_roll_score, $current_roll_index, $current_frame_index)){
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

function is_valid_roll($roll, $current_roll_index, $current_frame_index){
  global $message;
//TODO we should pass a final frame boolean here instead ofthe frame index.
  if(strlen($roll) > 1){ return false; }
  $pattern = '/\d|[X|\/]/';
  if(!preg_match($pattern, $roll)){
    $message = 'Score must be a digit between 0-9, an X, or a /.<br>';
    return false;
  }else{

    if($current_frame_index != 9){
      if($current_roll_index == 0 && $roll == '/'){
        $message = 'Cannot enter a / for the first roll.<br>';
        return false;
      }
      if($current_roll_index == 1 && $roll == 'X'){
        $message = 'Cannot enter a X for the second roll.<br>';
        return false;
      }
    }
  }



  return true;
}

  $app->run();

?>
