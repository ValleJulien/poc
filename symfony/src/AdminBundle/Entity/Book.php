<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

/**
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\BookRepository")
 * @Gedmo\SoftDeleteable(fieldName="deleted_at", timeAware=false)
 */
class Book
{

    /**
     * updates deletedAt field
     */
    use SoftDeleteableEntity;


    /**
     * @ORM\Column(name="book_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="isbn", type="string", nullable=false)
     */
    protected $isbn;


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
     * @ORM\Column(name="publication_date", nullable=false)
     */
    protected $published_at;


    /**
     * @var int
     * @ORM\Column(name="page_number", type="integer", nullable=false)
     */
    protected $page_number;


    /**
     * @Assert\Type(
     *     type="string",
     *     message="La valeur {{ value }} enregistrée n'est pas valide {{ type }}."
     * )
     * @Assert\Length(
     *      min = 5,
     *      minMessage = "Le résumé du livre doit comprendre au moins {{ limit }} caractères minimum",
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
     * @var AuthorDirector
     *
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\AuthorDirector", inversedBy="book", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author_director_id", referencedColumnName="author_director_id", nullable=false)
     * })
     */
    protected $authorDirector;


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
    public function getIsbn()
    {
        return $this->isbn;
    }


    /**
     * @param string $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
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
     * @return int
     */
    public function getPageNumber()
    {
        return $this->page_number;
    }


    /**
     * @param int $page_number
     */
    public function setPageNumber($page_number)
    {
        $this->page_number = $page_number;
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


    /**
     * @return AuthorDirector
     */
    public function getAuthorDirector()
    {
        return $this->authorDirector;
    }


    /**
     * @param AuthorDirector $authorDirector
     */
    public function setAuthorDirector($authorDirector)
    {
        $this->authorDirector = $authorDirector;
    }


    /**
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }


    /**
     * @param \DateTime $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }
}