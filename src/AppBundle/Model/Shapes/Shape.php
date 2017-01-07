<?php
namespace AppBundle\Model\Shapes;
/** public interface representing a shape that exposes 3 public methods to any class 
 * the class need not have  knowledge of what type of shape is passed.   
  **/
interface Shape {
	function calcArea();
	function calcPerimeter();
	function resize(float $factor);
}