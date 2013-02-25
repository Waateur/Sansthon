<?php

namespace Sansthon\ProdBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sansthon\ProdBundle\Entity\Etape;
use Sansthon\ProdBundle\Form\EtapeType;

/**
 * Etape controller.
 *
 * @Route("/etape")
 */
class EtapeController extends Controller
{
    /**
     * Lists all Etape entities.
     *
     * @Route("/", name="etape")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SansthonProdBundle:Etape')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Etape entity.
     *
     * @Route("/", name="etape_create")
     * @Method("POST")
     * @Template("SansthonProdBundle:Etape:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Etape();
        $form = $this->createForm(new EtapeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('etape_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Etape entity.
     *
     * @Route("/new", name="etape_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Etape();
        $form   = $this->createForm(new EtapeType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Etape entity.
     *
     * @Route("/{id}", name="etape_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Etape')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Etape entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Etape entity.
     *
     * @Route("/{id}/edit", name="etape_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Etape')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Etape entity.');
        }

        $editForm = $this->createForm(new EtapeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Etape entity.
     *
     * @Route("/{id}", name="etape_update")
     * @Method("PUT")
     * @Template("SansthonProdBundle:Etape:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Etape')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Etape entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EtapeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('etape_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Etape entity.
     *
     * @Route("/{id}", name="etape_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SansthonProdBundle:Etape')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Etape entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('etape'));
    }

    /**
     * Creates a form to delete a Etape entity by id.
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
