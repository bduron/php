<?php

require_once 'Vertex.class.php';

class Vector
{
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 0.0;

	public static $verbose = FALSE; 

	public function __construct(array $kwargs)
	{
		$this->_dest = $kwargs['dest'];

		$_orig = (key_exists('orig', $kwargs)) ? $kwargs['orig'] 
			: new Vertex( array('x' => 0, 'y' => 0, 'z' => 0) );

		$this->_x = $this->_dest->getX() - $_orig->getX();
		$this->_y = $this->_dest->getY() - $_orig->getY();
		$this->_z = $this->_dest->getZ() - $_orig->getZ();
		$this->_w = 0;
		if (self::$verbose)
			printf("%s constructed\n", $this);
		return ;
	}

	public function __toString()
	{
		return 	sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )",
			$this->getX(), $this->getY(), $this->getZ(), $this->getW());
	}

	public function __destruct()
	{
		if (self::$verbose)
			printf("%s destructed\n", $this);
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

	public function normalize()
	{
		$vtx = new Vertex( array('x' => ($this->getX() / $this->magnitude()), 
			'y' => ($this->getY() / $this->magnitude()), 
			'z' => ($this->getZ() / $this->magnitude())) );

		return (new Vector( array('dest' => $vtx) ));
	}

	public function add(Vector $rhs) 
	{
		$vtx = new Vertex( array('x' => ($this->getX() + $rhs->getX()), 
			'y' => ($this->getY() + $rhs->getY()), 
			'z' => ($this->getZ() + $rhs->getZ())) );

		return (new Vector( array('dest' => $vtx) ));
	}

	public function sub(Vector $rhs) 
	{
		$vtx = new Vertex( array('x' => ($this->getX() - $rhs->getX()), 
			'y' => ($this->getY() - $rhs->getY()), 
			'z' => ($this->getZ() - $rhs->getZ())) );

		return (new Vector( array('dest' => $vtx) ));
	}

	public function opposite() 
	{
		$vtx = new Vertex( array('x' => (-1 * $this->getX()), 
			'y' => (-1 * $this->getY()), 
			'z' => (-1 * $this->getZ())) );

		return (new Vector( array('dest' => $vtx) ));
	}

	public function scalarProduct($k)
	{
		$vtx = new Vertex( array('x' => ($k * $this->getX()), 
			'y' => ($k * $this->getY()), 
			'z' => ($k * $this->getZ())) );

		return (new Vector( array('dest' => $vtx) ));
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
		$vtx = new Vertex( array('x' => ($this->getY() * $rhs->getZ() - $this->getZ() * $rhs->getY()), 
			'y' => ($this->getZ() * $rhs->getX() - $this->getX() * $rhs->getZ()), 
			'z' => ($this->getX() * $rhs->getY() - $this->getY() * $rhs->getX())) );

		return (new Vector( array('dest' => $vtx) ));
	}
}

?>
