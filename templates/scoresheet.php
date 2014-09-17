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
    <input type="hidden" name="roll" value="1">
    <input type="text" name="roll_score">
    <input type="submit">
  </form>

  <?php
    require "frame_row.php";

    $num_frames = 10;
    $num_rolls = ($num_frames*2)+1;
    $frame_row = new frame_row($num_frames);



  ?>

  {% for s in score %}
  {{ s }}
  {% endfor %}
  roll score = {{ roll_score }}<br>
  roll = {{ roll }}
