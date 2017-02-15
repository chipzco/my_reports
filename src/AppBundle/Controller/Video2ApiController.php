<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Video;



class Video2ApiController extends RestAbsController  {
	/**
	 * @Route("/api/video/{id}", name="Api_video_by_id", requirements={"id": "\d+"} )
	 */
	public function defaultAction($id=0) {
		
		return parent::indexAction($id);
	}
	
	/**
	 * @Route("/api/video/", name="Api_video_Noid" )
	 */
	public function defaultNoIdAction() {
		return parent::indexAction();
	}
	
	
	protected function GET_PAG(Request $request,$Id=null) {		
		$t['Id']=$Id;
		$video = $this->getDoctrine()->getRepository('AppBundle:Video')->find($Id);
		if (!$video) 
			return $this->returnJsonError(RESPONSE::HTTP_NOT_FOUND,"No video found for id: ".$Id);		
		$t['data']=$video;
		return $this->returnSerializedJsonData(RESPONSE::HTTP_OK,$t);		
	}
	
	protected function LIST_PAG(Request $request) {		
		$videos=$this->getDoctrine()->getRepository("AppBundle:Video")->listVideoswithLanguageTranscript() ; //listVideoswithLanguage();
		$resp['data']=$videos;	
		return $this->returnSerializedJsonData(RESPONSE::HTTP_OK,$resp);				
	}
	
	protected function POST_PAG(Request $request,$Id=null) {
		$bu = $this->get('app.api.video_bu');		
		$video=$bu->setVideo($this->getDoctrine()->getRepository('AppBundle:Video'),$this->getDoctrine()->getRepository("AppBundle:Language"),$this->getContentJson($request));
		$errObj=$bu->validateVideo($video);
		if (!$errObj->isValid())
			return $this->returnJsonError(RESPONSE::HTTP_UNPROCESSABLE_ENTITY,"",false,$errObj);		
		$em = $this->getDoctrine()->getManager();
		$em->persist($video);
		$em->flush();		
		$id=$video->getId();		
		return $this->returnSerializedJsonData(RESPONSE::HTTP_OK,$video);
	}
	
	
	protected function PUT_PAG(Request $request,$Id=null) {		
		$bu = $this->get('app.api.video_bu');
		$video=$bu->setVideo($this->getDoctrine()->getRepository('AppBundle:Video'),$this->getDoctrine()->getRepository("AppBundle:Language"),$this->getContentJson($request));
		$errObj=$bu->validateVideo($video);
		if (!$errObj->isValid()) 			
			return $this->returnJsonError(RESPONSE::HTTP_BAD_REQUEST,"",false,$errObj);		
		$em = $this->getDoctrine()->getManager();
		$em->flush();
		$id=$video->getId();		
		return $this->returnSerializedJsonData(RESPONSE::HTTP_OK,$video);
	}	
	
	protected function DELETE_PAG(Request $request,$Id=null) {
		$em = $this->getDoctrine()->getManager();		
		$video = $this->getDoctrine()->getRepository('AppBundle:Video')->find($Id);		
		if (!$video) 			
			return $this->returnJsonError(RESPONSE::HTTP_NOT_FOUND,"No video found for id: ".$Id);		
		$em->remove($video);
		$em->flush();		
		return $this->returnSerializedJsonData(RESPONSE::HTTP_OK,$video);		
	}
	
}