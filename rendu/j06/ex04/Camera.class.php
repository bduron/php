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

	public static $verbose = FALSE; 

	public function __construct(array $kwargs)
	{
		$this->_vtxO = $kwargs['origin']; 
		$this->_v = new Vector(['dest' => $kwargs['origin']]);  
		$this->_oppv = $this->_v->opposite();  
		$this->_T = new Matrix(['preset' => Matrix::TRANSLATION, 'vtc' => $this->_v]);	
		$this->_tT = new Matrix(['preset' => Matrix::TRANSLATION, 'vtc' => $this->_oppv]);	
		$this->_R = $kwargs['orientation'];
		$this->_tR = $this->_R->transposeMatrix(); 
		$this->_viewMatrix = $this->_tR->mult($this->_tT);
		$this->_proj = new Matrix([ , , ,]);
			
		if (self::$verbose)
			printf("Camera instance constructed\n", $this);
		return ;
	}

	public function __toString()
	{
		return 	sprintf("Camera(\n+ Origine: %s\n+ tT: %s\n+ tR: %s\n+ tR->mult( tT ):\n%s", $this->_vtxO, $this->_tT, $this->_tR, $this->_viewMatrix );
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


}

?>
