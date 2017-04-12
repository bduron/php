<?php

require_once 'Vector.class.php';

class Matrix
{
	const IDENTITY = 0;
	const SCALE = 1;
	const RX = 2;
	const RY = 3;
	const RZ = 4;
	const TRANSLATION = 5;
	const PROJECTION = 6;	

	private $_matrix;

	public static $verbose = FALSE; 

	public function __construct(array $kwargs)
	{
		if (key_exists('preset', $kwargs))
		{
			if ($kwargs['preset'] == self::IDENTITY)		
			{
				$this->_matrix = [	[1, 0, 0, 0],
									[0, 1, 0, 0],
									[0, 0, 1, 0],
									[0, 0, 0, 1]	];
				if (self::$verbose)
					printf("Matrix IDENTITY instance constructed\n", $this);
			}
			elseif ($kwargs['preset'] == self::TRANSLATION)
			{
				$this->_matrix = [	[1, 0, 0, $kwargs['vtc']->getX()],
									[0, 1, 0, $kwargs['vtc']->getY()],
									[0, 0, 1, $kwargs['vtc']->getZ()],
									[0, 0, 0, 1]	];
				if (self::$verbose)
					printf("Matrix TRANSLATION preset instance constructed\n", $this);
			}	
			elseif ($kwargs['preset'] == self::SCALE)
			{
				$this->_matrix = [	[1 * $kwargs['scale'], 0, 0, 0],
									[0, 1 * $kwargs['scale'], 0, 0],
									[0, 0, 1 * $kwargs['scale'], 0],
									[0, 0, 0, 1]	];
				if (self::$verbose)
					printf("Matrix SCALE preset instance constructed\n", $this);
			}	
			elseif ($kwargs['preset'] == self::RX)
			{
				$this->_matrix = [	[1, 0, 0, 0],
									[0, cos($kwargs['angle']), -sin($kwargs['angle']), 0],
									[0, sin($kwargs['angle']), cos($kwargs['angle']), 0],
									[0, 0, 0, 1]	];
				if (self::$verbose)
					printf("Matrix Ox ROTATION preset instance constructed\n", $this);
			}	
			elseif ($kwargs['preset'] == self::RY)
			{
				$this->_matrix = [	[cos($kwargs['angle']), 0, sin($kwargs['angle']), 0],
									[0, 1, 0, 0],
									[-sin($kwargs['angle']), 0, cos($kwargs['angle']), 0],
									[0, 0, 0, 1]	];
				if (self::$verbose)
					printf("Matrix Oy ROTATION preset instance constructed\n", $this);
			}	
			elseif ($kwargs['preset'] == self::RZ)
			{
				$this->_matrix = [	[cos($kwargs['angle']), -sin($kwargs['angle']), 0, 0],
									[sin($kwargs['angle']), cos($kwargs['angle']), 0, 0],
									[0, 0, 1, 0],
									[0, 0, 0, 1]	];
				if (self::$verbose)
					printf("Matrix Oz ROTATION preset instance constructed\n", $this);
			}	
			elseif ($kwargs['preset'] == self::PROJECTION)
			{
				$scale = 1 / tan($kwargs['fov'] * 0.5 * M_PI / 180);

				$this->_matrix = [	[$scale / $kwargs['ratio'], 0, 0, 0],
									[0, $scale, 0, 0],
									[0, 0, -($kwargs['far'] + $kwargs['near']) / ($kwargs['far'] - $kwargs['near']),
								   	(-2 * $kwargs['far'] * $kwargs['near']) / ($kwargs['far'] - $kwargs['near'])],
									[0, 0, -1, 0]	];
				if (self::$verbose)
					printf("Matrix PROJECTION preset instance constructed\n", $this);
			}	
		}			
		return ;
	}

	public function __toString()
	{
		return 	sprintf("M | vtcX | vtcY | vtcZ | vtxO\n".
						"-----------------------------\n".
						"x | %.2f | %.2f | %.2f | %.2f\n".
						"y | %.2f | %.2f | %.2f | %.2f\n".
						"z | %.2f | %.2f | %.2f | %.2f\n".
						"w | %.2f | %.2f | %.2f | %.2f", 
						$this->_matrix[0][0], $this->_matrix[0][1], $this->_matrix[0][2], $this->_matrix[0][3],
						$this->_matrix[1][0], $this->_matrix[1][1], $this->_matrix[1][2], $this->_matrix[1][3],
						$this->_matrix[2][0], $this->_matrix[2][1], $this->_matrix[2][2], $this->_matrix[2][3],
						$this->_matrix[3][0], $this->_matrix[3][1], $this->_matrix[3][2], $this->_matrix[3][3]);
	}

	public function __destruct()
	{
		if (self::$verbose)
			print("Matrix instance destructed\n");
		return ;
	}

	public static function doc() 
	{
		return file_get_contents('Matrix.doc.txt');
	}

	public function getMatrix() { return $this->_matrix; }
	
	public function mult(Matrix $rhs)
    {
        $new_matrix = clone $this;
        $new_matrix->_matrix = [   [  $this->getMatrix()[0][0] * $rhs->getMatrix()[0][0] + $this->getMatrix()[0][1] * $rhs->getMatrix()[1][0] + $this->getMatrix()[0][2] * $rhs->getMatrix()[2][0] + $this->getMatrix()[0][3] * $rhs->getMatrix()[3][0],
                                        $this->getMatrix()[0][0] * $rhs->getMatrix()[0][1] + $this->getMatrix()[0][1] * $rhs->getMatrix()[1][1] + $this->getMatrix()[0][2] * $rhs->getMatrix()[2][1] + $this->getMatrix()[0][3] * $rhs->getMatrix()[3][1],
                                        $this->getMatrix()[0][0] * $rhs->getMatrix()[0][2] + $this->getMatrix()[0][1] * $rhs->getMatrix()[1][2] + $this->getMatrix()[0][2] * $rhs->getMatrix()[2][2] + $this->getMatrix()[0][3] * $rhs->getMatrix()[3][2],
                                        $this->getMatrix()[0][0] * $rhs->getMatrix()[0][3] + $this->getMatrix()[0][1] * $rhs->getMatrix()[1][3] + $this->getMatrix()[0][2] * $rhs->getMatrix()[2][3] + $this->getMatrix()[0][3] * $rhs->getMatrix()[3][3] ],
                                [  $this->getMatrix()[1][0] * $rhs->getMatrix()[0][0] + $this->getMatrix()[1][1] * $rhs->getMatrix()[1][0] + $this->getMatrix()[1][2] * $rhs->getMatrix()[2][0] + $this->getMatrix()[1][3] * $rhs->getMatrix()[3][0],
                                        $this->getMatrix()[1][0] * $rhs->getMatrix()[0][1] + $this->getMatrix()[1][1] * $rhs->getMatrix()[1][1] + $this->getMatrix()[1][2] * $rhs->getMatrix()[2][1] + $this->getMatrix()[1][3] * $rhs->getMatrix()[3][1],
                                        $this->getMatrix()[1][0] * $rhs->getMatrix()[0][2] + $this->getMatrix()[1][1] * $rhs->getMatrix()[1][2] + $this->getMatrix()[1][2] * $rhs->getMatrix()[2][2] + $this->getMatrix()[1][3] * $rhs->getMatrix()[3][2],
                                        $this->getMatrix()[1][0] * $rhs->getMatrix()[0][3] + $this->getMatrix()[1][1] * $rhs->getMatrix()[1][3] + $this->getMatrix()[1][2] * $rhs->getMatrix()[2][3] + $this->getMatrix()[1][3] * $rhs->getMatrix()[3][3] ],
                                [  $this->getMatrix()[2][0] * $rhs->getMatrix()[0][0] + $this->getMatrix()[2][1] * $rhs->getMatrix()[1][0] + $this->getMatrix()[2][2] * $rhs->getMatrix()[2][0] + $this->getMatrix()[2][3] * $rhs->getMatrix()[3][0],
                                        $this->getMatrix()[2][0] * $rhs->getMatrix()[0][1] + $this->getMatrix()[2][1] * $rhs->getMatrix()[1][1] + $this->getMatrix()[2][2] * $rhs->getMatrix()[2][1] + $this->getMatrix()[2][3] * $rhs->getMatrix()[3][1],
                                        $this->getMatrix()[2][0] * $rhs->getMatrix()[0][2] + $this->getMatrix()[2][1] * $rhs->getMatrix()[1][2] + $this->getMatrix()[2][2] * $rhs->getMatrix()[2][2] + $this->getMatrix()[2][3] * $rhs->getMatrix()[3][2],
                                        $this->getMatrix()[2][0] * $rhs->getMatrix()[0][3] + $this->getMatrix()[2][1] * $rhs->getMatrix()[1][3] + $this->getMatrix()[2][2] * $rhs->getMatrix()[2][3] + $this->getMatrix()[2][3] * $rhs->getMatrix()[3][3] ],
                                [  $this->getMatrix()[3][0] * $rhs->getMatrix()[0][0] + $this->getMatrix()[3][1] * $rhs->getMatrix()[1][0] + $this->getMatrix()[3][2] * $rhs->getMatrix()[2][0] + $this->getMatrix()[3][3] * $rhs->getMatrix()[3][0],
                                        $this->getMatrix()[3][0] * $rhs->getMatrix()[0][1] + $this->getMatrix()[3][1] * $rhs->getMatrix()[1][1] + $this->getMatrix()[3][2] * $rhs->getMatrix()[2][1] + $this->getMatrix()[3][3] * $rhs->getMatrix()[3][1],
                                        $this->getMatrix()[3][0] * $rhs->getMatrix()[0][2] + $this->getMatrix()[3][1] * $rhs->getMatrix()[1][2] + $this->getMatrix()[3][2] * $rhs->getMatrix()[2][2] + $this->getMatrix()[3][3] * $rhs->getMatrix()[3][2],
                                        $this->getMatrix()[3][0] * $rhs->getMatrix()[0][3] + $this->getMatrix()[3][1] * $rhs->getMatrix()[1][3] + $this->getMatrix()[3][2] * $rhs->getMatrix()[2][3] + $this->getMatrix()[3][3] * $rhs->getMatrix()[3][3]] ];
        return ($new_matrix);
    }

	public function transformVertex(Vertex $vtx)
    {
        return new Vertex([ 'x' => $this->_matrix[0][0] * $vtx->getX() + $this->_matrix[0][1] * $vtx->getY() + $this->_matrix[0][2] * $vtx->getZ() + $this->_matrix[0][3] * $vtx->getW(), 
                            'y' => $this->_matrix[1][0] * $vtx->getX() + $this->_matrix[1][1] * $vtx->getY() + $this->_matrix[1][2] * $vtx->getZ() + $this->_matrix[1][3] * $vtx->getW(), 
                            'z' => $this->_matrix[2][0] * $vtx->getX() + $this->_matrix[2][1] * $vtx->getY() + $this->_matrix[2][2] * $vtx->getZ() + $this->_matrix[2][3] * $vtx->getW(),
                            'w' => $this->_matrix[3][0] * $vtx->getX() + $this->_matrix[3][1] * $vtx->getY() + $this->_matrix[3][2] * $vtx->getZ() + $this->_matrix[3][3] * $vtx->getW(),
                            'color' => $vtx->getColor()]);
    }

	public function transposeMatrix()
	{
		$tMtx = clone $this;

		$tMtx->_matrix = [	[ $this->_matrix[0][0], $this->_matrix[1][0], $this->_matrix[2][0], $this->_matrix[3][0]], 
							[ $this->_matrix[0][1], $this->_matrix[1][1], $this->_matrix[2][1], $this->_matrix[3][1]], 
							[ $this->_matrix[0][2], $this->_matrix[1][2], $this->_matrix[2][2], $this->_matrix[3][2]], 
							[ $this->_matrix[0][3], $this->_matrix[1][3], $this->_matrix[2][3], $this->_matrix[3][3]] ];
		return $tMtx;
	}
}

?>
