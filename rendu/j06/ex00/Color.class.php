<?php

class Color 
{
	public $red = 0;
	public $green = 0;
	public $blue = 0;

	public static $verbose = FALSE; 

	public function __construct(array $kwargs)	
	{
		if (array_key_exists('rgb', $kwargs))
		{
			$this->red = (0xFF0000 & intval($kwargs['rgb'])) >> 16;
			$this->green = (0x00FF00 & intval($kwargs['rgb'])) >> 8;
			$this->blue = (0x0000FF & intval($kwargs['rgb']));
		}
		else // Check if the 3 key exists ? 
		{
			$this->red = intval($kwargs['red']);	
			$this->green = intval($kwargs['green']);	
			$this->blue = intval($kwargs['blue']);	
		}	
		if (self::$verbose) 
			print('Color( red:   0, green:   0, blue: 255 ) constructed.'.PHP_EOL);
	}
	
	public function __toString()
	{
		return 'darkgrey: Color( red:  10, green:  10, blue:  10 )';	
	}

	public function __destruct()
	{
		if (self::$verbose) 
			return 'darkgrey: Color( red:  10, green:  10, blue:  10 )';	
	}

	public static function doc() 
	{
		return file_get_contents('Color.doc.txt');
	}

	public function add(Color $color) 
	{
		return new Color(array(
			'red' => $this->red + $color->red, 
			'green' => $this->green + $color->green, 
			'blue' => $this->blue + $color->blue));
	}
		
	public function sub(Color $color) 
	{
		return new Color(array(
			'red' => $this->red - $color->red, 
			'green' => $this->green - $color->green, 
			'blue' => $this->blue - $color->blue));
	}

	public function mult(int $f) 
	{
		return new Color(array(
			'red' => $this->red * $f, 
			'green' => $this->green * $f, 
			'blue' => $this->blue * $f));
	}
}



?>
