<?php
namespace AppBundle\Controller;
use AppBundle\Model\EntityParseError;
use Chme\RestBundle\Controller\RestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;


abstract class RestAbsController extends RestController {
	
	protected function returnJsonError(int $r,string $s,bool $isJson=false,EntityParseError $e=null) {		
		if (!$e) {
			$e=new EntityParseError();
			$e->setError($s);
		}
		elseif ($e->isValid()) {
			//otherwise no need to set the string unless error flag is not set (so do not pass object and expect the string to be set)		
			$e->setError($s);			
		}
		return new JsonResponse($e->serializeSendBack(),$r,[],$isJson);
	}
	protected function returnSerializedJsonData(int $statusCode,$object) {
		$bu=$this->get('app.api.video_bu');
		return new JsonResponse($bu->getSerializedJson($object),$statusCode,[],true);
	}
	
}