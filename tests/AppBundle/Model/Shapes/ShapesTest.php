<?php 
namespace Tests\AppBundle\Model\Circle;

use AppBundle\Model\Shapes\Circle;
use AppBundle\Model\Shapes\Rectangle;

class ShapesTest extends \PHPUnit_Framework_TestCase
{
    public function testCircle()
    {
        $c = new Circle(5);        
        // assert that circle calculated area corrrectly !
        $this->assertEquals(78.54, $this->round2($c->calcArea())); 
              
        $this->assertEquals(274.89, $this->round2($c->resize(3.5)));        
        
    }
    
    public function testRectangle() {    	
    	$rect=new Rectangle(1,3);
    	$area = $rect->calcArea();
    	$this->assertEquals(3,$area);    	
    	
    	//resizing proportionally 
    	$newarea=$rect->resize(2);    	
    	$this->assertEquals(6,$newarea);
    	$this->assertEquals(6,$rect->calcArea());
    	
    	
    	
    	
    	
    	
    	$expectedHeight=sqrt(2) * 3;    	
    	$this->assertEquals($expectedHeight,$rect->getHeight());
    	$expectedLength=sqrt(2) * 1; //1
    	$this->assertEquals($expectedLength,$rect->getLength());
    	
    	
    	
    }
    
    
    private function round2($number) {
    	return number_format((float)$number, 2, '.', '');
    }
    
}
?>