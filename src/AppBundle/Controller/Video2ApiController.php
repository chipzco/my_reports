<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Chme\RestBundle\Controller\RestController;
use AppBundle\Entity\Video;



class Video2ApiController extends RestController {
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
		if (!$video) {
			$t['exception']='No video found for id '.$Id;
			return JsonResponse::create($t,RESPONSE::HTTP_NOT_FOUND);
		}
		$t['data']=$video;
		return $this->json($t);
	}
	
	protected function LIST_PAG(Request $request) {		
		$videos=$this->getDoctrine()->getRepository("AppBundle:Video")->listVideoswithLanguageTranscript() ; //listVideoswithLanguage();
		$resp['data']=$videos;	
		$bu=$this->get('app.api.video_bu');
		return new JsonResponse($bu->getSerializedJson($resp),RESPONSE::HTTP_OK,[],true);		
	}
	
	protected function POST_PAG(Request $request,$Id=null) {
		$bu = $this->get('app.api.video_bu');		
		$video=$bu->setVideo($this->getDoctrine()->getRepository('AppBundle:Video'),$this->getDoctrine()->getRepository("AppBundle:Language"),$this->getContentJson($request));
		if (!(strlen($video->getFilename()) > 0 && is_numeric($video->getVideoid()))) {
			$t['exception']='No videoid and/or filename set ';
			return JsonResponse::create($t,RESPONSE::HTTP_UNPROCESSABLE_ENTITY);
		}
		$em = $this->getDoctrine()->getManager();
		$em->persist($video);
		$em->flush();		
		$id=$video->getId();
		return $this->json($video);
	}
	
	
	protected function PUT_PAG(Request $request,$Id=null) {		
		$bu = $this->get('app.api.video_bu');
		$video=$bu->setVideo($this->getDoctrine()->getRepository('AppBundle:Video'),$this->getDoctrine()->getRepository("AppBundle:Language"),$this->getContentJson($request));
		if (!(strlen($video->getFilename()) > 0 && is_numeric($video->getVideoid()))) {
			$t['exception']='No videoid and/or filename set ';
			return JsonResponse::create($t,RESPONSE::HTTP_BAD_REQUEST);
		}
		$em = $this->getDoctrine()->getManager();
		$em->flush();
		$id=$video->getId();
		return $this->json($video);
	}	
	
	protected function DELETE_PAG(Request $request,$Id=null) {
		$em = $this->getDoctrine()->getManager();		
		$video = $this->getDoctrine()->getRepository('AppBundle:Video')->find($Id);		
		if (!$video) {
			$t['exception']='No video found for id '.$Id;
			return JsonResponse::create($t,RESPONSE::HTTP_NOT_FOUND);
		}
		$em->remove($video);
		$em->flush();		
		//return $this->json($t);
		//$resp=new Response('',RESPONSE::HTTP_OK);
		return $this->json($video);
	}
	
}