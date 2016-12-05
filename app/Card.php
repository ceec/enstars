<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use Auth;
use App\Usercard;

class Card extends Model
{
  
    /**
     * Get the event for this card.
     */
    public function event()
    {
          return $this->belongsTo('App\Event');
    }

    /**
     * Get the scout for this card.
     */
    public function scout()
    {
          return $this->belongsTo('App\Scout');
    }


    public function display($view='',$text='') {
    	//display the card

    	//lets standardize this across all cards!

    	//remove lesson skill, keep name bloomed and bg?
    	//bg maybe only if you have that card.


    	//how to check if this card is already had by the user

		//get current user
		$user = Auth::user();    
		

		//check if they have this card
		if (isset($user)) {
			//they are logged in


			$have = Usercard::where('user_id','=',$user->id)->where('card_id','=',$this->id)->count();

			if ($have > 0 ) {
				$background = 'panel-info';
			} else {
				$background = '';
			}
		} else {
			$background = '';
		}

		//check for mini
		if ($view == 'mini') {
			$col = 2;
		} else {
			$col = 3;
		}

?>
    <div class="col-md-<?php print $col; ?>">
<?php
	if ($this->stars != '') {
?>
		<div id="card-panel-<?php print $this->id; ?>" class="panel <?php print $background; ?>">
			<div class="panel-heading">
				<h3 class="panel-title">
					<a href="/card/<?php print $this->id ?>"><div class="card-container" id="card-<?php print $this->id ?>"><img class="img-responsive" src="/images/cards/<?php print $this->boy_id ?>_<?php print $this->card_id ?>.png"></div></a>
					<?php
						if ($view != 'mini') {
?>
					<span class="glyphicon glyphicon-certificate bloom hoverhand" id="bloom-<?php print $this->id ?>" data-id="<?php print $this->id ?>" data-card-id="<?php print $this->card_id ?>" data-boy="<?php print $this->boy_id ?>" aria-hidden="true"></span>
			 		<?php print $this->id ?> <?php print $this->name_e ?>
<?php							
						}
					?>
					<?php print $text; ?>
				</h3>
			</div>
<?php


		//dont show the buttons if its in mini view
		if ($view != 'mini') {

			//check if they are logged in
			if (isset($user)) {
				//extra UI for admins



        		if ($user->isAdmin()) {
?>
       				<button class="button">Edit</button>
<?php  	 
        		} 
	        	//normal UI for users
	        	//change text based on if they have the card
	        	if ($have > 0 ) {
	        		$button_text = 'Remove';
	        		$button_class = 'remove-card';
	        	} else {
	        		$button_text = 'Add';
	        		$button_class = 'add-card';
	        	}

?>
				<button class="button <?php print $button_class; ?>" data-id="<?php print $this->id; ?>"><?php print $button_text; ?></button>
<?php

			}			
		}
 ?>			
		</div>     
<?php		
	}
?>    	
   
    </div>   
<?php    	



    }
}
