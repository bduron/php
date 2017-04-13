<?php

class NightsWatch
{
	private $_army;

	public function recruit($fighter)
	{
		if ($fighter instanceof IFighter)
			$this->_army[] = $fighter;
	}
	
	public function fight()
	{
		foreach ($this->_army as $fighter)
			$fighter->fight();
	}
}

?>
