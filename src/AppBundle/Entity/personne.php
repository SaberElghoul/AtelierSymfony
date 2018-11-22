<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * personne
 *
 * @ORM\Table(name="personne")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\personneRepository")
 */
class personne
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="age", type="string", length=255)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;


    /**
     * @ORM\OneToOne(targetEntity="Media")
     * @ORM\JoinColumn(name="media_id",referencedColumnName="id")
     */
    private $media;


    /**
     * @ORM\ManyToOne(targetEntity="Adresse")
     * @ORM\JoinColumn(name="adresse_id", referencedColumnName="id")
     */
    private $adresses;


    /**
     * @ORM\ManyToMany(targetEntity="Emploi")
     * @ORM\JoinTable(name="users_jobs" )
     */

    private $emplois;



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
     * Set name
     *
     * @param string $name
     *
     * @return personne
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return personne
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set age
     *
     * @param string $age
     *
     * @return personne
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return personne
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->emplois = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set media
     *
     * @param \AppBundle\Entity\Media $media
     *
     * @return personne
     */
    public function setMedia(\AppBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \AppBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set adresses
     *
     * @param \AppBundle\Entity\Adresse $adresses
     *
     * @return personne
     */
    public function setAdresses(\AppBundle\Entity\Adresse $adresses = null)
    {
        $this->adresses = $adresses;

        return $this;
    }

    /**
     * Get adresses
     *
     * @return \AppBundle\Entity\Adresse
     */
    public function getAdresses()
    {
        return $this->adresses;
    }

    /**
     * Add emplois
     *
     * @param \AppBundle\Entity\Emploi $emplois
     *
     * @return personne
     */
    public function addEmplois(\AppBundle\Entity\Emploi $emplois)
    {
        $this->emplois[] = $emplois;

        return $this;
    }

    /**
     * Remove emplois
     *
     * @param \AppBundle\Entity\Emploi $emplois
     */
    public function removeEmplois(\AppBundle\Entity\Emploi $emplois)
    {
        $this->emplois->removeElement($emplois);
    }

    /**
     * Get emplois
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmplois()
    {
        return $this->emplois;
    }
}
