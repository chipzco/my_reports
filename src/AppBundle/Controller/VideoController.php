<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Video;
use AppBundle\Form\VideoFrm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class VideoController extends Controller {
	/**
	 * @Route("/video/add", name="videoadd")
	 */
	public function addAction(Request $request)
	{
		$video=new Video();
		$form = $this->createForm(VideoFrm::class, $video);
		return $this->render('video/add.html.twig', array('form'=>$form->createView()));
	}
}