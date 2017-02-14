<?php
namespace AppBundle\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use AppBundle\Entity\Video;
use AppBundle\Entity\Study;
use AppBundle\Entity\Language;
use AppBundle\Entity\VideoStudy;
use \Doctrine\Common\Collections;

class VideoBU {
	
	public function sayHi() {
		return "HELLO!";
	}
	
	public function getSerializedJson($object) {
		$encoder = new JsonEncoder();
		$normalizer = new ObjectNormalizer();
		$normalizer->setCircularReferenceHandler(function ($object) {
			return $object->getId();
		});
		$serializer = new Serializer(array($normalizer), array($encoder));
		return $serializer->serialize($object, 'json');		
	}
	
	
	public function setVideo($videoRep,$langRep,$video_data) {
		$video=new Video();
		if (is_array($video_data)) {
			if (array_key_exists('id', $video_data) && $video_data['id']>0) {
				$id=$video_data['id'];
				$video = $videoRep->find($id);
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
				$lang=$langRep->find($lid);
				if ($lang)
					$video->setLanguage($lang);
			}
								
			if (array_key_exists('transcripts', $video_data) && is_array($video_data['transcripts']) && count($video_data['transcripts'])>0)  {
				$ids=array_map(function($val) {
					return $val['id'];
				},$video_data['transcripts']);
					$filt=$this->filterTranscripts($ids,$video);
					$filtids=$this->map_give_ids($filt);
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
							$lang=$langRep->find($lid);
							if ($lang)
								$video->addTranscript($lang);
						}
					}						
			}
			else
				$video->clearTranscripts();
		}
		return $video;
	}
	
	
	public function setVideoStudy($videostudyRep,$studyRep,$videoRep,$video_data) {
		$videostudy=new VideoStudy();
		if (is_array($video_data)) {
			if (array_key_exists('id', $video_data) && $video_data['id']>0) {
				$id=$video_data['id'];
				$videostudy = $videostudyRep->find($id);
				if (!$videostudy) {
					return null;
				}
			}
			if (array_key_exists('purpose', $video_data))
				$videostudy->setPurpose($video_data['purpose']);
			if (array_key_exists('notes', $video_data))
				$videostudy->setNotes($video_data['notes']);
			if (array_key_exists('study', $video_data) && array_key_exists('id', $video_data['study']) && $video_data['study']['id'] >0 ) {
				$id=$video_data['study']['id'];
				$study=$studyRep->find($id);
				if (!$study) 
					$study=new Study();
				$videostudy->setStudy($study);								
			}
			if (array_key_exists('video', $video_data) && array_key_exists('id', $video_data['video']) && $video_data['video']['id'] >0 ) {
				$id=$video_data['video']['id'];
				$video=$videoRep->find($id);
				if (!$video) 
					$video=new Video();
				$videostudy->setVideo($video);				
			}
		}
		return $videostudy;
	}
	public function filterTranscripts(array $ids,$video) {
		$transcripts=$video->getTranscripts();
		$filtered=$transcripts->filter(function($val) use ($ids) {
			if (array_search($val->getId(), $ids)!==false)
				return true;
			return false;
		});
		return $filtered;
	}	
	
	public function map_give_ids(\Doctrine\Common\Collections\ArrayCollection $coll) {
		return $coll->map(function($e) { return $e->getId(); } )->getValues();
		/*
		$ids=[];
		foreach ($coll as $elem) {
			$ids[]=$elem->getId();
		}		
		return $ids;
		*/
		
	}	
}