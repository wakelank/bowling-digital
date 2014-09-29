<?php

  class frame_row {

    var $num_rolls;
    var $frames;
    var $game_over;

    function __construct($num_frames, $new_roll_scores){

      foreach($new_roll_scores as $roll){
        if(!$this->is_valid_roll($roll)){
          echo "Invalid input: '" . $roll . "' .Must be an integer from 0-9, a 'X' or a '/'.";
          die();
        }
      }

      $this->build_frames($num_frames, $new_roll_scores);
    }

    function build_frames($num_frames, $roll_scores){
      global $frames;
      $roll_score_index = 0;
      $max_rolls_per_frame = 2;
      $frames = array();

      for ($frame_index = 0; $frame_index < $num_frames; ++$frame_index){
        $current_frame = array('rolls' => array(), 'frame_score' => null);
        $previous_frame = isset($frames[$frame_index - 1]) ? $frames[$frame_index - 1] : array('rolls' => array(),'frame_score' => null);

        if($frame_index + 1 == $num_frames){
          $last_frame = true;
        }else{
          $last_frame = false;
        }

        for($frame_roll_index = 0; $frame_roll_index < $max_rolls_per_frame; ++ $frame_roll_index){

          $previous_roll = isset($roll_scores[$roll_score_index - 1]) ? $roll_scores[$roll_score_index - 1] : null;
          $current_roll = isset($roll_scores[$roll_score_index]) ? $roll_scores[$roll_score_index] : null;

          $next_roll = isset($roll_scores[$roll_score_index + 1]) ? $roll_scores[$roll_score_index + 1] : null;
          if ($next_roll == 'X'){
            $next_roll = 10;
          }elseif($next_roll == '/'){
             $next_roll = 10 - $current_roll;
          }

          $roll_after_next = isset($roll_scores[$roll_score_index + 2]) ? $roll_scores[$roll_score_index + 2] : null;
          if ($roll_after_next == 'X'){
            $roll_after_next = 10;
          }elseif ($roll_after_next == '/'){
            $roll_after_next = 10 - $next_roll;
          }

          if ($frame_roll_index + 1 == $max_rolls_per_frame){
            $last_roll_in_frame = true;
          }else{
            $last_roll_in_frame = false;
          }

          if (!is_null($current_roll)){

            if ($current_roll == 'X'){
              //TODO error if strike is on second roll of frame

              $current_frame['rolls'][$frame_roll_index] = $current_roll;
              $current_frame['frame_score'] += 10;

              if ($last_frame){
                $max_rolls_per_frame = 3;
                if($last_roll_in_frame){
                  $current_frame['frame_score'] += $previous_frame['frame_score'];
                }
              }else{
                if (!is_null($next_roll) && !is_null($roll_after_next)){
                  $current_frame['frame_score'] += $next_roll;
                  $current_frame['frame_score'] += $roll_after_next;
                  $current_frame['frame_score'] += $previous_frame['frame_score'];

                }else{
                  $current_frame['frame_score'] = '';
                }

                $current_frame['rolls'][$frame_roll_index + 1 ] = '-';
                ++$roll_score_index;
                break 1;
              }
            }elseif ($current_roll == '/'){
              //TODO error if spare is on first roll of frame

              $current_frame['rolls'][$frame_roll_index] = $current_roll;
              $current_frame['frame_score'] = 10;

              if ($last_frame){
                $max_rolls_per_frame = 3;
              }else{

                if(!is_null($next_roll)){
                  $current_frame['frame_score'] += $next_roll;
                  $current_frame['frame_score'] += $previous_frame['frame_score'];
                }else{
                  $current_frame['frame_score'] = '';
                }
              }
            }else{
              $current_frame['rolls'][$frame_roll_index] = $current_roll;
              $current_frame['frame_score'] += $current_roll;

              if($last_roll_in_frame){
                $current_frame['frame_score'] += $previous_frame['frame_score'];
              }
            }
          }else{

            $current_frame['rolls'][$frame_roll_index] = '';
            $current_frame['frame_score'] = '';
          }

          ++$roll_score_index;
        }

        array_push($frames, $current_frame);

      }
    }

    function is_valid_roll($roll){
      if(strlen($roll) > 1){ return false; }
      $pattern = '/\d|[X|\/]/';
      if(preg_match($pattern, $roll)){ return true; }
      return false;
    }

    function get_frames(){
      global $frames;

      return $frames;
    }

    function game_over_check($roll_scores){
      $game_over = false;
      if (count($roll_scores) == $this->num_rolls){
        $game_over = true;
      }
      return $game_over;
    }

    function is_game_over(){
      return $this->game_over;
    }

  }


?>
