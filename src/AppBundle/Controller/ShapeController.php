<?php
namespace AppBundle\Controller;
use AppBundle\Model\Shapes\Circle;
use AppBundle\Model\CronJob;
use AppBundle\Model\StackCrons;
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
	 * @Route("/shape/stackstart", name="stackstart")
	 */
	public function stackAction(Request $request)
	{
		
		$mystack=StackCrons::createStack($request);
		return $this->render('shape/stack.html.twig', array('mystack'=>$mystack));
	}	
	
	/**
	 * @Route("/shape/jobstart", name="jobstart")
	 */
	public function jobstartAction(Request $request) {
		$mystack=StackCrons::startJob($request);
		return $this->render('shape/stack.html.twig', array('mystack'=>$mystack));
	}
	
	
	/**
	 * @Route("/stack/view", name="stackview")
	 */
	public function stackviewAction(Request $request) {
		$mystack=StackCrons::getStack($request);
		$myrunstack=StackCrons::getRunningStack($request);
		return $this->render('shape/stackview.html.twig', array('crons'=>$mystack,'jobs'=>$myrunstack));
	}
	
	
}