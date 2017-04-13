<?php

abstract class Fighter
{
	private $_type;

	public function __construct($type)
	{
		$this->_type = $type;
	}

	public function __toString()
	{
		return $this->_type;	
	}

	abstract public function fight($target);
}

?>
