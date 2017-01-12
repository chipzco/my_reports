<?php
namespace AppBundle\Model;
use Symfony\Component\HttpFoundation\Request;

class RepBU {
	private $invqrybu;
	function __construct(iInvBU $invbu) {
		$this->invqrybu=$invbu;
	}
	function processRepFrm(string $str_startdate, string $str_enddate) {
		return $this->invqrybu->ListInvoices($str_startdate,$str_startdate);
	}
	
	protected function convertToDate(string $strdate): date {
		if (date_create_from_format($strdate) !==false) {
			
		}
	}
	
}

