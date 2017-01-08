<?php
namespace AppBundle\Controller;
use AppBundle\Model\Shapes\Circle;
use AppBundle\Model\{CronJob,StackCrons};
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class ShapeController extends Controller {
	/**
	 * @Route("/shape/view", name="shapeview")
	 */
	public function viewAction(Request $request)
	{
		$shape=new Circle(10.9);
		return $this->render('shape/view.html.twig', array('shape'=>$shape));
	}
	
	
	/**
	 * @Route("/shape/stack", name="stackview")
	 */
	public function stackAction(Request $request)
	{
		
		$mystack=StackCrons::createStack();
		return $this->render('shape/stack.html.twig', array('mystack'=>$mystack));
	}
	
	
}