<?php

namespace TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="TaskBundle\Repository\CategoryRepository")
 */
class Category
{
    public function __toString()
    {
        return $this->name;
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Task", mappedBy="category")
     */
    private $task;
    public function __construct() {
        $this->users = new ArrayCollection();
    }

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="category")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


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
     * @return Category
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
     * Add task
     *
     * @param \TaskBundle\Entity\Task $task
     * @return Category
     */
    public function addTask(\TaskBundle\Entity\Task $task)
    {
        $this->task[] = $task;

        return $this;
    }

    /**
     * Remove task
     *
     * @param \TaskBundle\Entity\Task $task
     */
    public function removeTask(\TaskBundle\Entity\Task $task)
    {
        $this->task->removeElement($task);
    }

    /**
     * Get task
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Set user
     *
     * @param \TaskBundle\Entity\User $user
     * @return Category
     */
    public function setUser(\TaskBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \TaskBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
