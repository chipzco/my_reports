<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Video;
use AppBundle\Form\VideoFrm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\BrowserKit\Response;



class VideoAPIController extends Controller {
	
	
	/**
	 * @Route("/api/video/list", name="api_videolist")
	 */
	public function listAction() {
		$videos=$this->getDoctrine()->getRepository("AppBundle:Video")->listVideoswithLanguageTranscript() ; //listVideoswithLanguage();
		$resp['data']=$videos;
		$serializer = $this->get('serializer');
		//$json =$serializer->serialize($resp);
		return $this->json($resp);
	}
}