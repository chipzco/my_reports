<?php
namespace AppBundle\Model\Shapes;



abstract class GenericScalingFactorShape {
/**   Generic shape with two dimensions/associated properties
	   and implementation of setting these dimensions proportionally  when area is scaled by a factor
**/
	
	protected $length;
	protected $height;
	
	
	function __construct(float $length, float $height) {		
		$this->length=$length;
		$this->height=$height;			
	}
	
	
	protected function reCalcDim(float $scalingfactor) {
		/**  for rectangles triangles paralleograms if the area is scaled by a factor 
		 *   the dimensions (lenght/height) are scaled by square root of that factor.  
		 *   
		 */
		 $dimensionScalingFactor=sqrt($scalingfactor);  
		 $this->height *=$dimensionScalingFactor;
		 $this->length *=$dimensionScalingFactor;
	}	
	
	public function getLength(): float {
		return $this->length;
	}
	public function getHeight(): float {
		return $this->height;
	}
}