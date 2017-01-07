<?php
namespace AppBundle\Model\Shapes;

class Circle implements  Shape {
	protected $radius;

	function __construct(float $radius) {
		$this->radius=$radius;
	}
	function calcArea() {
		return M_PI * ($this->radius ** 2);
	}
	function calcPerimeter() {
		return 2* M_1_PI * $this->radius;
	}
	function resize(float $factor) {
		$newarea=$this->calcArea() * $factor;
		$this->radius = sqrt($newarea / M_PI);
	}
}
