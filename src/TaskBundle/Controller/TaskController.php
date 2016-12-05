<?php

namespace TaskBundle\Controller;

use TaskBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Task controller.
 *
 * @Route("task")
 */
class TaskController extends Controller
{


    /**
     * Lists all task entities.
     *
     * @Route("/", name="task_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tasks = $em->getRepository('TaskBundle:Task')->findByUser($this->getUser());

        $collection = new ArrayCollection($tasks);

        list($completed, $notcompleted) = $collection->partition(function ($key, Task $task) {
            return $task->getCompleted();
        });

        return $this->render('task/index.html.twig', array(
            'notcompleted' => $notcompleted,
            'completed' => $completed,
            'tasks' => $tasks,
        ));



    }




    /**
    * @Route("/", name="index")
    * @Method("GET")
    */
        public function indexPageAction()
        {
            $em = $this->getDoctrine()->getManager();

            $tasks = $em->getRepository('TaskBundle:Task')->findAll();

            return $this->render('indexPage.html.twig');
        }



    /**
     * Creates a new task entity.
     *
     * @Route("/new", name="task_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm('TaskBundle\Form\TaskType', $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush($task);

            return $this->redirectToRoute('task_show', array('id' => $task->getId()));
        }

        return $this->render('task/new.html.twig', array(
            'task' => $task,
            'form' => $form->createView(),
        ));
    }

    /**
     * Count the number of comments
     *
     * @Route("/", name="comment_index")
     * @Method("GET")
     */
    public function countCommentsAction()
    {
        $query = $this->createQueryBuilder()
            ->select('COUNT(comment.id)')
            ->from('task_planner', 'comment')
            ->where('comment = :id')
            ->setParameter('id', $myID)
            ->getQuery();

        $totalcomments = $query->getSingleScalarResult();
    }
    /**
     * Finds and displays a task entity.
     *
     * @Route("/{id}", name="task_show")
     * @Method("GET")
     */

    public function showAction(Task $task)
    {
        if
        (
            !$this->getUser()
            ||
            $this->getUser()->getId() != $task->getUser()->getId()

        )

        return new Response('Not allowed!');

        $deleteForm = $this->createDeleteForm($task);

        return $this->render('task/show.html.twig', array(
            'task' => $task,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing task entity.
     *
     * @Route("/{id}/edit", name="task_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Task $task)
    {
        if ($task->getCompleted() == true) {                            //unable to edit completed tasks
            return $this->redirect($this->generateUrl('task_index', [
                'id' => $task->getId()
            ]));
        }

        if (                                                             // unable to edit if created by other user
            !$this->getUser()
            ||
            $this->getUser()->getId() != $task->getUser()->getId()
        )

            return new Response('Not allowed!');

        $deleteForm = $this->createDeleteForm($task);
        $editForm = $this->createForm('TaskBundle\Form\TaskType', $task);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('task_edit', array('id' => $task->getId()));
        }

        return $this->render('task/edit.html.twig', array(
            'task' => $task,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a task entity.
     *
     * @Route("/{id}", name="task_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Task $task)
    {
        if ($task->getCompleted() == true) {                            //unable to delete completed tasks
            return $this->redirect($this->generateUrl('task_index', [
                'id' => $task->getId()
            ]));
        }


        if (
            !$this->getUser()                                         // unable to delete if created by other user
            ||
            $this->getUser()->getId() != $task->getUser()->getId()
        )
            return new Response('Not allowed!');

        $form = $this->createDeleteForm($task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($task);
            $em->flush($task);
        }

        return $this->redirectToRoute('task_index');
    }

    /**
     * Creates a form to delete a task entity.
     *
     * @param Task $task The task entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Task $task)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('task_delete', array('id' => $task->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
