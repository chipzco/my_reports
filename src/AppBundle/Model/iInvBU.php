<?php
namespace AppBundle\Model; 
interface iInvBU
	/**
	 * This interface describes the methods needed to implement report 1-3  
	 */
{
	public function ListInvoices(date $date_st, date $date_end);
}
