<?php
namespace AppBundle\Model\Shapes;

class Rectangle extends Parall {
	function __construct($length, $height) {
		$radangle=M_PI /180 * 90;  //a rectangle is a parallelogram with 90 degree angle.
		parent::__construct($length, $height,$radangle);
	}
}