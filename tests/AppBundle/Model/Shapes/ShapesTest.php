<?php 
namespace Tests\AppBundle\Model\Shapes;

use AppBundle\Model\Shapes\{Shape,Circle,Rectangle,RightTriangle,EquilateralTriangle,Square,Parall};



class ShapesTest extends \PHPUnit_Framework_TestCase
/**
 * playing around with unit testing to test out the shapes. 
 * This is not perfected but more used as an aide to help with testing. 
 * (so it may seem a bit cluttered :))
 * if the test fails for different values add  the  round 2 function and recheck ....   
 */
{
    public function testCircle()
    {
        $c = new Circle(5);        
        $expectedArea=M_PI * 5 * 5;
        // assert that circle calculated area corrrectly !
        $this->assertEquals($this->round2($expectedArea), $this->round2($c->calcArea())); 
              
       	//resize by factor of 3.5 
        //$this->assertEquals(274.89, $this->round2($c->resize(3.5)));        
         $this->RevSizeScaleTests($c,3.5,$expectedArea);
    }
    
    public function testRectangle() {
    	$length=30.56;
    	$height=100.92;
    	$expectedArea=$length * $height;
    	$expectedPerim=2* ($length + $height);
    	$rect=new Rectangle($length,$height);
    	    	
    	$this->sizeShapeTests($rect,$expectedArea,$expectedPerim);
    	$scalefactor=1110.5656; 
    	$this->RevSizeScaleTests($rect, $scalefactor,$expectedArea);
    	/*
    	$area = $rect->calcArea();    	
    	$this->assertEquals(3,$area);  //area is 3 * 1     	
    	$this->assertEquals(8,$rect->calcPerimeter());  //perim=2* (3+1)
    	*/
    	
    	//resizing proportionally  factor of 2 in this case.
    	
    	//$this->assertEquals(6,$this->round2($rect->resize(2))); //the method sets the dimensions and then returns the recalculated area  	
    	
    	/* not necessary -- had to check something here */
    	/*
    	$expectedHeight=sqrt(2) * 3;    	
    	$this->assertEquals($expectedHeight,$rect->getHeight());
    	$expectedLength=sqrt(2) * 1; //1
    	$this->assertEquals($expectedLength,$rect->getLength());
    	*/
    	/*  end dim assertions */
    	/*
    	$newperim=2* ($expectedHeight + $expectedLength);
    	$this->assertEquals($newperim,$rect->calcPerimeter());
    	*/    	
    	//divide back by 2 to get original area 3
    	
    	//$this->assertEquals(3,$rect->resize(0.5));
    	
    	
    	//just to make sure about proportianal formula * 7 and then / by 7
    	/*
    	$this->assertEquals(21,$rect->resize(7));
    	$this->assertEquals(3,$rect->resize(1/7));
    	$this->assertEquals(3,$rect->calcArea());  //just to make sure of something here;  not needed since the line above return area too.
    	*/
    	
    	
    	
    	//just to make sure about proportianal formula * 25.69 and then / by 1/25.69
    	//$this->assertEquals(21,$rect->resize(25.69));
    	//$this->assertEquals(3,$rect->resize(1/25.69));
    	
    }
    
    
    public function testSquare() {
    	$side=50;
    	$square=new Square($side);    	
    	$expectedArea=$side **2;
    	$expectedPerim=4*$side;    	    	
    	$this->sizeShapeTests($square,$expectedArea,$expectedPerim);
    	$scalefactor=1110.5656;
    	$this->RevSizeScaleTests($square, $scalefactor,$expectedArea);    	
    }
    
    
    public function testParall() {
    	$length=30.56;
    	$height=100.92;
    	$angle=M_PI / 180 * 60; 
    	$parall=new Parall($length,$height,$angle);
    	
    	$expectedArea=$length * $height;
    	$width=$height/sin($angle);
    	$expectedPerim=2* ($width + $length);
    	    	
    	 
    	$this->sizeShapeTests($parall,$expectedArea,$expectedPerim);
    	$scalefactor=1110.5656;
    	$this->RevSizeScaleTests($parall, $scalefactor,$expectedArea);
    	 
    }
    
    
    
    
    public function testRightTriangle() {
    	//define  new triangle with base 3.5 and height 8.9
    	$tri=new RightTriangle(3.5, 8.9);
    	$expectedArea=0.5 * 3.5 *  8.9;
    	$expectedPerimeter= (3.5 +  8.9) + sqrt(3.5**2 + 8.9**2);
    	//$this->assertEquals($expectedArea,$tri->calcArea());
    	$this->sizeShapeTests($tri, $expectedArea, $expectedPerimeter);
    	
    	//lets resize by 7.4
    	
    	$this->RevSizeScaleTests($tri,7.4,$expectedArea);
    	
    	
    	$this->RevSizeScaleTests($tri,0.4,$expectedArea);    	
    	
    }
    
    public function testEqTriangle() {
    	$side=9.76;
    	$eqtri=new EquilateralTriangle($side);
    	$expectedArea=sqrt(3) /4 *  ($side**2);    	
    	$expectedPerimeter= 3* $side;
    	//$this->assertEquals($expectedArea,$tri->calcArea());
    	$this->sizeShapeTests($eqtri, $expectedArea, $expectedPerimeter);
    	 
    	//
    	 
    	$this->RevSizeScaleTests($eqtri,17.4,$expectedArea);
    	 
    	 
    	$this->RevSizeScaleTests($eqtri,19.4,$expectedArea);
    	
    	
    }
    
    
    private function RevSizeScaleTests(Shape $shape,float $scaleFactor,float $origArea) {
    	$newarea=$origArea * $scaleFactor;
    	$this->assertEquals($this->round2($newarea),$this->round2($shape->resize($scaleFactor)));
    	$invScaleFactor=1/$scaleFactor;
    	$this->assertEquals($origArea,$shape->resize($invScaleFactor));
    }
    
    
    
    
    private function sizeShapeTests(Shape $shape,$expectedArea,$expectedPerimeter) {
    	//lets see how passing the interface works
    	$this->assertEquals($expectedArea,$shape->calcArea());
    	$this->assertEquals($expectedPerimeter,$shape->calcPerimeter());
    }
    
    private function round2($number) {
    	return number_format((float)$number, 2, '.', '');
    }
    
}
?>