<?php

class Jaime extends Lannister
{

	public function sleepwith($mate)
	{
		if ($mate instanceof Lannister)
		{
			if ($mate instanceof Cersei)
				print "With pleasure, but only in a tower in Winterfell, then.".PHP_EOL;		
			else 
				print "Not even if I'm drunk".PHP_EOL;		
		}
		else
			print "Let's do this.".PHP_EOL;		
	}			

}



?>
