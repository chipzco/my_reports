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
		$id=$video->getId();
		return $this->json($video);
	}
	
	
	protected function PUT_PAG(Request $request,$Id=null) {		
		$video=$this->setVideo($this->getContentJson($request));
		if (!(strlen($video->getFilename()) > 0 && is_numeric($video->getVideoid()))) {
			$t['exception']='No videoid and/or filename set ';
			return JsonResponse::create($t,RESPONSE::HTTP_BAD_REQUEST);
		}
		$em = $this->getDoctrine()->getManager();
		$em->flush();
		$id=$video->getId();
		return $this->json($video);
	}
	
	protected function refreshVideoTrans($id) {
		$videos=$this->getDoctrine()->getRepository("AppBundle:Video")->listVideoswithLanguageTranscript() ; 
		$video = $this->getDoctrine()->getRepository('AppBundle:Video')->find($id);
		if (!$video) {
			$t['exception']='cannot retreive video ';
			return JsonResponse::create($t,RESPONSE::HTTP_INTERNAL_SERVER_ERROR);
		}
		return $this->json($video);
	}
	
	protected function setVideo($video_data) {
		$video=new Video();
		if (is_array($video_data)) {
			if (array_key_exists('id', $video_data) && $video_data['id']>0) {
				$id=$video_data['id'];
				$video = $this->getDoctrine()->getRepository('AppBundle:Video')->find($id);
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
			/*
			foreach ($video->getTranscripts() as $oldtrans) {
				$video->removeTranscript($oldtrans);
			}
			*/
			
			if (array_key_exists('transcripts', $video_data) && is_array($video_data['transcripts']) && count($video_data['transcripts'])>0)  {
				$ids=array_map(function($val) { 
					return $val['id'];		
				},$video_data['transcripts']);
				$filt=$video->filterTranscripts($ids);				
				$filtids=$video->map_give_ids($filt);				
				$video->clearTranscripts();
				foreach ($filt as $transcript) {
					$video->addTranscript($transcript);
				}						
				$filtered_input=array_filter($video_data['transcripts'],(function($val) use ($filtids) {
					if (array_search($val['id'], $filtids)===false)
						return true;
					return false;
				}));
				if (count($filtered_input) >0) {
					foreach ($filtered_input as $inputT) {
						$lid=$inputT['id'];
						$lang=$this->getDoctrine()->getRepository("AppBundle:Language")->find($lid);
						if ($lang)
							$video->addTranscript($lang);
					}
				}
				/*
				foreach ($video_data['transcripts'] as $transcript) {
					if (array_key_exists('id',$transcript)) {
						$lid=$transcript['id'];
						
						$lang=$this->getDoctrine()->getRepository("AppBundle:Language")->find($lid);
						if ($lang) 
							$video->addTranscript($lang);
					}
				}
				*/
			}
			else 
				$video->clearTranscripts();
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