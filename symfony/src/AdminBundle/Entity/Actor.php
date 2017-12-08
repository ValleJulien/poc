<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

/**
 * @ORM\Table(name="actor")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\DvdRepository")
 * @Gedmo\SoftDeleteable(fieldName="deleted_at", timeAware=false)
 */
class Actor
{

    /**
     * updates deletedAt field
     */
    use SoftDeleteableEntity;


    /**
     * @ORM\Column(name="actor_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Assert\Length(
     *      min = 3,
     *      minMessage = "Le prénom doit comprendre au moins {{ limit }} caractères minimum",
     * )
     * @ORM\Column(name="fisrt_name", length=255, nullable=false)
     */
    protected $fisrtName;

    /**
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Assert\Length(
     *      min = 3,
     *      minMessage = "Le nom doit comprendre au moins {{ limit }} caractères minimum",
     * )
     * @ORM\Column(name="last_name", length=255, nullable=false)
     */
    protected $lastName;

    /**
     * @Gedmo\Slug(fields={"firstName", "lastName"})
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
     * @return mixed
     */
    public function getFisrtName()
    {
        return $this->fisrtName;
    }


    /**
     * @param mixed $fisrtName
     */
    public function setFisrtName($fisrtName)
    {
        $this->fisrtName = $fisrtName;
    }


    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }


    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
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