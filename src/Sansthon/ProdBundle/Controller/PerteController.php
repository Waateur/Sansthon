<?php

namespace Sansthon\ProdBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sansthon\ProdBundle\Entity\Perte;
use Sansthon\ProdBundle\Form\PerteType;

/**
 * Perte controller.
 *
 * @Route("/perte")
 */
class PerteController extends Controller
{
    /**
     * Lists all Perte entities.
     *
     * @Route("/", name="perte")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SansthonProdBundle:Perte')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Perte entity.
     *
     * @Route("/", name="perte_create")
     * @Method("POST")
     * @Template("SansthonProdBundle:Perte:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Perte();
        $form = $this->createForm(new PerteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('perte_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Perte entity.
     *
     * @Route("/new", name="perte_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Perte();
        $form   = $this->createForm(new PerteType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Perte entity.
     *
     * @Route("/{id}", name="perte_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Perte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Perte entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Perte entity.
     *
     * @Route("/{id}/edit", name="perte_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Perte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Perte entity.');
        }

        $editForm = $this->createForm(new PerteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Perte entity.
     *
     * @Route("/{id}", name="perte_update")
     * @Method("PUT")
     * @Template("SansthonProdBundle:Perte:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Perte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Perte entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PerteType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('perte_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Perte entity.
     *
     * @Route("/{id}", name="perte_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SansthonProdBundle:Perte')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Perte entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('perte'));
    }

    /**
     * Creates a form to delete a Perte entity by id.
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
