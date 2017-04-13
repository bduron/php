<?php

class Lannister
{

	public function sleepwith($mate)
	{
		if ($mate instanceof Lannister)
			print "Not even if I'm drunk !".PHP_EOL;		
		else
			print "Let's do this.".PHP_EOL;		
	}			

}

?>
