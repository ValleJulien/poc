<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

/**
 * @ORM\Table(name="dvd")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\DvdRepository")
 * @Gedmo\SoftDeleteable(fieldName="deleted_at", timeAware=false)
 */
class Dvd
{

    /**
     * updates deletedAt field
     */
    use SoftDeleteableEntity;


    /**
     * @ORM\Column(name="dvd_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="isan", type="string", nullable=false)
     */
    protected $isan;


    /**
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Assert\Length(
     *      min = 5,
     *      minMessage = "Le titre doit comprendre au moins {{ limit }} caractères minimum",
     * )
     * @ORM\Column(name="title", length=1500, nullable=false)
     */
    protected $title;


    /**
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Assert\Length(
     *      min = 5,
     *      minMessage = "Le réalisateur doit comprendre au moins {{ limit }} caractères minimum",
     * )
     * @ORM\Column(name="director", length=1500, nullable=false)
     */
    protected $director;


    /**
     * @ORM\Column(name="publication_date", nullable=false)
     */
    protected $published_at;


    /**
     * @ORM\Column(name="duration", nullable=false)
     */
    protected $duration;


    /**
     * @Assert\Type(
     *     type="text",
     *     message="La valeur {{ value }} enregistrée n'est pas valide {{ type }}."
     * )
     * @Assert\Length(
     *      min = 5,
     *      minMessage = "Le résumé du dvd doit comprendre au moins {{ limit }} caractères minimum",
     * )
     * @ORM\Column(name="book_summary", length=1500, nullable=true)
     */
    protected $summary;


    /**
     * @var float
     * @ORM\Column(name="book_price", type="float", nullable=true)
     */
    protected $price;

    /**
     * @var boolean
     * @ORM\column(name="blu_ray_version", type="boolean", options={"default"=0})
     */
    protected $bluRayVersion;


    /**
     * @Gedmo\Slug(fields={"title", "id"})
     * @ORM\Column(name="slug", length=128, unique=true)
     */
    private $slug;


    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getIsan()
    {
        return $this->isan;
    }


    /**
     * @param string $isan
     */
    public function setIsan($isan)
    {
        $this->isan = $isan;
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }


    /**
     * @return mixed
     */
    public function getDirector()
    {
        return $this->director;
    }


    /**
     * @param mixed $director
     */
    public function setDirector($director)
    {
        $this->director = $director;
    }


    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->published_at;
    }


    /**
     * @param mixed $published_at
     */
    public function setPublishedAt($published_at)
    {
        $this->published_at = $published_at;
    }


    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }


    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }


    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }


    /**
     * @param mixed $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }


    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }


    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }


    /**
     * @return bool
     */
    public function isBluRayVersion()
    {
        return $this->bluRayVersion;
    }


    /**
     * @param bool $bluRayVersion
     */
    public function setBluRayVersion($bluRayVersion)
    {
        $this->bluRayVersion = $bluRayVersion;
    }


    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }


    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }


    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }


    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
}