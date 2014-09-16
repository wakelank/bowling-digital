<?php

  class frame_row {

    var $num_rolls;

    function __construct($num_frames){
      $this->num_rolls = ($num_frames * 2) + 1;
    }

    var $rolls = array();

    function get_roll_score($roll){
      global $rolls;
      return $rolls[$roll];
    }

    function set_roll_score($roll, $score){
      global $rolls;

      $rolls[$roll] = $score;
    }

    function get_running_total($roll){
      $total = 0;
      for ($i = 0; $i <= $roll; ++$roll){
        $total += $rolls[$i];
      }
      return $total;
    }
  }

?>
