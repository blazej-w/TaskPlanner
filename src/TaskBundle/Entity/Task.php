<?php

namespace TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="TaskBundle\Repository\TaskRepository")
 */
class Task
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due", type="datetime")
     */
    private $due;

    /**
     * @var bool
     *
     * @ORM\Column(name="completed", type="boolean")
     */
    private $completed;


    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=255)
     */
    private $priority;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="task")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="task")
     */
    private $comments;


    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="task")
     * @ORM\JoinTable(name="task_category")
     */
    private $category;
    public function __construct() {
        $this->comments = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Task
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
     * Set description
     *
     * @param string $description
     * @return Task
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }



    /**
     * Set due
     *
     * @param \DateTime $due
     * @return Task
     */
    public function setDue($due)
    {
        $this->due = $due;

        return $this;
    }

    /**
     * Get due
     *
     * @return \DateTime 
     */
    public function getDue()
    {
        return $this->due;
    }

    /**
     * Set completed
     *
     * @param boolean $completed
     * @return Task
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get completed
     *
     * @return boolean 
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Set priority
     *
     * @param string $priority
     * @return Task
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set user
     *
     * @param \TaskBundle\Entity\User $user
     * @return Task
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

    /**
     * Add category
     *
     * @param \TaskBundle\Entity\Category $category
     * @return Task
     */
    public function addCategory(\TaskBundle\Entity\Category $category)
    {
        $this->category[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \TaskBundle\Entity\Category $category
     */
    public function removeCategory(\TaskBundle\Entity\Category $category)
    {
        $this->category->removeElement($category);
    }

    /**
     * Get category
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add comment
     *
     * @param \TaskBundle\Entity\Comment $comment
     * @return Task
     */
    public function addComment(\TaskBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \TaskBundle\Entity\Comment $comment
     */
    public function removeComment(\TaskBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComment()
    {
        return $this->comments;
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
