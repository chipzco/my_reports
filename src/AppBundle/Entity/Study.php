<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Study
 *
 * @ORM\Table(name="study")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StudyRepository")
 */
class Study
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Protocol", type="string", length=50)
     */
    private $protocol;

    /**
     * @var string
     *
     * @ORM\Column(name="CRO", type="string", length=50)
     */
    private $cRO;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="StartDate", type="date")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DueDate", type="date")
     */
    private $dueDate;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set protocol
     *
     * @param string $protocol
     *
     * @return Study
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;

        return $this;
    }

    /**
     * Get protocol
     *
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * Set cRO
     *
     * @param string $cRO
     *
     * @return Study
     */
    public function setCRO($cRO)
    {
        $this->cRO = $cRO;

        return $this;
    }

    /**
     * Get cRO
     *
     * @return string
     */
    public function getCRO()
    {
        return $this->cRO;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Study
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     *
     * @return Study
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }
}

