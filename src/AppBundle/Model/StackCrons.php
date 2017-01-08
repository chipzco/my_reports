<?php
namespace AppBundle\Model;
use \SplStack;
 
 class StackCrons {

	static function createStack(): \SplStack {
		$stack = new SplStack();
			
		$cron1=new CronJob(1,"My First Job");
			
		$cron2=new CronJob(2,"My Second Job");
			
		$stack->push($cron1);
		$stack->push($cron2);
			
			
			
		$stack->rewind();
		while($stack->valid()){
			var_dump($stack->current());
			$stack->next();
		}
		return $stack;
	}
}
