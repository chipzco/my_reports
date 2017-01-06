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
	public function __construct() {
		$this->$transcripts = new \Doctrine\Common\Collections\ArrayCollection();
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
        $this->transcripts[] = $transcript;

        return $this;
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
}
