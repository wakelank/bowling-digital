<?php

  class frame_row {

    var $num_rolls;
    var $frame_scores= array();

    function __construct($num_frames){
      $this->num_rolls = ($num_frames * 2) + 1;
    }

    var $rolls = array();

    function get_roll_score($roll){
      global $rolls;
      return $rolls[$roll];
    }

    function get_roll_scores(){
      global $rolls;

      return $rolls;
    }

    function set_roll_scores($roll_scores){
      global $rolls;

      foreach($roll_scores as $score){
        array_push($rolls, $score);
      }
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
