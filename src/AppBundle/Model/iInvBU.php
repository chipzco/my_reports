<?php
namespace AppBundle\Model; 
interface iInvBU
	/**
	 * This interface describes the methods needed to implement report 1-3  
	 */
{
	public function ListInvoices(\datetime $date_st,\datetime $date_end);
	public function SumInvoices(\datetime $date_st,\datetime $date_end);
}
