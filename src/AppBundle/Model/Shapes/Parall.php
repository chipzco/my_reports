<?php
namespace AppBundle\Model\Shapes;

class Parall extends GenericScalingFactorShape implements Shape {
	/** specify the parallelogram with just the length (base), height and acute angle of slant or diagonal sides (in radians)
	 * 
	 * 
	 */
	
	protected $side; //the diagonal /slant sides 
	
	function __construct($length, $height, $angle) {
		parent::__construct($length, $height);
		$this->side=$this->height/sin($angle);
	}
	
	
	function calcArea(): float {
		return $this->height * $this->length;
	}
	function calcPerimeter(): float {
		return 2 * ($this->length + $this->side);
	}
	function resize(float $factor): float {
		parent::reCalcDim($factor);
		return $this->calcArea();
	}		
}