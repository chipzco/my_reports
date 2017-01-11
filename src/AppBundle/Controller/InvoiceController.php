<?php
namespace AppBundle\Controller;
use AppBundle\Entity\{InvoiceCharge,InvoiceDetail,InvoiceHeader};
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\BrowserKit\Response;



class InvoiceController extends Controller {
	/**
	 * @Route("/invoice/rep1", name="invoice_rep1")
	 */
	public function repFormAction(Request $request)
	{
		return $this->render('invoice/rep1form.html.twig');
		
	}
	
	/**
	 * @Route("/invoice/repgen",name="invoice_reportgen")
	 */
	public function repGenAction(Request $request) {
		$frm=$request->request;		
		$repres=$this->getDoctrine()->getRepository("AppBundle:InvoiceHeader")->ListInvoices($frm->get('date_from','1/1/2001'),$frm->get('date_to','1/1/2020'));
		return $this->render('invoice/rep1form.html.twig',array('rep'=>$repres));
		
	}
	
}