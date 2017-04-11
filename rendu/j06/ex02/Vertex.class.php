<?php

require_once 'Color.class.php';

class Vertex
{
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 1.0;
	private $_color; 
	
	public static $verbose = FALSE; 

	public function __construct(array $kwargs)	
	{
		if (array_key_exists('w', $kwargs))
			$this->setW($kwargs['w']);

		if (array_key_exists('color', $kwargs))
			$this->setColor($kwargs['color']);
		else 
			$this->setColor(new Color(array('rgb' => 0xFFFFFF))); 

		$this->setX($kwargs['x']);	
		$this->setY($kwargs['y']);	
		$this->setZ($kwargs['z']);	

		if (self::$verbose)
			printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s ) constructed\n",
				$this->getX(), $this->getY(), $this->getZ(), 
				$this->getW(), $this->getColor());
		return ;
	}
	
	public function __toString()
	{
		if (self::$verbose) 
			return 	sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s )",
					$this->getX(), $this->getY(), $this->getZ(), 
					$this->getW(), $this->getColor());
		else 
			return 	sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )",
					$this->getX(), $this->getY(), $this->getZ(), 
					$this->getW());
	}

	public function __destruct()
	{
		if (self::$verbose) 
			printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s ) destructed\n",
				$this->getX(), $this->getY(), $this->getZ(), 
				$this->getW(), $this->getColor());
		return ;
	}

	public static function doc() 
	{
		return file_get_contents('Vertex.doc.txt');
	}

	public function getX() { return $this->_x; }
	public function getY() { return $this->_y; }
	public function getZ() { return $this->_z; }
	public function getW() { return $this->_w; }
	public function getColor() { return $this->_color; }
	 	
	public function setX($v) { $this->_x = $v; return; }
	public function setY($v) { $this->_y = $v; return; }
	public function setZ($v) { $this->_z = $v; return; }
	public function setW($v) { $this->_w = $v; return; }
	public function setColor($v) { $this->_color = $v; return; }
}
?>
