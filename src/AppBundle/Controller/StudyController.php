<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Study;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class StudyController extends Controller { 
	
	/**
	 * @Route("/study/new", name="study_new")
	 */
	public function newAction() {
		$study=new Study();
		$study->setCRO('123');
		$study->setProtocol('t123');
		$myval1="2017-02-28";
		$dateval=new \DateTime($myval1);
		$myval2="2017-02-09";
		$dateval2=new \DateTime($myval2);
		$study->setDueDate($dateval2);
		$study->setStartDate($dateval);
		$em = $this->getDoctrine()->getManager();
		$em->persist($study);
		$em->flush();
		return $this->json($study);
	}
	
	
}