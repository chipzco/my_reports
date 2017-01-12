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
		return $invbu->ListInvoices($invform->getStartDate(),$invform->getEndDate());
	}
	
	
}

