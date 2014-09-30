<!doctype html>
<html>
<head>
  <title>
    Bowling Digital
  </title>
  <link rel="stylesheet" href="styles/stylesheet.css">
</head>
<body>

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
      echo $flash['error'];
    }

    $frame_row = new frame_row($num_frames, $roll_scores);

    $frames = $frame_row->get_frames();

    $current_frame_index = $frame_row->get_current_frame_index();
    $current_roll_index = $frame_row->get_current_roll_index();
  ?>

  <h1>Bowling Digital</h1>
  <form action="/" method="POST">
    <input type="hidden" name="_METHOD" value="PUT">
    <input type="text" name="new_roll_score" maxlength="1" value="0">
    <input type='hidden' name='current_frame_index' value='<?php echo $current_frame_index; ?>'>
    <input type='hidden' name='current_roll_index' value='<?php echo $current_roll_index; ?>'>
    <input type="submit">
  </form>

  <!-- <form action="/" method="POST">
    <input type="hidden" name"_METHOD" value ="DELETE"> -->

  <form action="/delete" method="POST">
    <input type="submit" value="clear scores">


<?php

    echo "<table class='score_table'>";
    echo "<tr>";
    foreach($frames as $frame_index => $frame){

      echo "<td>";
      echo "<table class='frame_table'>";
      echo "<tr>";
      foreach($frame['rolls'] as $roll_index => $roll){
        echo "<td>" . $roll . "</td>";
      }
      echo "</tr><tr>";
      echo "<td colspan=2>" . $frame['frame_score'] . "</td>";
      echo "</tr></table>";
      echo "</td>";
    }

    echo "</tr>";
    echo "</table>";





  ?>

</form>
