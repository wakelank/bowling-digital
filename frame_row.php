<?php

  class frame_row {

    var $num_rolls;
    var $frames;
    var $game_over;

    function __construct($num_frames, $new_roll_scores){

      $this->build_frames($new_roll_scores, $num_frames);

    }

    function build_frames($roll_scores, $num_frames){
      //$frames = $this->frames;
      global $frames;
      $roll_score_index = 0;
      $max_rolls_per_frame = 2;
      $frames = array();

      for ($frame_index = 0; $frame_index < $num_frames; ++$frame_index){
        $current_frame = array('rolls' => array(), 'frame_score' => null);
        $previous_frame = isset($frames[$frame_index - 1]) ? $frames[$frame_index - 1] : array('frame_score' => null);

        // echo "frame index: " . $frame_index . "<br>";
        // echo "previous_frame: <br>";
        // if (isset($frames[$frame_index -1])){
        //   print_r($frames[$frame_index -1]);
        // }
        // echo"<br><br>";



        for($frame_roll_index = 1; $frame_roll_index <= $max_rolls_per_frame; ++ $frame_roll_index){

          if (isset($roll_scores[$roll_score_index])){
            $current_roll = $roll_scores[$roll_score_index];
            $current_frame['rolls'][$frame_roll_index] = $current_roll;
            $current_frame['frame_score'] += $current_roll;
            if($frame_roll_index == $max_rolls_per_frame){
              $current_frame['frame_score'] += $previous_frame['frame_score'];
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

    function get_frames(){
       //$frames = $this->frames;
      global $frames;

      return $frames;
    }

    function get_num_frames(){
      $frames = $this->frames;;

      return count($frames);
    }

    function get_frame_scores($frame_index){
      $frames = $this->frames;;

      return $frames[$frame_index];
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
