<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use Auth;

class Card extends Model
{
    //


    public function display() {
    	//display the card

    	//lets standardize this across all cards!

    	//remove lesson skill, keep name bloomed and bg?
    	//bg maybe only if you have that card.

?>
    <div class="col-md-3">
<?php
	if ($this->stars != '') {
?>
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">
					<a href="/card/<?php print $this->id ?>"><div class="card-container" id="card-<?php print $this->id ?>"><img class="img-responsive" src="/images/cards/<?php print $this->boy_id ?>_<?php print $this->card_id ?>.png"></div></a>
					<span class="glyphicon glyphicon-certificate bloom" id="bloom-<?php print $this->id ?>" data-id="<?php print $this->id ?>" data-card-id="<?php print $this->card_id ?>" data-boy="<?php print $this->boy_id ?>" aria-hidden="true"></span>
			 		<?php print $this->id ?> <?php print $this->name_e ?>
				</h3>
			</div>
<?php
		//get current user
		$user = Auth::user();

		//check if they are logged in
		if (isset($user)) {
			//extra UI for admins



        	if ($user->isAdmin()) {
?>
       		<button class="button">Edit</button>
<?php  	 
        	} 
        	//normal UI for users
?>
			<button class="button">Add</button>
<?php

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
