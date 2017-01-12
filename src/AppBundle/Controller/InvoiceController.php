<?php
namespace AppBundle\Controller;
use AppBundle\Entity\{InvoiceCharge,InvoiceDetail,InvoiceHeader};
use AppBundle\Model\RepBU;
use AppBundle\Model\InvoiceReportForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class InvoiceController extends Controller {
	/**
	 * @Route("/invoice/rep", name="invoice_rep")
	 */
	public function repFormAction(Request $request)
	{
		$repform=new InvoiceReportForm();
		$form = $this->createFormBuilder($repform)
			->add('reportnum',ChoiceType::class,array(
				'choices'=>array(
						'Report 1'=>1,
						'Report 2'=>2,
						'Report 3'=>3
				  )
			   ))
			
			-> add('startDate',DateType::class)
			->add('endDate',DateType::class)
			->add('save',SubmitType::class,array('label'=>'Create Report'))
			->getForm();
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {			
			$repform = $form->getData();
			return $this->repGenAction($repform,$request);
		}
			
			
			
		return $this->render('invoice/repgenform.html.twig',array('form'=>$form->createView()));
		
	}
	
	/**
	 * @Route("/invoice/repgen",name="invoice_reportgen")
	 */
	public function repGenAction(InvoiceReportForm $repform,Request $request) {		
		
		
		$frm=$request->request;	
		$repres=$repform;
		/*
		$repbu=new RepBU($this->getDoctrine()->getRepository("AppBundle:InvoiceHeader"));
		$repres=$repbu->processRepFrm($frm->get('date_from','1/1/2001'),$frm->get('date_to','1/1/2020'));
		*/
		//$repres=$this->getDoctrine()->getRepository("AppBundle:InvoiceHeader")->ListInvoices($frm->get('date_from','1/1/2001'),$frm->get('date_to','1/1/2020'));
		return $this->render('invoice/rep1form.html.twig',array('rep'=>$repres));
		
	}
	
}