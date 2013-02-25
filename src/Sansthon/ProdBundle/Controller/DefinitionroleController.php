<?php

namespace Sansthon\ProdBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sansthon\ProdBundle\Entity\Definitionrole;
use Sansthon\ProdBundle\Form\DefinitionroleType;

/**
 * Definitionrole controller.
 *
 * @Route("/definitionrole")
 */
class DefinitionroleController extends Controller
{
    /**
     * Lists all Definitionrole entities.
     *
     * @Route("/", name="definitionrole")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SansthonProdBundle:Definitionrole')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Definitionrole entity.
     *
     * @Route("/", name="definitionrole_create")
     * @Method("POST")
     * @Template("SansthonProdBundle:Definitionrole:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Definitionrole();
        $form = $this->createForm(new DefinitionroleType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('definitionrole_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Definitionrole entity.
     *
     * @Route("/new", name="definitionrole_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Definitionrole();
        $form   = $this->createForm(new DefinitionroleType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Definitionrole entity.
     *
     * @Route("/{id}", name="definitionrole_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Definitionrole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Definitionrole entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Definitionrole entity.
     *
     * @Route("/{id}/edit", name="definitionrole_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Definitionrole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Definitionrole entity.');
        }

        $editForm = $this->createForm(new DefinitionroleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Definitionrole entity.
     *
     * @Route("/{id}", name="definitionrole_update")
     * @Method("PUT")
     * @Template("SansthonProdBundle:Definitionrole:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Definitionrole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Definitionrole entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DefinitionroleType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('definitionrole_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Definitionrole entity.
     *
     * @Route("/{id}", name="definitionrole_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SansthonProdBundle:Definitionrole')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Definitionrole entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('definitionrole'));
    }

    /**
     * Creates a form to delete a Definitionrole entity by id.
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
