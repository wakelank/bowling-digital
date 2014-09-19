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


    $roll_scores = $_SESSION['roll_scores'];
    $frame_row = new frame_row($num_frames, $roll_scores);
    $num_frames = $frame_row->get_num_frames();
    echo "frames: " . $num_frames. "<br>";
    echo "score: ";
    print_r($frame_row->get_frame_scores($num_frames-1));
    echo "<br>";

    echo "<table class='score_table'>";
    echo "<tr>";

    for($i = 0; $i <= $num_frames-1; ++$i){
      $frame_scores = $frame_row->get_frame_scores($i);
      echo "<td>";
      echo "<table class='frame_table'>";
      echo "<tr>";
      echo "<td>" . $frame_scores['roll1'] . "</td>";
      echo "<td>" . $frame_scores['roll2'] . "</td>";
      echo "</tr><tr>";
      echo "<td colspan=2>" . $frame_scores['frame_score'] . "</td>";
      echo "</tr></table>";
      echo "</td>";
    }

    echo "</tr>";
    echo "</table>";

  ?>
