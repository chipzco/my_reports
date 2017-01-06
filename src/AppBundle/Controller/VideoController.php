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
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			// $form->getData() holds the submitted values
			// but, the original `$task` variable has also been updated
			$video = $form->getData();
		
			// ... perform some action, such as saving the task to the database
			// for example, if Task is a Doctrine entity, save it!
			 $em = $this->getDoctrine()->getManager();
			 $em->persist($video);
			 $em->flush();
		
			return $this->redirectToRoute('homepage');
		}
		
		
		return $this->render('video/add.html.twig', array('form'=>$form->createView()));
	}
}