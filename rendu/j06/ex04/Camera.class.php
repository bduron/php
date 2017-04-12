<?php

require_once 'Matrix.class.php';

class Camera
{
	private $_vtxO;
	private $_v;
	private $_oppv;
	private $_T;
	private $_tT;
	private $_R;
	private $_tR;
	private $_viewMatrix;
	private $_proj;
	private $_width;
	private $_height;

	public static $verbose = FALSE; 

	public function __construct(array $kwargs)
	{
		$this->_width = $kwargs['width'];
		$this->_height = $kwargs['height'];
		$this->_vtxO = $kwargs['origin']; 
		$this->_v = new Vector(['dest' => $kwargs['origin']]);  
		$this->_oppv = $this->_v->opposite();  
		$this->_T = new Matrix(['preset' => Matrix::TRANSLATION, 'vtc' => $this->_v]);	
		$this->_tT = new Matrix(['preset' => Matrix::TRANSLATION, 'vtc' => $this->_oppv]);	
		$this->_R = $kwargs['orientation'];
		$this->_tR = $this->_R->transposeMatrix(); 
		$this->_viewMatrix = $this->_tR->mult($this->_tT);
		if (key_exists('ratio', $kwargs))
			$ratio = $kwargs['ratio'];
		else 
			$ratio = $kwargs['width'] / $kwargs['height'];
		$this->_proj = new Matrix(['preset' => Matrix::PROJECTION, 'fov' => $kwargs['fov'], 'ratio' => $ratio, 'far' => $kwargs['far'], 'near' => $kwargs['near']]);
			
		if (self::$verbose)
			printf("Camera instance constructed\n", $this);
		return ;
	}

	public function __toString()
	{
		return 	sprintf("Camera( \n+ Origine: %s\n+ tT:\n%s\n+ tR:\n%s\n+ tR->mult( tT ):\n%s\n+ Proj:\n%s\n)", 
			$this->_vtxO, $this->_tT, $this->_tR, $this->_viewMatrix, $this->_proj);
	}

	public function __destruct()
	{
		if (self::$verbose)
			printf("Camera instance destructed\n", $this);
		return ;
	}

	public static function doc() 
	{
		return file_get_contents('Camera.doc.txt');
	}
	
	public function watchVertex(Vertex $worldVertex)
	{
		$viewProjectionMatrix = $this->_proj->mult($this->_viewMatrix); 		
		$worldVertex = $viewProjectionMatrix->transformVertex($worldVertex);
		$winX =  (($worldVertex->getX() + 1) / 2.0) * $this->_width; 
		$winY =  ((1 - $worldVertex->getY()) / 2.0) * $this->_height; 
		
		return new Vertex(['x' => $winX, 'y' => $winY, 'z' => $worldVertex->getZ(), 'color' => $worldVertex->getColor(), 'w' => $worldVertex->getW()]);
	}
}

?>
