<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Individual;
use AppBundle\Form\IndividualType;

/**
 * Individual controller.
 *
 * @Route("/individual")
 */
class IndividualController extends Controller
{
    /**
     * Lists all Individual entities.
     *
     * @Route("/", name="individual_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $individuals = $em->getRepository('AppBundle:Individual')->findAll();

        return $this->render('individual/index.html.twig', array(
            'individuals' => $individuals,
        ));
    }

    /**
     * Creates a new Individual entity.
     *
     * @Route("/new", name="individual_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $individual = new Individual();
        $form = $this->createForm('AppBundle\Form\IndividualType', $individual);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($individual);
            $em->flush();

            return $this->redirectToRoute('individual_show', array('id' => $individual->getId()));
        }

        return $this->render('individual/new.html.twig', array(
            'individual' => $individual,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Individual entity.
     *
     * @Route("/{id}", name="individual_show")
     * @Method("GET")
     */
    public function showAction(Individual $individual)
    {
        $deleteForm = $this->createDeleteForm($individual);

        return $this->render('individual/show.html.twig', array(
            'individual' => $individual,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Individual entity.
     *
     * @Route("/{id}/edit", name="individual_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Individual $individual)
    {
        $deleteForm = $this->createDeleteForm($individual);
        $editForm = $this->createForm('AppBundle\Form\IndividualType', $individual);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($individual);
            $em->flush();

            return $this->redirectToRoute('individual_edit', array('id' => $individual->getId()));
        }

        return $this->render('individual/edit.html.twig', array(
            'individual' => $individual,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Individual entity.
     *
     * @Route("/{id}", name="individual_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Individual $individual)
    {
        $form = $this->createDeleteForm($individual);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($individual);
            $em->flush();
        }

        return $this->redirectToRoute('individual_index');
    }

    /**
     * Creates a form to delete a Individual entity.
     *
     * @param Individual $individual The Individual entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Individual $individual)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('individual_delete', array('id' => $individual->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
