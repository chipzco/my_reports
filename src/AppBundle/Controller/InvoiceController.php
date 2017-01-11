<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Video;
use AppBundle\Form\VideoFrm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class InvoiceController extends Controller {
	/**
	 * @Route("/video/add", name="videoadd")
	 */
	public function repFormAction(Request $request)
	{
		$video=new Video();
		
	}
}