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
   * add a Etat new attributed and etape linked entity.
   *
   * @Route("/add", name="etat_add")
   * @Method("POST")
   */
  public function addAction(Request $request)
  {
    /* Verification de l'existance des params indispensable Type Etape Quantite*/


    $type = $this->getDoctrine()
      ->getRepository('SansthonProdBundle:Type')
      ->find($request->request->get('type'));
    if(!$type) {
      throw $this->createNotFoundException('The Type was not found');
    }
    $personne= $this->getDoctrine()
      ->getRepository('SansthonProdBundle:Personne')
      ->find($request->request->get('personne'));

    $etape = $this->getDoctrine()
      ->getRepository('SansthonProdBundle:Etape')
      ->find($request->request->get('etape'));
    if(!$etape) {
      throw $this->createNotFoundException('The etape was not found');
    }

    $quantite=$request->request->get('quantite');
    if(!$quantite){
      throw new \Exception('No quantity given');
    }
    if($request->request->get('prevue')){
      $prevue= new \Datetime($request->request->get('prevue'));
    }else {
      $prevue = null;
    }
    /* On préléve la quantite à l'etape d'origine si il y en a une*/
    $origin= $this->getDoctrine()
      ->getRepository('SansthonProdBundle:Etape')
      ->find($request->request->get('origin'));
    if($origin){
      $stockOrigin= $this->getDoctrine()
        ->getRepository('SansthonProdBundle:Stock')
        ->getByEtapeAndType($origin,$type);
      $stockOrigin->subValue($quantite);
    }
    $newEtat = new Etat();
    $newEtat->setType($type)
      ->setEtapeorigine($origin)
      ->setPrevue($prevue)
      ->setEtape($etape)
      ->setPersonne($personne)
      ->setQuantite($quantite);
    $em = $this->getDoctrine()->getManager();
    $em->persist($newEtat);
    $em->flush();
    $this->get('session')->getFlashBag()->add('success', 'Etat N°'.$newEtat->getId().'.  '.$newEtat->getQuantite().' "'.$newEtat->getType().' '.$newEtat->getType()->getNom().'" en '.$newEtat->getEtape()->getNom().' lancé'); 
    return $this->redirect($this->getRequest()->headers->get("referer"));
  }


  /**
   * Cancel an Etat and Give back quantite to origin
   *
   *@Route("/cancel/{id}",name="etat_cancel")
   *
   *
   */
  public function cancel(Request $request,$id){
    $repo=$this->getDoctrine()
      ->getRepository('SansthonProdBundle:Etat');
    $etat =$repo->find($id);
    $this->get('session')->getFlashBag()->add('notice', 'Etat N°'.$etat->getId()." annulé.".$etat->getEtape()." de ".$etat->getType().' '.$etat->getType()->getNom().' incrémenté de '.$etat->getQuantite()."."  ); 
    
    $repo->cancel($id);
    return $this->redirect($this->getRequest()->headers->get("referer"));
  }


  /**
   * Show Entity filter by a type.
   *
   * @Route("/bytype", name="etat_by_type")
   * @Template("SansthonProdBundle:Etat:bytype.html.twig")
   */
  public function byTypeAction(Request $request){
    $id=$request->query->get('id');
    $typeList= $this->getDoctrine()
      ->getRepository('SansthonProdBundle:Type')
      ->findAll();

    if(empty($id)){
      return array(
          'types' => $typeList,
          'type' => null,
          'etatList' => null,
          'stocks' =>array(),
          );
    }
    $currentType= $this->getDoctrine()
      ->getRepository('SansthonProdBundle:Type')
      ->find($id);
    $stockList = $this->getDoctrine()
      ->getRepository('SansthonProdBundle:Stock')
      ->getByType($currentType);
    $etatList =$this->getDoctrine()
      ->getRepository('SansthonProdBundle:Etat')
      ->findBy(array("type" => $currentType,"fin" => null, "stocked" => false ));
    return array(
        'etatList' => $etatList,
        'types' => $typeList,
        'type' => $currentType,
        'stocks' => $stockList,
        );

  }


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
