<?php
namespace AppBundle\Model\Shapes;

interface Shape {
	function calcArea();
	function calcPerimeter();
	function resize(float $factor);
}