<?php

namespace Sansthon\ProdBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sansthon\ProdBundle\Entity\Etat;
use Sansthon\ProdBundle\Form\EtatType;

/**
 * Etat controller.
 *
 * @Route("/etat")
 */
class EtatController extends Controller
{
    /**
     * Lists all Etat entities.
     *
     * @Route("/", name="etat")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SansthonProdBundle:Etat')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Etat entity.
     *
     * @Route("/", name="etat_create")
     * @Method("POST")
     * @Template("SansthonProdBundle:Etat:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Etat();
        $form = $this->createForm(new EtatType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('etat_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Etat entity.
     *
     * @Route("/new", name="etat_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Etat();
        $form   = $this->createForm(new EtatType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Etat entity.
     *
     * @Route("/{id}", name="etat_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Etat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Etat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Etat entity.
     *
     * @Route("/{id}/edit", name="etat_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Etat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Etat entity.');
        }

        $editForm = $this->createForm(new EtatType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Etat entity.
     *
     * @Route("/{id}", name="etat_update")
     * @Method("PUT")
     * @Template("SansthonProdBundle:Etat:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Etat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Etat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EtatType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('etat_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Etat entity.
     *
     * @Route("/{id}", name="etat_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SansthonProdBundle:Etat')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Etat entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('etat'));
    }

    /**
     * Creates a form to delete a Etat entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
