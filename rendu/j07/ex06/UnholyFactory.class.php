<?php

class UnholyFactory
{
	private $_army = array();	

	public function absorb($type)
	{
		if ($type instanceof Fighter)
		{	
			if (!in_array($type, $this->_army)) 
			{	
				$this->_army[] = $type;	//try with name
				print "(Factory absorbed a fighter of type ".$type.")".PHP_EOL;
			}
			else 
				print "(Factory already absorbed a fighter of type ".$type.")".PHP_EOL;
		}
		else 
			print "(Factory can't absorb this, it's not a fighter)".PHP_EOL;
	}

	public function fabricate($rf)
	{
		foreach ($this->_army as $kind)
		{	
			if ((string) $kind === $rf)	
			{
				print "(Factory fabricates a fighter of type ".$rf.")".PHP_EOL;	
				return clone $kind;
			}	
		}
		print "(Factory hasn't absorbed any fighter of type ".$rf.")".PHP_EOL;	
		return ;				
	}
}

?>
