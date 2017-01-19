<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** Invoice Header
*
* @ORM\Table
* @ORM\Entity(repositoryClass="AppBundle\Repository\InvoiceHeaderRepository")
*/
class InvoiceHeader
{	
	
	
	/**
	 
	 * @Assert\NotBlank()
	 * @ORM\Id
	 * @ORM\Column(type="string", length=50, unique=true )	 
	 * 
	 */
	private $invoicenum;
	
	/**
	 * * @Assert\NotBlank()
	 *   @ORM\Column(type="date")
	 */
	private $invoicedate;
	
	
	
	
	/**
	 * @Assert\NotBlank() 
	 * @ORM\Column(type="float")
	 */
	private $invoiceamount;
	
	
	/**
	 * @ORM\OneToMany(targetEntity="InvoiceDetail", mappedBy ="invoiceheader")
	 * 	
	 */
	private $invoicedetails;
	
	
	
	
	public function __construct() {
		$this->invoicedetails = new \Doctrine\Common\Collections\ArrayCollection();
	}
	

        

    /**
     * Set invoicenum
     *
     * @param string $invoicenum
     *
     * @return InvoiceHeader
     */
    public function setInvoicenum($invoicenum)
    {
        $this->invoicenum = $invoicenum;

        return $this;
    }

    /**
     * Get invoicenum
     *
     * @return string
     */
    public function getInvoicenum()
    {
        return $this->invoicenum;
    }

    /**
     * Set invoicedate
     *
     * @param \DateTime $invoicedate
     *
     * @return InvoiceHeader
     */
    public function setInvoicedate($invoicedate)
    {
        $this->invoicedate = $invoicedate;

        return $this;
    }

    /**
     * Get invoicedate
     *
     * @return \DateTime
     */
    public function getInvoicedate()
    {
        return $this->invoicedate;
    }

    /**
     * Set invoiceamount
     *
     * @param float $invoiceamount
     *
     * @return InvoiceHeader
     */
    public function setInvoiceamount($invoiceamount)
    {
        $this->invoiceamount = $invoiceamount;

        return $this;
    }

    /**
     * Get invoiceamount
     *
     * @return float
     */
    public function getInvoiceamount()
    {
        return $this->invoiceamount;
    }

    /**
     * Add invoicedetail
     *
     * @param \AppBundle\Entity\InvoiceDetail $invoicedetail
     *
     * @return InvoiceHeader
     */
    public function addInvoicedetail(\AppBundle\Entity\InvoiceDetail $invoicedetail)
    {
        $this->invoicedetails[] = $invoicedetail;

        return $this;
    }

    /**
     * Remove invoicedetail
     *
     * @param \AppBundle\Entity\InvoiceDetail $invoicedetail
     */
    public function removeInvoicedetail(\AppBundle\Entity\InvoiceDetail $invoicedetail)
    {
        $this->invoicedetails->removeElement($invoicedetail);
    }

    /**
     * Get invoicedetails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvoicedetails()
    {
        return $this->invoicedetails;
    }
    
    public function getSumInvoiceDetails() {
    	$summed=0;
    	foreach($this->invoicedetails as $invdet) {
    		$summed+=$invdet->getDetailamount();
    	}    	
    	return $summed;
    }
    public function getDiscrep() {
    	return $this->invoiceamount - $this->getSumInvoiceDetails();    	
    }
    
}
