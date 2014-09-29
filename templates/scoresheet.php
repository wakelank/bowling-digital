<!doctype html>
<html>
<head>
  <title>
    Bowling Digital
  </title>
  <link rel="stylesheet" href="styles/stylesheet.css">
</head>
<body>

  <!-- <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> -->
  <h1>Bowling Digital</h1>
  <form action="/" method="POST">
    <input type="hidden" name="_METHOD" value="PUT">
    <input type="text" name="new_roll_score" maxlength="1" value="0">
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

    echo "<table class='score_table'>";
    echo "<tr>";
    foreach($frames as $i => $frame){

      echo "<td>";
      echo "<table class='frame_table'>";
      echo "<tr>";
      foreach($frame['rolls'] as $roll){
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
