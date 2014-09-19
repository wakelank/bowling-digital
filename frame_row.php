<?php

  class frame_row {

    var $num_rolls, $roll_scores;
    // var $frame_scores= array();

    var $frames = array();
    // $frame_index = 0;

    function __construct($num_frames, $new_roll_scores){
      $this->num_rolls = ($num_frames * 2) + 1;
      // $this->roll_scores = array_fill(0, $this->num_rolls + 2, 0);

      for ($i = 0; $i <= $this->num_rolls + 2; ++$i){
        if (isset($new_roll_scores[$i])){
          $this->roll_scores[$i] = $new_roll_scores[$i];
        } else{
          $this->roll_scores[$i] = 0;
        }
      }
      $this->build_frames($this->roll_scores);
      echo "constructor: ";
      print_r($this->roll_scores);
      echo "<br>";

    }

    //
    // function get_roll_score($roll){
    //   // global $roll_scores;
    //   $roll_scores = $this->roll_scores;
    //
    //   return $roll_scores[$roll];
    // }

    // function set_roll_score($roll, $score){
    //   // global $roll_scores;
    //   $roll_scores = $this->roll_scores;
    //
    //   $roll_scores[$roll] = $score;
    //   print_r($roll_scores);
    //
    //   $this->build_frames($roll_scores);
    //
    // }



    function build_frames($roll_scores){
      global $frames;
      $frame_index = 0;
      $roll = 1;
      $frame_score = 0;

      for($i = 0; $i < $this->num_rolls; ++$i){
        $roll_score = $roll_scores[$i];
        $frames[$frame_index]['roll' . $roll] = $roll_score;
        if ($roll_score == 'X' || $roll_score == '/'){
          $roll_score = 10;
          $frame_score += $roll_scores[$i+1];        // spare or strike, the next roll is added
          if ($roll = 1){                            // if it's a strike, the roll after that is added
            $frame_score += $roll_scores[$i+2];
          }
        }
        $frame_score += $roll_score;
        $frames[$frame_index]['frame_score'] = $frame_score;

        if ($roll == 1){
          ++$roll;
        }else{
          $roll = 1;
          ++$frame_index;
        }
      }
    }

    function get_num_frames(){
      global $roll_scores, $frames;

      // $num_frames = 0;
      // foreach($roll_scores as $roll_score){
      //   if ($roll_score == 'X'){
      //     ++$num_frames;
      //   }else{
      //     $num_frames =$num_frames + 0.5;
      //   }
      // }
      // return round($num_frames);
      return count($frames);
    }

    function get_frame_scores($frame_index){
      global $frames;

      return $frames[$frame_index];
    }



  }

?>
