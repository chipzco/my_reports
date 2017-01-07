<?php
	namespace AppBundle\Model\Shapesmessed;
	
	
	
	interface Shape {
		function calcArea();
		function calcPerimeter();
		function resize(float $factor);		
	}
	
	class Circle implements  Shape {
		protected $radius;		
		
		function ___construct(float $radius) {
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