<?php
namespace Chme\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EgController extends RestController
{
	
	
	/**
	 * @Route("/resteg/{objid}", name="resteg", requirements={"objid": "\d+"} )
	 */
	public function defaultAction($objid=0) {
		//modify this for your own default value (e.g empty string -1 0 anything		
		return parent::indexAction($objid);		
	}

	/**
	 * @Route("/resteg/", name="restegnoid" )
	 */
	public function defaultNoIdAction() {		
		return parent::indexAction();
	}
	
	protected function GET_PAG(Request $request,$Id=null) {
		$t['method']= "GET ANything I want!";
		$t['contenttype']=$request->headers->get('content_type');
		$t['Id']=$Id;
		return $this->json($t);
	}
	
	protected function LIST_PAG(Request $request) {
		$t['method']= "LIST ANything I want!";
		$t['contenttype']=$request->headers->get('content_type');
		return $this->json($t);
	}


	protected function POST_PAG(Request $request,$Id=null) {
		$t['method']= "POST";
		$t['contenttype']=$request->headers->get('content_type');
		$t['Id']=$Id;
		return $this->json($t);
	}

	protected function PUT_PAG(Request $request,$Id=null) {
		$t['method']= "PUT !!!";
		$t['contenttype']=$request->headers->get('content_type');
		$t['Id']=$Id;
		return $this->json($t);
	}
	protected function DELETE_PAG(Request $request,$Id=null) {
		$t['method']= "DELETE !!!";
		$t['contenttype']=$request->headers->get('content_type');
		$t['Id']=$Id;
		//return $this->json($t);
		//$resp=new Response('',RESPONSE::HTTP_OK);
		return JsonResponse::create($t);
	}

}