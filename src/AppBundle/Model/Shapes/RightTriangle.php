<?php
namespace AppBundle\Model\Shapes;

class RightTriangle extends GenericScalingFactorShape implements  Shape {
	protected $diagonal;
	
	function __construct($length, $height) {
		parent::__construct($length, $height);
		$this->diagonal=sqrt($length *$height);
	}
	
	
	function calcArea(): float {
		return ($this->height * $this->length)  /2;
	}
	function calcPerimeter(): float {
		return $this->length +  $this->height +$this ->diagonal;
	}	
	
	function resize(float $factor): float {		
		parent::reCalcDim($factor);
		$this->diagonal=sqrt($length *$height);
		return $this->calcArea(); //should be equal to factor * old area 
	}
}