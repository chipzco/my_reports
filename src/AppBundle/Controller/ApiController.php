<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Chme\RestBundle\Controller\RestController;

class ApiController extends RestController {
	/**
	 * @Route("/api/{id}", name="Api", requirements={"id": "\d+"} )
	 */
	public function defaultAction($id=0) {
		
		return parent::indexAction($id);
	}
	
	/**
	 * @Route("/api/", name="ApiNoid" )
	 */
	public function defaultNoIdAction() {
		return parent::indexAction();
	}
	
	protected function GET_PAG(Request $request,$Id=null) {
		$t['method']= "GET ANything I want from API!";
		$t['contenttype']=$request->headers->get('content_type');
		$t['Id']=$Id;
		return $this->json($t);
	}
	
	protected function LIST_PAG(Request $request) {
		$t['method']= "LIST ANything I want from API!";
		$t['contenttype']=$request->headers->get('content_type');
		return $this->json($t);
	}
	
	protected function POST_PAG(Request $request,$Id=null) {
		$t['method']= "POST in API";
		$t['contenttype']=$request->headers->get('content_type');
		$t['Id']=$Id;
		return $this->json($t);
	}
	
	protected function PUT_PAG(Request $request,$Id=null) {
		$t['method']= "PUT in API !!!";
		$t['contenttype']=$request->headers->get('content_type');
		$t['Id']=$Id;
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