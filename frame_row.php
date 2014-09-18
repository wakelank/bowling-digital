<?php

  class frame_row {

    var $num_rolls;
    var $frame_scores= array();

    function __construct($num_frames){
      $this->num_rolls = ($num_frames * 2) + 1;
    }

    var $roll_scores = array();

    function get_roll_score($roll){
      global $roll_scores;
      return $roll_scores[$roll];
    }
    //
    // function get_roll_scores(){
    //   global $rolls;
    //
    //   return $rolls;
    // }
    //
    // function set_roll_scores($roll_scores){
    //   global $rolls;
    //
    //   foreach($roll_scores as $score){
    //     array_push($rolls, $score);
    //   }
    // }

    function set_roll_score($roll, $score){
      global $roll_scores;

      $roll_scores[$roll] = $score;
    }

    function get_num_frames(){
      global $roll_scores;

      $num_frames = 0;
      foreach($roll_scores as $roll_score){
        if ($roll_score == 'X'){
          ++$num_frames;
        }else{
          $num_frames =$num_frames + 0.5;
        }
      }
      return $num_frames;
    }


  }

?>
