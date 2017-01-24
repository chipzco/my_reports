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
	 * @Route("/videoapi/{id}", name="Api", requirements={"id": "\d+"} )
	 */
	public function defaultAction($id=0) {
		
		return parent::indexAction($id);
	}
	
	/**
	 * @Route("/videoapi/", name="ApiNoid" )
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
		$serializer = $this->get('serializer');
		//$json =$serializer->serialize($resp);
		return $this->json($resp);
	}
	
	protected function POST_PAG(Request $request,$Id=null) {		
		$video=$this->setVideo($this->getContentJson($request));
		if (!(strlen($video->getFilename()) > 0 && is_numeric($video->getVideoid()))) {
			$t['exception']='No videoid and/or filename set ';
			return JsonResponse::create($t,RESPONSE::HTTP_UNPROCESSABLE_ENTITY);
		}
		$em = $this->getDoctrine()->getManager();
		$em->persist($video);
		$em->flush();
		return $this->json($video);
	}
	protected function setVideo($video_data): Video {
		$video=new Video();
		if (is_array($video_data)) {
			if (array_key_exists('id', $video_data) && $video_data['id']>0) {
				$id=$video_data['id'];
				$video = $this->getDoctrine()->getRepository('AppBundle:Video')->find($Id);
				if (!$video) {
					return null;				
				}
			}	
			if (array_key_exists('filename', $video_data))
				$video->setFilename($video_data['filename']);
			if (array_key_exists('subjectname', $video_data))
				$video->setSubjectname($video_data['subjectname']);
			if (array_key_exists('videoid', $video_data))
				$video->setVideoid($video_data['videoid']);
			if (array_key_exists('patientact', $video_data))
				$video->setPatientact(($video_data['patientact']));
				
			if (array_key_exists('language', $video_data) && is_array($video_data['language']) && array_key_exists('id',$video_data['language'] )) {
				 $lid=$video_data['language']['id'];
				 $lang=$this->getDoctrine()->getRepository("AppBundle:Language")->find($lid);
				 if ($lang)
				 	$video->setLanguage($lang);
			}
			if (array_key_exists('transcripts', $video_data) && is_array($video_data['transcripts']) && count($video_data['transcripts'])>0)  {			
				foreach ($video_data['transcripts'] as $transcript) {
					if (array_key_exists('id',$transcript)) {
						$lid=$transcript['id'];
						$lang=$this->getDoctrine()->getRepository("AppBundle:Language")->find($lid);
						if ($lang) 
							$video->addTranscript($lang);
					}
				}
			}			
		}
		return $video;
	}
	
	protected function getContentJson(Request $request) {
		$content=utf8_encode($request->getContent());
		$jsonvars=null;
		if (!empty($content)) {
			$jsonvars = json_decode($content,true); // 2nd param to get as array
		}
		return $jsonvars;
	}
	protected function PUT_PAG(Request $request,$Id=null) {
		$t['method']= "PUT in API !!!";
		$t['contenttype']=$request->headers->get('content_type');
		$t['Id']=$Id;
		$t['putvars']=$this->getContentJson($request);
		return $this->json($t);
	}
	protected function DELETE_PAG(Request $request,$Id=null) {
		$t['method']= "DELETE  in API!!!";
		$t['contenttype']=$request->headers->get('content_type');
		$t['Id']=$Id;
		//return $this->json($t);
		//$resp=new Response('',RESPONSE::HTTP_OK);
		return JsonResponse::create($t);
	}
	
}