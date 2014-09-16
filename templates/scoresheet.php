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
  <?php
    require "frame_row.php";

    $num_frames = 10;
    $num_rolls = ($num_frames*2)+1;
    $frame_row = new frame_row($num_frames);

    for ($i = 1; $i <= $num_rolls; ++$i){
      $frame_row->set_roll_score($i,$i+2);
    }

    for ($i = 1; $i <= $num_rolls; ++$i){
      echo "Roll " . $i . ": " . $frame_row->get_roll_score($i) . "<br>";
    }

    echo "end";
  ?>
