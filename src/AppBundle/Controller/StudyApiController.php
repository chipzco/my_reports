<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Chme\RestBundle\Controller\RestController;
use AppBundle\Entity\Study;
use AppBundle\Model\EntityParseError;

class StudyApiController extends RestController {
	/**
	 * @Route("/api/study/{id}", name="Api_study_by_id", requirements={"id": "\d+"} )
	 */
	public function defaultAction($id=0) {
		
		return parent::indexAction($id);
	}
	
	/**
	 * @Route("/api/study/", name="Api_study_Noid" )
	 */
	public function defaultNoIdAction() {
		return parent::indexAction();
	}
	
	protected function GET_PAG(Request $request,$Id=null) {		
		$t['Id']=$Id;
		$study = $this->getDoctrine()->getRepository('AppBundle:Study')->find($Id);
		if (!$study) {
			$errObj=new EntityParseError();
			$errObj->setError('No study found for id '.$Id);
			$errObj->setObjectInstance($t);
			return JsonResponse::create($errObj->serializeSendBack(),RESPONSE::HTTP_NOT_FOUND);
		}
		$study->convDates();
		$t['data']=$study;
		return $this->json($t);
	}
	
	protected function LIST_PAG(Request $request) {		
		$studys=$this->getDoctrine()->getRepository("AppBundle:Study")->findAll();
		foreach ($studys as $s) {
			$s->convDates();			
		}
		$resp['data']=$studys;
		$bu=$this->get('app.api.video_bu');
		return new JsonResponse($bu->getSerializedJson($resp),RESPONSE::HTTP_OK,[],true);		
	}
	
	protected function POST_PAG(Request $request,$Id=null) {		
		$errObj=$this->setstudy($this->getContentJson($request));		
		if (!$errObj->isValid()) 
			return JsonResponse::create($errObj->serializeSendBack(),RESPONSE::HTTP_UNPROCESSABLE_ENTITY);
		$study=$errObj->getObjectInstance();		
		$em = $this->getDoctrine()->getManager();
		$em->persist($study);
		$em->flush();
		$study->convDates();
		return $this->json($study);
	}
	
	
	protected function PUT_PAG(Request $request,$Id=null) {		
		$errObj=$this->setstudy($this->getContentJson($request));	
		if (!$errObj->isValid())		
			return JsonResponse::create($errObj->serializeSendBack(),RESPONSE::HTTP_BAD_REQUEST);	
		$study=$errObj->getObjectInstance();
		$em = $this->getDoctrine()->getManager();
		$em->flush();		
		$study->convDates();
		return $this->json($study);
	}
	
	protected function setstudy($study_data) {
		$errObj=new EntityParseError();		
		if (is_array($study_data)) {
			$bu = $this->get('app.api.video_bu');
			$study=$bu->setStudy($this->getDoctrine()->getRepository("AppBundle:Study"),$study_data);
			$errObj->setObjectInstance($study);
			$bu->validateStudy($errObj);			
		}
		else {
			$errObj->setError("no data array passed");
		}
		return $errObj;
	}
	
	
	protected function DELETE_PAG(Request $request,$Id=null) {
		$em = $this->getDoctrine()->getManager();		
		$study = $this->getDoctrine()->getRepository('AppBundle:Study')->find($Id);		
		if (!$study) {
			$t['exception']='No study found for id '.$Id;
			return JsonResponse::create($t,RESPONSE::HTTP_NOT_FOUND);
		}
		$em->remove($study);
		$em->flush();		
		return $this->json($study);
	}
	
}