<!doctype html>
<html>
<head>
  <title>
    Bowling Digital
  </title>
  <link rel="stylesheet" href="styles/stylesheet.css">
  <link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
</head>
<body>
  <form action="/delete" method="POST">
    <input type="submit" value="clear scores">
  </form>

  <?php
    require "frame_row.php";

    $num_frames = 10;
    $current_frame_index = 0;
    $current_roll_index = 0;

    $roll_scores = isset($_SESSION['roll_scores']) ? $_SESSION['roll_scores'] : null;
    if(is_null($roll_scores)){
      echo "No scores to display.<br>";
      die();
    }

    if(isset($flash['error'])){
      echo "<p class='error_message'>" . $flash['error'] . "</p>";
    }

    $frame_row = new frame_row($num_frames, $roll_scores);

    $frames = $frame_row->get_frames();
    $current_roll_index = $frame_row->get_current_roll_index();
    $is_final_frame = $frame_row->is_final_frame();
    $has_bonus_roll = $frame_row->has_bonus_roll();
    $game_over = $frame_row->is_game_over();
  ?>

  <h1>Bowling Digital</h1>
  <p> Enter your score.  A score can be a number between 0 and 9 or an 'X' or a '/' if you're good. </p>
  <form action="/" method="POST">
    <input type="hidden" name="_METHOD" value="PUT">
    <input type="text" name="new_roll_score" maxlength="1">
    <!-- these hidden inputs are used for data validation in the put route -->
    <input type='hidden' name='current_roll_index' value='<?php echo $current_roll_index; ?>'>
    <input type='hidden' name='has_bonus_roll' value='<?php echo $has_bonus_roll; ?>'>

    <input type="submit">
  </form>

  <!-- I would have liked to use the following form action for the delete button,
  but I was unable to get the route to work.

  <form action="/" method="POST">
    <input type="hidden" name"_METHOD" value ="DELETE"> -->

<?php
  if($game_over){
    echo "<h2>Game Over</h2>";
  }
  echo "<table class='score_table'>";
  echo "<tr>";
  foreach($frames as $frame_index => $frame){

    echo "<td class='frame_table_cell'>";
    echo "<table class='frame_table'>";
    echo "<tr>";
    foreach($frame['rolls'] as $roll_index => $roll){
      echo "<td class='roll_cell'>" . $roll . "</td>";
    }
    echo "</tr><tr>";
    if (count($frames) < $frame_index + 1){
      echo "<td colspan=2 class='framescore_cell'>" . $frame['frame_score'] . "</td>";
    }else{
      echo "<td colspan=3 class='framescore_cell'>" . $frame['frame_score'] . "</td>";
    }

    echo "</tr></table>";
    echo "</td>";

  }
  echo "</tr>";
  echo "</table>";
?>
