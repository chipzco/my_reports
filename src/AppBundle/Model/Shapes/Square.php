<?php
namespace AppBundle\Model\Shapes;

class Square extends Rectangle  {
	function __construct(float $side) {
		parent::__construct($side, $side);
	}	
}