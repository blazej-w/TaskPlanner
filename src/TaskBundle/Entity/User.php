<?php

namespace TaskBundle\Entity;
    use FOS\UserBundle\Model\User as BaseUser;
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;
    /**
    * @ORM\Entity
    * @ORM\Table(name="fos_user")
    */
    class User extends BaseUser
    {


    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;
    public function __construct()
    {
    parent::__construct();

    }

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="user")
     */
    private $task;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="user")
     */
    private $category;
        
    /**
     * Add comment
     *
     * @param \TaskBundle\Entity\Comment $comment
     * @return User
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
     * Add task
     *
     * @param \TaskBundle\Entity\Task $task
     * @return User
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
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add category
     *
     * @param \TaskBundle\Entity\Category $category
     * @return User
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
}
