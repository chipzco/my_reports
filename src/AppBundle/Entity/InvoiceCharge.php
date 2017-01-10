<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** Invoice Charge
 *
 * @ORM\Table
 * @ORM\Entity
 */

class InvoiceCharge {
	/**	
	* @Assert\NotBlank()	 
	* @ORM\Column(type="string", length=50)	
	*/
	private $invoicenum;
	
	
	/**
	 * @Assert\NotBlank()	
	 * @ORM\Column(type="string", length=50)
	 * @ORM\Id
	 */
	private $trackingnum;
	
	
	
	/**
	 * @Assert\NotBlank()	
	 * @ORM\Column(type="string", length=10)
	 * @ORM\Id
	 */
	private $chargetype;
	
	
	/**
	 * @Assert\NotBlank()	
	 * @ORM\Column(type="float")
	 */
	private $chargeamount;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="InvoiceDetail",inversedBy="invoicecharges")
	 * @ORM\JoinColumn(name="trackingnum", referencedColumnName="trackingnum")
	 * 
	 */	
	private $invoicedetail;
	
	
	

    /**
     * Set invoicenum
     *
     * @param string $invoicenum
     *
     * @return InvoiceCharge
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
     * Set trackingnum
     *
     * @param string $trackingnum
     *
     * @return InvoiceCharge
     */
    public function setTrackingnum($trackingnum)
    {
        $this->trackingnum = $trackingnum;

        return $this;
    }

    /**
     * Get trackingnum
     *
     * @return string
     */
    public function getTrackingnum()
    {
        return $this->trackingnum;
    }

    /**
     * Set chargetype
     *
     * @param string $chargetype
     *
     * @return InvoiceCharge
     */
    public function setChargetype($chargetype)
    {
        $this->chargetype = $chargetype;

        return $this;
    }

    /**
     * Get chargetype
     *
     * @return string
     */
    public function getChargetype()
    {
        return $this->chargetype;
    }

    /**
     * Set chargeamount
     *
     * @param float $chargeamount
     *
     * @return InvoiceCharge
     */
    public function setChargeamount($chargeamount)
    {
        $this->chargeamount = $chargeamount;

        return $this;
    }

    /**
     * Get chargeamount
     *
     * @return float
     */
    public function getChargeamount()
    {
        return $this->chargeamount;
    }

    /**
     * Set invoicedetail
     *
     * @param \AppBundle\Entity\InvoiceDetail $invoicedetail
     *
     * @return InvoiceCharge
     */
    public function setInvoicedetail(\AppBundle\Entity\InvoiceDetail $invoicedetail = null)
    {
        $this->invoicedetail = $invoicedetail;

        return $this;
    }

    /**
     * Get invoicedetail
     *
     * @return \AppBundle\Entity\InvoiceDetail
     */
    public function getInvoicedetail()
    {
        return $this->invoicedetail;
    }
}
