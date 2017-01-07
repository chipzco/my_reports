<?php 
namespace AppBundle\Model\Shapes;

class EquilateralTriangle extends RightTriangle  {
	function __construct(float $side) {
		$this->length=$side; 	
		$this->diagonal=$side;
		$this->height=sqrt($side**2 - ($side/2)**2);
	}	
	function calcPerimeter(): float {
		return $this->side *3;
	}
	
}

?>