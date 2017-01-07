<?php 
namespace Tests\AppBundle\Model\Circle;

use AppBundle\Model\Shapes\Circle;

class ShapesTest extends \PHPUnit_Framework_TestCase
{
    public function testCircle()
    {
        $c = new Circle(5);
        $area = $c->calcArea();
        // assert that your calculator added the numbers correctly!
        $this->assertEquals(78.54, $this->round2($area));
    }
    
    private function round2($number) {
    	return number_format((float)$number, 2, '.', '');
    }
    
}
?>