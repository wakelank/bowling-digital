<?php

class frame {
  protected var $num_rolls;

  function __contstruct($num_rolls){
    $this->$num_of_rolls = $num_of_rolls
  }

  protected var $roll_scores = array();
  protected var $frame_score;

  function get_roll_score($roll){
    return $roll_scores[$throw];
  }
  function get_num_rolls(){
    return $num_rolls;
  }

  function set_throw_score($roll, $score){
    // TODO only one $roll allowed if it's a strike

    if is_valid($score){
      $roll_scores[$roll] = $score;
    } else {
      return "invalid score";
    }
  }

  function is_valid($score){
    $validity = false;

    if($score == "strike"){
      $validity = true;
    }
    if($score == "spare"){
      $validity = true;
    }
    if($score > 1 && $score < 10){
      $validity = true;
    }
    return $validity;
  }
}
