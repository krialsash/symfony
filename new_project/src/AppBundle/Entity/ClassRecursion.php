<?php

declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClassRecursion
 *
 * @ORM\Entity()
 */
class ClassRecursion
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
     * @ORM\Column(name="url", type="text")
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="NamespaceRecursion", inversedBy="classes")
     */
    private $namespace;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return ClassRecursion
     */
    public function setName(string $name): ClassRecursion
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return ClassRecursion
     */
    public function setUrl(string $url): ClassRecursion
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNamespace(): NamespaceRecursion
    {
        return $this->namespace;
    }

    /**
     * @param mixed $namespaces
     *
     * @return ClassRecursion
     */
    public function setNamespace(NamespaceRecursion $namespace): ClassRecursion
    {
        $this->namespace = $namespace;

        return $this;
    }

}