<?php
namespace AppBundle\Model\Shapes;

class RightTriangle extends GenericScalingFactorShape implements  Shape {
	protected $diagonal;	
	function __construct(float $base, float $height) {
		parent::__construct($base, $height);
		$this->setDiagonal();		
	}	
	protected function setDiagonal() {		
		$this->diagonal=sqrt($this->length**2  +  $this->height**2);		
	}
	function calcArea(): float {
		return (0.5 * $this->height * $this->length) ;
	}
	function calcPerimeter(): float {
		return $this->length +  $this->height + $this ->diagonal;
	}	
	
	function resize(float $factor): float {		
		parent::reCalcDim($factor);
		$this->setDiagonal();
		return $this->calcArea(); //should be equal to factor * old area 
	}	
	
	function getBase(): float {
		return $this->length;  //the length is the base;
	}
}