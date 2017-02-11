<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** Video
*
* @ORM\Table(name="video")
* @ORM\Entity(repositoryClass="AppBundle\Repository\VideoRepository")
*/
class Video
{	
	/**
	 
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=255)
	 */
	private $filename;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255)
	 */
	private $subjectname;
	
	/**	 
	 *  * @Assert\Range(
     *      min = 1,
     *      max = 3,
     *      minMessage = "You must be at least {{ limit }} patient, actor unknown",
     *      maxMessage = "You cannot be taller than {{ limit }}cm to enter"
     *   )   
	 * @ORM\Column(type="smallint")	 
	 */
	private $patientact;
	
	
	
	/**
	 *   * @Assert\Range(
     *      min = 0,
     *      max = 9999999,
     *      minMessage = "You must have id at least {{ limit }}",
     *      maxMessage = "You cannot have id greater than {{ limit }} in db."
     *      )
	 * @ORM\Column(type="integer")
	 */
	private $videoid;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Language")
	 * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
	 */
	private $language;
	
	
	/**
	 * Many Users have Many Groups.
	 * @ORM\ManyToMany(targetEntity="Language")
	 * @ORM\JoinTable(name="video_transcripts",
	 *      joinColumns={@ORM\JoinColumn(name="video_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="language_id", referencedColumnName="id")}
	 *      )
	 */
	private $transcripts;
	
	/**
	 * One Video to Many VideoStudy
	 * @ORM\OneToMany(targetEntity="VideoStudy",mappedBy="video")	 
	*/
	private $video_studies;
	
	private $patact_labels=array("CHOOSE ONE","Patient","Actor","?");
	
	public function __construct() {
		$this->transcripts = new \Doctrine\Common\Collections\ArrayCollection();
		$this->video_studies=new \Doctrine\Common\Collections\ArrayCollection();
	}
	

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return Video
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set subjectname
     *
     * @param string $subjectname
     *
     * @return Video
     */
    public function setSubjectname($subjectname)
    {
        $this->subjectname = $subjectname;

        return $this;
    }

    /**
     * Get subjectname
     *
     * @return string
     */
    public function getSubjectname()
    {
        return $this->subjectname;
    }

    /**
     * Set patientact
     *
     * @param integer $patientact
     *
     * @return Video
     */
    public function setPatientact($patientact)
    {
        $this->patientact = $patientact;

        return $this;
    }

    /**
     * Get patientact
     *
     * @return integer
     */
    public function getPatientact()
    {
        return $this->patientact;
    }

    /**
     * Set videoid
     *
     * @param integer $videoid
     *
     * @return Video
     */
    public function setVideoid($videoid)
    {
        $this->videoid = $videoid;

        return $this;
    }

    /**
     * Get videoid
     *
     * @return integer
     */
    public function getVideoid()
    {
        return $this->videoid;
    }

    /**
     * Set language
     *
     * @param \AppBundle\Entity\Language $language
     *
     * @return Video
     */
    public function setLanguage(\AppBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \AppBundle\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Add transcript
     *
     * @param \AppBundle\Entity\Language $transcript
     *
     * @return Video
     */
    public function addTranscript(\AppBundle\Entity\Language $transcript)
    {
        $this->transcripts->add($transcript);        
        return $this;
    }

    public function filterTranscripts(array $ids) {
    	$filtered=$this->transcripts->filter(function($val) use ($ids) {
    		if (array_search($val->getId(), $ids)!==false)
    			return true;
    		return false;
    	});
    	return $filtered;
    }
    
    public function map_give_ids(\Doctrine\Common\Collections\ArrayCollection $coll) {
    	//return $coll->map(function($val) {  return $val->getId(); 	});
    	$ids=[];
    	foreach ($coll as $elem) {
    		$ids[]=$elem->getId();	
    	}
    	return $ids;
    }
    
    public function clearTranscripts() {
    	$this->transcripts->clear();
    }
    
    /**
     * Remove transcript
     *
     * @param \AppBundle\Entity\Language $transcript
     */
    public function removeTranscript(\AppBundle\Entity\Language $transcript)
    {
        $this->transcripts->removeElement($transcript);
    }

    /**
     * Get transcripts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranscripts()
    {
        return $this->transcripts;
    }
    
    
    public function getPatientactTxt() {
    	$dispText="";
    	if ( $this->patientact !=null &&  $this->patientact>=0 && $this->patientact < count($this->patact_labels))
    		$dispText=$this->patact_labels[$this->patientact];
    	return $dispText;
    }    
    

    /**
     * Add videoStudy
     *
     * @param \AppBundle\Entity\VideoStudy $videoStudy
     *
     * @return Video
     */
    public function addVideoStudy(\AppBundle\Entity\VideoStudy $videoStudy)
    {
        $this->video_studies[] = $videoStudy;

        return $this;
    }

    /**
     * Remove videoStudy
     *
     * @param \AppBundle\Entity\VideoStudy $videoStudy
     */
    public function removeVideoStudy(\AppBundle\Entity\VideoStudy $videoStudy)
    {
        $this->video_studies->removeElement($videoStudy);
    }

    /**
     * Get videoStudies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVideoStudies()
    {
        return $this->video_studies;
    }
}
