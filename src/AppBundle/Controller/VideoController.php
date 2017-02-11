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
		
			return $this->redirectToRoute('videolist');
		}
		
		
		return $this->render('video/add.html.twig', array('form'=>$form->createView()));
	}
	
	/**
	 * @Route("/video/edit/{videoId}", name="videoedit", requirements={"videoId": "\d+"} )
	 */
	public function editAction($videoId, Request $request) {
		$video = $this->getDoctrine()->getRepository('AppBundle:Video')->find($videoId);		
		if (!$video) {
			throw $this->createNotFoundException('No video found for id '.$videoId);
		}
		$form = $this->createForm(VideoFrm::class, $video);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			// $form->getData() holds the submitted values
			// but, the original `$task` variable has also been updated
			$video = $form->getData();
		
			// ... perform some action, such as saving the task to the database
			// for example, if Task is a Doctrine entity, save it!
			$em = $this->getDoctrine()->getManager();			
			$em->flush();		
			return $this->redirectToRoute('videolist');
		}	
		return $this->render('video/add.html.twig', array('form'=>$form->createView()));
	}	
	
	/**
	 * @Route("/video/see/{videoId}", name="videosee", requirements={"videoId": "\d+"}) 
	 * 
	 */
	
	public function seeAction($videoId, Request $request) {
		$video = $this->getDoctrine()->getRepository('AppBundle:Video')->find($videoId);
		if (!$video) {
			throw $this->createNotFoundException('No video found for id '.$videoId);
		}
		$ids=[149];
		$filt=$video->filterTranscripts($ids);
		return $this->render('video/see.html.twig', array('video'=>$video,'filt'=>$filt));
	}
	
	
	/**
	 * @Route("/video/list", name="videolist")
	 */
	public function listAction() {
		$videos=$this->getDoctrine()->getRepository("AppBundle:Video")->listVideoswithLanguageTranscript() ; //listVideoswithLanguage();
		
		$urlAdd = $this->generateUrl('videoadd');		
		return $this->render('video/list.html.twig', array('videos'=>$videos,"urlAdd"=>$urlAdd));
	}
	
}