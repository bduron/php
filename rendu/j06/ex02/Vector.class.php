<?php

require_once 'Vertex.class.php';

class Vector
{
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 0.0;
	private $_dest;
	private $_orig;
	
	public static $verbose = FALSE; 

	public function __construct(array $kwargs)	
	{	
		
		if (!array_key_exists('orig', $kwargs))
		{
			$this->_x = $kwargs['dest']->getX();	
			$this->_y = $kwargs['dest']->getY();	
			$this->_z = $kwargs['dest']->getZ();	
		}	
		else 
		{	$this->_x = $kwargs['dest']->getX() - $kwargs['orig']->getX();	
			$this->_y = $kwargs['dest']->getY() - $kwargs['orig']->getX();	
			$this->_z = $kwargs['dest']->getZ() - $kwargs['orig']->getX();	
		}
	//	if (self::$verbose)
	//		printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s ) constructed\n",
	//			$this->getX(), $this->getY(), $this->getZ(), 
	//			$this->getW(), $this->getColor());
		return ;
	}
	
//	public function __toString()
//	{
//		if (self::$verbose) 
//			return 	sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s )",
//					$this->getX(), $this->getY(), $this->getZ(), 
//					$this->getW(), $this->getColor());
//		else 
//			return 	sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )",
//					$this->getX(), $this->getY(), $this->getZ(), 
//					$this->getW());
//	}

	public function __destruct()
	{
//		if (self::$verbose) 
//			printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s ) destructed\n",
//				$this->getX(), $this->getY(), $this->getZ(), 
//				$this->getW(), $this->getColor());
		return ;
	}

	public static function doc() 
	{
		return file_get_contents('Vector.doc.txt');
	}

	public function getX() { return $this->_x; }
	public function getY() { return $this->_y; }
	public function getZ() { return $this->_z; }
	public function getW() { return $this->_w; }
	 	
	public function magnitude() 
	{
		return sqrt(pow($this->getX(), 2) + pow($this->getY(), 2) + pow($this->getZ(), 2));
	}

	/**************/
	public function normalize() // ADDD the special CASE 
	{
		$normalized = clone $this;
		$normalized->_x	= $normalized->_x / magnitude(); 
		$normalized->_y	= $normalized->_y / magnitude(); 
		$normalized->_z	= $normalized->_z / magnitude(); 
		return $normalized;
	}

	public function add(Vector $rhs) 
	{
		$addition = clone $this;
		$addition->_x	= $addition->_x + $rhs->getX(); 
		$addition->_y	= $addition->_y + $rhs->getY();
		$addition->_z	= $addition->_z + $rhs->getZ();
		return $addition;
	}

	public function sub(Vector $rhs) 
	{
		$addition = clone $this;
		$addition->_x	= $addition->_x - $rhs->getX(); 
		$addition->_y	= $addition->_y - $rhs->getY();
		$addition->_z	= $addition->_z - $rhs->getZ();
		return $addition;
	}

	public function opposite() 
	{
		$opposite = clone $this;
		$opposite->_x	= $opposite->_x * (-1); 
		$opposite->_y	= $opposite->_y * (-1);
		$opposite->_z	= $opposite->_z * (-1);
		return $opposite;
	}

	public function scalarProduct($k)
	{
		$scalar = clone $this;
		$scalar->_x	= $scalar->_x * $k; 
		$scalar->_y	= $scalar->_y * $k;
		$scalar->_z	= $scalar->_z * $k;
		return $scalar;
	}

	public function dotProduct(Vector $rhs)
	{
		return ($this->getX() * $rhs->getX())
		   + ($this->getY() * $rhs->getY())	
		   + ($this->getZ() * $rhs->getZ());
	}

	public function cos(Vector $rhs)
	{
		return $this->dotProduct($rhs) / ($this->magnitude() * $rhs->magnitude());
	}

	public function crossProduct(Vector $rhs)
	{
		$cross = clone $this;
		$cross->_x	= $cross->_x * $k; 
		$cross->_y	= $cross->_y * $k;
		$cross->_z	= $cross->_z * $k;
		return $cross;
	}
}

?>

