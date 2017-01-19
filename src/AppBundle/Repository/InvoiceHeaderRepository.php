<?php

namespace AppBundle\Repository;
use AppBundle\Model\iInvBU;

/**
 * LanguageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InvoiceHeaderRepository extends \Doctrine\ORM\EntityRepository implements iInvBU
{
	public function listInvoices(\datetime $date_st,\datetime $date_end) {
		$query=$this->getEntityManager()->createQuery('SELECT h  FROM AppBundle:InvoiceHeader h 
				where h.invoicedate >= :date_start AND h.invoicedate <= :date_end ');		
		try {
			$query->setParameters(array('date_start' => $date_st,'date_end' => $date_end));
			return $query->getResult();
		}
		catch(\Doctrine\ORM\NoResultException $e) {		
			die($e);
			return null;			
		}
	}
	
	
	public function SumInvoices(\datetime $date_st,\datetime $date_end) {
		$query=$this->getEntityManager()->createQuery('SELECT SUM(h.invoiceamount) as summed  FROM AppBundle:InvoiceHeader h
				where h.invoicedate >= :date_start AND h.invoicedate <= :date_end ');
		try {
			$query->setParameters(array('date_start' => $date_st,'date_end' => $date_end));
			return $query->getSingleScalarResult();
		}
		catch(\Doctrine\ORM\NoResultException $e) {
			die($e);
			return null;
		}
	}
	
	public function ListDetDisc(\datetime $date_st,\datetime $date_end) {
		$query=$this->getEntityManager()->createQuery('SELECT h, d  FROM  AppBundle:InvoiceHeader h JOIN h.invoicedetails d 
					 where h.invoicedate >= :date_start AND h.invoicedate <= :date_end ' );				
		try {
			$query->setParameters(array('date_start' => $date_st,'date_end' => $date_end));
			return $query->getResult();
		}
		catch(\Doctrine\ORM\NoResultException $e) {
			die($e);
			return null;
		}
		
	}
	
	
}
