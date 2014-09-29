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

        if($frame_index + 1 == $num_frames){
          $last_frame = true;
        }else{
          $last_frame = false;
        }

        // echo "frame index: " . $frame_index . "<br>";
        // echo "previous_frame: <br>";
        // if (isset($frames[$frame_index -1])){
        //   print_r($frames[$frame_index -1]);
        // }
        // echo"<br><br>";



        for($frame_roll_index = 0; $frame_roll_index < $max_rolls_per_frame; ++ $frame_roll_index){

          $previous_roll = isset($roll_scores[$roll_score_index - 1]) ? $roll_scores[$roll_score_index -1] : null;
          $current_roll_symbol = isset($roll_scores[$roll_score_index]) ? $roll_scores[$roll_score_index] : null;
          if ($current_roll_symbol == 'X') { $current_roll = 10; }
          elseif ($current_roll_symbol == '/'){ $current_roll = 10 - $previous_roll; }
          else { $current_roll = $current_roll_symbol; }
          $next_roll = isset($roll_scores[$roll_score_index + 1]) ? $roll_scores[$roll_score_index + 1] : null;
          if ($next_roll == 'X'){ $next_roll = 10; }
          elseif ($next_roll == '/'){ $next_roll = 10 - $current_roll; }
          $roll_after_next = isset($roll_scores[$roll_score_index + 2]) ? $roll_scores[$roll_score_index + 2] : null;
          if ($roll_after_next == 'X'){ $roll_after_next = 10; }
          elseif ($roll_after_next == '/'){ $roll_after_next = 10 - $next_roll; }

          if ($frame_roll_index + 1 == $max_rolls_per_frame){
            $last_roll_in_frame = true;
          }else{
            $last_roll_in_frame = false;
          }




          // echo "frame: " . $frame_index . "<br>";
          // echo "current roll :" .$current_roll . "<br>";
          // print_r($frames);
          // echo "<br>";

          // echo "roll scores: <br>";
          // print_r($roll_scores);
          // echo "<br>";

          if (!is_null($current_roll)){

            if ($current_roll_symbol == 'X'){
              //TODO error if strike is on second roll of frame

              $current_frame['rolls'][$frame_roll_index] = $current_roll_symbol;
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
                }else{
                  $current_frame['frame_score'] = '-';
                }
                $current_frame['frame_score'] += $previous_frame['frame_score'];
                ++$roll_score_index;
                $current_frame['rolls'][$frame_roll_index + 1 ] = '-';
                break 1;
              }

            }elseif ($current_roll_symbol == '/'){
              //TODO error if spare is on first roll of frame

              $current_frame['rolls'][$frame_roll_index] = $current_roll_symbol;
              $current_frame['frame_score'] = 10;

              if ($last_frame){
                $max_rolls_per_frame = 3;
              }else{

                if(!is_null($next_roll)){
                  $current_frame['frame_score'] += $next_roll;
                }else{
                  $current_frame['frame_score'] = '';
                }
                
                $current_frame['frame_score'] += $previous_frame['frame_score'];
              }

            }else{

              $current_frame['rolls'][$frame_roll_index] = $current_roll_symbol;
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
        // print_r($frames);
        // echo"<br><br>";

      }
    }



    function get_frames(){
       //$frames = $this->frames;
      global $frames;

      return $frames;
    }
    //
    // function get_num_frames(){
    //   $frames = $this->frames;;
    //
    //   return count($frames);
    // }
    //
    // function get_frame_scores($frame_index){
    //   $frames = $this->frames;;
    //
    //   return $frames[$frame_index];
    // }

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
