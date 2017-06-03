<?php

declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceRecursion
 *
 * @ORM\Entity()
 */
class InterfaceRecursion
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
     * @ORM\ManyToOne(targetEntity="NamespaceRecursion", inversedBy="interfaces")
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
        return (string) $this->name;
    }

    /**
     * @param string $name
     *
     * @return InterfaceRecursion
     */
    public function setName(string $name): InterfaceRecursion
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
     */
    public function setUrl($url)
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
     * @param mixed $namespace
     *
     * @return InterfaceRecursion
     */
    public function setNamespace(NamespaceRecursion $namespace): InterfaceRecursion
    {
        $this->namespace = $namespace;

        return $this;
    }

}
