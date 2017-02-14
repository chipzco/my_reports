<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Chme\RestBundle\Controller\RestController;
use AppBundle\Entity\Video;

class VideoStudyApiController extends RestController {
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
			$t['exception']='No videostudy found for id '.$Id;
			return JsonResponse::create($t,RESPONSE::HTTP_NOT_FOUND);
		}
		$t['data']=$videostudy;
		return $this->json($t);
	}
	
	protected function LIST_PAG(Request $request) {		
		$vid=$request->get('vid',0);
		if ($vid>0)
			$videostudies = $this->getDoctrine()->getRepository('AppBundle:VideoStudy')->findForVideo($vid);
		else 
			$videostudies=$this->getDoctrine()->getRepository("AppBundle:VideoStudy")->findAll() ;		
		$resp['data']=$videostudies;		
		$bu=$this->get('app.api.video_bu');
		return new JsonResponse($bu->getSerializedJson($resp),RESPONSE::HTTP_OK,[],true);		
	}
	
	protected function POST_PAG(Request $request,$Id=null) {
		$bu = $this->get('app.api.video_bu');		
		$videostudy=$bu->setVideoStudy($this->getDoctrine()->getRepository('AppBundle:VideoStudy'),$this->getDoctrine()->getRepository("AppBundle:Study"),$this->getDoctrine()->getRepository("AppBundle:Video"),$this->getContentJson($request));
		if (!(is_numeric($videostudy->getVideo()->getId()) && ($videostudy->getVideo()->getId() >0))) {
			$t['exception']='No video id  set ';
			return JsonResponse::create($t,RESPONSE::HTTP_UNPROCESSABLE_ENTITY);
		}
		$em = $this->getDoctrine()->getManager();
		$em->persist($videostudy);
		$em->flush();		
		$id=$videostudy->getId();		
		$bu=$this->get('app.api.video_bu');
		return new JsonResponse($bu->getSerializedJson($videostudy),RESPONSE::HTTP_OK,[],true);
		
	}	
	protected function PUT_PAG(Request $request,$Id=null) {		
		$bu = $this->get('app.api.video_bu');
		$videostudy=$bu->setVideoStudy($this->getDoctrine()->getRepository('AppBundle:VideoStudy'),$this->getDoctrine()->getRepository("AppBundle:Study"),$this->getDoctrine()->getRepository("AppBundle:Video"),$this->getContentJson($request));
		if (!(is_numeric($videostudy->getVideo()->getId()) && ($videostudy->getVideo()->getId() >0))) {
			$t['exception']='No videoid and/or filename set ';
			return JsonResponse::create($t,RESPONSE::HTTP_BAD_REQUEST);
		}
		$em = $this->getDoctrine()->getManager();
		$em->flush();		
		return $this->json($videostudy);
	}	
	
	protected function DELETE_PAG(Request $request,$Id=null) {
		$em = $this->getDoctrine()->getManager();		
		$videostudy = $this->getDoctrine()->getRepository('AppBundle:VideoStudy')->find($Id);		
		if (!$videostudy) {
			$t['exception']='No video found for id '.$Id;
			return JsonResponse::create($t,RESPONSE::HTTP_NOT_FOUND);
		}
		$em->remove($videostudy);
		$em->flush();		
		return $this->json($videostudy);
	}
	
}