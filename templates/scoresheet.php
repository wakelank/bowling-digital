<!doctype html>
<html>
<head>
  <title>
    Bowling Digital
  </title>
  <link rel="stylesheet" href="styles/stylesheet.css">
</head>
<body>
  <h1>Bowling Digital</h1>
  <form action="/" method="POST">
    <input type="hidden" name="_METHOD" value="PUT">
    <input type="text" name="new_roll_score">
    <input type="submit">
  </form>

  <!-- <form action="/" method="POST">
    <input type="hidden" name"_METHOD" value ="DELETE"> -->

  <form action="/delete" method="POST">
    <input type="submit" value="clear scores">
  </form>

  <?php
    require "frame_row.php";

    $num_frames = 10;
    $frame_row = new frame_row($num_frames);

    $roll_scores = $_SESSION['roll_scores'];

    $count = 0;
    foreach($roll_scores as $roll_score){
      $frame_row->set_roll_score($count, $roll_score);
      ++$count;
    }
    echo "frame: " . $frame_row->get_num_frames() . "<br>";


    $count = 0;
    foreach($roll_scores as $roll_score){
      echo "roll " . $count . ": " . $frame_row->get_roll_score($count) . "<br>";
      ++$count;
    }

  ?>
