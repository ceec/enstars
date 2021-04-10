<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\User;
use Auth;
use App\Usercard;
use App\Eventcard;


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
     * Get the event data for the card.
     */
    public function eventcard()
    {
          return $this->hasOne('App\Eventcard');
    }



    /**
     * Get the scout for this card.
     */
    public function scout()
    {
          return $this->belongsTo('App\Scout');
    }


    /**
     * Get the boy for this card.
     */
    public function boy()
    {
          return $this->belongsTo('App\Boy');
    }

    /**
     * Get the boy for this card.
     */
    public function idolRoad()
    {
          return $this->hasMany('App\Cardroad');
    }


    public function scouts()
    {
        return $this->belongsToMany('App\Scout','scoutcards');
    }




    /**
     * Get 5 star cards
     */
    public function stars($stars)
    {
          return $this->where('stars', '=',$stars);
    }

    /**
     * Tie the card to the shop
     */
    public function shop()
    {
          return $this->belongsTo('App\Shopcard');
    }		


    public function display($view='',$text='') {
			// TODO: This should not be in the model!! 
			
			// display the card
			//
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
				$current_page = Route::getFacadeRoot()->current()->uri();
				//dont show blue if on user page
				if ($current_page == 'user/{name}/cards') {
					$background = '';
				} else {
					$background = 'panel-info';
				}

				$bloomcheck = Usercard::where('user_id','=',$user->id)->where('card_id','=',$this->id)->first();

				if ($bloomcheck->bloom == 1) {
					$bloom = true;
				} else {
					$bloom = false;
				}	
			} else {
				$background = '';
				$bloom = false;
			}
		} else {
			$background = '';
			$bloom = false;
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
					<a href="/card/<?php print $this->id ?>">
						<div class="card-container" id="card-<?php print $this->id ?>">
<?php 
							if($bloom) {
								$displaybloom = 'b';
							} else {
								$displaybloom = '';
							}
?>
							<img class="img-responsive" src="/images/cards/<?php print $this->boy_id ?>_<?php print $this->card_id.$displaybloom; ?>.png">
						</div>
					</a>
					<?php
						if ($view != 'mini') {
?>
					<span class="glyphicon glyphicon-certificate bloom hoverhand" id="bloom-<?php print $this->id ?>" data-id="<?php print $this->id ?>" data-card-id="<?php print $this->card_id ?>" data-boy="<?php print $this->boy_id ?>" aria-hidden="true"></span>
			 		<?php print $this->id ?> <?php print $this->name_e ?>
					 <?php
						if (!Auth::guest()) {
							if (Auth::user()->isAdmin()) {
					?>
					 <div class="pull-right"><?php print $this->da; ?></div>
					<?php
							}
						 }                  
					 ?>

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


				//make sure its not the user display page, hide buttons there - 2017-09-02
				$route = $route = Route::current()->uri();

				if ($route != "collection/{name}") {
						        	//normal UI for users
	        	//change text based on if they have the card
	        	if ($have > 0 ) {
	        		$button_text = 'Remove';
	        		$button_class = 'btn-danger remove-card';
	        	} else {
	        		$button_text = 'Add';
	        		$button_class = 'add-card btn-success';
	        	}

?>
				<button class="btn <?php print $button_class; ?> btn-xs" data-id="<?php print $this->id; ?>"><?php print $button_text; ?></button>
				<?php if (Auth::user()->role_id == 2) {
						print $this->boy->id.'_'.$this->place;
				}
				?>


<?php
				}



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
