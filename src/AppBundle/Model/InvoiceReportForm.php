<?php
namespace AppBundle\Model;
use Symfony\Component\Validator\Constraints as Assert;

class InvoiceReportForm {
	protected $reportnum;
	protected $startDate;
	protected $endDate;
	
	public function getReportNum()
	{
		return $this->reportnum;
	}
	
	public function setReportNum($reportnum)
	{
		$this->reportnum = $reportnum;
	}
	
	public function getStartDate()
	{
		return $this->startDate;
	}
	
	public function setStartDate(\DateTime $sDate = null)
	{
		$this->startDate = $sDate;
	}
	
	public function getEndDate()
	{
		return $this->endDate;
	}
	
	public function setEndDate(\DateTime $eDate = null)
	{
		$this->endDate = $eDate;
	}
	
}