<?php

// declare(strict_types = 1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NamespacesSymfony
 *
 * @ORM\Entity()
 */
class NamespacesSymfony
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
     * @ORM\Column(name="name", type="text")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", type="text")
     */
    private $url;

    /**
     * @ORM\OneToMany(targetEntity="InterfacesSymfony", mappedBy="namespaces")
     */
    private $interfaces;

    /**
     * @ORM\OneToMany(targetEntity="ClassesSymfony", mappedBy="namespaces")
     */
    private $classes;

    /**
     * NamespacesSymfony constructor for intarfaces & classes
     */
    public function __construct()
    {
        $this->interfaces = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInterfaces()
    {
        return $this->interfaces;
    }

    /**
     * @param mixed $interfaces
     */
    public function setInterface($interfaces)
    {
        $this->interfaces = $interfaces;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param mixed $classes
     */
    public function setClasses($classes)
    {
        $this->classeses = $classes;

        return $this;
    }
}

