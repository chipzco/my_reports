<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;



/** Invoice Detail
*
* @ORM\Table
* @ORM\Entity
*/
class InvoiceDetail
{
	
	/**
	* @Assert\NotBlank()
	* @ORM\Column(type="string", length=50 )
	*
	*/
	private $invoicenum;

	
	
	/**
	 * * @Assert\NotBlank()
	 *   @ORM\Id
	 *   @ORM\Column(type="string", length=50)
	 */
	private $trackingnum;


	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float")
	 */
	private $detailamount;


	/**
	 * @ORM\ManyToOne(targetEntity="InvoiceHeader",inversedBy="invoicedetails")
	 * @ORM\JoinColumn(name="invoicenum", referencedColumnName="invoicenum")
	 */
	private $invoiceheader;
	
	
	
	/**
	 * @ORM\OneToMany(targetEntity="InvoiceCharge",mappedBy="invoicedetail")
	 *	  
	 */
	private $invoicecharges;
	
	
	public function __construct() {
		$this->invoicecharges = new \Doctrine\Common\Collections\ArrayCollection();
	}
	


    /**
     * Set invoicenum
     *
     * @param string $invoicenum
     *
     * @return InvoiceDetail
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
     * @return InvoiceDetail
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
     * Set detailamount
     *
     * @param float $detailamount
     *
     * @return InvoiceDetail
     */
    public function setDetailamount($detailamount)
    {
        $this->detailamount = $detailamount;

        return $this;
    }

    /**
     * Get detailamount
     *
     * @return float
     */
    public function getDetailamount()
    {
        return $this->detailamount;
    }

    /**
     * Set invoiceheader
     *
     * @param \AppBundle\Entity\InvoiceHeader $invoiceheader
     *
     * @return InvoiceDetail
     */
    public function setInvoiceheader(\AppBundle\Entity\InvoiceHeader $invoiceheader = null)
    {
        $this->invoiceheader = $invoiceheader;

        return $this;
    }

    /**
     * Get invoiceheader
     *
     * @return \AppBundle\Entity\InvoiceHeader
     */
    public function getInvoiceheader()
    {
        return $this->invoiceheader;
    }

    /**
     * Add invoicecharge
     *
     * @param \AppBundle\Entity\InvoiceCharge $invoicecharge
     *
     * @return InvoiceDetail
     */
    public function addInvoicecharge(\AppBundle\Entity\InvoiceCharge $invoicecharge)
    {
        $this->invoicecharges[] = $invoicecharge;

        return $this;
    }

    /**
     * Remove invoicecharge
     *
     * @param \AppBundle\Entity\InvoiceCharge $invoicecharge
     */
    public function removeInvoicecharge(\AppBundle\Entity\InvoiceCharge $invoicecharge)
    {
        $this->invoicecharges->removeElement($invoicecharge);
    }

    /**
     * Get invoicecharges
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvoicecharges()
    {
        return $this->invoicecharges;
    }
}
