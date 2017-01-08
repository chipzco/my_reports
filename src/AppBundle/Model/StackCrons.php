<?php
namespace AppBundle\Model;
use Symfony\Component\HttpFoundation\Request;
use \SplStack;
use SplDoublyLinkedList;
use Symfony\Component\HttpFoundation\Session\Session;
 
 class StackCrons {

	static function createStack(Request $request): \SplStack {
		$stack = new SplStack();
			
		$cron1=new CronJob(1,"My First Job");
			
		$cron2=new CronJob(2,"My Second Job");
			
		$stack->push($cron1);
		$stack->push($cron2);
		
		
			
		$stack->rewind();
		
		/*
		while($stack->valid()){
			var_dump($stack->current());
			$stack->next();
		}*/
		
		$runningstack=new SplDoublyLinkedList();
		
		$session = $request->getSession();		
		$session->set('cronstack', $stack);
		$session->set('runningcronstack', $runningstack);		
		return $stack;
	}
	
	static function getStack(Request $request): \SplStack  {
		$session = $request->getSession();
		return $session->get('cronstack');		
	}
	
	static function getRunningStack(Request $request): \SplDoublyLinkedList  {
		$session = $request->getSession();
		return $session->get('runningcronstack');			
	}
	static function startJob(Request $request): \SplDoublyLinkedList {
		$session = $request->getSession();
		$mystack=$session->get('cronstack');
		$runningstack=$session->get('runningcronstack');
		if ($mystack->count() > 0) {
			$myjob=$mystack->pop();
			$myjob->setStart();
			$runningstack->push($myjob);			
		}		
		return $runningstack;
	}	
}
