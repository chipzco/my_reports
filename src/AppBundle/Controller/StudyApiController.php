<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Chme\RestBundle\Controller\RestController;
use AppBundle\Entity\Study;

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
			$t['exception']='No study found for id '.$Id;
			return JsonResponse::create($t,RESPONSE::HTTP_NOT_FOUND);
		}
		$t['data']=$study;
		return $this->json($t);
	}
	
	protected function LIST_PAG(Request $request) {		
		$studys=$this->getDoctrine()->getRepository("AppBundle:Study")->findAll(); 
		$resp['data']=$studys;
		//$serializer = $this->get('serializer');
		//$json =$serializer->serialize($resp);
		return $this->json($resp);
	}
	
	protected function POST_PAG(Request $request,$Id=null) {		
		$study=$this->setstudy($this->getContentJson($request));
		if (!(strlen($study->getProtocol()) > 0 )) {
			$t['exception']='No protocol set ';
			return JsonResponse::create($t,RESPONSE::HTTP_UNPROCESSABLE_ENTITY);
		}
		$em = $this->getDoctrine()->getManager();
		$em->persist($study);
		$em->flush();
		return $this->json($study);
	}
	
	
	protected function PUT_PAG(Request $request,$Id=null) {		
		$study=$this->setstudy($this->getContentJson($request));
		if (!(strlen($study->getProtocol()) > 0 )) {
			$t['exception']='No studyid and/or filename set ';
			return JsonResponse::create($t,RESPONSE::HTTP_BAD_REQUEST);
		}
		$em = $this->getDoctrine()->getManager();
		$em->flush();		
		return $this->json($study);
	}
	
	protected function setstudy($study_data) {
		$study=new study();
		if (is_array($study_data)) {
			if (array_key_exists('id', $study_data) && $study_data['id']>0) {
				$id=$study_data['id'];
				$study = $this->getDoctrine()->getRepository('AppBundle:Study')->find($id);
				if (!$study) {
					return null;				
				}
			}	
			if (array_key_exists('protocol', $study_data))
				$study->setProtocol($study_data['protocol']);
			if (array_key_exists('CRO', $study_data))
				$study->setCRO($study_data['CRO']);
			if (array_key_exists('StartDate', $study_data))
				$study->setStartDate($study_data['StartDate']);
			if (array_key_exists('DueDate', $study_data))
				$study->setDueDate(($study_data['DueDate']));						
		}
		return $study;
	}
	
	protected function getContentJson(Request $request) {
		$content=utf8_encode($request->getContent());
		$jsonvars=null;
		if (!empty($content)) {
			$jsonvars = json_decode($content,true); // 2nd param to get as array
		}
		return $jsonvars;
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
		//return $this->json($t);
		//$resp=new Response('',RESPONSE::HTTP_OK);
		return $this->json($study);
	}
	
}