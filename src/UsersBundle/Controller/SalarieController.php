<?php

namespace UsersBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UsersBundle\Entity\Salarie;
use UsersBundle\Form\SalarieType;

/**
 * Salarie controller.
 *
 * @Route("/salarie")
 */
class SalarieController extends Controller
{
    /**
     * Lists all Salarie entities.
     *
     * @Route("/", name="salarie_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $salaries = $em->getRepository('UsersBundle:Salarie')->findAll();

        return $this->render('salarie/index.html.twig', array(
            'salaries' => $salaries,
        ));
    }

    /**
     * Creates a new Salarie entity.
     *
     * @Route("/new", name="salarie_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $salarie = new Salarie();
        $form = $this->createForm('UsersBundle\Form\SalarieType', $salarie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($salarie);
            $em->flush();

            return $this->redirectToRoute('salarie_show', array('id' => $salarie->getId()));
        }

        return $this->render('salarie/new.html.twig', array(
            'salarie' => $salarie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Salarie entity.
     *
     * @Route("/{id}", name="salarie_show")
     * @Method("GET")
     */
    public function showAction(Salarie $salarie)
    {
        $deleteForm = $this->createDeleteForm($salarie);

        return $this->render('salarie/show.html.twig', array(
            'salarie' => $salarie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Salarie entity.
     *
     * @Route("/{id}/edit", name="salarie_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Salarie $salarie)
    {
        $deleteForm = $this->createDeleteForm($salarie);
        $editForm = $this->createForm('UsersBundle\Form\SalarieType', $salarie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($salarie);
            $em->flush();

            return $this->redirectToRoute('salarie_edit', array('id' => $salarie->getId()));
        }

        return $this->render('salarie/edit.html.twig', array(
            'salarie' => $salarie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Salarie entity.
     *
     * @Route("/{id}", name="salarie_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Salarie $salarie)
    {
        $form = $this->createDeleteForm($salarie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($salarie);
            $em->flush();
        }

        return $this->redirectToRoute('salarie_index');
    }

    /**
     * Creates a form to delete a Salarie entity.
     *
     * @param Salarie $salarie The Salarie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Salarie $salarie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('salarie_delete', array('id' => $salarie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
