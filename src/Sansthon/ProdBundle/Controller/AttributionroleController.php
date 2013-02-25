<?php

namespace Sansthon\ProdBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sansthon\ProdBundle\Entity\Attributionrole;
use Sansthon\ProdBundle\Form\AttributionroleType;

/**
 * Attributionrole controller.
 *
 * @Route("/attributionrole")
 */
class AttributionroleController extends Controller
{
    /**
     * Lists all Attributionrole entities.
     *
     * @Route("/", name="attributionrole")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SansthonProdBundle:Attributionrole')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Attributionrole entity.
     *
     * @Route("/", name="attributionrole_create")
     * @Method("POST")
     * @Template("SansthonProdBundle:Attributionrole:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Attributionrole();
        $form = $this->createForm(new AttributionroleType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attributionrole_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Attributionrole entity.
     *
     * @Route("/new", name="attributionrole_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Attributionrole();
        $form   = $this->createForm(new AttributionroleType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Attributionrole entity.
     *
     * @Route("/{id}", name="attributionrole_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Attributionrole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attributionrole entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Attributionrole entity.
     *
     * @Route("/{id}/edit", name="attributionrole_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Attributionrole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attributionrole entity.');
        }

        $editForm = $this->createForm(new AttributionroleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Attributionrole entity.
     *
     * @Route("/{id}", name="attributionrole_update")
     * @Method("PUT")
     * @Template("SansthonProdBundle:Attributionrole:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Attributionrole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attributionrole entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AttributionroleType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attributionrole_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Attributionrole entity.
     *
     * @Route("/{id}", name="attributionrole_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SansthonProdBundle:Attributionrole')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Attributionrole entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('attributionrole'));
    }

    /**
     * Creates a form to delete a Attributionrole entity by id.
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
