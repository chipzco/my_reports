<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VideoStudy
 *
 * @ORM\Table(name="video_study")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VideoStudyRepository")
 */
class VideoStudy
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
     * @ORM\Column(name="purpose", type="string", length=50)
     */
    private $purpose;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="string", length=255)
     */
    private $notes;

    
    /**
     * @ORM\ManyToOne(targetEntity="Video",inversedBy="video_studies")   
     * @ORM\JoinColumn(name="video_id", referencedColumnName="id")
     *      
    */    
    private $video;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Study",inversedBy="video_studies")
     * @ORM\JoinColumn(name="study_id", referencedColumnName="id")
     *
     */
    private $study;
    

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
     * Set purpose
     *
     * @param string $purpose
     *
     * @return VideoStudy
     */
    public function setPurpose($purpose)
    {
        $this->purpose = $purpose;

        return $this;
    }

    /**
     * Get purpose
     *
     * @return string
     */
    public function getPurpose()
    {
        return $this->purpose;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return VideoStudy
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set video
     *
     * @param \AppBundle\Entity\Video $video
     *
     * @return VideoStudy
     */
    public function setVideo(\AppBundle\Entity\Video $video = null)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return \AppBundle\Entity\Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set study
     *
     * @param \AppBundle\Entity\Study $study
     *
     * @return VideoStudy
     */
    public function setStudy(\AppBundle\Entity\Study $study = null)
    {
        $this->study = $study;

        return $this;
    }

    /**
     * Get study
     *
     * @return \AppBundle\Entity\Study
     */
    public function getStudy()
    {
        return $this->study;
    }
}
