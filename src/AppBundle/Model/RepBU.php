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
		$repnum=$invform->getReportNum();
		$res=[];
		switch($repnum) {
			case 1:
				$res['records']= $invbu->ListInvoices($invform->getStartDate(),$invform->getEndDate());
				$res['recordcount']=count($res['records']);
				$res['sum']=$invbu->SumInvoices($invform->getStartDate(),$invform->getEndDate());
				break;
			case 2: 
				$res['records']=$invbu->ListDetDisc($invform->getStartDate(),$invform->getEndDate());
				$res['recordcount']=count($res['records']);
				break;
			case 3:
				$recs=$invbu->ListChargeDisc($invform->getStartDate(),$invform->getEndDate());
				$res=[];
				$res['records']=[];
				foreach($recs as $r) {
					$discre=false;
					foreach ($r->getInvoicedetails() as $d) {
						if ($d->getDiscrep() != 0) {
							$discre=true;	
						}
						
					}
					if ($discre)
						$res['records'][]=$r;
				}				
				
				$res['recordcount']=count($res['records']);
				
		}
		return $res;
	}
	
}

