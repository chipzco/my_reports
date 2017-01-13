<?php
namespace AppBundle\Model;
use Symfony\Component\HttpFoundation\Request;

class RepBU {
	/**
	 * Carry out business logic related to report generation
	 *  
	 */
	
	/*
	private $invqrybu;
	function __construct(iInvBU $invbu) {
		$this->invqrybu=$invbu;
	}
	*/
	function processRepFrm(iInvBU $invbu,InvoiceReportForm $invform) {
		if ($invform->getStartDate()==null || $invform->getEndDate()==null)
			die("Incorrect dates");
		$res['records']= $invbu->ListInvoices($invform->getStartDate(),$invform->getEndDate());
		$res['recordcount']=count($res['records']);
		$res['sum']=$invbu->SumInvoices($invform->getStartDate(),$invform->getEndDate());
		return $res;
	}	
}

