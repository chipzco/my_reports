<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Video;

class VideoStudyApiController extends RestAbsController {
	/**
	 * @Route("/api/videostudy/{id}", name="Api_videostudy_by_id", requirements={"id": "\d+"} )
	 */
	public function defaultAction($id=0) {
		
		return parent::indexAction($id);
	}
	
	/**
	 * @Route("/api/videostudy/", name="Api_videostudy_Noid" )
	 */
	public function defaultNoIdAction() {
		return parent::indexAction();
	}
	
	protected function GET_PAG(Request $request,$Id=null) {		
		$t['Id']=$Id;
		$videostudy = $this->getDoctrine()->getRepository('AppBundle:VideoStudy')->find($Id);
		if (!$videostudy) {
			return $this->returnJsonError(RESPONSE::HTTP_NOT_FOUND,"No videostudy found for id : ".$Id);			
		}
		$t['data']=$videostudy;
		return $this->returnSerializedJsonData(RESPONSE::HTTP_OK, $t);		
	}
	
	protected function LIST_PAG(Request $request) {		
		$vid=$request->get('vid',0);
		if ($vid>0)
			$videostudies = $this->getDoctrine()->getRepository('AppBundle:VideoStudy')->findForVideo($vid);
		else 
			$videostudies=$this->getDoctrine()->getRepository("AppBundle:VideoStudy")->findAll() ;
		$bu=$this->get('app.api.video_bu');
		$bu->cleanVideoStudies($videostudies);
		$resp['data']=$videostudies;
		return $this->returnSerializedJsonData(RESPONSE::HTTP_OK, $resp);				
	}
	
	protected function POST_PAG(Request $request,$Id=null) {
		$bu = $this->get('app.api.video_bu');		
		$videostudy=$bu->setVideoStudy($this->getDoctrine()->getRepository('AppBundle:VideoStudy'),$this->getDoctrine()->getRepository("AppBundle:Study"),$this->getDoctrine()->getRepository("AppBundle:Video"),$this->getContentJson($request));
		$errObj=$bu->validateVideoStudy($videostudy);
		if (!($errObj->isValid())) 
			return $this->returnJsonError(RESPONSE::HTTP_UNPROCESSABLE_ENTITY,"",false,$errObj);		
		$em = $this->getDoctrine()->getManager();
		$em->persist($videostudy);
		$em->flush();		
		$id=$videostudy->getId();		
		return $this->returnSerializedJsonData(RESPONSE::HTTP_OK, $videostudy);
	}	
	protected function PUT_PAG(Request $request,$Id=null) {		
		$bu = $this->get('app.api.video_bu');
		$videostudy=$bu->setVideoStudy($this->getDoctrine()->getRepository('AppBundle:VideoStudy'),$this->getDoctrine()->getRepository("AppBundle:Study"),$this->getDoctrine()->getRepository("AppBundle:Video"),$this->getContentJson($request));
		$errObj=$bu->validateVideoStudy($videostudy);
		if (!($errObj->isValid()))
			return $this->returnJsonError(RESPONSE::HTTP_BAD_REQUEST,"",false,$errObj);		
		$em = $this->getDoctrine()->getManager();
		$em->flush();		
		return $this->returnSerializedJsonData(RESPONSE::HTTP_OK, $videostudy);
	}	
	
	protected function DELETE_PAG(Request $request,$Id=null) {
		$em = $this->getDoctrine()->getManager();		
		$videostudy = $this->getDoctrine()->getRepository('AppBundle:VideoStudy')->find($Id);		
		if (!$videostudy) 
			return $this->returnJsonError(RESPONSE::HTTP_NOT_FOUND,"No videostudy found for id : ".$Id);		
		$em->remove($videostudy);
		$em->flush();		
		return $this->returnSerializedJsonData(RESPONSE::HTTP_OK, $videostudy);		
	}
	
}