<?php

declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * NamespaceRecursion
 *
 * @ORM\Entity()
*/
class NamespaceRecursion
{
    /**
     * @var NamespaceRecursion
     *
     * @ORM\ManyToOne(targetEntity="NamespaceRecursion", inversedBy="children")
     */
    private $parent;

    /**
     * @var NamespaceRecursion
     *
     * @ORM\OneToMany(targetEntity="NamespaceRecursion", mappedBy="parent")
     */
    private $children;

    /**
     * @return NamespaceRecursion|null
     */
    public function getParent(): ?NamespaceRecursion
    {
        return $this->parent;
    }

    /**
     * @param NamespaceRecursion|null $parent
     *
     * @return NamespaceRecursion
     */
    public function setParent(?NamespaceRecursion $parent): ?NamespaceRecursion
    {
        $this->parent = $parent;
        return $parent;
    }

    /**
     * @return NamespaceRecursion
     */
    public function getChildren(): NamespaceRecursion
    {
        return $this->children;
    }

    /**
     * @param NamespaceRecursion $children
     */
    public function setChildren(NamespaceRecursion $children)
    {
        $this->children = $children;
    }

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
     * @ORM\OneToMany(targetEntity="InterfaceRecursion", mappedBy="namespace")
     */
    private $interfaces;

    /**
     * @ORM\OneToMany(targetEntity="ClassRecursion", mappedBy="namespace")
     */
    private $classes;

    /**
     * NamespacesRecursion constructor for intarfaces & classes
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
    public function getInterface()
    {
        return $this->interface;
    }

    /**
     * @param mixed $interface
     */
    public function setInterface($interface)
    {
        $this->interface = $interface;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }
}

