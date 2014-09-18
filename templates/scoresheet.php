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
  <form action="/framerow" method="POST">
    <input type="hidden" name="_METHOD" value="PUT">
    <input type="text" name="new_roll_score">
    <input type="submit">
  </form>

  <?php
    require "frame_row.php";

    $num_frames = 10;
    $frame_row = new frame_row($num_frames);

    $roll_scores = $_SESSION['roll_scores'];
    echo "count ". count ($roll_scores);

    $count = 0;
    foreach($roll_scores as $roll_score){
      $frame_row->set_roll_score($count, $roll_score);
      ++$count;
    }
    $count = 0;
    foreach($roll_scores as $roll_score){
      echo "roll " . $count . ": " . $frame_row->get_roll_score($count) . "<br>";
      ++$count;
    }



  ?>

<!--
  roll score = {{ score }}<br>
  roll = {{ roll }}<br>
  for {% for num in scores %}
  scores = {{ num }}
  {% endfor %} -->
