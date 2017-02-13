<?php
namespace Chme\RestBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class RestController extends Controller
{
	
	
	public function indexAction($Id=null) {
		$request = Request::createFromGlobals();
		$method=strtoupper($request->getMethod())."_PAG";    // e.g. GET, POST, PUT, DELETE or HEAD
		
		if (method_exists($this, $method)) {			
			if ($method=="GET_PAG" && $Id==null)
				$method="LIST_PAG";			
			return $this->$method($request,$Id);
		}
		
		$t['method']= "COULD NOT FIND IT";
		$t['varmethod']=$method;
		$t['contenttype']=$request->headers->get('content_type');
		$t['Allow']="GET,HEAD,POST,PUT,OPTIONS,TRACE,DELETE";
		return $this->json($t);
	}

	protected function GET_PAG(Request $request,$Id=null) {
		$t['method']= "GET not implemented";
		$t['contenttype']=$request->headers->get('content_type');
		return $this->json($t);
	}
	protected function LIST_PAG(Request $request) {
		$t['method']= "LIST not implemented";
		$t['contenttype']=$request->headers->get('content_type');
		return $this->json($t);
	}
	protected function POST_PAG(Request $request,$Id=null) {
		$t['method']= "POST not implemnted";
		$t['contenttype']=$request->headers->get('content_type');
		return $this->json($t);
	}
	protected function PUT_PAG(Request $request,$Id=null) {
		$t['method']= "PUT not implemnted";
		$t['contenttype']=$request->headers->get('content_type');
		return $this->json($t);
	}
	
	protected function PATCH_PAG(Request $request,$Id=null) {
		$t['method']= "PATCH not implemnted";
		$t['contenttype']=$request->headers->get('content_type');
		return $this->json($t);
	}
	protected function DELETE_PAG(Request $request,$Id=null) {
		$t['method']= "DELETE not implemnted";
		$t['contenttype']=$request->headers->get('content_type');
		return RESPONSE::HTTP_OK;
	}

	protected function getContentJson(Request $request) {
		$content=utf8_encode($request->getContent());
		$jsonvars=null;
		if (!empty($content)) {
			$jsonvars = json_decode($content,true); // 2nd param to get as array
		}
		return $jsonvars;
	}
}