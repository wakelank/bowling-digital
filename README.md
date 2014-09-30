bowling-digital
===============

The data is stored in a session varaible called "roll_scores." It's a one-dimensional array of the bowling scores.
Each time the template, scoresheet.php is rendered, a frame_row object is instantiated, using the bowling scores.
The frame_row object uses the scores to calculate the score of each frame.  It also checks for invalid entries. 
The frame_row cannot write to the roll_scores variable, so in the case of invalid data it simply dies.  For this 
reason invalid entries are also caught in the index.php before they are added to roll_scores.  In the case
of an invalid entry, the data is not added, and the user can enter something else.

"Game" might have been a more logical name than "frame_row," but "game" makes more sense for a multi-player version.
In case someone uses this code to make a multi-player bowling app, "game" will not be taken.

The "frame_row" class seems a little complicated for my taste.  I would have like to break it up into discrete 
methods, but the method would need access to so many variables (score of the previous frame, value of the previous
roll, value of the next roll or two, etc) that I judged it to be less convoluted to put almost everything into
one "build_frames" method.  This interconnectedness is also why I chose not to use a frame object.  Each frame
needs to know so much about it's neighbors that it made more sense to me to use the row of frames as the smallest
unit of organization.


This app uses the Slim framework to build the routes. http://www.slimframework.com/ 
And composer to manage dependencies (slim is the only one). https://getcomposer.org/

Unit testing, AJAX, and database storage of the scores were not requirement, so in the interest of time, I didn't do them.  Though unit testing would have been helpful.  Since bowling scoring is so complicated and dependent on so many variables, this seems like a perfect candidate for TDD.  
