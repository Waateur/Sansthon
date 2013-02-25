<?php

namespace Sansthon\ProdBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sansthon\ProdBundle\Entity\Etapefille;
use Sansthon\ProdBundle\Form\EtapefilleType;

/**
 * Etapefille controller.
 *
 * @Route("/etapefille")
 */
class EtapefilleController extends Controller
{
    /**
     * Lists all Etapefille entities.
     *
     * @Route("/", name="etapefille")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SansthonProdBundle:Etapefille')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Etapefille entity.
     *
     * @Route("/", name="etapefille_create")
     * @Method("POST")
     * @Template("SansthonProdBundle:Etapefille:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Etapefille();
        $form = $this->createForm(new EtapefilleType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('etapefille_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Etapefille entity.
     *
     * @Route("/new", name="etapefille_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Etapefille();
        $form   = $this->createForm(new EtapefilleType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Etapefille entity.
     *
     * @Route("/{id}", name="etapefille_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Etapefille')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Etapefille entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Etapefille entity.
     *
     * @Route("/{id}/edit", name="etapefille_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Etapefille')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Etapefille entity.');
        }

        $editForm = $this->createForm(new EtapefilleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Etapefille entity.
     *
     * @Route("/{id}", name="etapefille_update")
     * @Method("PUT")
     * @Template("SansthonProdBundle:Etapefille:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SansthonProdBundle:Etapefille')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Etapefille entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EtapefilleType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('etapefille_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Etapefille entity.
     *
     * @Route("/{id}", name="etapefille_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SansthonProdBundle:Etapefille')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Etapefille entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('etapefille'));
    }

    /**
     * Creates a form to delete a Etapefille entity by id.
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
