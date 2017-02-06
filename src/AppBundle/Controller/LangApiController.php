<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Chme\RestBundle\Controller\RestController;
use AppBundle\Entity\Language;

class LangApiController extends RestController {
	/**
	 * @Route("/api/lang/", name="Api_Lang_Noid" )
	 */
	public function defaultNoIdAction() {
		return parent::indexAction();
	}	
	protected function LIST_PAG(Request $request) {
		$langs=$this->getDoctrine()->getRepository("AppBundle:Language")->findAll(); 
		$resp['data']=$langs;		
		return $this->json($resp);
	}
}