<?php
namespace AppBundle\Model\Shapes;

class Circle implements  Shape {
	protected $radius;

	function __construct(float $radius)  {
		$this->radius=$radius;
	}
	function calcArea(): float {
		return M_PI * ($this->radius ** 2);
	}
	function calcPerimeter(): float {
		return 2* M_1_PI * $this->radius;
	}
	function resize(float $factor): float {
		$newarea=$this->calcArea() * $factor;
		$this->radius = sqrt($newarea / M_PI);
		return $this->calcArea();
	}
	
	function getDiameter(): float {
		return 2*$this->radius;
	}
			
}
