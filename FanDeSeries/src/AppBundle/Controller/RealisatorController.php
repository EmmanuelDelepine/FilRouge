<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Realisator;
use AppBundle\Form\RealisatorType;

/**
 * Realisator controller.
 *
 * @Route("/realisator")
 */
class RealisatorController extends Controller
{
    /**
     * Lists all Realisator entities.
     *
     * @Route("/", name="realisator_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $realisators = $em->getRepository('AppBundle:Realisator')->findAll();

        return $this->render('realisator/index.html.twig', array(
            'realisators' => $realisators,
        ));
    }

    /**
     * Creates a new Realisator entity.
     *
     * @Route("/new", name="realisator_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $realisator = new Realisator();
        $form = $this->createForm('AppBundle\Form\RealisatorType', $realisator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($realisator);
            $em->flush();

            return $this->redirectToRoute('realisator_show', array('id' => $realisator->getId()));
        }

        return $this->render('realisator/new.html.twig', array(
            'realisator' => $realisator,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Realisator entity.
     *
     * @Route("/{id}", name="realisator_show")
     * @Method("GET")
     */
    public function showAction(Realisator $realisator)
    {
        $deleteForm = $this->createDeleteForm($realisator);

        return $this->render('realisator/show.html.twig', array(
            'realisator' => $realisator,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Realisator entity.
     *
     * @Route("/{id}/edit", name="realisator_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Realisator $realisator)
    {
        $deleteForm = $this->createDeleteForm($realisator);
        $editForm = $this->createForm('AppBundle\Form\RealisatorType', $realisator);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($realisator);
            $em->flush();

            return $this->redirectToRoute('realisator_edit', array('id' => $realisator->getId()));
        }

        return $this->render('realisator/edit.html.twig', array(
            'realisator' => $realisator,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Realisator entity.
     *
     * @Route("/{id}", name="realisator_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Realisator $realisator)
    {
        $form = $this->createDeleteForm($realisator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($realisator);
            $em->flush();
        }

        return $this->redirectToRoute('realisator_index');
    }

    /**
     * Creates a form to delete a Realisator entity.
     *
     * @param Realisator $realisator The Realisator entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Realisator $realisator)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('realisator_delete', array('id' => $realisator->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
