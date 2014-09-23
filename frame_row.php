<?php

  class frame_row {

    var $num_rolls;
    var $frames = array();
    var $game_over;



    function __construct($num_frames, $new_roll_scores){

      $this->num_rolls = ($num_frames * 2);

      // for($i = count($new_roll_scores); $i <= $this->num_rolls+2; ++$i){
      //   $new_roll_scores[$i] = 0;
      // }

      $this->build_frames($new_roll_scores, $num_frames);

    }

    function build_frames($roll_scores, $num_frames){
      global $frames;
       $roll_score_index = 0;


      for($i=1; $i <= $num_frames; ++$i){
        // $frames[$i]['total_frame_score'] = 0;
        $total_frame_score = 0;

        $rolls_per_frame = 2;

        for ($frame_roll_index = 1; $frame_roll_index <= $rolls_per_frame; ++$frame_roll_index){

           if (isset($roll_scores[$roll_score_index])){
             $roll_score = $roll_scores[$roll_score_index];
           }else{
               $roll_score = '';
           }

           $frames[$i]['rolls'][$frame_roll_index] = $roll_score;
           $total_frame_score += (int)$roll_score;
          //  $frames[$i]['total_frame_score'] += (int)$roll_score;
           ++$roll_score_index;
         }


         if($frames[$i]['rolls'][$rolls_per_frame] != '') {
           echo "set<br>";
          //  $frames[$i]['total_frame_score'] = $total_frame_score;
           if(isset($frames[$i-1]['total_frame_score'])){
             $total_frame_score += $frames[$i-1]['total_frame_score'];
           }
         }else{
           $total_frame_score = '';
         }



         $frames[$i]['total_frame_score'] = $total_frame_score;

       }

      // $frame_index = 0;
      // $roll = 1;
      // $frame_score = 0;
      //
      // foreach($roll_scores as $i => $roll_score){
      //   $frames[$frame_index]['roll' . $roll] = $roll_score;
      //
      //   if (((string)$roll_score == "X") || ((string)$roll_score == "/")){
      //     $roll_score = 10;
      //     $frame_score += $roll_scores[$i+1];        // spare or strike, the next roll is added
      //     if ($roll = 1){                            // if it's a strike, the next roll score is "-"
      //       $frame_score += $roll_scores[$i+2];     // so the scores of the following two rolls are added
      //       $frame_score += $roll_scores[$i+3];
      //     }
      //   }
      //   $frame_score += $roll_score;
      //   $frames[$frame_index]['frame_score'] = $frame_score;
      //
      //   if ($roll == 1){
      //     ++$roll;
      //   }else{
      //     $roll = 1;
      //     ++$frame_index;
      //   }
      // }
    }

    function get_frames(){
      global $frames;

      return $frames;
    }

    function get_num_frames(){
      global $frames;

      return count($frames);
    }

    function get_frame_scores($frame_index){
      global $frames;

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
