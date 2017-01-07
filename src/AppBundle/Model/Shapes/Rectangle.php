<?php
namespace AppBundle\Model\Shapes;

class Rectangle extends GenericScalingFactorShape implements  Shape {
	function calcArea(): float {
		return $this->height * $this->length;
	}
	function calcPerimeter(): float {
		return 2 * ($this->length + $this->height);
	}
	function resize(float $factor): float {	
		parent::reCalcDim($factor);		
		return $this->calcArea();
	}	
}